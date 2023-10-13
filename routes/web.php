<?php

use App\Events\ChatEvent;
use App\Events\CountEvent;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HukumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Security;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\VerificatorController;
use App\Http\Controllers\Users;
use App\Http\Controllers\DevelopingController;

use App\Models\Config;
use App\Models\District;
use App\Models\Province;
use App\Models\ProvinceDomain;
use App\Models\Regency;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use App\Notifications\WelcomeEmailNotification;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\BalwasluController;
use App\Http\Controllers\HumanVerificationController;
use App\Http\Controllers\RekapitulatorController;
use App\Http\Controllers\ValidatorHukumController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RelawanController;
use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\CheckingController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\Payrole;
use App\Models\MultiAdministrator;
use App\Models\RegenciesDomain;
use App\Models\Tracking;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\Promise\all;

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




Route::get('/kontol', function () {
    $config = App\Models\Config::first();
    $kotas = App\Models\Regency::where('province_id', $config->provinces_id)->get();

    foreach ($kotas as $kot) {
        dump($kot->id, $kot->name);
    }
});


Route::get('/ceksetup', function () {
    $config = Config::first();
    if ($config->setup == 'yes') {
        return view('publik.belum-setup');
    } else {
        return redirect(url('/'));
    }
});
Route::get('/', function () {
    $config = Config::all()->first();
    if ($config['setup'] == "yes") {
        return redirect('setup');
    } else {
        // return redirect('index');
        return redirect('login');
    }
});


Route::get('/memuat', function () {
    return view('test.memuat');
});


Route::get('/geojson', function () {
    return view('test.geojson');
});


Route::get('/setup', function () {
    $config = Config::all()->first();
    if ($config['setup'] == "yes") {
        return view('setup.dashboard');
    } else {
        return redirect('index');
    }
});


