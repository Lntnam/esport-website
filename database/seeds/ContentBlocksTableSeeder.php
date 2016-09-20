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
                'id' => '2',
                'view' => 'front-home',
                'key' => 'intro_sub_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 18:55:31',
                'updated_at' => '2016-09-20 18:55:31',
            ),
            1 => 
            array (
                'id' => '3',
                'view' => 'front-home',
                'key' => 'heading_dota2',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:00:16',
                'updated_at' => '2016-09-20 19:00:16',
            ),
            2 => 
            array (
                'id' => '4',
                'view' => 'front-home',
                'key' => 'intro_dota2',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:00:47',
                'updated_at' => '2016-09-20 19:00:47',
            ),
            3 => 
            array (
                'id' => '5',
                'view' => 'front-home',
                'key' => 'heading_lol',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:01:10',
                'updated_at' => '2016-09-20 19:01:10',
            ),
            4 => 
            array (
                'id' => '6',
                'view' => 'front-home',
                'key' => 'intro_lol',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:01:30',
                'updated_at' => '2016-09-20 19:01:30',
            ),
            5 => 
            array (
                'id' => '7',
                'view' => 'front-home',
                'key' => 'intro_nextgen',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:01:49',
                'updated_at' => '2016-09-20 19:01:49',
            ),
            6 => 
            array (
                'id' => '8',
                'view' => 'front-home',
                'key' => 'heading_nextgen',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:01:50',
                'updated_at' => '2016-09-20 19:01:50',
            ),
            7 => 
            array (
                'id' => '9',
                'view' => 'front-home',
                'key' => 'heading_subscription',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:02:06',
                'updated_at' => '2016-09-20 19:02:06',
            ),
            8 => 
            array (
                'id' => '10',
                'view' => 'match-dota2_fixtures',
                'key' => 'page_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:33:18',
                'updated_at' => '2016-09-20 19:33:18',
            ),
            9 => 
            array (
                'id' => '11',
                'view' => 'match-dota2_fixtures',
                'key' => 'sub_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:34:02',
                'updated_at' => '2016-09-20 19:34:02',
            ),
            10 => 
            array (
                'id' => '13',
                'view' => 'match-dota2_fixtures',
                'key' => 'live_heading',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:34:35',
                'updated_at' => '2016-09-20 19:34:35',
            ),
            11 => 
            array (
                'id' => '14',
                'view' => 'match-dota2_fixtures',
                'key' => 'upcoming_heading',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:34:41',
                'updated_at' => '2016-09-20 19:34:41',
            ),
            12 => 
            array (
                'id' => '15',
                'view' => 'match-dota2_fixtures',
                'key' => 'recent_heading',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:34:47',
                'updated_at' => '2016-09-20 19:34:47',
            ),
            13 => 
            array (
                'id' => '16',
                'view' => 'match-dota2_fixtures',
                'key' => 'subscribe_heading',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:35:25',
                'updated_at' => '2016-09-20 19:35:25',
            ),
            14 => 
            array (
                'id' => '17',
                'view' => 'match-dota2_results',
                'key' => 'sub_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:40:43',
                'updated_at' => '2016-09-20 19:40:43',
            ),
            15 => 
            array (
                'id' => '18',
                'view' => 'match-dota2_results',
                'key' => 'page_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:40:44',
                'updated_at' => '2016-09-20 19:40:44',
            ),
            16 => 
            array (
                'id' => '20',
                'view' => 'subscription-subscribe',
                'key' => 'sub_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:49:25',
                'updated_at' => '2016-09-20 19:49:25',
            ),
            17 => 
            array (
                'id' => '21',
                'view' => 'subscription-subscribe',
                'key' => 'page_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:49:27',
                'updated_at' => '2016-09-20 19:49:27',
            ),
            18 => 
            array (
                'id' => '22',
                'view' => 'subscription-confirmation',
                'key' => 'successful_text',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:55:49',
                'updated_at' => '2016-09-20 19:55:49',
            ),
            19 => 
            array (
                'id' => '23',
                'view' => 'subscription-confirmation',
                'key' => 'page_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:55:51',
                'updated_at' => '2016-09-20 19:55:51',
            ),
            20 => 
            array (
                'id' => '24',
                'view' => 'subscription-confirmation',
                'key' => 'unsuccessful_text',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:56:30',
                'updated_at' => '2016-09-20 19:56:30',
            ),
            21 => 
            array (
                'id' => '25',
                'view' => 'subscription-confirmation',
                'key' => 'sub_header',
                'description' => 'Auto created.',
                'created_at' => '2016-09-20 19:56:47',
                'updated_at' => '2016-09-20 19:56:47',
            ),
        ));
    }
}
