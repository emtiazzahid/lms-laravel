<?php
namespace App\Repository;

use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardGraphDataRepo
{
    public function getStudentActivityDataArray()
    {
        $now = Carbon::now();

        $userActivityData = UserActivity::select('total_student_login', 'created_at')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->orderBy('created_at')
            ->get();

        $arrayString = '';
        foreach ($userActivityData as $key =>  $data)
        {
            $year = $data->created_at->year;
            $month = $data->created_at->month;
            $day = $data->created_at->day;
            $total_student_login = $data->total_student_login;
            $arrayString .= '[gd('.$year.', '.$month.', '.$day.'), '.$total_student_login.'],';
        }
        return $arrayString;
    }

    public function getTeacherActivityDataArray()
    {
        $now = Carbon::now();

        $userActivityData = UserActivity::select('total_teacher_login', 'created_at')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->orderBy('created_at')
            ->get();
            
        $arrayString = '';
        foreach ($userActivityData as $key =>  $data)
        {
            $year = $data->created_at->year;
            $month = $data->created_at->month;
            $day = $data->created_at->day;
            $total_teacher_login = $data->total_teacher_login;
            $arrayString .= '[gd('.$year.', '.$month.', '.$day.'), '.$total_teacher_login.'],';
        }
        return $arrayString;
    }

    public function getTopFourTeacherList()
    {
       $teachers =  DB::raw('SELECT users.name, AVG(teacher_reviews.point) as point 
            FROM `teacher_reviews` 
            JOIN users on users.id = teacher_reviews.teacher_id
            GROUP BY teacher_id
            ORDER by point DESC
            LIMIT 4');

        return $teachers;
    }
}