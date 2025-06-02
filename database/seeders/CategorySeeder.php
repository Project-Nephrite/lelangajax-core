<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories")
            ->insert([
                "name" => "Luxury",
                "description" => "Jewerly, Collectors items, Decorations, any items that meets the eye"
            ]);

        DB::table("categories")
            ->insert([
                "name" => "TCG Cards",
                "description" => "Collection of TCG cards, generic and limited editions"
            ]);
        DB::table("categories")
            ->insert([
                "name" => "Daily Goods",
                "description" => "Items for daily use that worth bid for"
            ])
        ;
    }
}
