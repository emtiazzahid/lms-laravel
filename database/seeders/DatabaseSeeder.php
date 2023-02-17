<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(DepartmentSeeder::class);
         $this->call(CourseTableSeeder::class);
         $this->call(TeacherCourseTableSeeder::class);
         $this->call(TrendingCourseTableSeeder::class);
         $this->call(TeacherCourseLessonTableSeeder::class);
         $this->call(QuestionsSeeder::class);
    }
}
