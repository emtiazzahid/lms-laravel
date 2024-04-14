<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['AdminOrTeacher']], function () {
    // Routes for Department CRUD
    Route::get('/departments', [DepartmentController::class, 'getIndex'])->name('departments-list');
    Route::post('/departments/add', [DepartmentController::class, 'add'])->name('departments-add');
    Route::post('/departments/update', [DepartmentController::class, 'update'])->name('departments-update');
    Route::get('/departments/remove/{id}', [DepartmentController::class, 'delete'])->name('departments-delete');
});