<?php

namespace Tests\Unit;

use App\Business;
use App\BusinessLocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DojoLocationConfigurationTest extends TestCase
{
    public function test_terminal_availability_uses_the_locations_own_dojo_key(): void
    {
        $business = (new Business())->newFromBuilder([
            'id' => 3,
            'pos_settings' => json_encode(['dojo_api_key' => 'legacy-key']),
        ]);
        $first = $this->location(3, 'terminal-a', 'account-a');
        $second = $this->location(10, 'terminal-b', 'account-b');

        $this->assertTrue($first->hasDojoTerminal($business));
        $this->assertTrue($second->hasDojoTerminal($business));
        $this->assertSame('account-a', $first->dojoApiKey($business));
        $this->assertSame('account-b', $second->dojoApiKey($business));

        $second->dojo_terminal_id = '';
        $this->assertFalse($second->hasDojoTerminal($business));
    }

    public function test_legacy_key_is_limited_to_the_primary_location(): void
    {
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');
        Schema::create('business_locations', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('business_id');
        });
        DB::table('business_locations')->insert([
            ['id' => 1, 'business_id' => 2],
            ['id' => 3, 'business_id' => 3],
            ['id' => 10, 'business_id' => 3],
        ]);
        $business = (new Business())->newFromBuilder([
            'id' => 3,
            'pos_settings' => json_encode(['dojo_api_key' => 'legacy-key']),
        ]);

        $this->assertSame('legacy-key', $this->location(3, 'terminal-a')->dojoApiKey($business));
        $this->assertFalse($this->location(10, 'terminal-b')->hasDojoTerminal($business));
        $this->assertFalse($this->location(3, 'terminal-a', '')->hasDojoTerminal($business));
    }

    private function location(int $id, string $terminal, ?string $key = null): BusinessLocation
    {
        return (new BusinessLocation())->newFromBuilder([
            'id' => $id,
            'business_id' => 3,
            'dojo_terminal_id' => $terminal,
            'loc_settings' => json_encode($key === null ? [] : [
                'business_settings' => ['pos_settings' => ['dojo_api_key' => $key]],
            ]),
        ]);
    }
}
