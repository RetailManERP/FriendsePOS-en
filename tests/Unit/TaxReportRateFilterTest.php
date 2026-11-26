<?php

namespace Tests\Unit;

use App\Http\Controllers\ReportController;
use App\TaxRate;
use App\Transaction;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use ReflectionMethod;
use Tests\TestCase;

class TaxReportRateFilterTest extends TestCase
{
    private function invokeReportMethod(string $method, array $arguments)
    {
        $controller = (new ReflectionClass(ReportController::class))->newInstanceWithoutConstructor();
        $reflection = new ReflectionMethod(ReportController::class, $method);
        $reflection->setAccessible(true);

        return $reflection->invokeArgs($controller, $arguments);
    }

    public function test_rate_matches_invoice_tax_item_tax_scheme_tax_and_returned_items(): void
    {
        config([
            'database.default' => 'tax_report_test',
            'database.connections.tax_report_test' => ['driver' => 'sqlite', 'database' => ':memory:', 'prefix' => ''],
        ]);
        $db = DB::connection('tax_report_test');
        $schema = $db->getSchemaBuilder();
        $schema->create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id');
            $table->string('type');
            $table->unsignedInteger('tax_id')->nullable();
            $table->unsignedInteger('return_parent_id')->nullable();
            $table->softDeletes();
        });
        foreach (['purchase_lines', 'transaction_sell_lines'] as $table_name) {
            $schema->create($table_name, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('transaction_id');
                $table->unsignedInteger('tax_id')->nullable();
                $table->unsignedInteger('scheme_tax_id')->nullable();
                $table->decimal('quantity_returned')->default(0);
                $table->softDeletes();
            });
        }

        $db->table('transactions')->insert([
            ['id' => 1, 'business_id' => 1, 'type' => 'purchase', 'tax_id' => 2, 'return_parent_id' => null],
            ['id' => 2, 'business_id' => 1, 'type' => 'purchase', 'tax_id' => null, 'return_parent_id' => null],
            ['id' => 3, 'business_id' => 1, 'type' => 'purchase_return', 'tax_id' => null, 'return_parent_id' => 2],
            ['id' => 4, 'business_id' => 1, 'type' => 'purchase', 'tax_id' => 8, 'return_parent_id' => null],
            ['id' => 5, 'business_id' => 1, 'type' => 'purchase_return', 'tax_id' => null, 'return_parent_id' => 4],
            ['id' => 6, 'business_id' => 2, 'type' => 'purchase', 'tax_id' => 2, 'return_parent_id' => null],
            ['id' => 7, 'business_id' => 1, 'type' => 'sell', 'tax_id' => null, 'return_parent_id' => null],
            ['id' => 8, 'business_id' => 1, 'type' => 'expense', 'tax_id' => 5, 'return_parent_id' => null],
        ]);
        $db->table('purchase_lines')->insert([
            ['transaction_id' => 2, 'tax_id' => null, 'scheme_tax_id' => 5, 'quantity_returned' => 1],
            ['transaction_id' => 4, 'tax_id' => 2, 'scheme_tax_id' => null, 'quantity_returned' => 0],
        ]);
        $db->table('transaction_sell_lines')->insert(['transaction_id' => 7, 'tax_id' => 2]);
        $groups = [5 => ['sub_taxes' => [2 => new TaxRate(['amount' => 10])]]];

        $purchases = Transaction::where('business_id', 1)->whereIn('type', ['purchase', 'purchase_return']);
        $this->invokeReportMethod('applyTaxReportRateFilter', [$purchases, 'purchase', 2, $groups]);
        $this->assertSame([1, 2, 3, 4], $purchases->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all());

        $sales = Transaction::where('business_id', 1)->where('type', 'sell');
        $this->invokeReportMethod('applyTaxReportRateFilter', [$sales, 'sell', 2, $groups]);
        $this->assertEquals([7], $sales->pluck('id')->all());

        $expenses = Transaction::where('business_id', 1)->where('type', 'expense');
        $this->invokeReportMethod('applyTaxReportRateFilter', [$expenses, 'expense', 2, $groups]);
        $this->assertEquals([8], $expenses->pluck('id')->all());
    }

    public function test_filtered_overview_sums_only_the_selected_rate_and_its_group_share(): void
    {
        $details = ['total_tax' => 35, 'tax_details' => [
            2 => ['tax_amount' => 10],
            5 => ['tax_amount' => 15],
            8 => ['tax_amount' => 10],
        ]];
        $groups = [5 => ['sub_taxes' => [
            2 => new TaxRate(['amount' => 10]),
            8 => new TaxRate(['amount' => 5]),
        ]]];

        $this->assertSame(20.0, $this->invokeReportMethod('getTaxReportRateTotal', [$details, 2, $groups]));
        $this->assertSame(15.0, $this->invokeReportMethod('getTaxReportRateTotal', [$details, 5, $groups]));
        $this->assertSame(35.0, $this->invokeReportMethod('getTaxReportRateTotal', [$details, null, $groups]));
    }
}
