<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Folders;
use App\Http\Controllers\Files;
use App\Http\Controllers\Auth\ApiTokenController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', fn () => response()->json(['message' => 'Welcome to your api'], 200));

Route::post('/tokens/issue', ApiTokenController::class);
Route::post('/register', RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    // Управление папками
    Route::post('folders', Folders\StoreController::class);
    Route::get('folders/{folder}', Folders\ShowController::class);
    Route::get('folders/{folder}/contents', Folders\ShowContentsController::class);
    Route::patch('folders/{folder}', Folders\UpdateController::class);
    Route::delete('folders/{folder}', Folders\DestroyController::class);

    // Управление файлами
    Route::post('files/upload', Files\UploadController::class);
    Route::get('files/{file}/download', Files\DownloadController::class);
    Route::delete('files/{file}', Files\DestroyController::class);
});
