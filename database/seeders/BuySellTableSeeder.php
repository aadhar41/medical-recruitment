<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BuySell;
use App\Models\BuySellMedia;
use Illuminate\Support\Facades\DB;

class BuySellTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('buy_sells')->truncate();
        DB::table('buy_sell_media')->truncate();
        DB::statement("SET foreign_key_checks=1");

        \App\Models\BuySell::factory(10)->create()
            ->each(function ($u) {
                $u->buysellmedia()
                    ->saveMany(
                        \App\Models\BuySellMedia::factory(3)->make()
                    );
            });
    }
}
