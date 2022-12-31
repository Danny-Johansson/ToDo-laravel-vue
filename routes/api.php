<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items', [ItemController::class, 'index']);
Route::prefix('/item')->group(function(){
    Route::get('/{id}',[ItemController::class, 'show']);
    Route::post('/store',[ItemController::class, 'store']);
    Route::put('/{id}/complete' , [ItemController::class, 'complete']);
    Route::put('/{id}/update' , [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy'] );
});
