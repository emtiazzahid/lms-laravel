<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = \App\Models\Course::first();
        if (empty($model)) {
            $department1 = \App\Models\Department::where('title','Department of Architecture')->first();
            $department2 = \App\Models\Department::where('title','Department of History of Art')->first();
            $department3 = \App\Models\Department::where('title','Computer Science')->first();
            $department4 = \App\Models\Department::where('title','Civil engineering')->first();
            $data = [
                [
                    'department_id' => $department1->id,
                    'title' => 'ARCH 100 Architectural Foundations I',
                    'featured_image' => '/admin/images/courses/course_1.jpg',
                    'short_code' => 'ARCH 100',
                    'featured_text' => 'An introductory design studio directed toward the development of spatial thinking and the skills necessary for the analysis and design of architectural space and form. This course is based on a series of exercises that include direct observation: drawing, analysis and representation of the surrounding world, and full-scale studies in the making of objects and the representation of object and space. Students are introduced to different descriptive and analytical media and techniques of representation to aid in the development of critical thought. These include freehand drawing, orthographic projection, paraline drawing, basic computer skills, and basic materials investigation. Prerequisite: Approval from the Dean of the School of Architecture and Urban Planning. LAB.',
                    'default_cost' => null,
                    'status' => \App\Libraries\Enumerations\CourseStatus::$APPROVED,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'department_id' => $department1->id,
                    'title' => 'ARCH 104 Principles of Modern Architecture',
                    'featured_image' => '/admin/images/courses/course_2.jpg',
                    'short_code' => 'ARCH 104',
                    'featured_text' => 'A lecture course covering the emergence of technological, theoretical and aesthetic principles of modern design beginning with the socio-cultural impact of industrialization and the crisis in architecture at the end of the 19th century. Attention is given to functionalist theory, mechanical analogies and the so-called machine aesthetic of 1910-1930 and to the precedents of important design principles of modern architecture, including modular coordination, the open plan, interlocking universal space, unadorned geometry, structural integrity, programmatic and tectonic expression, efficiency and transparency and briefly explores their development in post-war and late 20th century examples. LEC.',
                    'default_cost' => null,
                    'status' => \App\Libraries\Enumerations\CourseStatus::$APPROVED,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'department_id' => $department3->id,
                    'title' => 'Discrete Mathematics',
                    'featured_image' => '/admin/images/courses/course_3.jpg',
                    'short_code' => 'MATH1061',
                    'featured_text' => 'Propositional & predicate logic, valid arguments, methods of proof. Elementary set theory. Elementary graph theory. Relations & functions. Induction & recursive definitions. Counting methods (pigeonhole, inclusion/exclusion). Introductory probability. Binary operations, groups, fields. Applications of finite fields. Elementary number theory.',
                    'default_cost' => null,
                    'status' => \App\Libraries\Enumerations\CourseStatus::$APPROVED,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'department_id' => $department3->id,
                    'title' => 'Introduction to Software Engineering',
                    'featured_image' => '/admin/images/courses/course_4.jpg',
                    'short_code' => 'CSSE1001',
                    'featured_text' => 'Introduction to Software Engineering through programming with particular focus on the fundamentals of computing & programming, using an exploratory problem-based approach. Building abstractions with procedures, data & objects; data modelling; designing, coding & debugging programs of increasing complexity',
                    'default_cost' => null,
                    'status' => \App\Libraries\Enumerations\CourseStatus::$APPROVED,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'department_id' => $department3->id,
                    'title' => 'Algorithms & Data Structures',
                    'featured_image' => '/admin/images/courses/course_5.jpg',
                    'short_code' => 'COMP3506',
                    'featured_text' => 'Data structures & types, mapping of abstract information structures into representations on primary & secondary storage. Analysis of time & space complexity of algorithms. Sequences. Lists. Stacks. Queues. Sets, multisets, tables. Trees. Sorting. Hash tables. Priority queues. Graphs. String algorithms.',
                    'default_cost' => null,
                    'status' => \App\Libraries\Enumerations\CourseStatus::$APPROVED,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'department_id' => $department3->id,
                    'title' => 'Programming in the Large',
                    'featured_image' => '/admin/images/courses/course_6.jpg',
                    'short_code' => 'CSSE2002',
                    'featured_text' => 'This course covers techniques that scale to programming large software systems with teams of programmers. The techniques are explained in the context of the specification, implementation, testing and maintenance of software systems. The course utilises the Java programming language and covers programming concepts such as data abstraction, procedural abstraction, unit testing, class hierarchies and polymorphism, exception handling, file I/O, and graphical user interfaces.',
                    'default_cost' => null,
                    'status' => \App\Libraries\Enumerations\CourseStatus::$APPROVED,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];
            \App\Models\Course::insert($data);
        }
    }
}
