<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\VoteController;

Route::get('/', [VoteController::class, 'index']); // Show the voting options
Route::post('/vote/{option}', [VoteController::class, 'vote']); // Handle the vote