Route::get('/mail', function () {
    $user = User::create([
        'name' => '12312',
        'email' => 'adityasundawa.34@gmail.com',
        'password' => Hash::make('23123123'),
    ]);
    $user->notify(new WelcomeEmailNotification());
    return $user;
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/registrasi_saksi', function () {
    $kecamatan = District::where('regency_id', 3674)->get();
    return view('auth.registasi', [
        'kec' => $kecamatan
    ]);
})->name('registrasi');
Route::get('/redirect', [LoginController::class, 'index']);
Route::get('/get-aca', [EmailController::class, 'getAca'])->name('getAca');
// Ajax Kelurahan / Kecamatan
Route::get('getCourse/{id}', function ($id) {
    $course = Regency::where('province_id', $id)->get();
    return response()->json($course);
});
Route::get('getKecamatan/{id}', function ($id) {
    $course = District::where('regency_id', $id)->get();
    return response()->json($course);
});
Route::get('getKelurahan/{id}', function ($id) {
    $course = Village::where('district_id', $id)->get();
    return response()->json($course);
});
//auth
//register Admin
Route::get('register-admin', [LoginController::class, 'createAdmin'])->name('formRegister.admin');
Route::get('login/tracking', [LoginController::class, 'track_rec']);
Route::post('store-admin', [LoginController::class, 'storeAdmin'])->name('storeRegister.admin');
Route::get('request', [Controller::class, 'request']);
Route::get('ambil', [Controller::class, 'ambil']);
// Route::get('/email', function () {
//     Mail::to('adityasundawa.co@gmail.com')->send(new WelcomeMail());
//     return new WelcomeMail();
// });
Route::group(['middleware' => 'auth'], function () {
    //administrator
    Route::get('security/login/{id}', [SecurityController::class, 'index'])->name('security.login');
    Route::get('security/register/{id}', [SecurityController::class, 'create'])->name('security.register');
    Route::get('security/logoutKelurahan/{id}', [SecurityController::class, 'logoutKelurahan'])->name('security.logoutKelurahan');
    Route::post('security/store/{id}', [SecurityController::class, 'store'])->name('security.store');
    Route::post('security/loginAction/{id}', [SecurityController::class, 'loginAction'])->name('security.actionLog');
    Route::group(['middleware' => 'role:administrator', 'prefix' => 'administrator', 'as' => 'superadmin.'], function () {
        Route::get('index', [AdminController::class, 'index'])->name('index');



        Route::get('/all-c1-plano',function ()
        {
           return view('administrator.all_c1'); 
        });

        Route::get('/all-c1-relawan',function ()
        {
           return view('administrator.all_c1_relawan'); 
        });

        Route::post('settings-theme', [AdminController::class, 'theme'])->name('theme');
        //commander
        Route::group(['middleware' => "commander"], function () {
            Route::get('commander-index', [CommanderController::class, 'index'])->name('commander-index');
            Route::post('commander-redirect',  [CommanderController::class, 'redirect']);
            Route::post('commander-scroll',  [CommanderController::class, 'scroll']);
            Route::post('commander-settings', [CommanderController::class, 'settings']);
            Route::get('notif-delete', [CommanderController::class, 'notifDel']);
            Route::get('commander-defaults', [CommanderController::class, 'defaults']);
        });
        Route::controller(AdminController::class)->group(function () {
            //Administratorw
            Route::get('r-data-record', 'rDataRecord');
            Route::get('r-data', 'rdata');
            Route::post('main-permission', 'mainPermission');
            Route::get('solution/{id}', 'solution')->name('solution');
            Route::get('laporan-bawaslu', 'laporanBapilu')->name('laporan_bapilu');
            Route::get('real_count2', 'real_count2')->name('real_count2');
            Route::get('quick_count2', 'quick_count2')->name('quick_count2');
            Route::get('terverifikasi', 'terverifikasi')->name('terverifikasi');
            Route::get('verifikasi-c1', 'verifikasiC1')->name('verifikasiC1');
            Route::get('audit-c1', 'auditC1')->name('auditC1');
            Route::get('data-gugatan', 'data_gugatan')->name('data_gugatan');
            Route::get('developer', 'developer')->name('developer');
            Route::post('cek_pass', 'cek_pass');
            Route::get('fraud-data-report', 'FraudDataReport')->name('FraudDataReport');
            Route::get('fraud-data-print', 'fraudDataPrint')->name('fraudDataPrint');
            Route::get('fraud-data-print-tercetak', 'fraudDataPrint_tercetak')->name('fraudDataPrint_tercetak');
            Route::get('print/{id}', 'print')->name('printKecurangan');
            Route::get('ajax-kecurangan-terverifikasi', 'getKecuranganTerverifikasi')->name('ajaxKecuranganTerverifikasi');
            Route::get('kecamatan/{id}', 'kecamatan');
            Route::get('index-tsm', 'index_tsm')->name('index_tsm');
            Route::get('print-index-tsm', 'print_index_tsm')->name('print_index_tsm');
            Route::get('kelurahan/{id}', 'kelurahan');
            Route::get('real_count', 'real_count');
            Route::get('quick_count', 'quick_count');
            Route::get('maps_count', 'maps_count');
            Route::get('master_data_tps', 'master_data_tps');
            Route::get('tentang', 'tentang');
            Route::get('pusat_bantuan', 'pusat_bantuan');
            Route::get('laporan', 'laporan');
            Route::get('tutorial', 'tutorial');
            Route::get('patroli_mode', 'patroli_mode');
            Route::get('patroli_mode/tracking/maps', 'tracking_maps');
            Route::get('patroli_mode/tracking/detail/{id}', 'tracking_detail');
            Route::get('verifikasi_akun', 'verifikasi_akun');
            Route::get('verifikasi_saksi', 'verifikasi_saksi');
            Route::get('pembayaran_saksi', 'pembayaran_saksi');
            Route::get('verifikasi_koreksi', 'verifikasi_koreksi');
            Route::get('kick/{id}', 'kick');
            Route::get('kecamatan/rekapitulator/{id}', 'rekapitulator');
            Route::get('blokir/{id}', 'blokir');
            Route::post('action_verifikasi/{id}', 'action_verifikasi');
            Route::get('ajax/get_verifikasi_saksi', 'get_verifikasi_saksi');
            Route::get('ajax/get_verifikasi_akun', 'get_verifikasi_akun');
            Route::get('ajax/get_history_user', 'get_history_user');
            Route::get('ajax/get_kecamatan_tracking', 'get_kecamatan_tracking');
            Route::get('ajax/get_test', 'get_test');
            Route::get('/ajax/get_koreksi_saksi', 'get_koreksi_saksi');
            Route::post('kecamatan/rekapitulator/action_rekapitulator/{id}', 'action_rekapitulator');
            Route::post('action_setujui/{id}', 'action_setujui');
            Route::get('tolak_koreksi/{id}', 'tolak_koreksi');
            Route::get('perhitungan_kecamatan/{id}', 'perhitungan_kecamatan');
            Route::get('perhitungan_kelurahan/{id}', 'perhitungan_kelurahan');
            Route::get('rekapitulator/index/{id}', 'admin_rekapitulator');
            Route::get('rekapitulator/kota', 'rekapitulator_kota');
            Route::get('rekapitulator-kota-print', 'rekapitulator_kota_print');
            Route::get('verivikator/index/{id}', 'admin_verifikator_index');
            Route::get('auditor/index/{id}', 'admin_auditor_index');
            Route::get('absensi', 'absensi');
            Route::get('absensi/hadir', 'absensi_hadir');
            Route::get('absensi/tidak_hadir', 'absensi_tidak');
            Route::get('ajax/get_tps_kelurahan', 'get_tps_kelurahan');
            Route::get('luar_negri', 'luar_negri');
            Route::post('action_luar_negri', 'actionfde_luar_negri');
            Route::post('action_luar_negri', 'action_luar_negri');
            Route::get('sidang_online', 'sidangOnline');
            Route::get('sidang_online_all', 'sidangOnlineAll');
            Route::get('sidang_online_status/{role}', 'sidangOnlinestatus');


            Route::get('/dev-pass', function () {
                return view('security.dev_pass');
            });

            Route::get('analisa_dpt_kpu', 'analisa_dpt_kpu');
            Route::get('analisa_dpt_kpu/print', 'analisa_dpt_kpu_print');
            Route::get('get_qrsidang', 'get_qrsidang');
            Route::get('print_sidang/{id}', 'print_sidang');
            Route::get('get_sidang_online/{id}', 'get_sidang_online');

            Route::get('print_qr_code', 'print_qr_code')->name('print_qr');
            Route::get('sidang_online/action/{id}/{role}', 'sidang_online_action');
            Route::get('action/batalkan_history/{id}/{user_id}', 'batalkan_history');
            Route::get('patroli/batalkan_semua/{id}', 'batalkan_semua');
        });
    });
    // End Setup Page
});

