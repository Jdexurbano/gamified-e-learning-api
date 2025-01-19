<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::get('/',function (){
//     return 'hello';
// });

Route::post('/register',[AuthController::class,'register']);
Route::post('/admin',[AuthController::class,'adminLogin']);
Route::post('/student',[AuthController::class,'studentLogin']);

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('students',UserController::class);
    Route::apiResource('announcements',AnnouncementController::class);
});