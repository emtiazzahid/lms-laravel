<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Libraries\Enumerations\UserTypes;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'admin@mail.com')->first();
        if (empty($admin)) {
            $admin = new User();
            $admin->name = 'Admin';
            $admin->email = 'admin@mail.com';
            $admin->password = bcrypt('123');
            $admin->user_type = UserTypes::$ADMIN;
            $admin->save();
        }
        $teacher = User::where('email', 'teacher@mail.com')->first();
        if (empty($teacher)) {
            $teacher = new User();
            $teacher->name = 'Teacher';
            $teacher->email = 'teacher@mail.com';
            $teacher->password = bcrypt('123');
            $teacher->user_type = UserTypes::$TEACHER;
            $teacher->save();
        }
        $student = User::where('email', 'student@mail.com')->first();
        if (empty($student)) {
            $student = new User();
            $student->name = 'Student';
            $student->email = 'student@mail.com';
            $student->password = bcrypt('123');
            $student->user_type = UserTypes::$STUDENT;
            $student->save();
        }

    }
}