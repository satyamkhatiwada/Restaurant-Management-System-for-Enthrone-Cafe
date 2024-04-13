<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WaiterAuthController;
use App\Http\Controllers\WaiterOrderController;
use App\Http\Controllers\BookingController;


 
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
})->name('home');


Route::get('/menu', [UserMenuController::class, 'index'])->name('menu'); 
Route::get('/about', [AboutController::class, 'about'])->name('about'); 
Route::get('/reservation', [BookingController::class, 'index'])->name('booking');
Route::post('/reservation/store', [BookingController::class, 'storeBooking'])->name('bookings.store');


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
        return view('home');
    })->name('home');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admindashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{menuItemId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('/cart/update/{cartItemId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/orders/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::post('/esewa', [OrderController::class, 'esewaCallback'])->name('esewa');
    Route::get('/success', [OrderController::class, 'esewaSuccess']);
    Route::get('/failure', [OrderController::class, 'esewaFailed']);
    Route::get('/history', [OrderController::class, 'history'])->name('order.history');

});

Route::group(['prefix' => 'waiter'], function () {
    Route::get('/login', [WaiterAuthController::class, 'showLoginForm'])->name('waiter.login');
    Route::post('/login', [WaiterAuthController::class, 'login']);
    Route::post('/logout', [WaiterAuthController::class, 'logout'])->name('waiter.logout');

    // Define the dashboard route inside the middleware group
    Route::middleware(['auth:waiter'])->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('waiter.dashboard');
        Route::get('/order', [WaiterOrderController::class, 'index'])->name('waiter.order');
        Route::get('/makeorder/{id}', [WaiterOrderController::class, 'makeOrder'])->name('makeOrder');
        Route::post('/createorder/{id}', [WaiterOrderController::class, 'createOrder'])->name('waiter.createOrder');
        Route::put('/updateWaiterOrderStatusByWaiter/{id}', [WaiterOrderController::class, 'updateWaiterOrderStatusByWaiter'])->name('updateWaiterOrderStatusByWaiter');

    });    
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addMenu', [MenuController::class, 'addMenu'])->name('addMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory');
Route::middleware(['auth:sanctum,admin', 'verified'])->delete('/admin/category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/employee', [EmployeeController::class, 'index'])->name('employee');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addwaiter', [EmployeeController::class, 'addWaiter'])->name('addWaiter');
Route::middleware(['auth:sanctum,admin', 'verified'])->post('/admin/createwaiter', [EmployeeController::class, 'createWaiter'])->name('createWaiter');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addmenu', [MenuController::class, 'addmenu'])->name('addmenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->post('/admin/menu', [MenuController::class, 'store'])->name('menu.store');
Route::middleware(['auth:sanctum,admin', 'verified'])->post('/admin/category', [CategoryController::class, 'store'])->name('category.store');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/menu/{id}/edit', [MenuController::class, 'editMenu'])->name('editMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/menu/{id}', [MenuController::class, 'updateMenu'])->name('updateMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/updateStatus/{id}', [MenuController::class, 'updateStatus'])->name('updateStatus');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/updateOrderStatus/{id}', [OrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/updateWaiterOrderStatus/{id}', [WaiterOrderController::class, 'updateWaiterOrderStatus'])->name('updateWaiterOrderStatus');
Route::middleware(['auth:sanctum,admin', 'verified'])->delete('/admin/menu/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/order', [OrderController::class, 'index'])->name('admin.order');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/waiterorder', [OrderController::class, 'indexwaiter'])->name('admin.waiterorder');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/table', [BookingController::class, 'viewTable'])->name('admin.table');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/timeslot', [BookingController::class, 'viewTimeslot'])->name('admin.timeslot');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/bookings', [BookingController::class, 'viewBooking'])->name('admin.booking');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addtable', [BookingController::class, 'addTable'])->name('addTable');
Route::middleware(['auth:sanctum,admin', 'verified'])->post('/admin/tables', [BookingController::class, 'storeTable'])->name('storeTable');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/addtimeslot', [BookingController::class, 'addTimeslot'])->name('addTimeslot');
Route::middleware(['auth:sanctum,admin', 'verified'])->post('/admin/timeslots', [BookingController::class, 'storeTimeslot'])->name('storeTimeslot');
Route::middleware(['auth:sanctum,admin', 'verified'])->delete('/admin/timeslot/{id}', [BookingController::class, 'deleteTimeslot'])->name('deleteTimeslot');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/reschedule/{id}', [BookingController::class, 'reschedule'])->name('reschedule');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/reschedule/{id}/edit', [BookingController::class, 'rescheduleBooking'])->name('rescheduleBooking');
Route::middleware(['auth:sanctum,admin', 'verified'])->delete('/admin/table/{id}', [BookingController::class, 'deleteTable'])->name('deleteTable');
Route::middleware(['auth:sanctum,admin', 'verified'])->delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
Route::middleware(['auth:sanctum,admin', 'verified'])->put('/admin/updateBookingStatus/{id}', [BookingController::class, 'updateBookingStatus'])->name('updateBookingStatus');




