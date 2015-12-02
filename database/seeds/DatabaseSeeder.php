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
        $this->command->info('Seeding official deck of cards');
        $this->call(CardsOfficialDeckSeeder::class);
        $this->command->info('Seeding test users');
        $this->call(TestUsersSeeder::class);

        Model::reguard();
    }
}
