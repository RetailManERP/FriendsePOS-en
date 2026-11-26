<?php

namespace Tests\Unit;

use App\BusinessLocation;
use App\Http\Controllers\OfflineSyncController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use ReflectionMethod;
use Tests\TestCase;

class OfflineSyncBusinessLocationsTest extends TestCase
{
    public function test_location_sync_saves_warehouse_fields_and_ignores_connector_metadata(): void
    {
        config([
            'database.default' => 'location_sync_test',
            'database.connections.location_sync_test' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ],
        ]);

        $connection = DB::connection('location_sync_test');
        $schema = $connection->getSchemaBuilder();
        $schema->create('business_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id');
            $table->string('name');
            $table->string('loc_code');
            $table->string('uid');
            $table->string('location_type');
            $table->unsignedInteger('invoice_scheme_id');
            $table->text('default_payment_accounts');
            $table->text('ref_no_prefixes');
            $table->string('warehouse_type')->nullable();
            $table->unsignedInteger('warehouse_parent_location')->nullable();
            $table->timestamps();
        });
        $schema->create(config('permission.table_names.permissions'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        $controller = (new ReflectionClass(OfflineSyncController::class))->newInstanceWithoutConstructor();
        $import = new ReflectionMethod(OfflineSyncController::class, 'importBusinessLocations');
        $import->setAccessible(true);

        $payload = [
            'id' => 6,
            'business_id' => 3,
            'name' => 'Warehouse 1',
            'loc_code' => '02',
            'uid' => 'test-location-6',
            'location_type' => 'warehouse',
            'invoice_scheme_id' => 3,
            'default_payment_accounts' => '{"cash":{"is_enabled":1,"account":2}}',
            'ref_no_prefixes' => ['stock_transfer' => 'ST'],
            'warehouse_type' => 'main',
            'warehouse_parent_location' => 4,
            'invoice_scheme_prefix' => 'SSM',
            'payment_methods' => [['name' => 'cash']],
        ];

        $import->invoke($controller, [$payload]);
        $location = BusinessLocation::findOrFail(6);
        $this->assertSame('warehouse', $location->location_type);
        $this->assertSame('main', $location->warehouse_type);
        $this->assertEquals(4, $location->warehouse_parent_location);
        $this->assertEquals(3, $location->invoice_scheme_id);
        $this->assertSame($payload['default_payment_accounts'], $location->default_payment_accounts);
        $this->assertSame(['stock_transfer' => 'ST'], $location->ref_no_prefixes);

        $payload['name'] = 'Warehouse 1 Updated';
        $import->invoke($controller, [$payload]);

        $this->assertSame('Warehouse 1 Updated', $location->refresh()->name);
        $this->assertSame(1, $connection->table(config('permission.table_names.permissions'))->where('name', 'location.6')->count());
    }
}