//verifikator
Route::group(['middleware' => 'role:verifikator', 'prefix' => 'verifikator', 'as' => 'verifikator.'], function () {
    Route::get('index', [VerificatorController::class, 'index'])->name('index');
    Route::post('getSaksiData', [VerificatorController::class, 'getSaksiData'])->name('getSaksiData');
    Route::get('verifikasiKecurangan/{id}', [VerificatorController::class, 'verifikasiKecurangan'])->name('verifikasiKecurangan');
    Route::get('tolakKecurangan/{id}', [VerificatorController::class, 'tolakKecurangan'])->name('tolakKecurangan');
    Route::get('getKecuranganSaksi', [VerificatorController::class, 'getKecuranganSaksi'])->name('getKecuranganSaksi');
    Route::get('get-saksi-pending', [VerificatorController::class, 'getSaksiPending'])->name('getSaksiPending');
    Route::post('get-relawan-data', [VerificatorController::class, 'getRelawanData'])->name('getRelawanData');
    Route::get('verifikasiData/{id}', [VerificatorController::class, 'verifikasiData'])->name('verifikasiData');
    Route::get('verifikasi-data-pending/{id}', [VerificatorController::class, 'verifikasiDataPending'])->name('verifikasiDataPending');
    Route::get('verifikasi-data-c1-relawan/{id}', [VerificatorController::class, 'verifikasiDataC1Relawan'])->name('verifikasiDataC1Relawan');
    Route::get('koreksidata/{id}', [VerificatorController::class, 'koreksidata'])->name('koreksidata');
    Route::post('actionKoreksiData/{id}', [VerificatorController::class, 'actionKoreksiData'])->name('actionKoreksiData');
    Route::get('village/{id}', [VerificatorController::class, "village"])->middleware('districtCheck:kelurahan')->name("village");
});


