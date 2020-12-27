<?php

use Illuminate\Database\Seeder;
use App\Religion;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Religion::create(['title' => 'Islam']);
        Religion::create(['title' => 'Hinduism']);
        Religion::create(['title' => 'Christianity']);
        Religion::create(['title' => 'Buddhism']);
        Religion::create(['title' => 'Other']);
    }
}
