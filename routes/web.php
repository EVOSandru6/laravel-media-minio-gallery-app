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
    if ($request->hasFile('file')) {
        $user = User::find(1);
        $user->addMedia($request->file('file'))->toMediaCollection('avatars');
    } else {
        throw new DomainException('oops');
    }
})->name('users');

Route::get('/show-img', function (Request $request) {
    $remotePath = '4/pic-1.jpg';
    $localPath = '4/pic-1.jpg';

    $fileContent = Storage::disk('minio')->get($remotePath);
    Storage::disk('local')->put($localPath, $fileContent);

    $fn = function ($fileName = '') {
        $bashPath = 'public' . DIRECTORY_SEPARATOR . 'cache';
        return $fileName ? ($bashPath . DIRECTORY_SEPARATOR . $fileName) : $bashPath;
    };

    $imagePathResult = storage_path(
        'app' . DIRECTORY_SEPARATOR . $fn($localPath)
    );

    return response()->file($imagePathResult);
});

Route::get('storage-test', function () {
    return Storage::disk('minio')->delete('pic-5.jpg');
});
