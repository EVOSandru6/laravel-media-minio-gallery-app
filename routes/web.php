<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

// minio
Route::get('storage-all', function () {
    return Storage::disk('minio')->files();
});

// media
Route::post('/users/upload', function (Request $request) {
    if($request->hasFile('file')) {
        $user = User::find(1);
        $user->addMedia($request->file('file'))->toMediaCollection('avatars');
    } else {
        throw new DomainException('oops');
    }
})->name('users');
