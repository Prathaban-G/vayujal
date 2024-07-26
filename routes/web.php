<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ThresholdController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
Route::get('superadmin/dashboard', [ProductController::class, 'homeindex'])
    ->middleware(['superadmin','auth']);
    Route::get('admin/dashboard', [ProductController::class, 'homeindex'])
    ->middleware(['admin','auth']);
    Route::get('/superadmin/alarmlog', [LogsController::class, 'showForm']);
    Route::post('/retrieveData', [LogsController::class, 'retrieveData']);
    Route::get('/downloadCsv', [LogsController::class, 'downloadCsv']);
    
    Route::get('/superhome', [ProductController::class, 'homeindex'])->name('user.dashboard');
    
    
    Route::get('/users', [UserController::class, 'index'])->name('superadmin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('superadmin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('superadmin.users.store');
    
    Route::get('/admins', [UserController::class, 'index'])->name('superadmin.admins.index');
    Route::get('/admins/create', [UserController::class, 'createadmin'])->name('superadmin.admins.create');
    Route::post('/admins/store', [UserController::class, 'store'])->name('superadmin.admins.store');
    
    Route::get('admins', [UserController::class, 'adminindex'])->name('superadmin.admins.index');
    Route::get('users', [UserController::class, 'index'])->name('superadmin.users.index');
    Route::resource('users', UserController::class);
    
    Route::get('superadmin/admins/index', [UserController::class, 'adminindex'])->name('superadmin.admins.index');
    Route::get('/products', [ProductController::class, 'index'])->name('superadmin.products.index');
    Route::resource('/products', ProductController::class);
    
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    
    Route::get('superadmin/users/index', [UserController::class, 'index'])->name('superadmin.users.index');
    
    
    
     // Add this line
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('superadmin.users.update'); // Add this line
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('superadmin.users.destroy'); // Add this line
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('superadmin.users.edit');
    Route::get('/admins/{id}/edit', [UserController::class, 'edit'])->name('superadmin.admins.edit');
    
    
    Route::get('superadmin/products/index', [ProductController::class, 'index'])->name('superadmin.products.index');
    
    
    
    Route::post('/parameter', [ThresholdController::class, 'store'])->name('parameter.store');
    Route::post('/parameter/copy', [ThresholdController::class, 'copyParameters'])->name('parameter.copy');
    
    
    Route::get('products/parameter/{productname}', [ThresholdController::class, 'show'])->name('parameter.show');
    
    
    
    
    
    
    Route::get('/superadmin/data', [DataController::class, 'showForm']);
    Route::post('/data/retrieveData', [DataController::class, 'retrieveData']);
    Route::get('/data/downloadCsv', [DataController::class, 'downloadCsv']);
    
    Route::get('dashboard/{hw_id}', [DataController::class, 'showDashboard'])->name('dashboard');
    Route::get('threedashboard/{hw_id}', [DataController::class, 'showthreeDashboard'])->name('threedashboard');
    
    Route::get('dashboard/{hw_id}/latest-data', [DataController::class, 'fetchLatestData'])->name('dashboard.latestData');
    