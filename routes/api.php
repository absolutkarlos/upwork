<?php

use App\Http\Controllers\API\SubmissionController; // Adjust the namespace as needed

Route::apiResource('submissions', SubmissionController::class);
Route::post('/submit', [SubmissionController::class, 'store']);