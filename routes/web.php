<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller; 
use App\Http\Controllers\Home\HomeController; 
use App\Http\Controllers\Menu\MenuController; 
use App\Http\Controllers\Users\UsersController; 
use App\Http\Controllers\Role\RoleController; 
use App\Http\Controllers\Role\RoleUserController; 
use App\Http\Controllers\Role\RoleMenuController; 
use App\Http\Controllers\Auth\AuthController; 
use App\Http\Controllers\Provinsi\ProvinsiController; 
use App\Http\Controllers\KabKota\KabKotaController; 
use App\Http\Controllers\Kecamatan\KecamatanController; 
use App\Http\Controllers\KelDesa\KelDesaController; 
use App\Http\Controllers\Bksu\BksuController; 
use App\Http\Controllers\Bksd\BksdController; 
use App\Http\Controllers\JenisKerjasama\JenisKerjasamaController; 
use App\Http\Controllers\JenisMitra\JenisMitraController; 
use App\Http\Controllers\Mitra\MitraController; 
use App\Http\Controllers\Unit\UnitController; 
use App\Http\Controllers\Usulan\UsulanController; 
use App\Http\Controllers\DokumenKerjasama\DokumenKerjasamaController; 

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
Route::get('/no-akses', [HomeController::class, 'no_akses'])->name("no_akses");
Route::get('/no-role', [HomeController::class, 'no_role']);
Route::get('/coba', [HomeController::class, 'menu_akses']);
Route::get('/tes-dir', function(){
    $dir = opendir(__DIR__."../public_html/public/simkerma/dokumen/kerjasama/");
    print_r($dir);
});

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name("login");
Route::post('/login', [AuthController::class, 'login'])->name("login");
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");

/** M PROVINSI */
Route::prefix('provinsi')->middleware('auth')->group(function () {
    Route::get('/', [ProvinsiController::class, 'index']);
    Route::get('/add', [ProvinsiController::class, 'create']);
    Route::post('/save', [ProvinsiController::class, 'store']);
    Route::get('/ubah/{id}', [ProvinsiController::class, 'edit']);
    Route::put('/update/{id}', [ProvinsiController::class, 'update']);
    Route::delete('/delete/{id}', [ProvinsiController::class, 'destroy']);
    Route::put('/update_status/{id}', [ProvinsiController::class, 'update_status']);
});

/** M KAB KOTA */
Route::prefix('kab-kota')->middleware('auth')->group(function () {
    Route::get('/', [KabKotaController::class, 'index']);
    Route::get('/add', [KabKotaController::class, 'create']);
    Route::post('/save', [KabKotaController::class, 'store']);
    Route::get('/ubah/{id}', [KabKotaController::class, 'edit']);
    Route::put('/update/{id}', [KabKotaController::class, 'update']);
    Route::delete('/delete/{id}', [KabKotaController::class, 'destroy']);
    Route::put('/update_status/{id}', [KabKotaController::class, 'update_status']);
});

