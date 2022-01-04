<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\User;


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
Route::get('tasklist/all',[TaskController::class,'AllTask'])->name('all.tasklist');
Route::post('tasklist/add',[TaskController::class,'AddTask'])->name('store.tasklist');
Route::get('tasklist/edit/{id}',[TaskController::class,'Edit']);
Route::post('tasklist/update/{id}',[TaskController::class,'Update']);
Route::get('delete/tasklist/{id}',[TaskController::class,'Delete']);
Route::get('tasklist/status/{status}/{id}',[TaskController::class,'status']); 
Route::get('changeStatus',[TaskController::class,'changeStatus']); 

Route::get('/dashboard', function () {
     $users=User::all();
    return view('dashboard',compact('users'));
})->middleware(['auth'])->name('dashboard');
// Route::get('/tasklist', function () {
//     return view('tasklist');
// })->middleware(['auth'])->name('tasklist');

require __DIR__.'/auth.php';