//auditor
Route::group(['middleware' => 'role:auditor', 'prefix' => 'auditor', 'as' => 'auditor.'], function () {
    Route::get('index', [AuditorController::class, 'index'])->name('index');
    Route::post('getSaksiData', [AuditorController::class, 'getSaksiData'])->name('getSaksiData');
    Route::get('auditData/{id}', [AuditorController::class, 'auditData'])->name('auditData');
    Route::get('batalkanData/{id}', [AuditorController::class, 'batalkanData'])->name('batalkanData');
    Route::get('tpsteraudit/{id}', [AuditorController::class, 'tpsteraudit'])->name('tpsteraudit');
    Route::get('village/{id}', [AuditorController::class, "village"])->middleware('districtCheck:kelurahan')->name("village");
});

//huver
Route::group(['middleware' => 'role:huver', 'prefix' => 'huver', 'as' => 'huver.'], function () {
    Route::get('index', [HumanVerificationController::class, 'index'])->name('index');
    Route::controller(HumanVerificationController::class)->group(function () {
        Route::get('verifikasi_akun', 'verifikasi_akun');
        Route::get('verifikasi_saksi', 'verifikasi_saksi');
        Route::get('ajax/get_verifikasi_saksi', 'get_verifikasi_saksi');
        Route::get('ajax/get_verifikasi_akun', 'get_verifikasi_akun');
         Route::get('verifikasi_koreksi', 'verifikasi_koreksi');
         Route::get('ajax/get_koreksi_saksi', 'get_koreksi_saksi');
        Route::post('action_verifikasi/{id}', 'action_verifikasi');
            Route::post('action_setujui/{id}', 'action_setujui');
            Route::get('tolak_koreksi/{id}', 'tolak_koreksi');
    });
});
//rekapitulator
Route::group(['middleware' => 'role:rekapitulator', 'prefix' => 'rekapitulator', 'as' => 'rekapitulator.'], function () {
    Route::get('index', [RekapitulatorController::class, 'index'])->name('index');
    Route::get('print_kecamatan', [RekapitulatorController::class, 'print_kecamatan'])->name('print_kecamatan');
    Route::post('action_rekapitulator/{id}', [RekapitulatorController::class, 'action_rekapitulator']);
});


//checking
Route::group(['middleware' => 'role:checking', 'prefix' => 'checking', 'as' => 'checking.'], function () {
    // Route::get('index', function () {
    //     return 'hai checking' . Auth::user()->role_id;
    // })->name('index');
    Route::get('index', [CheckingController::class, 'index'])->name('index');
    Route::get('verifikasi/{id}', [CheckingController::class, 'verifikasi'])->name('verifikasi');
    Route::get('tolak-overlimit/{id}', [CheckingController::class, 'tolakOverlimit'])->name('tolakOverlimit');
    Route::post('get-saksi-data', [CheckingController::class, 'getSaksiData'])->name('getSaksiData');
});


//hunter
Route::group(['middleware' => 'role:hunter', 'prefix' => 'hunter', 'as' => 'hunter.'], function () {
    Route::get('index', [HunterController::class, 'index'])->name('index');
    Route::post('get-saksi-data', [HunterController::class, 'getSaksiData'])->name('getSaksiData');
    Route::post('verifikasi-relawan/{id}', [HunterController::class, 'verifikasiRelawan'])->name('verifikasiRelawan');
});


