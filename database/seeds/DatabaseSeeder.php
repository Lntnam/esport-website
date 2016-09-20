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

        factory(App\Models\Tournament::class, 10)->create();
        factory(App\Models\Opponent::class, 30)->create();
        factory(App\Models\Match::class, 50)->create();

        $this->call(InterestSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(ContentBlocksTableSeeder::class);
        $this->call(ContentBlockContentsTableSeeder::class);
    }
}
