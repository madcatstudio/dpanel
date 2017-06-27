<?php

use Illuminate\Database\Seeder;

class MaintainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Maintainer::class, 3)->create();
    }
}