//saksi
Route::group(['middleware' => 'role:saksi', 'prefix' => 'saksi', 'as' => 'saksi.'], function () {
    Route::get('index', function () {
        return 'hai saksi';
    })->name('index');
});
//hukum
Route::group(['middleware' => 'role:hukum', 'prefix' => 'hukum', 'as' => 'hukum.'], function () {
    Route::get('index', [HukumController::class, 'index'])->name('index');
    Route::controller(HukumController::class)->group(function () {
        Route::get('terverifikasi', 'terverifikasi');
        Route::get('ditolak', 'ditolak');
        Route::get('print/{id}', 'print');
        Route::get('verifikasi_kecurangan/{id}', 'verifikasi_kecurangan');
        Route::get('indextsm', 'indextsm');
        Route::get('getsolution', 'getsolution');
        Route::get('ajax/get_foto_kecurangan', 'get_foto_kecurangan');
        Route::get('ajax/get_vidio_kecurangan', 'get_vidio_kecurangan');
        Route::get('ajax/get_list_kecurangan', 'get_list_kecurangan');
        Route::get('ajax/get_fotoKecuranganterverifikasi', 'get_fotoKecuranganterverifikasi');
        Route::get('ajax/get_fotoKecuranganditolak', 'get_fotoKecuranganditolak');
        Route::get('action_verifikasi_kecurangan/{id}', 'action_verifikasi_kecurangan');
        Route::get('action_tolak_kecurangan/{id}', 'action_tolak_kecurangan');
        Route::post('action/proses_kecurangan/{id}', 'proses_kecurangan');
    });
});
//validator hukum
Route::group(['middleware' => 'role:validator_hukum', 'prefix' => 'validator-hukum', 'as' => 'validator_hukum.'], function () {
    Route::get('index', [ValidatorHukumController::class, 'index'])->name('index');
    Route::controller(ValidatorHukumController::class)->group(function () {
        Route::get('terverifikasi', 'terverifikasi');
        Route::get('ditolak', 'ditolak');
        Route::get('print/{id}', 'print');
        Route::get('verifikasi_kecurangan/{id}', 'verifikasi_kecurangan');
        Route::get('indextsm', 'indextsm');
        Route::get('ajax/get_foto_kecurangan', 'get_foto_kecurangan');
        Route::get('ajax/get_vidio_kecurangan', 'get_vidio_kecurangan');
        Route::get('ajax/get_list_kecurangan', 'get_list_kecurangan');
        Route::get('ajax/get_fotoKecuranganterverifikasi', 'get_fotoKecuranganterverifikasi');
        Route::get('ajax/get_fotoKecuranganditolak', 'get_fotoKecuranganditolak');
        Route::get('action_verifikasi_kecurangan/{id}', 'action_verifikasi_kecurangan');
        Route::get('action_tolak_kecurangan/{id}', 'action_tolak_kecurangan');
        Route::post('action/proses_kecurangan/{id}', 'proses_kecurangan');
    });
});
//banwaslu
Route::group(['middleware' => 'role:banwaslu', 'prefix' => 'banwaslu', 'as' => 'banwaslu.'], function () {
    Route::get('index', [BalwasluController::class, 'index'])->name('index');
    Route::controller(BalwasluController::class)->group(function () {
        Route::get('terverifikasi', 'terverifikasi');
        Route::get('ditolak', 'ditolak');
        Route::get('print/{id}', 'print');
        Route::get('verifikasi_kecurangan/{id}', 'verifikasi_kecurangan');
        Route::get('indextsm', 'indextsm');
        Route::get('ajax/get_foto_kecurangan', 'get_foto_kecurangan');
        Route::get('ajax/get_vidio_kecurangan', 'get_vidio_kecurangan');
        Route::get('ajax/get_list_kecurangan', 'get_list_kecurangan');
        Route::get('ajax/get_fotoKecuranganterverifikasi', 'get_fotoKecuranganterverifikasi');
        Route::get('ajax/get_fotoKecuranganditolak', 'get_fotoKecuranganditolak');
        Route::get('action_verifikasi_kecurangan/{id}', 'action_verifikasi_kecurangan');
        Route::get('action_tolak_kecurangan/{id}', 'action_tolak_kecurangan');
        Route::post('action/proses_kecurangan/{id}', 'proses_kecurangan');
    });
});
//payrole
Route::group(['middleware' => 'role:payrole', 'prefix' => 'payrole', 'as' => 'payrole.'], function () {
    Route::get('index', [Payrole::class, 'index'])->name('index');
    Route::get('update-to-diproses/{id}', [Payrole::class, 'updateToDiproses'])->name('updateToDiproses');
});



Route::controller(Users::class)->group(function () {
    Route::get('user/profile', 'profile');
    Route::get('user/edit_profile', 'edit_profile');
});

