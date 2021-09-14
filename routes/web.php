<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/event', [App\Http\Controllers\EventController::class, 'index'])->name('event');
Route::get('/event/add', [App\Http\Controllers\EventController::class, 'add'])->name('addevent');
Route::post('/event/add', [App\Http\Controllers\EventController::class, 'addevent'])->name('newevent');
Route::get('/event/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteevent']);
Route::get('/event/edit/{id}', [App\Http\Controllers\EventController::class, 'editevent']);
Route::post('/event/edit', [App\Http\Controllers\EventController::class, 'addeditevent'])->name('editevent');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/contact/add', [App\Http\Controllers\ContactController::class, 'add'])->name('addcontact');
Route::post('/contact/add', [App\Http\Controllers\ContactController::class, 'addcontact'])->name('newcontact');
Route::get('/contact/delete/{id}', [App\Http\Controllers\ContactController::class, 'deletecontact']);
Route::get('/contact/edit/{id}', [App\Http\Controllers\ContactController::class, 'editcontact']);
Route::post('/contact/edit', [App\Http\Controllers\ContactController::class, 'addeditcontact'])->name('editcontact');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');


