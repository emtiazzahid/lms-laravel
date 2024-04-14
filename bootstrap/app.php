<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\AdminTeacherMiddleware;
use App\Http\Middleware\StudentAuthMiddleware;
use App\Http\Middleware\TeacherAuthMiddleware;
use App\Http\Middleware\TeacherStudentMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/teacher.php'));

            Route::middleware('web')
                ->group(base_path('routes/student.php'));

            Route::middleware('web')
                ->group(base_path('routes/department.php'));

            Route::middleware('web')
                ->group(base_path('routes/course.php'));

            Route::middleware('web')
                ->group(base_path('routes/question.php'));

            Route::middleware('web')
                ->group(base_path('routes/exam.php'));

            Route::middleware('web')
            ->group(base_path('routes/lesson.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'AdminAuth' => AdminAuthMiddleware::class,
            'StudentAuth' => StudentAuthMiddleware::class,
            'TeacherAuth' => TeacherAuthMiddleware::class,
            'AdminOrTeacher' => AdminTeacherMiddleware::class,
            'TeacherOrStudent' => TeacherStudentMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();