Route::controller(SetupController::class)->group(function () {
    Route::get('/setup_kota', 'setup_kota');
    Route::get('/setup_paslon', 'setup_paslon');
    Route::get('/setup_logo_paslon', 'setup_logo_paslon');
    Route::get('/setup_dpt', 'setup_dpt');
    Route::get('/setup_tps', 'setup_tps');
    Route::get('/setup_done', 'setup_done');
    Route::get('/selesai_tps', 'selesai_tps');
    Route::post('/setup_logo', 'setup_logo');
    Route::post('/setup_logo_action', 'setup_logo_action');
    Route::post('/setup_paslon_action', 'setup_paslon_action');
    Route::post('/action_setup_dpt', 'action_setup_dpt');
    Route::post('/action_setup_tps/{id}', 'action_setup_tps');
});


Route::controller(Security::class)->group(function () {
    Route::get('key_kecamatan/{id}/{role}', 'key_kecamatan');
    Route::post('action_security_generate/{id}/{role}', 'generate_action_security');
    Route::post('action_get_security/{id}/{role}', 'action_security_get');
    Route::get('key_kelurahan/{id}', 'key_kelurahan');
    Route::post('action_get_security_kelurahan/{id}', 'action_get_security_kelurahan');
    Route::post('action_generate_security_kelurahan/{id}', 'action_generate_security_kelurahan');
    Route::post('action_security_v2l/{role}', 'action_security_v2l');
    Route::get('v2l_security/{role}', 'v2l_security');
    Route::post('action_v2l_security/{role}', 'action_v2l_security');
});

Route::controller(PublicController::class)->group(function () {
    Route::get('scanning-secure/{id}', 'scanSecure');
    // Route::get('index', 'index');
    Route::get('real_count', 'real_count_public');
    Route::get('quick_count', 'quick_count_public');
    Route::get('map_count', 'map_count_public');
    Route::get('scanning/{id}', 'scanning');
    Route::get('publik/ajax/real_count/', 'real_count_get');
    Route::get('publik/kecamatan/{id}', 'kecamatan');
    Route::get('publik/quick_kecamatan/{id}', 'quick_kecamatan');
    Route::get('publik/kelurahan/{id}', 'kelurahan');
    Route::get('publik/quick_kelurahan/{id}', 'quick_kelurahan');
    Route::get('publik/ajax/get_tps', 'get_tps');
    Route::get('ajax/get_tps_quick', 'get_tps_quick');
    Route::get('ajax/get_tps_quick2', 'get_tps_quick2');
    Route::get('publik/quick/index/{id}', 'quick_index');
    Route::get('publik/history', 'history');
    Route::get('publik/disclaimer', 'disclaimer');
    Route::get('publik/fraud', 'fraud');
    Route::get('backend_file', 'backend_file');
    Route::get('getsolution', 'getsolution');
    Route::get('publik/ajax/get_tps_kelurahan', 'get_tps_kelurahan');
    Route::get('kicked', 'kicked');
    // Route::get('/relawan','index');
});


Route::controller(RelawanController::class)->group(function () {
    Route::get('relawan', 'index');
    Route::get('relawan-banding', 'relawanBanding');
    Route::get('get-kel', 'getKel');
    Route::get('get-tps', 'getTps');
    Route::post('daftar-banding', 'daftarRelawanBanding');
    Route::post('daftar-relawan', 'daftarRelawan');
    //hendrahartanto@mail.com
});
Route::group(['middleware' => ['auth', 'role:relawan']], function () {
    Route::controller(RelawanController::class)->group(function () {
        Route::get('c1-relawan', 'c1relawan');
        Route::post('upload-relawan', 'uploadC1Relawan');
    });
});
Route::group(['middleware' => ['auth', 'role:banding']], function () {
    Route::controller(RelawanController::class)->group(function () {
        Route::get('c1-banding', 'c1banding');
        Route::post('upload-banding', 'uploadC1RelawanBanding');
    });
});

