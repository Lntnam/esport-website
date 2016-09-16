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
        DB::table('interests')
          ->delete();

        // Pull interests from MailChimp account
        $interests = MailChimp::getInterests();
        if ($interests === false) {
            \Log::error('Unable to get interests list: ' . MailChimp::getError()['detail']);

            return;
        }
        foreach ($interests as $interest) {
            Interest::create([
                                 'mail_chimp_id' => $interest['id'],
                                 'name'          => $interest['name'],
                                 'language_key'  => 'interest_' . $interest['id'],
                             ]);
        }
    }
}
