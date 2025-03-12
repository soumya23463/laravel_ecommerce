<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/category/{slug}', [CategoryController::class, 'detail']);

Route::get('/category/electronics/{slug}', [SubCategoryController::class, 'detail']);
