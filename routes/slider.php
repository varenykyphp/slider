<?php


use App\Http\Kernel;
use Illuminate\Support\Facades\Route;
use Varenyky\Http\Middleware\Authenticate;

use VarenykySlider\Http\Controllers\SliderController;
use VarenykySlider\Http\Controllers\SliderItemsController;

Route::prefix(config('varenyky.path'))->name('admin.')->middleware(resolve(Kernel::class)->getMiddlewareGroups()['web'])->group(function () {
    Route::group(['middleware' => [Authenticate::class]], function () {
        Route::resource('/sliders', SliderController::class);
        Route::resource('/slider/{id}/items', SliderItemsController::class);
    });
});