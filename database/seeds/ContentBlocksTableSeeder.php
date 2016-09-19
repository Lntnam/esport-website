<?php

use Illuminate\Database\Seeder;

class ContentBlocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('content_blocks')->delete();
        
        \DB::table('content_blocks')->insert(array (
            0 => 
            array (
                'id' => 3,
                'key' => 'home.intro_sub_header',
                'description' => '[Home] Sub header intro message on home page',
                'created_at' => '2016-09-19 08:31:24',
                'updated_at' => '2016-09-19 08:31:24',
            ),
            1 => 
            array (
                'id' => 4,
                'key' => 'home.intro_dota2',
                'description' => '[Home] Introduction for DOTA 2 team',
                'created_at' => '2016-09-19 08:44:08',
                'updated_at' => '2016-09-19 08:44:08',
            ),
            2 => 
            array (
                'id' => 5,
                'key' => 'home.intro_lol',
                'description' => '[Home] Introduction for LOL team',
                'created_at' => '2016-09-19 08:46:22',
                'updated_at' => '2016-09-19 08:46:22',
            ),
            3 => 
            array (
                'id' => 6,
                'key' => 'home.heading_dota2',
                'description' => '[Home] Heading line for DOTA 2 team',
                'created_at' => '2016-09-19 08:49:42',
                'updated_at' => '2016-09-19 08:49:42',
            ),
            4 => 
            array (
                'id' => 7,
                'key' => 'home.heading_lol',
                'description' => '[Home] Heading line for LOL team',
                'created_at' => '2016-09-19 08:49:55',
                'updated_at' => '2016-09-19 08:49:55',
            ),
            5 => 
            array (
                'id' => 8,
                'key' => 'home.heading_nextgen',
                'description' => '[Home] Heading line for Next Gen',
                'created_at' => '2016-09-19 08:52:16',
                'updated_at' => '2016-09-19 08:52:16',
            ),
            6 => 
            array (
                'id' => 9,
                'key' => 'home.intro_nextgen',
                'description' => '[Home] Introduction for Next Gen',
                'created_at' => '2016-09-19 08:53:28',
                'updated_at' => '2016-09-19 08:53:28',
            ),
            7 => 
            array (
                'id' => 10,
                'key' => 'home.heading_subscription',
                'description' => '[Home] Heading line for subscription form',
                'created_at' => '2016-09-19 08:56:53',
                'updated_at' => '2016-09-19 08:56:53',
            ),
        ));
        
        
    }
}
