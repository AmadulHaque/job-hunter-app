<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\JobPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::get("/categories", [CategoryController::class,"index"]);
Route::get("/jobs", [JobPostController::class,"index"]);
Route::post("/job-apply", [JobPostController::class,"jobApply"]);



