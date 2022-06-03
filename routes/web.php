<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Middleware\ValidateAdmin;
use App\Http\Middleware\ValidateSession;
use App\Http\Middleware\ValidateUser;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [AppController::class, "app"])->name("home");

Route::get("user/register", [AppController::class, "register"])->name("user/register");
Route::get("user/login", [AppController::class, "login"])->name("user/login");
Route::get("admin/login", [AppController::class, "adminLogin"])->name("admin/login");

Route::post("user/register", [AuthenticationController::class, "register"]);
Route::post("user/login", [AuthenticationController::class, "login"]);
Route::post("admin/login", [AuthenticationController::class, "adminLogin"]);
Route::post("admin/dashboard/register", [AuthenticationController::class, "adminRegister"])->middleware(["admin", "session", "role"]);

Route::middleware([ValidateAdmin::class, ValidateSession::class])->group(function() {
    Route::controller(AdminDashboardController::class)->group(function() {
        Route::get("admin/dashboard", "dashboard")->name("admin/dashboard");
        Route::post("admin/dashboard/categories/add", "add");
        Route::get("admin/dashboard/categories/{id}/edit", "getEdit");
        Route::post("admin/dashboard/categories/{id}/edit", "edit");
        Route::get("admin/dashboard/categories/{id}/delete", "delete");
        Route::get("admin/dashboard/register", "getAdminRegister")->middleware(["role"])->name("admin/register");
        Route::get("admin/dashboard/logout", "logout");
    });
});

Route::middleware([ValidateUser::class, ValidateSession::class])->group(function() {
    Route::controller(UserDashboardController::class)->group(function() {
        Route::get("user/dashboard", "dashboard")->name("user/dashboard");
        Route::post("user/dashboard/posts/add", "add");
        Route::get("user/dashboard/posts/{id}", "post");
        Route::get("user/dashboard/posts/{id}/edit", "getEdit");
        Route::post("user/dashboard/posts/{id}/edit", "edit");
        Route::get("user/dashboard/posts/{id}/delete", "delete");
        Route::get("user/dashboard/logout", "logout");
    });
});

Route::middleware([ValidateUser::class, ValidateSession::class])->group(function() {
    Route::controller(PostController::class)->group(function() {
        Route::get("user/dashboard/posts", "all");
        Route::get("user/dashboard/posts/{id}/comments", "one")->name("post");
        Route::post("user/dashboard/search", "search");
        Route::get("/user/dashboard/search", "results")->name("search");
    });
});

Route::post("user/dashboard/posts/{id}/comments/add", [CommentController::class, "add"])->middleware(["user", "session"]);