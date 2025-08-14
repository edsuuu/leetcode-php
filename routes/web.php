<?php

use App\Http\Controllers\LeetCode;
use Illuminate\Support\Facades\Route;

Route::get('/', [LeetCode::class, 'render']);
