<?php

use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/employee')->name('employee.')->group(function () {
    Route::get('/', [EmployeeController::class, 'page'])->name('page');
    Route::get('/list', [EmployeeController::class, 'index'])->name('index');
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
});

Route::prefix('/vehicle')->name('vehicle.')->group(function () {
    Route::get('/', [VehicleController::class, 'page'])->name('page');
    Route::get('/list', [VehicleController::class, 'index'])->name('index');
    Route::post('/', [VehicleController::class, 'store'])->name('store');
    Route::get('/{vehicle', [VehicleController::class, 'show'])->name('show');
    Route::put('/{vehicle}', [VehicleController::class, 'update'])->name('update');
    Route::delete('/{vehicle}', [VehicleController::class, 'destroy'])->name('destroy');
});

Route::prefix('/assignment')->name('assignment.')->group(function () {
    Route::get('/list', [AssignmentController::class, 'index'])->name('index');
    Route::post('/', [AssignmentController::class, 'store'])->name('store');
    Route::get('/{assignment}', [AssignmentController::class, 'show'])->name('show');
    Route::put('/{assignment}', [AssignmentController::class, 'update'])->name('update');
    Route::delete('/{assignment}', [AssignmentController::class, 'destroy'])->name('destroy');
});
