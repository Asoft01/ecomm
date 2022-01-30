<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\NewsletterSubscriber;

class NewsletterSubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscribersRecords = [
            ['id' => 1, 'email' => 'lekhad19@gmail.com', 'status' => 1],
            ['id' => 2, 'email' => 'amit200@gmail.com', 'status' => 1]
        ];

        NewsletterSubscriber::insert($subscribersRecords);
    }
}
