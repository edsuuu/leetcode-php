<?php

use App\Http\Controllers\LeetCode;
use Illuminate\Support\Facades\Route;

Route::get('/', [LeetCode::class, 'render']);
Route::get('/pdf', [LeetCode::class, 'download']);
