<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Route đăng ký
    Route::get('/register', [AuthController::class, 'loadRegister']);
    Route::post('/register', [AuthController::class, 'studentRegister'])->name('studentRegister');

    // Route đăng nhập
    Route::get('/login', function(){
        return redirect('/');
    });

    Route::get('/', [AuthController::class,'loadLogin']);
    Route::post('/login', [AuthController::class,'userLogin'])->name('userLogin');

    // Route đăng xuất
    Route::get('/logout', [AuthController::class,'logout']);

    // Route quên mật khẩu
    Route::get('/forget-password', [AuthController::class,'forgetPasswordLoad']);
    Route::post('/forget-password', [AuthController::class,'forgetPassword'])->name('forgetPassword');
    
    Route::get('/reset-password', [AuthController::class,'resetPasswordLoad']);
    Route::post('/reset-password', [AuthController::class,'resetPassword'])->name('resetPassword');



    // Route cho admin
    Route::group(['middleware'=>['web', 'checkAdmin']],function(){
        Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);

        //Subject route
        Route::post('/add-subject', [AdminController::class,'addSubject'])->name('addSubject');
        Route::post('/edit-subject', [AdminController::class,'editSubject'])->name('editSubject');
        Route::post('/delete-subject', [AdminController::class,'deleteSubject'])->name('deleteSubject');
        
        //Exam route
        Route::get('admin/exam', [AdminController::class, 'examDashboard']);
        Route::get('get-exam-detail/{id}', [AdminController::class, 'getExamDetail'])->name('getExamDetail');

        Route::post('/add-exam', [AdminController::class,'addExam'])->name('addExam');
        Route::post('/update-exam', [AdminController::class,'updateExam'])->name('updateExam');
        Route::post('/delete-exam', [AdminController::class,'deleteExam'])->name('deleteExam');
    });

    // Route cho sinh viên
    Route::group(['middleware'=>['web', 'checkStudent']],function(){
        Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
    });

   
