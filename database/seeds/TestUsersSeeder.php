<?php

use Illuminate\Database\Seeder;
use Dixit\User;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$test_email_list = ['test@test.com', 'test2@test.com', 'test3@test.com'];
    	$i = 1;

        foreach($test_email_list as $email){
        	$this->command->info($email);  
        	$user = new User();
        	$user->username = 'Test User';
        	$user->email = $email;
        	$user->password = 'test';
        	$user->question = 'test';
        	$user->answer = 'test';
        	$user->save();
        	$i++;
        }
        
    }
}
