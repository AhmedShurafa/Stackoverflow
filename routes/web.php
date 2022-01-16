<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',     [MainController::class,'index'])->name('main');

Route::get('search/{word?}',[MainController::class,'search'])->name('search');

Route::get('users',[MainController::class,'users'])->name('users');
Route::get('users/search/{word?}',[MainController::class,'searchUsers'])->name('search.users');

Route::get('tags'       ,[MainController::class,'tags'])->name('tags');
Route::get('tags/search/{word?}',[MainController::class,'searchTag'])->name('tags.search');
Route::get('tags/question/{id}',[MainController::class,'getQuestionByTag'])->name('tag.question');

Route::get('user/profile/{id?}',[UserController::class,'show'])->name('profile');


// all route beloe you must br login
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->group(function () {
    Route::resource('question',QuestionController::class);

    Route::middleware('auth')->group(function () {
        Route::get('edit/profile',[UserController::class,'edit'])->name('edit.profile');
        Route::put('update/profile',[UserController::class,'update'])->name('update.profile');

        Route::put('change/passworrd',[UserController::class,'chnagePassword'])->name('change.passworrd');
        Route::get('recover/password',[UserController::class,'recover'])->name('recover.password');

        Route::post('questions/vote',[QuestionController::class,'vote'])->name('question.vote');
        Route::get('question/status/{id}',[QuestionController::class,'status'])->name('question.status');


        Route::get('Answer/accepted/{id}',[AnswerController::class,'accepted'])->name('question.accepted');
        Route::POST('Answer/store',[AnswerController::class,'store'])->name('answer.store');
        Route::get('Answer/edit/{id}',[AnswerController::class,'edit'])->name('answer.edit');
        Route::put('Answer/update/{id}',[AnswerController::class,'update'])->name('answer.update');
        Route::delete('Answer/delete/{id}',[AnswerController::class,'destroy'])->name('answer.delete');
        Route::post('Answer/vote',[AnswerController::class,'vote'])->name('answer.vote');
        // Route::resource('Answer',QuestionController::class); anthor way 2

        Route::post('comment/store',[CommentController::class,'store'])->name('comment.store');
        Route::post('comment/store/Anwser',[CommentController::class,'storeAnwser'])->name('comment.storeAnwser');


        Route::get('notifications', [NotificationController::class,'index'])->name('notifications');
        Route::get('notifications/show/{id}', [NotificationController::class,'show'])->name('notifications.show');
    });

});

Route::prefix('admin/dashboard/')->middleware(['auth',CheckUser::class])->group(function(){

    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('user',[DashboardController::class,'users'])->name('dashboard.user');
    // Route::Delete('user/delete/{id}',[DashboardController::class,'deleteUser'])->name('dashboard.user.delete');

    Route::get('questions',[DashboardController::class,'questions'])->name('dashboard.questions');
    // Route::Delete('dashboard/question/delete/{id}',[DashboardController::class,'deleteQuestion'])->name('dashboard.question.delete');

    Route::resource('tags', TagController::class);
    Route::resource('badges', BadgeController::class);
});

Route::get('badge',[MainController::class,'badges'])->name('all.badges');
Route::get('badges/search',[MainController::class,'badgeSearch'])->name('badgeSearch');
