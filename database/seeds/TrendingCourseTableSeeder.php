<?php

use Illuminate\Database\Seeder;

class TrendingCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = \App\Model\TrendingCourse::first();
        if (empty($model)) {
//            taking 3 random row from teacher course for trending list
            $teacherCourses = \App\Model\TeacherCourse::all()->random(3);
            foreach ($teacherCourses as $course){
                $trendingCourse = new \App\Model\TrendingCourse();
                $trendingCourse->teacher_course_id = $course->id;
                $trendingCourse->created_at = date('Y-m-d H:i:s');
                $trendingCourse->updated_at = date('Y-m-d H:i:s');
                $trendingCourse->save();
            }
        }
    }
}
