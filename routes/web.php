<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;
use PSpell\Config;

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
    return view('/login');
});

Route::get('/splashScreen', function () {
    return view('splashScreen');
});

Route::get('/login', function () {
    return view('login');
})->name('login');


// Hak Akses Auditor
Route::middleware(['auth', 'CekLevel:Auditor,Auditee,Master'])->group(function () {
    Route::get('MD-Auditee', [Controller::class, 'dataAuditee']);
    Route::get('MD-Auditor', [Controller::class, 'dataAuditor']);
    Route::put('/auditor/update-foto/{id}', [Controller::class, 'updateFotoAuditor'])->name('updateFotoAuditor');
    Route::put('/auditee/update-foto/{id}', [Controller::class, 'updateFotoAuditee'])->name('updateFotoAuditee');



    Route::get('/room-audit/{id}', [Controller::class, 'detailRoom'])->name('roomAudit.detail');
    Route::post('/room-audit/validate/{id}', [Controller::class, 'checkSandiRoom'])->name('roomAudit.validate');
    Route::get('/form-hasil/{room_id}', [Controller::class, 'form'])->name('formHasil');
    Route::get('/auditee/find/{nik}', [Controller::class, 'findAuditee'])->name('auditee.find');

    Route::post('/hasilpengamatan/storePengamatan/{room_id}', [Controller::class,'storePengamatan'])->name('hasilpengamatan.storePengamatan');

    Route::get('/dataPengamatan/{room_id}', [Controller::class, 'dataPengamatan'])->name('dataPengamatan');
    Route::put('/hasilpengamatan/{id}/{room_id}/updateCatatan', [Controller::class, 'updateCatatan'])->name('hasilpengamatan.updateCatatan');
    Route::delete('/hasilpengamatan/{id}/{room_id}', [Controller::class, 'pengamatanDestroy'])->name('hasilpengamatan.destroy');

    // Form Temuan
    Route::get('/temuan-audit/{id}', [Controller::class, 'temuanAudit'])->name('formTemuan');
    Route::post('/form-temuan/createTemuan', [Controller::class, 'createTemuan'])->name('createTemuan');

    Route::post('/form-temuan/{id}/add-foto', [Controller::class, 'addFoto'])->name('addFotoTemuan');
    Route::get('/hasilTemuan', [Controller::class, 'hasilTemuan'])->name('hasilTemuan');
    Route::delete('/temuan/{id}', [Controller::class, 'deleteTemuan'])->name('temuan.delete');
    Route::put('/temuan/{id}/selesaikan', [Controller::class, 'selesaikanTemuan'])->name('temuan.selesaikan');

    Route::delete('/temuan/{id}', [Controller::class, 'deleteTemuan'])->name('temuan.delete');

    // Approval Auditee (Hasil Pengamatan)
    Route::get('/auditeePengamatan', [Controller::class, 'auditeePengamatan'])->name('auditeePengamatan');
    Route::put('/pengamatan/approve/{id}', [Controller::class, 'approve'])->name('pengamatan.approval');
    Route::get('/auditeePengamatan/pdf/{id}', [Controller::class,
    'exportAuditeePengamatanPDF'])->name('auditeePengamatan.pdf');

    Route::get('/auditeePengamatan/preview/{id}', [Controller::class, 'previewAuditeePengamatan'])
    ->name('auditeePengamatan.preview');
    Route::get('/auditeePenyelesaian', [Controller::class, 'listPenyelesaian'])->name('listPenyelesaian');
    Route::get('/formPenyelesaian/{id}', [Controller::class, 'formPenyelesaian'])->name('formPenyelesaian');
    Route::post('/storePenyelesaian', [Controller::class, 'storePenyelesaian'])->name('storePenyelesaian');
});

