<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ApkBoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\WebPromosiController;
use App\Http\Controllers\ApkNotifikasiController;
use App\Http\Controllers\ApkContactController;

use App\Http\Controllers\ApkLinkController;
use App\Http\Controllers\ApkSettingController;
use App\Http\Controllers\ApkPemberitahuanController;

use App\Http\Controllers\LoginSpinnerController;

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

    if (Auth::check()) {
        $user = Auth::user();
        // dd($user->divisi);

        if ($user->divisi == 'superadmin') {
            return redirect()->intended('/superadmin');
        } elseif ($user->divisi == 'apk') {
            return redirect()->intended('/apk');
        } else {
            return redirect()->intended('http://127.0.0.1:8000/login');
        }
    }

    return redirect()->intended('http://127.0.0.1:8000/login');
});

Route::get('/superadmin', function () {
    return view('dashboard.superadmin.superadmin', [
        'title' => 'superadmin',
    ]);
})->Middleware(['auth', 'superadmin']);

Route::get('/apk', function () {
    return view('dashboard.dashboard', [
        'title' => 'APK',
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->Middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->Middleware('auth');


Route::get('/trex1diath/register', [RegisterController::class, 'index']);
Route::post('/trex1diath/register', [RegisterController::class, 'store']);

/*------------------------------------- APK -------------------------------------*/

/*-- Bo --*/
Route::get('/apk/bo', [ApkBoController::class, 'index']);
Route::get('apk/bo/data/{id}', [ApkBoController::class, 'data']);
Route::post('/apk/bo/create', [ApkBoController::class, 'store']);
Route::put('/apk/bo/update/{id}', [ApkBoController::class, 'update']);
Route::delete('/apk/bo/delete/{id}', [ApkBoController::class, 'destroy']);

/*-- Notifikasi --*/
Route::get('/apk/notifikasi', [ApkNotifikasiController::class, 'index']);
Route::post('/apk/notifikasi/update', [ApkNotifikasiController::class, 'update'])->name('notifikasi.update');


/*-- Contact --*/
Route::get('/apk/contact', [ApkContactController::class, 'index']);
Route::post('/apk/contact/update', [ApkContactController::class, 'update'])->name('contact.update');


/*-- Link --*/
Route::get('/apk/link', [ApkLinkController::class, 'index']);
Route::get('apk/link/data/{id}', [ApkLinkController::class, 'data']);
Route::post('/apk/link/create', [ApkLinkController::class, 'create']);
Route::post('/apk/link/update/{id}', [ApkLinkController::class, 'update']);
Route::delete('/apk/link/delete/{id}', [ApkLinkController::class, 'delete']);

/*-- Setting --*/
Route::get('/apk/setting', [ApkSettingController::class, 'index']);
Route::post('/apk/setting/update', [ApkSettingController::class, 'update'])->name('setting.update');

/*-- Pemberitahuan --*/
Route::get('/apk/pemberitahuan', [ApkPemberitahuanController::class, 'index']);
Route::get('apk/pemberitahuan/data/{id}', [ApkPemberitahuanController::class, 'data']);
Route::post('/apk/pemberitahuan/create', [ApkPemberitahuanController::class, 'create']);
Route::post('/apk/pemberitahuan/update/{id}', [ApkPemberitahuanController::class, 'update']);
Route::delete('/apk/pemberitahuan/delete/{id}', [ApkPemberitahuanController::class, 'delete']);



/*------------------------------------- SUPERADMIN -------------------------------------*/
/*-- Dshboard --*/
Route::resource('/superadmins/usertrexdiat', SuperAdminController::class)->Middleware(['auth', 'superadmin']);
Route::post('/superadmins/usertrexdiat/{post:id}', [SuperAdminController::class, 'show'])->Middleware(['auth', 'superadmin']);
Route::post('/web/promosi/deleteimage', [WebPromosiController::class, 'deleteimage'])->name('deleteimage');
