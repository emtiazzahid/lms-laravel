<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\TeacherCourse;
use App\Models\User;
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
        $model = TeacherCourse::first();
        if (empty($model)) {
            $teacher1 = User::where('email','teacher@mail.com')->first();
            $teacher2 = User::where('email','teacher2@mail.com')->first();

            $course1 = Course::where('title','Algorithms & Data Structures')->first();
            $course2 = Course::where('title','Programming in the Large')->first();
            $course3 = Course::where('title','Discrete Mathematics')->first();
            $data = [
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher1->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course2->id,
                    'teacher_id' => $teacher1->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course3->id,
                    'teacher_id' => $teacher1->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher2->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            TeacherCourse::insert($data);
        }
    }
}