Route::middleware(['auth', 'CekLevel:Auditor,leadAuditor,Master'])->group(function () {
    Route::get('/listRoom', [Controller::class, 'listRoom'])->name('listRoom');
});
// Hak Akses Master
Route::middleware(['auth', 'CekLevel:Master'])->group(function () {

    Route::post('/tambahUser', [Controller::class, 'tambahUser'])->name('user.store');
    Route::post('/user/update/{id}', [Controller::class, 'updateUser'])->name('user.update');
    Route::delete('/deleteUser/{id}', [Controller::class, 'Userdestroy'])->name('deleteUser');

    // Controller Auditor
    Route::post('/auditor/update/{id}', [Controller::class, 'updateAuditor'])->name('auditor.update');
    Route::delete('/deleteAuditor/{id}', [Controller::class, 'Auditordestroy'])->name('deleteAuditor');
    Route::post('/tambahAuditor', [Controller::class, 'tambahAuditor']);

    // Controller Auditee
    Route::post('/tambahAuditee', [Controller::class, 'tambahAuditee']);
    Route::post('/auditee/update/{id}', [Controller::class, 'updateAuditee'])->name('auditee.update');
    Route::delete('/deleteAuditee/{id}', [Controller::class, 'Auditeedestroy'])->name('deleteAuditee');

    // Import Excel
    Route::post('importAuditor', [ImportController::class, 'importAuditor']);
    Route::post('importAuditee', [ImportController::class, 'importAuditee']);
    Route::post('importCabang', [ImportController::class, 'importCabang']);


    // Surat Keluar
    Route::get('MD-SuratKeluar', [Controller::class, 'dataSuratKeluar']);
    Route::post('/tambahSurat', [Controller::class, 'tambahSurat']);
    Route::delete('/deleteSurat/{id}', [Controller::class, 'deleteSurat'])->name('deleteSurat');

    // Controller Cabang
    Route::get('MD-Cabang', [Controller::class, 'dataCabang'])->name('MD-Cabang');
    Route::post('/tambahCabang', [Controller::class, 'tambahCabang']);
    Route::post('/cabang/update/{id}', [Controller::class, 'updateCabang'])->name('cabang.update');
    Route::delete('/deleteCabang/{id}', [Controller::class, 'Cabangdestroy'])->name('deleteCabang');

    // User
    Route::post('/tambahUser', [Controller::class, 'tambahUser'])->name('user.store');
    Route::post('/user/update/{id}', [Controller::class, 'updateUser'])->name('user.update');
    Route::delete('/deleteUser/{id}', [Controller::class, 'Userdestroy'])->name('deleteUser');
    Route::get('daftarUser', [Controller::class, 'dataUser'])->name('dataUser');
});

// web.php



// Validasi Login Master dan Lead Auditor
Route::middleware(['auth', 'CekLevel:leadAuditor,Master'])->group(function () {
    Route::get('/dataRoom', [Controller::class, 'dataRoom'])->name('dataRoom');
    Route::post('/buatRoom', [Controller::class, 'createRoom'])->name('buatRoom');
    Route::delete('/deleteRoom/{id}', [Controller::class, 'Roomdestroy'])->name('deleteRoom');
    Route::put('/room/update/{id}', [Controller::class, 'updateRoom'])->name('room.update');

    Route::get('/hasilAudit', [Controller::class, 'showHasilAudit'])->name('hasilAudit');
    Route::get('/lihatHasilAudit/{id}', [Controller::class, 'lihatHasilAudit'])->name('lihatHasilAudit');
    Route::post('/temuan/{id}/approve', [Controller::class, 'approveTemuan'])->name('temuan.approve');
    // Tampilkan form revisi
    Route::get('/temuan/{id}/revisi', [Controller::class, 'editRevisi'])->name('temuan.revisi');
    // Update data hasil revisi
    Route::post('/temuan/{id}/revisi', [Controller::class, 'updateRevisi'])->name('temuan.updateRevisi');
});



// Proses login
Route::post('/login', [Controller::class, 'login'])->name('login.process');
// Logout
Route::post('/logout', [Controller::class, 'logout'])->name('logout');
Route::get('/get-kode-cabang/{cabang}', [Controller::class, 'getKodeCabang']);


