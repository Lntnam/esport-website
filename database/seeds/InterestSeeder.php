<?php

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interests')->delete();

        Interest::create(array(
            'mail_chimp_id'     => 'd796835b62',
            'name'              => 'Fixtures & results',
        ));
    }
}
