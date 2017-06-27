<?php

use Illuminate\Database\Seeder;

class HostingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hosting::class, 3)->create();
    }
}
