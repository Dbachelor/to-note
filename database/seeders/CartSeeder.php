<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (App::environment('test')){
            $i = 0;
            while ($i < 10) {
                DB::table('carts')->insert([
                    'user_id'=>rand(1,2),
                    'product_id'=>rand(1, 20),
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]);
                $i++;
            }
        }
    }
}
