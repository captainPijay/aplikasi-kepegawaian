<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KenaikanGajiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\SuamiIstriController;
use App\Http\Controllers\TunjanganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpknController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SatuanKerjaController;
use App\Http\Controllers\DataInstansiController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\JenjangJabatanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WorkLocationController;
use App\Http\Controllers\SatuanKerjaIndukController;

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
    // return view('back_office.layouts.index');
    return redirect('/login');
});
Route::middleware('guest')->get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('auth:web,pegawai')->prefix('back-office')->group(function () {
    Route::middleware('auth:web')->group(function () {
        Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::delete('/pegawai/destroy/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
        Route::post('/pegawai/update-readonly-input', [PegawaiController::class, 'updateReadonlyInput'])->name('pegawai.updateReadonlyInput');
    });
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/detail/{id}', [PegawaiController::class, 'detail'])->name('pegawai.detail');
});
Route::middleware(['auth:web'])->prefix('back-office')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware(['auth'])->prefix('data-master')->group(function () {
        Route::get('/kpkn', [KpknController::class, 'index'])->name('kpkn.index');
        Route::post('/kpkn/store', [KpknController::class, 'store'])->name('kpkn.store');
        Route::put('/kpkn/update/{id}', [KpknController::class, 'update'])->name('kpkn.update');
        Route::delete('/kpkn/destroy/{id}', [KpknController::class, 'destroy'])->name('kpkn.destroy');

        Route::get('/work-location', [WorkLocationController::class, 'index'])->name('workLocation.index');
        Route::post('/work-location/store', [WorkLocationController::class, 'store'])->name('workLocation.store');
        Route::put('/work-location/update/{id}', [WorkLocationController::class, 'update'])->name('workLocation.update');
        Route::delete('/work-location/destroy/{id}', [WorkLocationController::class, 'destroy'])->name('workLocation.destroy');

        Route::get('/opd', [SatuanKerjaIndukController::class, 'index'])->name('satuanKerjaInduk.index');
        Route::post('/opd/store', [SatuanKerjaIndukController::class, 'store'])->name('satuanKerjaInduk.store');
        Route::put('/opd/update/{id}', [SatuanKerjaIndukController::class, 'update'])->name('satuanKerjaInduk.update');
        Route::delete('/opd/destroy/{id}', [SatuanKerjaIndukController::class, 'destroy'])->name('satuanKerjaInduk.destroy');

        Route::get('/bagian-opd', [SatuanKerjaController::class, 'index'])->name('satuanKerja.index');
        Route::post('/bagian-opd/store', [SatuanKerjaController::class, 'store'])->name('satuanKerja.store');
        Route::put('/bagian-opd/update/{id}', [SatuanKerjaController::class, 'update'])->name('satuanKerja.update');
        Route::delete('/bagian-opd/destroy/{id}', [SatuanKerjaController::class, 'destroy'])->name('satuanKerja.destroy');

        Route::get('/data-instansi', [DataInstansiController::class, 'index'])->name('dataInstansi.index');
        Route::post('/data-instansi/store', [DataInstansiController::class, 'store'])->name('dataInstansi.store');
        Route::put('/data-instansi/update/{id}', [DataInstansiController::class, 'update'])->name('dataInstansi.update');
        Route::delete('/data-instansi/destroy/{id}', [DataInstansiController::class, 'destroy'])->name('dataInstansi.destroy');
    });

    Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan.index');
    Route::post('/pendidikan/store', [PendidikanController::class, 'store'])->name('pendidikan.store');
    Route::put('/pendidikan/update/{id}', [PendidikanController::class, 'update'])->name('pendidikan.update');
    Route::delete('/pendidikan/destroy/{id}', [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');

    Route::middleware(['auth'])->prefix('keluarga')->group(function () {
        Route::get('/suami-istri', [SuamiIstriController::class, 'index'])->name('suamiIstri.index');
        Route::post('/suami-istri/store', [SuamiIstriController::class, 'store'])->name('suamiIstri.store');
        Route::put('/suami-istri/update/{id}', [SuamiIstriController::class, 'update'])->name('suamiIstri.update');
        Route::delete('/suami-istri/destroy/{id}', [SuamiIstriController::class, 'destroy'])->name('suamiIstri.destroy');

        Route::get('/anak', [AnakController::class, 'index'])->name('anak.index');
        Route::post('/anak/store', [AnakController::class, 'store'])->name('anak.store');
        Route::put('/anak/update/{id}', [AnakController::class, 'update'])->name('anak.update');
        Route::delete('/anak/destroy/{id}', [AnakController::class, 'destroy'])->name('anak.destroy');
    });

    Route::middleware(['auth'])->prefix('data-kepegawaian')->group(function () {
        Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::post('/jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::put('/jabatan/update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::delete('/jabatan/destroy/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

        Route::get('/jenjang-jabatan', [JenjangJabatanController::class, 'index'])->name('jenjangJabatan.index');
        Route::post('/jenjang-jabatan/store', [JenjangJabatanController::class, 'store'])->name('jenjangJabatan.store');
        Route::put('/jenjang-jabatan/update/{id}', [JenjangJabatanController::class, 'update'])->name('jenjangJabatan.update');
        Route::delete('/jenjang-jabatan/destroy/{id}', [JenjangJabatanController::class, 'destroy'])->name('jenjangJabatan.destroy');

        Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
        Route::post('/cuti/store', [CutiController::class, 'store'])->name('cuti.store');
        Route::put('/cuti/update/{id}', [CutiController::class, 'update'])->name('cuti.update');
        Route::delete('/cuti/destroy/{id}', [CutiController::class, 'destroy'])->name('cuti.destroy');
        Route::post('/cuti/update-readonly-input', [CutiController::class, 'updateReadonlyInput'])->name('cuti.updateReadonlyInput');

        Route::get('/kenaikan-gaji', [KenaikanGajiController::class, 'index'])->name('kenaikanGaji.index');
        Route::post('/kenaikan-gaji/store', [KenaikanGajiController::class, 'store'])->name('kenaikanGaji.store');
        Route::put('/kenaikan-gaji/update/{id}', [KenaikanGajiController::class, 'update'])->name('kenaikanGaji.update');
        Route::delete('/kenaikan-gaji/destroy/{id}', [KenaikanGajiController::class, 'destroy'])->name('kenaikanGaji.destroy');

        Route::get('/tunjangan', [TunjanganController::class, 'index'])->name('tunjangan.index');
        Route::post('/tunjangan/store', [TunjanganController::class, 'store'])->name('tunjangan.store');
        Route::put('/tunjangan/update/{id}', [TunjanganController::class, 'update'])->name('tunjangan.update');
        Route::delete('/tunjangan/destroy/{id}', [TunjanganController::class, 'destroy'])->name('tunjangan.destroy');
    });

    Route::middleware('superAdmin')->prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    Route::get('cetak-laporan', [ExportController::class, 'index'])->name('cetakLaporan.index');
    Route::get('cetak-laporan-download', [ExportController::class, 'download'])->name('cetakLaporan.download');

    Route::get('pdf', [PdfController::class, 'index'])->name('pdf.index');
});
