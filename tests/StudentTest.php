<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\TestDummy\Factory;
use App\Student;
use App\User;

class StudentTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A students test.
     *
     * @return void
     */
    public function testStudents()
    {
        $student = Student::create([
            "name" => "Test User",
            "email" => "test@test.test",
            "password" => "pass"
        ]);

        eval(\Psy\sh());

        $this->assertEquals($student->user->id, $user);
        $this->assertTrue(true);
    }
}
