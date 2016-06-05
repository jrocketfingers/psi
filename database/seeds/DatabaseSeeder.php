<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Admin;
use App\Role;
use App\Team;
use App\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tableNames as $name) {
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }

        Model::unguard();

    	$this->call(AdminsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);

        Model::reguard();

        Schema::enableForeignKeyConstraints();
    }
}
