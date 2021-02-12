<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use APP\Models\User;

use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class,'index'])->name('con');


//category controller
Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');

//category add controller
Route::post('/category/add', [CategoryController::class,'AddCat'])->name('store.category');

//category edit 
Route::get('/category/edit/{id}', [CategoryController::class,'Edit']);

//update category
Route::post('/category/update/{id}', [CategoryController::class,'Update']);


//softdelete
Route::get('/softdelete/category/{id}', [CategoryController::class,'SoftDelete']);
//restore
Route::get('/category/restore/{id}', [CategoryController::class,'Restore']);
//delete permanent
Route::get('/pdelete/category/{id}', [CategoryController::class,'PDelete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
   // $users = User::all();
    $users= DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');
