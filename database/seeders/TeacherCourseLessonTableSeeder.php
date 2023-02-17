<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\FileLesson;
use App\Models\TeacherCourseLesson;
use App\Models\User;
use App\Models\VideoLesson;
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
        $model = TeacherCourseLesson::first();
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
                    'number' => '1',
                    'title' => 'asymptotic notations',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '2',
                    'title' => 'Time complexity Analysis of iterative programs',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '3',
                    'title' => 'comparing various functions to analyse time complexity',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course2->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '1',
                    'title' => 'C Introduction',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course2->id,
                    'teacher_id' => $teacher1->id,
                    'number' => '2',
                    'title' => 'How Computer Programs Work',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher2->id,
                    'number' => '1',
                    'title' => 'Lesson one',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'course_id' => $course1->id,
                    'teacher_id' => $teacher2->id,
                    'number' => '2',
                    'title' => 'Lesson two',
                    'description' => null,
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            TeacherCourseLesson::insert($data);

            $teacherCourseLesson1 = TeacherCourseLesson::where('title','asymptotic notations')->first();
            $teacherCourseLesson2 = TeacherCourseLesson::where('title','Time complexity Analysis of iterative programs')->first();
            $teacherCourseLesson3 = TeacherCourseLesson::where('title','comparing various functions to analyse time complexity')->first();
            $teacherCourseLesson4 = TeacherCourseLesson::where('title','C Introduction')->first();
            $teacherCourseLesson5 = TeacherCourseLesson::where('title','How Computer Programs Work')->first();

            $dataForVideoSource = [
                [
                    'lesson_id' => $teacherCourseLesson1->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'Video - 1',
                    'video_title' => 'Algorithms Lecture 1 -- Introduction to asymptotic notations',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/aGjL7YXI31Q',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson2->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'Video - 2',
                    'video_title' => 'Algorithms lecture 2 -- Time complexity Analysis of iterative programs',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/FEnwM-iDb2g',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson3->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'Video - 3',
                    'video_title' => 'Algorithms lecture 4 -- comparing various functions to analyse time complexity',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/aORkZXcjlIs',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson4->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'Video - 1',
                    'video_title' => 'C Programming Tutorial - 1 - Introduction',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/2NWeucMKrLI',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson4->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'Video - 2',
                    'video_title' => 'C Programming Tutorial - 2 - Setting Up Code Blocks',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/3DeLiClDd04',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson5->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'Video - 3',
                    'video_title' => 'C Programming Tutorial - 3 - How Computer Programs Work',
                    'description' => null,
                    'video_embed_url' => 'https://www.youtube.com/embed/iWx3yyFMWQA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            VideoLesson::insert($dataForVideoSource);

            $dataForFilesSource = [
                [
                    'lesson_id' => $teacherCourseLesson1->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'File - 1',
                    'file_title' => 'Asymptotic Growth of Functions',
                    'description' => null,
                    'file_url' => 'https://classes.soe.ucsc.edu/cmps102/Spring04/TantaloAsymp.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson2->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'File - 2',
                    'file_title' => 'Algorithms: analysis, complexity',
                    'description' => null,
                    'file_url' => 'https://ocw.mit.edu/courses/civil-and-environmental-engineering/1-204-computer-algorithms-in-systems-engineering-spring-2010/lecture-notes/MIT1_204S10_lec05.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson3->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'File - 3',
                    'file_title' => 'comparing various functions to analyse time complexity',
                    'description' => null,
                    'file_url' => 'https://www.cs.duke.edu/courses/summer10/cps130/files/L2-Analysis.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson4->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'File - 1',
                    'file_title' => 'C Programming Introduction',
                    'description' => null,
                    'file_url' => 'https://www.tutorialspoint.com/cprogramming/cprogramming_tutorial.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson4->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'File - 2',
                    'file_title' => 'C Programming Setting Up Code Blocks',
                    'description' => null,
                    'file_url' => 'http://www.codeblocks.org/docs/manual_en.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lesson_id' => $teacherCourseLesson5->id,
                    'teacher_id' => $teacher1->id,
                    'part_number' => 'File - 3',
                    'file_title' => 'C Programming How Computer Programs Work',
                    'description' => null,
                    'file_url' => 'https://www.tutorialspoint.com/computer_programming/computer_programming_tutorial.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            FileLesson::insert($dataForFilesSource);
        }
    }
}
