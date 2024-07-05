<?php

use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/folder',[WebController::class,'getFolder']);
Route::get('/folder/{id}',[WebController::class,'selectFolder']);
Route::post('/post-folder',[WebController::class,'postFolder']);
Route::delete('/delete-folder/{id}',[WebController::class,'deleteFolder']);
Route::put('/update-folder/{id}',[WebController::class,'updateFolder']);

Route::get('/file',[WebController::class,'getFile']);
Route::post('/post-file',[WebController::class,'createFile']);
Route::delete('delete-file/{id}',[WebController::class,'deleteFile']);
