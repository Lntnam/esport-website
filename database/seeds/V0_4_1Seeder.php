<?php

use App\Models\MasterList;
use Illuminate\Database\Seeder;

class V0_4_1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create donation master lists
        MasterList::create([
            'key'   => 'donation-targets',
            'value' => json_encode(['wesg-apac-2016' => 20000000]),
        ]);

        MasterList::create([
            'key'   => 'donation-sources',
            'value' => json_encode([
                'wesg-apac-2016' => [
                    'paypal' => 0,
                    'bank'   => 0,
                    'card'   => 0,
                    'others' => 0,
                ],
            ]),
        ]);

        MasterList::create([
            'key'   => 'back_games',
            'value' => json_encode([
                'dota2' => 'DotA 2',
                'lol'   => 'League of Legends',
            ]),
        ]);

        DB::table('matches')->update(['game' => 'dota2']);
        DB::table('opponents')->update(['game' => 'dota2']);
        DB::table('tournaments')->update(['game' => 'dota2']);
    }
}
