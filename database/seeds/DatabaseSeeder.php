<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CardsOfficialDeckSeeder::class);
        $this->command->info('Card table seeded with official deck');

        Model::reguard();
    }
}