/** M KECAMATAN */
Route::prefix('kecamatan')->middleware('auth')->group(function () {
    Route::get('/', [KecamatanController::class, 'index']);
    Route::get('/add', [KecamatanController::class, 'create']);
    Route::post('/save', [KecamatanController::class, 'store']);
    Route::get('/ubah/{id}', [KecamatanController::class, 'edit']);
    Route::put('/update/{id}', [KecamatanController::class, 'update']);
    Route::delete('/delete/{id}', [KecamatanController::class, 'destroy']);
    Route::put('/update_status/{id}', [KecamatanController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [KecamatanController::class, 'kab_kota']);
});

/** M KELURAHAN / DESA */
Route::prefix('kel-desa')->middleware('auth')->group(function () {
    Route::get('/', [KelDesaController::class, 'index']);
    Route::get('/add', [KelDesaController::class, 'create']);
    Route::post('/save', [KelDesaController::class, 'store']);
    Route::get('/ubah/{id}', [KelDesaController::class, 'edit']);
    Route::put('/update/{id}', [KelDesaController::class, 'update']);
    Route::delete('/delete/{id}', [KelDesaController::class, 'destroy']);
    Route::put('/update_status/{id}', [KelDesaController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [KelDesaController::class, 'kab_kota']);
    Route::get('/get_kecamatan/{id_provinsi}/{id_kab_kota}', [KelDesaController::class, 'kecamatan']);
});

/** M BNTUK KERJASAMA UMUM */
Route::prefix('bksu')->middleware('auth')->group(function () {
    Route::get('/', [BksuController::class, 'index']);
    Route::get('/add', [BksuController::class, 'create']);
    Route::post('/save', [BksuController::class, 'store']);
    Route::get('/ubah/{id}', [BksuController::class, 'edit']);
    Route::put('/update/{id}', [BksuController::class, 'update']);
    Route::delete('/delete/{id}', [BksuController::class, 'destroy']);
    Route::put('/update_status/{id}', [BksuController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [BksuController::class, 'kab_kota']);
    Route::get('/get_kecamatan/{id_provinsi}/{id_kab_kota}', [BksuController::class, 'kecamatan']);
});

/** M BNTUK KERJASAMA DETAIL */
Route::prefix('bksd')->middleware('auth')->group(function () {
    Route::get('/', [BksdController::class, 'index']);
    Route::get('/add', [BksdController::class, 'create']);
    Route::post('/save', [BksdController::class, 'store']);
    Route::get('/ubah/{id}', [BksdController::class, 'edit']);
    Route::put('/update/{id}', [BksdController::class, 'update']);
    Route::delete('/delete/{id}', [BksdController::class, 'destroy']);
    Route::put('/update_status/{id}', [BksdController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [BksdController::class, 'kab_kota']);
    Route::get('/get_kecamatan/{id_provinsi}/{id_kab_kota}', [BksdController::class, 'kecamatan']);
});

/** M JENIS KERJASAMA */
Route::prefix('jenis-ks')->middleware('auth')->group(function () {
    Route::get('/', [JenisKerjasamaController::class, 'index']);
    Route::get('/add', [JenisKerjasamaController::class, 'create']);
    Route::post('/save', [JenisKerjasamaController::class, 'store']);
    Route::get('/ubah/{id}', [JenisKerjasamaController::class, 'edit']);
    Route::put('/update/{id}', [JenisKerjasamaController::class, 'update']);
    Route::delete('/delete/{id}', [JenisKerjasamaController::class, 'destroy']);
    Route::put('/update_status/{id}', [JenisKerjasamaController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [JenisKerjasamaController::class, 'kab_kota']);
    Route::get('/get_kecamatan/{id_provinsi}/{id_kab_kota}', [JenisKerjasamaController::class, 'kecamatan']);
});

/** M JENIS MITRA */
Route::prefix('jenis-mitra')->middleware('auth')->group(function () {
    Route::get('/', [JenisMitraController::class, 'index']);
    Route::get('/add', [JenisMitraController::class, 'create']);
    Route::post('/save', [JenisMitraController::class, 'store']);
    Route::get('/ubah/{id}', [JenisMitraController::class, 'edit']);
    Route::put('/update/{id}', [JenisMitraController::class, 'update']);
    Route::delete('/delete/{id}', [JenisMitraController::class, 'destroy']);
    Route::put('/update_status/{id}', [JenisMitraController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [JenisMitraController::class, 'kab_kota']);
    Route::get('/get_kecamatan/{id_provinsi}/{id_kab_kota}', [JenisMitraController::class, 'kecamatan']);
});

/** M MITRA */
Route::prefix('mitra')->middleware('auth')->group(function () {
    Route::get('/', [MitraController::class, 'index']);
    Route::get('/add', [MitraController::class, 'create']);
    Route::post('/save', [MitraController::class, 'store']);
    Route::get('/ubah/{id}', [MitraController::class, 'edit']);
    Route::put('/update/{id}', [MitraController::class, 'update']);
    Route::delete('/delete/{id}', [MitraController::class, 'destroy']);
    Route::put('/update_status/{id}', [MitraController::class, 'update_status']);
    Route::get('/get_kab_kota/{id}', [MitraController::class, 'kab_kota']);
    Route::get('/get_kecamatan/{id_provinsi}/{id_kab_kota}', [MitraController::class, 'kecamatan']);
    Route::get('/get_kel_desa/{id_provinsi}/{id_kab_kota}/{id_kecamatan}', [MitraController::class, 'kel_desa']);
});

/** M UNIT */
Route::prefix('unit')->middleware('auth')->group(function () {
    Route::get('/', [UnitController::class, 'index']);
    Route::get('/add', [UnitController::class, 'create']);
    Route::post('/save', [UnitController::class, 'store']);
    Route::get('/ubah/{id}', [UnitController::class, 'edit']);
    Route::put('/update/{id}', [UnitController::class, 'update']);
    Route::delete('/delete/{id}', [UnitController::class, 'destroy']);
});

/** M USULAN */
Route::prefix('usulan')->middleware('auth')->group(function () {
    Route::get('/', [UsulanController::class, 'index']);
    Route::get('/add', [UsulanController::class, 'create']);
    Route::post('/save', [UsulanController::class, 'store']);
    Route::get('/ubah/{id}', [UsulanController::class, 'edit']);
    Route::put('/update/{id}', [UsulanController::class, 'update']);
    Route::delete('/delete/{id}', [UsulanController::class, 'destroy']);
});

/** T DOKUEN KERJASAMA */
Route::prefix('dokumen-ks')->middleware('auth')->group(function () {
    Route::get('/', [DokumenKerjasamaController::class, 'index']);
    Route::get('/add', [DokumenKerjasamaController::class, 'create']);
    Route::post('/save', [DokumenKerjasamaController::class, 'store']);
    Route::get('/ubah/{id}', [DokumenKerjasamaController::class, 'edit']);
    Route::put('/update/{id}', [DokumenKerjasamaController::class, 'update']);
    Route::delete('/delete/{id}', [DokumenKerjasamaController::class, 'destroy']);
    Route::get('/get_usulan/{id}', [DokumenKerjasamaController::class, 'get_usulan']);
});

























/** ADMIN ROUTE */
/** Route Menu */
Route::prefix('menu')->middleware('admin')->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::get('/add', [MenuController::class, 'create']);
    Route::post('/save', [MenuController::class, 'store']);
    Route::get('/ubah/{id}', [MenuController::class, 'edit']);
    Route::put('/update/{id}', [MenuController::class, 'update']);
    Route::delete('/delete/{id}', [MenuController::class, 'destroy']);
    Route::put('/update_status/{id}', [MenuController::class, 'update_status']);
});

/** Route Users */
Route::prefix('users')->middleware('admin')->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/add', [UsersController::class, 'create']);
    Route::post('/save', [UsersController::class, 'store']);
    Route::get('/ubah/{id}', [UsersController::class, 'edit']);
    Route::put('/update/{id}', [UsersController::class, 'update']);
    Route::delete('/delete/{id}', [UsersController::class, 'destroy']);
    Route::put('/update_status/{id}', [UsersController::class, 'update_status']);
});

/** Route Role */
Route::prefix('role')->middleware('admin')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/add', [RoleController::class, 'create']);
    Route::post('/save', [RoleController::class, 'store']);
    Route::get('/ubah/{id}', [RoleController::class, 'edit']);
    Route::put('/update/{id}', [RoleController::class, 'update']);
    Route::delete('/delete/{id}', [RoleController::class, 'destroy']);
    Route::put('/update_status/{id}', [RoleController::class, 'update_status']);
});

/** Route Role User */
Route::prefix('role-user')->middleware('admin')->group(function () {
    Route::get('/', [RoleUserController::class, 'index']);
    Route::get('/add', [RoleUserController::class, 'create']);
    Route::post('/save', [RoleUserController::class, 'store']);
    Route::get('/ubah/{id}', [RoleUserController::class, 'edit']);
    Route::put('/update/{id}', [RoleUserController::class, 'update']);
    Route::delete('/delete/{id}', [RoleUserController::class, 'destroy']);
    Route::put('/update_status/{id}', [RoleUserController::class, 'update_status']);
});

/** Route Role Menu */
Route::prefix('role-menu')->middleware('admin')->group(function () {
    Route::get('/', [RoleMenuController::class, 'index']);
    Route::get('/add', [RoleMenuController::class, 'create']);
    Route::post('/save', [RoleMenuController::class, 'store']);
    Route::get('/ubah/{id}', [RoleMenuController::class, 'edit']);
    Route::put('/update/{id}', [RoleMenuController::class, 'update']);
    Route::delete('/delete/{id}', [RoleMenuController::class, 'destroy']);
    Route::put('/update_status/{id}', [RoleMenuController::class, 'update_status']);
});

