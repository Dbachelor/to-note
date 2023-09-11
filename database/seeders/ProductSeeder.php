<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $i = 0;
        while ($i < 20) {
            DB::table('products')->insert([
                'name'=>'item_'.Str::random(8),
                'price'=>rand(50, 5010),
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            $i++;
        }
    }
}
