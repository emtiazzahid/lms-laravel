<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = \App\Models\Question::first();
        if (empty($model)) {
            $teacherCourseLesson1 = \App\Models\TeacherCourseLesson::where('title','asymptotic notations')->first();

            $lesson1VideoPart1 = \App\Models\VideoLesson::where('lesson_id',$teacherCourseLesson1->id)->first();
            $lesson1FilePart1 = \App\Models\FileLesson::where('lesson_id',$teacherCourseLesson1->id)->first();

            $teacherCourseLesson2 = \App\Models\TeacherCourseLesson::where('title','Time complexity Analysis of iterative programs')->first();

            $lesson2VideoPart1 = \App\Models\VideoLesson::where('lesson_id',$teacherCourseLesson2->id)->first();
            $lesson2FilePart1 = \App\Models\FileLesson::where('lesson_id',$teacherCourseLesson2->id)->first();

            $teacherCourseLesson3 = \App\Models\TeacherCourseLesson::where('title','comparing various functions to analyse time complexity')->first();
            $teacherCourseLesson4 = \App\Models\TeacherCourseLesson::where('title','C Introduction')->first();

            $lesson4VideoPart1 = \App\Models\VideoLesson::where('lesson_id',$teacherCourseLesson4->id)->first();
            $lesson4FilePart1 = \App\Models\FileLesson::where('lesson_id',$teacherCourseLesson4->id)->first();


            $teacherCourseLesson5 = \App\Models\TeacherCourseLesson::where('title','How Computer Programs Work')->first();

            $dataForWrittenQuestions = [
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1VideoPart1->part_number, 'question' => 'What is time complexity of Binary Search?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1FilePart1->part_number, 'question' => 'Can Binary Search be used for linked lists?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1FilePart1->part_number, 'question' => 'How to find if two given rectangles overlap?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1VideoPart1->part_number, 'question' => 'How to find angle between hour and minute hands at a given time?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1VideoPart1->part_number, 'question' => 'When does the worst case of QuickSort occur?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4VideoPart1->part_number, 'question' => 'What is a pointer on pointer?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4VideoPart1->part_number, 'question' => 'Distinguish between malloc() & calloc() memory allocation.', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4VideoPart1->part_number, 'question' => 'What is keyword auto for?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number, 'question' => 'What are the valid places for the keyword break to appear.', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number, 'question' => 'Explain the syntax for for loop.', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number, 'question' => 'What is difference between including the header file with-in angular braces < > and double quotes “ “', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number, 'question' => 'How a negative integer is stored.', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number, 'question' => 'What is a static variable?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number, 'question' => 'What is a NULL pointer?', 'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ];
            \App\Models\Question::insert($dataForWrittenQuestions);

            $dataForMcqQuestions = [
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1VideoPart1->part_number,
                    'question' => 'Which one of the below is not divide and conquer approach?',
                    'option_1' => 'Insertion Sort',
                    'option_2' => 'Merge Sort',
                    'option_3' => 'Shell Sort',
                    'option_4' => 'Heap Sort',
                    'right_answer' => 2,
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1FilePart1->part_number,
                    'question' => 'Postfix expression is just a reverse of prefix expression.',
                    'option_1' => 'True',
                    'option_2' => 'False',
                    'option_3' => null,
                    'option_4' => null,
                    'right_answer' => 2,
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1FilePart1->part_number,
                    'question' => 'Which one of the below is not divide and conquer approach?',
                    'option_1' => 'Insertion Sort',
                    'option_2' => 'Merge Sort',
                    'option_3' => 'Shell Sort',
                    'option_4' => 'Heap Sort',
                    'right_answer' => 2,
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1VideoPart1->part_number,
                    'question' => 'After each iteration in bubble sort',
                    'option_1' => 'at least one element is at its sorted position.',
                    'option_2' => 'one less comparison is made in the next iteration.',
                    'option_3' => 'Both A & B are true.',
                    'option_4' => 'Neither A or B are true.',
                    'right_answer' => '1',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson1->id, 'part_number' => $lesson1VideoPart1->part_number,
                    'question' => 'Which of the below mentioned sorting algorithms are not stable?',
                    'option_1' => 'Selection Sort',
                    'option_2' => 'Bubble Sort',
                    'option_3' => 'Merge Sort',
                    'option_4' => 'Insertion Sort',
                    'right_answer' => '1',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4VideoPart1->part_number,
                    'question' => 'Who is father of C Language?',
                    'option_1' => 'Bjarne Stroustrup',
                    'option_2' => 'James A. Gosling',
                    'option_3' => 'Dennis Ritchie',
                    'option_4' => 'Dr. E.F. Codd',
                    'right_answer' => '3',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4VideoPart1->part_number,
                    'question' => 'C Language developed at _________?',
                    'option_1' => 'AT & T\'s Bell Laboratories of USA in 1972',
                    'option_2' => 'AT & T\'s Bell Laboratories of USA in 1970',
                    'option_3' => 'Sun Microsystems in 1973',
                    'option_4' => 'Cambridge University in 1972',
                    'right_answer' => '1',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4VideoPart1->part_number,
                    'question' => 'For 16-bit compiler allowable range for integer constants is ________?',
                    'option_1' => '-3.4e38 to 3.4e38',
                    'option_2' => '-32767 to 32768',
                    'option_3' => '-32668 to 32667',
                    'option_4' => '-32768 to 32767',
                    'right_answer' => '4',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number,
                    'question' => 'C programs are converted into machine language with the help of',
                    'option_1' => 'An Editor',
                    'option_2' => 'A compiler',
                    'option_3' => 'An operating system',
                    'option_4' => 'None of these.',
                    'right_answer' => '2',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number,
                    'question' => 'C was primarily developed as',
                    'option_1' => 'System programming language',
                    'option_2' => 'General purpose language',
                    'option_3' => 'Data processing language',
                    'option_4' => 'None of the above.',
                    'right_answer' => '1',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number,
                    'question' => 'Standard ANSI C recognizes ______ number of keywords?',
                    'option_1' => '30',
                    'option_2' => '32',
                    'option_3' => '24',
                    'option_4' => '36',
                    'right_answer' => '2',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number,
                    'question' => 'Which one of the following is not a reserved keyword for C?',
                    'option_1' => 'auto',
                    'option_2' => 'case',
                    'option_3' => 'main',
                    'option_4' => 'default',
                    'right_answer' => '3',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number,
                    'question' => 'A C variable cannot start with',
                    'option_1' => 'A number',
                    'option_2' => 'A special symbol other than underscore',
                    'option_3' => 'Both of the above',
                    'option_4' => 'An alphabet',
                    'right_answer' => '3',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['lesson_id' => $teacherCourseLesson4->id, 'part_number' => $lesson4FilePart1->part_number,
                    'question' => 'Which one of the following is not a valid identifier?',
                    'option_1' => '_examveda',
                    'option_2' => '1examveda',
                    'option_3' => 'exam_veda',
                    'option_4' => 'examveda1',
                    'right_answer' => '2',
                    'description' => null, 'default_mark' => 2.00, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ];
            \App\Models\Mcq::insert($dataForMcqQuestions);


        }
    }
}
