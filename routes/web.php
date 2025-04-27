<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ExpenseController;

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
    return view('admin.login');
});

//  Admin group prefix
route::group(['prefix' => 'acme'], function(){
    route::group(['middleware' => 'admin.guest'],function(){

        Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');

    });

        route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');

        // User Route Controller users
        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::post('/users',[UserController::class,'store'])->name('users.store');
        Route::delete('/users',[UserController::class,'destory'])->name('users.delete');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update', [UserController::class, 'update'])->name('users.update');

       // Category Route Controller 
       Route::get('/category',[CategoryController::class,'index'])->name('category.index');
       Route::delete('/category',[CategoryController::class,'destory'])->name('category.delete');
       Route::post('/category',[CategoryController::class,'store'])->name('category.store');
       Route::get('/category/{did}/edit',[CategoryController::class,'edit'])->name('category.edit');
            

       // Expense Route Controller
       Route::get('/expense',[ExpenseController::class,'index'])->name('expense.index');     
       Route::post('/expense',[ExpenseController::class,'store'])->name('expense.store');  
       Route::delete('/expense',[ExpenseController::class,'destory'])->name('expense.delete');
       Route::get('/expense/monthly-report',[ExpenseController::class,'ExpenseMonthlyReport'])->name('expense.monthlyReport');
    
    });
});
// Close admin prefix group



// Clear Cache route
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    echo 'DONE';
});
// Close Clear cache

