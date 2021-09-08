<?php

use App\Http\Controllers\ChannelController;
use App\Http\Livewire\Vedio\AllVideo;
use App\Http\Livewire\Vedio\CreateVideo;
use App\Http\Livewire\Vedio\EditVideo;
use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth')->group(function (){

    Route::get('/channel/{channel}/edit',[ChannelController::class,'edit'])->name('channel.edit');
});






Route::middleware('auth')->group(function (){

    Route::get('/video/{channel}/create',CreateVideo::class)->name('video.create');
    Route::get('/video/{channel}/{video}/edit',EditVideo::class)->name('video.edit');
    Route::get('/video/{channel}',AllVideo::class)->name('video.all');
    Route::get('/video/{channel}/create',CreateVideo::class)->name('video.create');
});
