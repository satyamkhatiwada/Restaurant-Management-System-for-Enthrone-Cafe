<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\adminPanelController;
use App\Http\Controllers\WaiterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
   });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admindashboard');
})->name('admindashboard');

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/menu', [MenuController::class, 'index'])->name('menu');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addMenu', [MenuController::class, 'addMenu'])->name('addMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/employee', [EmployeeController::class, 'index'])->name('employee');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/panel', [adminPanelController::class, 'index'])->name('adminPanel');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/employee/addWaiter', [adminPanelController::class, 'index'])->name('waiter');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addmenu', [MenuController::class, 'addmenu'])->name('addmenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->post('/admin/menu', [MenuController::class, 'store'])->name('menu.store');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/menu/{id}/edit', [MenuController::class, 'editMenu'])->name('editMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/menu/{id}', [MenuController::class, 'updateMenu'])->name('updateMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->delete('/admin/menu/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');
