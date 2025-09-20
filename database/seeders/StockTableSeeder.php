<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stocks')->insert([
            ['item_id' => 1, 'batch_number' => 'BATCH-A-001', 'count' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 2, 'batch_number' => 'BATCH-B-002', 'count' => 120, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 3, 'batch_number' => 'BATCH-C-003', 'count' => 75, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 4, 'batch_number' => 'BATCH-D-004', 'count' => 200, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 5, 'batch_number' => 'BATCH-E-005', 'count' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 6, 'batch_number' => 'BATCH-F-006', 'count' => 90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 7, 'batch_number' => 'BATCH-G-007', 'count' => 150, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 8, 'batch_number' => 'BATCH-H-008', 'count' => 45, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 9, 'batch_number' => 'BATCH-I-009', 'count' => 60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['item_id' => 10, 'batch_number' => 'BATCH-J-010', 'count' => 180, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
