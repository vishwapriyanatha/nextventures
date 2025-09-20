<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('items')->insert([
            ['name' => 'Laptop', 'item_code' => 'ORD-1001', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mouse', 'item_code' => 'ORD-1002', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Keyboard', 'item_code' => 'ORD-1003', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Monitor', 'item_code' => 'ORD-1004', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Headphones', 'item_code' => 'ORD-1005', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Webcam', 'item_code' => 'ORD-1006', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Microphone', 'item_code' => 'ORD-1007', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'USB Drive', 'item_code' => 'ORD-1008', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'External Hard Drive', 'item_code' => 'ORD-1009', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Router', 'item_code' => 'ORD-1010', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
