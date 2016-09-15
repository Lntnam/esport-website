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
        $this->call(InterestSeeder::class);
        $this->call(SubscriberSeeder::class);

        \App\Models\SiteSetting::where('key', 'physical-address')->delete();
        \App\Models\SiteSetting::create(array(
            'key'           => 'physical-address',
            'title'         => trans('contents.physical_address'),
            'hint'          => 'for emails',
            'value'         => '',
            'lines'         => 1,
            'order'         => 5,
        ));
    }
}
