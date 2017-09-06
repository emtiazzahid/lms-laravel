<?php

use Illuminate\Database\Seeder;

class TeacherCourseLessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = \App\Model\TeacherCourseLesson::first();
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
                    'number' => '1',
                    'title' => 'asymptotic notations',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '2',
                    'title' => 'Time complexity Analysis of iterative programs',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '3',
                    'title' => 'comparing various functions to analyse time complexity',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course2->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '1',
                    'title' => 'C Introduction',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course2->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '2',
                    'title' => 'How Computer Programs Work',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher2->id,
                    'number' => '1',
                    'title' => 'Lesson one',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher2->id,
                    'number' => '2',
                    'title' => 'Lesson two',
                    'description' => null,
                    'tags' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];
            \App\Model\TeacherCourseLesson::insert($data);

            $teacherCourseLesson1 = \App\Model\TeacherCourseLesson::where('title','asymptotic notations')->first();
            $teacherCourseLesson2 = \App\Model\TeacherCourseLesson::where('title','Time complexity Analysis of iterative programs')->first();
            $teacherCourseLesson3 = \App\Model\TeacherCourseLesson::where('title','comparing various functions to analyse time complexity')->first();
            $teacherCourseLesson4 = \App\Model\TeacherCourseLesson::where('title','C Introduction')->first();
            $teacherCourseLesson5 = \App\Model\TeacherCourseLesson::where('title','How Computer Programs Work')->first();

            $dataForVideoSource = [
                [
                    'lesson_id' => $teacherCourseLesson1->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => '1 (Algorithms)',
                    'video_title' => 'Algorithms Lecture 1 -- Introduction to asymptotic notations',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/aGjL7YXI31Q',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'lesson_id' => $teacherCourseLesson2->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => '2 (Algorithms)',
                    'video_title' => 'Algorithms lecture 2 -- Time complexity Analysis of iterative programs',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/FEnwM-iDb2g',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'lesson_id' => $teacherCourseLesson3->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => '3 (Algorithms)',
                    'video_title' => 'Algorithms lecture 4 -- comparing various functions to analyse time complexity',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/aORkZXcjlIs',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'lesson_id' => $teacherCourseLesson4->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => '1 (C Programming)',
                    'video_title' => 'C Programming Tutorial - 1 - Introduction',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/2NWeucMKrLI',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'lesson_id' => $teacherCourseLesson4->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => '2 (C Programming)',
                    'video_title' => 'C Programming Tutorial - 2 - Setting Up Code Blocks',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/3DeLiClDd04',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'lesson_id' => $teacherCourseLesson5->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => '3 (C Programming)',
                    'video_title' => 'C Programming Tutorial - 3 - How Computer Programs Work',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/iWx3yyFMWQA',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];
            \App\Model\VideoLesson::insert($dataForVideoSource);


        }
    }
}
