<?php

use App\Http\Controllers\Api\V1\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('skills', SkillController::class);
    Route::put("/update-skills/{id}", [SkillController::class, 'updateSkills']);
    Route::delete("/delete-skills/{id}",[SkillController::class, 'deleteSkills']);
});

Route::get('/', function () {
    return response()->json(['message' => 'Success']);
});