<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SiteSettingSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(V0_4_1Seeder::class);
    }
}
