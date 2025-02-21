<?php

use App\Http\Controllers\Backend\Authcontroller;
use App\Http\Controllers\Backend\Dashboadcontroller;
use App\Http\Controllers\Backend\Usercontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\loginMiddleware;
use App\Http\Middleware\AuthMiddeware;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Fontend\HomeController;
use App\Http\Controllers\Backend\Socialcontroller;
use App\Http\Controllers\Backend\Othercontroller;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Fontend\Blogcontroller;
use App\Http\Controllers\Fontend\SingleBlogcontroller;
use App\Http\Controllers\Backend\Baivietcontroller;
use App\Http\Controllers\Backend\Anhcontroller;
use App\Http\Controllers\Fontend\Picturecontroller;
use App\Http\Controllers\Fontend\ResumeController;


Route::get('/', [Authcontroller::class,'index'])->name('auth.admin')->middleware(LoginMiddleware::class);
Route::get('about/{id}', [HomeController::class, 'showUser'])->name('showUser');
Route::get('darkboard/index', [Dashboadcontroller::class,'index'])->name('darkboard.index')->middleware(AuthMiddeware::class);
Route::get('admin', [Authcontroller::class,'index'])->name('auth.admin')->middleware(LoginMiddleware::class);
Route::get('logout', [Authcontroller::class,'logout'])->name('auth.logout');
Route::post('login', [Authcontroller::class,'login'])->name('auth.login');

Route::get('register', [Authcontroller::class,'showRegisterForm'])->name('auth.register');
Route::post('register', [Authcontroller::class,'register'])->name('auth.register');


Route::middleware(['auth'])->group(function () {
    Route::get('user/index', [Usercontroller::class, 'index'])->name('user.index');
    Route::post('user/update', [Usercontroller::class, 'update'])->name('user.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('social/index', [Socialcontroller::class, 'index'])->name('social-links.index');
    Route::post('social/store', [Socialcontroller::class, 'store'])->name('social-links.store');
    Route::post('social/update/{socialLink}', [Socialcontroller::class, 'update'])->name('social-links.update');
    Route::delete('social/destroy/{socialLink}', [Socialcontroller::class, 'destroy'])->name('social-links.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('other/index', [OtherController::class, 'index'])->name('other.index');

    Route::post('/resume', [OtherController::class, 'storeResume'])->name('resume.store');
    Route::put('/resume/{resume}', [OtherController::class, 'updateResume'])->name('resume.update');
    Route::delete('/resume/{resume}', [OtherController::class, 'destroyResume'])->name('resume.destroy');

    Route::post('/skills', [OtherController::class, 'storeSkill'])->name('skills.store');
    Route::put('/skills/{skill}', [OtherController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{skill}', [OtherController::class, 'destroySkill'])->name('skills.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('baiviet', [BaivietController::class, 'index'])->name('baiviet.index');
    Route::post('baiviet', [BaivietController::class, 'store'])->name('baiviet.store');
    Route::get('baiviet/{post}/edit', [BaivietController::class, 'edit'])->name('baiviet.edit');
    Route::put('baiviet/{post}', [BaivietController::class, 'update'])->name('baiviet.update');
    Route::delete('baiviet/{post}', [BaivietController::class, 'destroy'])->name('baiviet.destroy');
});
Route::get('/blog/{id}', [BlogController::class, 'index'])->name('blog.user');
Route::get('/user/{userId}/blog/{postId}', [SingleBlogcontroller::class, 'show'])->name('user.blog.show');

Route::middleware(['auth'])->group(function () {
    Route::get('anh', [Anhcontroller::class, 'index'])->name('anh.index');
});
Route::get('picture', [Picturecontroller::class,'index'])->name('picture.index');

Route::get('/resume/{id}', [ResumeController::class, 'index'])->name('resume.user');


