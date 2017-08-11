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

            $adminMeta = new \App\Model\Admin();
            $adminMeta->user_id = $admin->id;
            $adminMeta->country_code = 'bd';
            $adminMeta->iso = '880';
            $adminMeta->phone = '01763777585';
            $adminMeta->save();
        }
        $teacher = User::where('email', 'teacher@mail.com')->first();
        if (empty($teacher)) {
            $teacher = new User();
            $teacher->name = 'Teacher';
            $teacher->email = 'teacher@mail.com';
            $teacher->password = bcrypt('123');
            $teacher->user_type = UserTypes::$TEACHER;
            $teacher->save();

            $meta = new \App\Model\Teacher();
            $meta->user_id = $teacher->id;
            $meta->country_code = 'bd';
            $meta->iso = '880';
            $meta->phone = '01763777585';
            $meta->save();
        }
        $student = User::where('email', 'student@mail.com')->first();
        if (empty($student)) {
            $student = new User();
            $student->name = 'Student';
            $student->email = 'student@mail.com';
            $student->password = bcrypt('123');
            $student->user_type = UserTypes::$STUDENT;
            $student->save();
            
            $meta = new \App\Model\Student();
            $meta->user_id = $student->id;
            $meta->country_code = 'bd';
            $meta->iso = '880';
            $meta->phone = '01763777585';
            $meta->save();
        }

    }
}