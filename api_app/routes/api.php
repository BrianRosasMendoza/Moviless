<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;



//User Controllers
Route::get('users/{user}', [UserController::class, 'show'])->name('api.users.show');
Route::get('users', [UserController::class, 'index'])->name('api.users.index');
Route::post('users',[UserController::class, 'store'])->name('api.users.store');
Route::delete('users/{users}',[UserController::class,'destroy'])->name('api.users.destroy');
Route::put('users/{user}',[UserController::class, 'update'])->name('api.users.update');

Route::get('posts/{post}', [PostController::class, 'show'])->name('api.posts.show');
Route::get('post', [PostController::class, 'index'])->name('api.posts.index');

// Video Controllers
Route::get('videos/{video}', [VideoController::class, 'show'])->name('api.videos.show');
Route::get('videos', [VideoController::class, 'index'])->name('api.videos.index');
Route::post('videos',[VideoController::class, 'store'])->name('api.videos.store');
Route::delete('videos/{video}',[VideoController::class,'destroy'])->name('api.videos.destroy');
Route::put('videos/{video}', [VideoController::class, 'update'])->name('api.videos.update');

route::post('register', [AuthController::class, 'store'])->name('api.users.store');
route::post('login', [AuthController::class, 'login'])->name('api.users.login');




// Route::get('/user/{id}', function (string $id) {
//     return new UserResource(User::findOrFail($id));
// });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 
Route::get('/video', function (Request $request) {
    return $request->video();
})->middleware('auth:sanctum');



