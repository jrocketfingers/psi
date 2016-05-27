<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
    		['name' => 'AI Developer',],
    		['name' => 'Backend Developer'],
    		['name' => 'Frontend Developer'],
    		['name' => 'Web Designer'],
    		['name' => 'Human Resources'],
    		['name' => 'Public Relations'],
    		['name' => 'Financials'],
    		['name' => 'Project Manager'],
		]);
    }
}
