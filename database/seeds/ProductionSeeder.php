<?php

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* For v0.3 / content block update */
        $this->call(ContentBlocksTableSeeder::class);
        $this->call(ContentBlockContentsTableSeeder::class);

        /* No harm to always run these on production */
        $this->call(InterestSeeder::class);
        $this->call(SubscriberSeeder::class);
    }
}