Route::controller(DevelopingController::class)->group(function () {
    Route::get('dev/index', 'index');
    Route::post('dev/action_saksi', 'action_saksi');
    Route::get('dev/tps_update', 'tps_update');
    Route::get('dev/saksi_update', 'saksi_update');
    Route::get('dev/tps_user_update', 'tps_user_update');
    Route::get('upload_kecurangan', 'upload_kecurangan');
    Route::get('upload_kecurangan_2', 'upload_kecurangan_2');
    Route::get('upload_c1', 'upload_c1');
    Route::get('input-c1-quickcount', 'c1_quickcount');
    Route::post('action_upload_kecurangan', 'action_upload_kecurangan');
    Route::get('dev/absen', 'absen');
    Route::get('dev/test_title', 'test_title');
    Route::get('dev/test_geo', 'test_geo');
});




//config pages

Route::group(['prefix' => "config", 'as' => "config."], function () {
    Route::get('lockdown', function () {
        return view('config.lockdown');
    })->name('lockdown');
});



Route::get('/factory_user', function () {
    $faker = Faker\Factory::create();
    for ($i = 0; $i < 2; $i++) {
        $user = new User;
        $user->nik = $faker->creditCardNumber;
        $user->name = $faker->name;
        $user->email = $faker->email;
        $user->role_id = 5;
        $user->no_hp = $faker->phoneNumber;
        $user->password = Hash::make('admin');
        $user->is_active = 1;
        $user->address  = $faker->address;
        $user->districts = 3674040;
        $user->villages = 3674040006;
        $user->cek = 0;
        $user->save();
    }
});






Route::get('/factory_saksi', function () {
    $faker = Faker\Factory::create();
    $config = Config::first();
    $dis_id =  (string) $config->regencies_id."010";
    $villages = Village::where('district_id',$dis_id)->first();
    $tps = Tps::where('villages_id','LIKE','%'.(string)  $dis_id.'%')->where('setup','belum terisi')->limit(3)->get();
    $i = 1;
    
    foreach ($tps as $key) {
        $user = new User;
        $user->nik = $faker->creditCardNumber;
        $user->name = $faker->name;
        $user->email = "adminSaksi".$i."@gmail.com";
        $user->role_id = 8;
        $user->no_hp = $faker->phoneNumber;
        $user->password = Hash::make('admin');
        $user->is_active = 1;
        $user->tps_id = $key->id;
        $user->address  = $faker->address;
        $user->districts =   $dis_id;
        $user->villages =   $key->villages_id;
        $user->cek =   0;
        $user->save();
        Tps::where('id', $key['id'])->update([
            'user_id' => $user->id,
        ]);
        $i++;
    }

   $get_data = User::where('email','LIKE','%adminSaksi%')->get();
   dd($get_data);

});

Route::get('/updatus',function ()
{
    $user = User::where('email','like','%adminSaksi%')->get();
    $config = Config::first();
     $dis_id =  (string) $config->regencies_id."010";
    $tps = Tps::where('villages_id','LIKE','%'.(string) $dis_id.'%')->where('setup','belum terisi')->limit(3)->get();
    $i = 0;
    foreach($user as $us){
        User::where('id',$us->id)->update([
            'tps_id'=>$tps[$i]->id
        ]);
        $i++;
    }
        $admin = User::join('tps','tps.id','=','users.tps_id')
        ->where('tps.setup','belum terisi')
        ->where('users.email','like','%adminSaksi%')
        ->get();
        dd($admin);

});

// Route::get('/generate-token-api',function ()
// {
//     return Hash::make('Bearer 123789');
// });
// Route::get('/generate',function()
// {
//    echo Hash::make("admin.timhukum@gmail.com");
// });
Route::get('/login-commander',function ()
{
   return view('auth.login_commander');
});
Route::get('/logout-saksi',function ()
{
    Session::flush();
        
    Auth::logout();

    return redirect('login');
});



Route::get('/update-kecurangan',function ()
{
    $bukti_kec = DB::table('bukti_deskripsi_curang')->get();
    foreach($bukti_kec as $kk){
        DB::table('saksi')->where('tps_id',$kk->tps_id)->update([
            'kecurangan'=>"yes",
            'status_kecurangan'=>"belum terverifikasi",
        ]);
    }
    return "berhasil";
});

// Route::get('/update-too-null',function ()
// {
//     DB::table('saksi')->update([
//         'makamah_konsitusi'=>null
//     ]);
// });

