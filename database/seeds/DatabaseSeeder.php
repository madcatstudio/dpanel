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
        $this->call(HostingsTableSeeder::class);
        $this->call(MaintainersTableSeeder::class);

    }
}
