<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\ReturnRequest;

class ReturnRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ReturnRequestRecords = [
            ['id' => 1, 'order_id' => '1', 'user_id'=> 1, 'product_size' => 'Small', 'product_code' => 'BT001', 'return_reason' => 'Item arrived too late', 'return_status' => 'Pending', 'comment' => 'The item should have arrived earlier and it is 6days late']
        ];

        ReturnRequest::insert($ReturnRequestRecords);
    }
}
