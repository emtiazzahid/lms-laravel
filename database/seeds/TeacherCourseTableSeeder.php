<?php

use Illuminate\Database\Seeder;

class TeacherCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = \App\Model\TeacherCourse::first();
        if (empty($model)) {
            $teacher1 = \App\User::where('email','teacher@mail.com')->first();
            $teacher2 = \App\User::where('email','teacher2@mail.com')->first();

            $course1 = \App\Model\Course::where('title','Algorithms & Data Structures')->first();
            $course2 = \App\Model\Course::where('title','Programming in the Large')->first();
            $course3 = \App\Model\Course::where('title','Discrete Mathematics')->first();
            $data = [
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher1->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course2->id,
                    'teacher_id' => $teacher1->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course3->id,
                    'teacher_id' => $teacher1->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher2->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];
            \App\Model\TeacherCourse::insert($data);
        }
    }
}
