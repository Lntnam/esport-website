<?php

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class DonationTargetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('site_settings')->delete();

        SiteSetting::create(array(
            'key'           => 'donation_targets',
            'title'         => 'Donation Targets',
            'value'         => '{
  "tour_cost": 20000000,
  "month_cost": 35000000,
  "event_cost": 15000000
} ',
            'lines'         => 5,
            'order'         => 6,
        ));

        SiteSetting::create(array(
            'key'           => 'donation_values',
            'title'         => 'Donation Values',
            'value'         => '{
  "tour_cost": 0,
  "month_cost": 0,
  "event_cost": 0
} ',
            'lines'         => 5,
            'order'         => 7,
        ));
    }
}
