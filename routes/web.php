<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Middleware\CheckSocialParams;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("posts", PostController::class);

Route::post('posts/comment/{post}', [PostController::class, 'addComment'])->middleware('auth')->name('posts.comment.create');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/{social}', [SocialLoginController::class, 'redirectSocialLogin'])->name('auth.login.social.redirect')->middleware(CheckSocialParams::class);

Route::get('/callback-login/{social}', [SocialLoginController::class, 'processSocialLogin'])->name('auth.login.social.process')->middleware(CheckSocialParams::class);

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'role:admin']);
