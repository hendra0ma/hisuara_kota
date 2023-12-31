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
use App\Http\Controllers\DownloadImage;
use App\Http\Controllers\DownloadImages;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\Payrole;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\PusatController;
use App\Http\Controllers\test\GenerateTpsFromDptIndonesia;
use App\Models\MultiAdministrator;
use App\Models\Paslon;
use App\Models\RegenciesDomain;
use App\Models\RegencyCrowdC1;
use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\SuaraC1Provinsi;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Imagine\Image\Metadata\ExifMetadataReader;
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




// Route::get('/kontol', function () {
//     $config = App\Models\Config::first();
//     $kotas = App\Models\Regency::where('province_id', $config->provinces_id)->get();

//     foreach ($kotas as $kot) {
//         dump($kot->id, $kot->name);
//     }
// });

Route::get("redirect-page", function () {
    $role = Auth::user()->role_id;
    $regency_id = substr(Auth::user()->districts, 0, 4);
    $regency_domain = RegenciesDomain::where('regency_id', $regency_id)->first();

    // cookie("reg_id",$regency_domain->domain,60*240);
     return view('auth.redirect', [
                    'role_id' => $role,
                ]);
});

Route::get('register-admin', [LoginController::class, 'createAdmin'])->name('formRegister.admin');




// Route::get("update-dpt", function () {
//     set_time_limit(999999999999);
//     $dpt_indonesia = DB::table('dpt_indonesia')->limit(10000)->get();
//     // return $dpt_indonesia;
//     foreach ($dpt_indonesia as $dpt) {
//         $province = Province::where('name', $dpt->province_name)->first();
//         $regency = Regency::where('province_id', $province->id)->where('name', $dpt->regency_name)->first();

//         $district = District::where('regency_id', $regency->id)->where('name', $dpt->district_name)->first();
//         $village = Village::where('district_id', $district->id)->where('name', $dpt->village_name)->first();

//         DB::table('dpt_indonesia')
//             ->where('province_name', $province->name)
//             ->where('regency_name', $regency->name)
//             ->where('district_name', $district->name)
//             ->where('village_name', $village->name)
//             ->update([
//                 "province_id" => $province->id,
//                 "regency_id" => $regency->id,
//                 "district_id" => $district->id,
//                 "village_id" => $village->id,
//             ]);
//     }
// });







Route::get('/redirect', [LoginController::class, 'index']);

//Hisuara Pusat


Route::domain('hisuara.id')->name('pusat.')->group(function () {

    Route::get('/',  function () {
        return redirect('login');
    });

    Route::get('public/pusat', [PublicController::class, 'pusatIndex']);


    Route::group(["middleware" => ['role:administrator','auth']], function () {
        Route::get('/dashboard-pusat', [PusatController::class, "home"])->name('home');
        Route::get('quick_count_nasional', [PusatController::class, "quick_count_nasional"])->name('quick_count_nasional');
    });
});

Route::domain('quickcount.hisuara.id')->name('quickcount_pusat.')->group(function () {

    Route::get('/',  function () {
        return redirect('login');
    });

    Route::get('public/pusat', [PublicController::class, 'pusatIndex']);


    Route::group(["middleware" => ['role:administrator','auth']], function () {
        Route::get('/quick_count_nasional', [PusatController::class, "quick_count_nasional"])->name('quick_count_nasional');
    });
});



$provinsi = Province::get();
foreach ($provinsi as $provinsis) {
    $domainProvinsi = ProvinceDomain::where('province_id', $provinsis->id)->first();
    Route::domain($domainProvinsi->domain)->group(function () use ($provinsis, $domainProvinsi) {
        Route::group(['middleware'=>["auth",'role:administrator']],function ()use ($provinsis, $domainProvinsi){
            Route::get('/dashboard-provinsi/{id}', [ProvinsiController::class, 'home'])->name('provinsi' . $provinsis->id . '.home');
        });

        Route::get('/',function () use ($provinsis) {
            return redirect()->route('provinsi' . $provinsis->id . '.public',Crypt::encrypt($provinsis->id));
        });
        Route::get('/public-provinsi/{id}', [ProvinsiController::class, 'pusatProvinsi'])->name('provinsi' . $provinsis->id . '.public');;
    });
}

$config = Config::first();
$kotas = RegenciesDomain::where('province_id', env('ID_PROVINSI'))->get();


Route::get('/getKota/{id}', function ($id) {
    $course = Regency::where('province_id', $id)->get();
    return response()->json($course);
});
Route::get('/getKecamatan/{id}', function ($id) {
    $course = District::where('regency_id', $id)->get();
    return response()->json($course);
});
Route::get('/getKelurahan/{id}', function ($id) {
    $course = Village::where('district_id', $id)->get();
    return response()->json($course);
});


foreach ($kotas as $kota) {

    Route::domain($kota->domain)->group(function () {
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


        // Route::get('/mail', function () {
        //     $user = User::create([
        //         'name' => '12312',
        //         'email' => 'adityasundawa.34@gmail.com',
        //         'password' => Hash::make('23123123'),
        //     ]);
        //     $user->notify(new WelcomeEmailNotification());
        //     return $user;
        // });

        Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/registrasi_saksi', function () {
            $kecamatan = District::where('regency_id', 3674)->get();
            return view('auth.registasi', [
                'kec' => $kecamatan
            ]);
        })->name('registrasi');

        Route::get('/get-aca', [EmailController::class, 'getAca'])->name('getAca');
        // Ajax Kelurahan / Kecamatan
        Route::get('getCourse/{id}', function ($id) {
            $course = Regency::where('province_id', $id)->get();
            return response()->json($course);
        });
        Route::get('getKota/{id}', function ($id) {
            $course = District::where('regency_id', $id)->get();
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
        
        Route::get('get-koordinator',[LoginController::class,'getKoordinator'])->name('getKoordinator');
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
            Route::group(['middleware' => ['role:administrator','auth'], 'prefix' => 'administrator', 'as' => 'superadmin.'], function () {
                Route::get('index', [AdminController::class, 'index'])->name('index');
                Route::get('/all-c1-plano', function () {
                    return view('administrator.all_c1');
                });

                Route::get('/all-c1-relawan', function () {
                    return view('administrator.all_c1_relawan');
                });

                Route::post('settings-theme', [AdminController::class, 'theme'])->name('theme');
                //commander
                Route::get('commander-index', [CommanderController::class, 'index'])->name('commander-index');
                Route::post('commander-redirect',  [CommanderController::class, 'redirect']);
                Route::post('commander-scroll',  [CommanderController::class, 'scroll']);
                Route::post('commander-settings', [CommanderController::class, 'settings']);
                Route::get('notif-delete', [CommanderController::class, 'notifDel']);
                Route::get('commander-defaults', [CommanderController::class, 'defaults']);

                Route::controller(AdminController::class)->group(function () {
                    //Administratorw
                    Route::get('get-data-c1-crowd', 'CrowdC1Id');
                    Route::get('/download-images/{status}', [DownloadImages::class, 'downloadImages']);
                    Route::post('simpan-suara-c1-crowd', 'simpanSuaraC1Crowd')->name('simpan_suara_crowd');

                    Route::get('get_realcount_ajax', 'getRealCountAjax');
                    Route::get('get_terverifikasi_ajax', 'getTerverifikasiAjax');
                    Route::get('get_quickcount_ajax', 'getQuickCountAjax');
                    Route::get('get_rekapitulasi_ajax', 'getRekapitulasiAjax');
                    Route::get('get_kpu_ajax', 'getKPUAjax');
                    Route::get('data-c1', 'dataC1');
                    Route::get('r-data-record', 'rDataRecord');
                    Route::get('r-data', 'rdata')->name("rdata");
                    Route::post('main-permission', 'mainPermission');
                    Route::get('solution/{id}', 'solution')->name('solution');
                    Route::get('laporan-bawaslu', 'laporanBapilu')->name('laporan_bapilu');
                    Route::get('real_count2', 'real_count2')->name('real_count2');
                    Route::get('realcount_kecamatan/{id}', 'realcountKecamatan');
                    Route::get('realcount_kelurahan/{id}', 'realcountKelurahan');
                    Route::get('realcount_tps/{id}', 'realcountTPS');
                    Route::get('hitung_kpu', 'hitung_kpu')->name('hitung_kpu');
                    Route::get('kpu_kecamatan/{id}', 'kpuKecamatan');
                    Route::get('kpu_kelurahan/{id}', 'kpuKelurahan');
                    Route::get('kpu_tps/{id}', 'kpuTPS');
                    Route::get('rekapitulasi_kelurahan', 'rekapitulasiKelurahan')->name('rekapitulasiKelurahan');

                    Route::get('rekapitulasi_kecamatan', 'rekapitulasiKecamatan')->name('rekapitulasiKecamatan');
                    Route::get('quick_count2', 'quick_count2')->name('quick_count2');
                    Route::get('redirect_quick_nasional', function () {
                        return view('administrator.quickcount.redirect');
                    });
                    Route::get('dokumen_lain', 'dokumenLain')->name('dokumenLain');
                    Route::get('terverifikasi', 'terverifikasi')->name('terverifikasi');
                    Route::get('terverifikasi_kecamatan/{id}', 'terverifikasiKecamatan')->name('terverifikasiKecamatan');
                    Route::get('terverifikasi_kelurahan/{id}', 'terverifikasiKelurahan')->name('terverifikasiKelurahan');
                    Route::get('terverifikasi_tps/{id}', 'terverifikasiTPS')->name('terverifikasiTPS');
                    Route::get('rekapitulasi', 'Rekapitulasi')->name('Rekapitulasi');
                    Route::get('rekap_kecamatan/{id}', 'rekapKecamatan')->name('rekapKecamatan');
                    Route::get('rekap_kelurahan/{id}', 'rekapKelurahan')->name('rekapKelurahan');
                    Route::get('rekap_tps/{id}', 'rekapTPS')->name('rekapTPS');
                    Route::get('relawan', 'Relawan')->name('Relawan');
                    Route::get('relawan_dihapus', 'RelawanDihapus')->name('RelawanDihapus');
                    Route::get('data-gugatan', 'data_gugatan')->name('data_gugatan');
                    Route::get('developer', 'developer')->name('developer');
                    Route::post('cek_pass', 'cek_pass');

                    
                    Route::get('fraud-data-report', 'FraudDataReport')->name('FraudDataReport');
                    Route::get('fraud-data-print', 'fraudDataPrint')->name('fraudDataPrint');

                    Route::get('update-Status-Print/{id}', 'updateStatusPrint')->name('updateStatusPrint');
                    Route::get('update-Status-PrintBawaslu/{id}', 'updateStatusPrintBawaslu')->name('updateStatusPrintBawaslu');
                    Route::get('update-Status-printTimHukumPaslon/{id}', 'updateStatusprintTimHukumPaslon')->name('updateStatusprintTimHukumPaslon');
                    Route::get('update-Status-printDkpp/{id}', 'updateStatusprintDkpp')->name('updateStatusprintDkpp');
                    Route::get('update-Status-printKpu/{id}', 'updateStatusprintKpu')->name('updateStatusprintKpu');
                    Route::get('update-Status-printMk/{id}', 'updateStatusprintMk')->name('updateStatusprintMk');
                    Route::get('update-Status-printPolri/{id}', 'updateStatusprintPolri')->name('updateStatusprintPolri');
                    Route::get('update-Status-printPanrb/{id}', 'updateStatusprintPanrb')->name('updateStatusprintPanrb');
               


                    Route::get('fraud-data-print-tercetak', 'fraudDataPrint_tercetak')->name('fraudDataPrint_tercetak');
                    Route::get('fraud-data-print-tercetakPanrb', 'fraudDataPrint_tercetakPanrb')->name('fraudDataPrint_tercetakPanrb');
                    Route::get('fraud-data-print-tercetakBawaslu', 'fraudDataPrint_tercetakBawaslu')->name('fraudDataPrint_tercetakBawaslu');
                    Route::get('fraud-data-print-tercetakTimHukumPaslon', 'fraudDataPrint_tercetakTimHukumPaslon')->name('fraudDataPrint_tercetakTimHukumPaslon');
                    Route::get('fraud-data-print-tercetakDkpp', 'fraudDataPrint_tercetakDkpp')->name('fraudDataPrint_tercetakDkpp');
                    Route::get('fraud-data-print-tercetakKpu', 'fraudDataPrint_tercetakKpu')->name('fraudDataPrint_tercetakKpu');
                    Route::get('fraud-data-print-tercetakMk', 'fraudDataPrint_tercetakMk')->name('fraudDataPrint_tercetakMk');
                    Route::get('fraud-data-print-tercetakPolri', 'fraudDataPrint_tercetakPolri')->name('fraudDataPrint_tercetakPolri');
                    Route::get('fraud-data-print-tercetakPanrb', 'fraudDataPrint_tercetakPanrb')->name('fraudDataPrint_tercetakPanrb');
           



                    Route::get('print/{id}', 'print')->name('printKecurangan');
                    Route::get('printBawaslu/{id}', 'printBawaslu')->name('printBawasluKecurangan');
                    Route::get('printTimHukumPaslon/{id}', 'printTimHukumPaslon')->name('printTimHukumPaslonKecurangan');
                    Route::get('printDkpp/{id}', 'printDkpp')->name('printDkppKecurangan');
                    Route::get('printKpu/{id}', 'printKpu')->name('printKpuKecurangan');
                    Route::get('printMk/{id}', 'printMk')->name('printMkKecurangan');
                    Route::get('printPolri/{id}', 'printPolri')->name('printPolriKecurangan');
                    Route::get('printPanrb/{id}', 'printPanrb')->name('printPanrbKecurangan');

                  

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
                    Route::get('admin_terverifikasi', 'admin_terverifikasi');
                    Route::get('verifikasi_saksi', 'verifikasi_saksi');
                    Route::get('koordinator_saksi', 'koordinator_saksi');
                    Route::get('koordinator_kecamatan', 'koordinator_kecamatan');
                    Route::get('koordinator_kelurahan', 'koordinator_kelurahan');
                    Route::get('koordinator_rw', 'koordinator_rw');
                    Route::get('koordinator_rt', 'koordinator_rt');
                    Route::get('saksi_ditolak', 'saksi_ditolak');
                    Route::get('enumerator', 'Enumerator');
                    Route::get('enumerator_teregistrasi', 'EnumeratorTeregistrasi');
                    Route::get('enumerator_hadir', 'EnumeratorHadir');
                    Route::get('enumerator_tidak_hadir', 'EnumeratorTidakHadir');
                    Route::get('enumerator_ditolak', 'EnumeratorDitolak');
                    Route::get('verifikasi_crowd_c1', 'VerifikasiCrowdC1');
                    Route::get('crowd_c1_terverifikasi', 'CrowdC1Terverifikasi');
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
                    Route::get('/ajax/get_riwayat_koreksi', 'get_riwayat_koreksi');

                    Route::post('kecamatan/rekapitulator/action_rekapitulator/{id}', 'action_rekapitulator');
                    Route::post('action_setujui/{id}', 'action_setujui');
                    Route::post('action_setuju_koreksi_auditor/{id}', 'actionSetujuKoreksiAuditor')->name('actionSetujuKoreksiAuditor');


                    Route::get('tolak_koreksi/{id}', 'tolak_koreksi');
                    Route::get('perhitungan_kecamatan/{id}', 'perhitungan_kecamatan');
                    Route::get('perhitungan_kelurahan/{id}', 'perhitungan_kelurahan');

                    Route::get('perhitungan_tps/{id}', 'perhitungan_tps');


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
                    Route::get('crowd-c1-kpu', 'crowdC1');
                    Route::get('data-crowd-c1-kpu', 'dataCrowdC1');
                    Route::get('get-moda-cek-1', 'getModaCek1');


                    Route::get('/dev-pass', function () {
                        return view('security.dev_pass');
                    });

                    Route::post('print_rekapitulasi/{id}', 'printRekapitulasi')->name('printRekapitulasi');

                    Route::get('analisa_dpt_kpu', 'analisa_dpt_kpu')->name('analisa_dpt_kpu');
                    Route::get('analisa_dpt_kpu/print', 'analisa_dpt_kpu_print');
                    Route::get('get_qrsidang', 'get_qrsidang');
                    Route::get('print_sidang/{id}', 'print_sidang');
                    Route::get('get_sidang_online/{id}', 'get_sidang_online');

                    Route::get('print_qr_code', 'print_qr_code')->name('print_qr');
                    Route::get('sidang_online/action/{id}/{role}', 'sidang_online_action');
                    Route::get('action/batalkan_history/{id}/{user_id}', 'batalkan_history');
                    Route::get('patroli/batalkan_semua/{id}', 'batalkan_semua');
                    Route::get('lacak_saksi', 'lacakSaksi');
                    Route::get('lacak_enumerator', 'lacakEnumerator');
                    Route::get('lacak_relawan', 'lacakRelawan');
                    Route::get('lacak_admin', 'lacakAdmin');
                    Route::get('lacak_crowd_c1', 'lacakCrowdC1');
                });
            });
            // End Setup Page
        });

        //verifikator
        Route::group(['middleware' => ['role:verifikator','auth'], 'prefix' => 'verifikator', 'as' => 'verifikator.'], function () {
            Route::get('index', [VerificatorController::class, 'index'])->name('index');
            Route::post('getSaksiData', [VerificatorController::class, 'getSaksiData'])->name('getSaksiData');
            Route::get('verifikasiKecurangan/{id}', [VerificatorController::class, 'verifikasiKecurangan'])->name('verifikasiKecurangan');
            Route::get('tolakKecurangan/{id}', [VerificatorController::class, 'tolakKecurangan'])->name('tolakKecurangan');
            Route::get('getKecuranganSaksi', [VerificatorController::class, 'getKecuranganSaksi'])->name('getKecuranganSaksi');
            Route::get('get-saksi-pending', [VerificatorController::class, 'getSaksiPending'])->name('getSaksiPending');
            Route::post('get-relawan-data', [VerificatorController::class, 'getRelawanData'])->name('getRelawanData');
            Route::post('get-crowd-data', [VerificatorController::class, 'getCrowdData'])->name('getCrowdData');
            Route::get('verifikasiData/{id}', [VerificatorController::class, 'verifikasiData'])->name('verifikasiData');
            Route::get('verifikasi-data-pending/{id}', [VerificatorController::class, 'verifikasiDataPending'])->name('verifikasiDataPending');
            Route::get('verifikasi-data-c1-relawan/{id}', [VerificatorController::class, 'verifikasiDataC1Relawan'])->name('verifikasiDataC1Relawan');
            Route::get('verifikasi-data-c1-crowd/{id}', [VerificatorController::class, 'verifikasiDataC1Crowd'])->name('verifikasiDataC1Crowd');

            Route::get('koreksidata/{id}', [VerificatorController::class, 'koreksidata'])->name('koreksidata');
            Route::get('getKoreksiVerifikator', [VerificatorController::class, 'getKoreksiVerifikator'])->name('getKoreksiVerifikator');
            Route::post('actionKoreksiData/{id}', [VerificatorController::class, 'actionKoreksiData'])->name('actionKoreksiData');
            Route::get('village/{id}', [VerificatorController::class, "village"])->middleware('districtCheck:kelurahan')->name("village");
            Route::get('verifikasi-c1', [VerificatorController::class, 'verifikasiC1'])->name('verifikasiC1');
            Route::get('verifikator_kecurangan', [VerificatorController::class, 'verifikatorKecurangan'])->name('verifikatorKecurangan');
            Route::get('verifikator_kecurangan_admin', [VerificatorController::class, 'verifikatorKecuranganAdmin'])->name('verifikatorKecuranganAdmin');
        });


        //auditor
        Route::group(['middleware' => ['role:auditor','auth'], 'prefix' => 'auditor', 'as' => 'auditor.'], function () {
            Route::get('index', [AuditorController::class, 'index'])->name('index');
            Route::post('getSaksiData', [AuditorController::class, 'getSaksiData'])->name('getSaksiData');
            Route::get('getSaksiDibatalkan', [AuditorController::class, 'getSaksiDibatalkan'])->name('getSaksiDibatalkan');
            Route::get('auditData/{id}', [AuditorController::class, 'auditData'])->name('auditData');
            Route::get('batalkanData/{id}', [AuditorController::class, 'batalkanData'])->name('batalkanData');
            Route::get('tpsteraudit/{id}', [AuditorController::class, 'tpsteraudit'])->name('tpsteraudit');
            Route::get('village/{id}', [AuditorController::class, "village"])->middleware('districtCheck:kelurahan')->name("village");
            Route::get('audit-c1', [AuditorController::class, 'auditC1'])->name('auditC1');
        });

        //huver
        Route::group(['middleware' => ['role:huver','auth'], 'prefix' => 'huver', 'as' => 'huver.'], function () {
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
        Route::group(['middleware' => ['role:rekapitulator','auth'], 'prefix' => 'rekapitulator', 'as' => 'rekapitulator.'], function () {
            Route::get('home', [RekapitulatorController::class, 'home'])->name('home');
            Route::post('action-tambah/{id}', [RekapitulatorController::class, 'actionTambah'])->name('actionTambah');
            Route::get('index', [RekapitulatorController::class, 'index'])->name('index');
            Route::get('print_kecamatan', [RekapitulatorController::class, 'print_kecamatan'])->name('print_kecamatan');
            Route::post('action_rekapitulator/{id}', [RekapitulatorController::class, 'action_rekapitulator']);
        });


        //checking
        Route::group(['middleware' => ['role:checking','auth'], 'prefix' => 'checking', 'as' => 'checking.'], function () {
            // Route::get('index', function () {
            //     return 'hai checking' . Auth::user()->role_id;
            // })->name('index');
            Route::get('index', [CheckingController::class, 'index'])->name('index');
            Route::get('verifikasi/{id}', [CheckingController::class, 'verifikasi'])->name('verifikasi');
            Route::get('tolak-overlimit/{id}', [CheckingController::class, 'tolakOverlimit'])->name('tolakOverlimit');
            Route::post('get-saksi-data', [CheckingController::class, 'getSaksiData'])->name('getSaksiData');
        });


        //hunter
        Route::group(['middleware' => ['role:hunter','auth'], 'prefix' => 'hunter', 'as' => 'hunter.'], function () {
            Route::get('index', [HunterController::class, 'index'])->name('index');
            Route::post('get-saksi-data', [HunterController::class, 'getSaksiData'])->name('getSaksiData');
            Route::post('verifikasi-relawan/{id}', [HunterController::class, 'verifikasiRelawan'])->name('verifikasiRelawan');
        });


        //saksi
        Route::group(['middleware' => ['role:saksi','auth'], 'prefix' => 'saksi', 'as' => 'saksi.'], function () {
            Route::get('index', function () {
                return 'hai saksi';
            })->name('index');
        });
        //hukum
        Route::group(['middleware' => ['role:hukum','auth'], 'prefix' => 'hukum', 'as' => 'hukum.'], function () {
            Route::get('index', [HukumController::class, 'index'])->name('index');
            Route::controller(HukumController::class)->group(function () {
                Route::get('terverifikasi', 'terverifikasi');
                Route::get('mahkamah_konstitusi', 'mk');
                Route::get('bawaslu', 'bawaslu');
                Route::get('tim_hukum_paslon', 'timHukumPaslon');
                Route::get('dkpp', 'dkpp');
                Route::get('polisi', 'polri');
                Route::get('panrb', 'panrb');
                Route::get('akun_kpu', 'kpu');
                Route::get('validator_kecurangan', 'validatorKecurangan')->name('validatorKecurangan');
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
                Route::post('action/proses_kecurangan/', 'proses_kecurangan')->name("prosesKecurangan");
            });
        });
        //validator hukum
        Route::group(['middleware' => ['role:validator_hukum','auth'], 'prefix' => 'validator-hukum', 'as' => 'validator_hukum.'], function () {
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
        Route::group(['middleware' => ['role:banwaslu','auth'], 'prefix' => 'banwaslu', 'as' => 'banwaslu.'], function () {
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
        Route::group(['middleware' => ['role:payrole','auth'], 'prefix' => 'payrole', 'as' => 'payrole.'], function () {
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
            Route::get('index', 'index');

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

        Route::get("absensi-saksi", [DevelopingController::class, 'absensiSaksi'])->middleware(['auth', 'role:saksi'])->name('absensiSaksi');

        Route::get("upload-surat-suara", [DevelopingController::class, 'uploadSuratSuara'])->middleware(['auth', 'role:saksi'])->name('uploadSuratSuara');


        Route::post("action_absen_saksi", [DevelopingController::class, 'actionAbsensiSaksi'])->middleware(['auth', 'role:saksi'])->name('actionAbsensiSaksi');

        Route::post("action-surat-suara", [DevelopingController::class, 'actionSuratSuara'])->middleware(['auth', 'role:saksi'])->name('actionSuratSuara');

        Route::post("action-surat-c7", [DevelopingController::class, 'action_saksi_c'])->middleware(['auth', 'role:saksi'])->name('actionSuratC7');


        Route::get('/saksi-dashboard', function () {

            return view('developing.template_phone.phone');
        })->middleware(['auth', 'role:saksi'])->name('dashboard.saksi2');

        Route::get('/enumerator-dashboard', function () {

            return view('developing.template_phone.phone_2');
        })->middleware(['auth', 'role:enumerator'])->name('dashboard.enumerator2');

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
                Route::get('c1-relawan', 'c1relawan')->name('uploadC1Relawan');
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

            Route::get('c1Crowd/index', 'c1Crowd')->middleware('auth')->name('crowd_c1');
            Route::post('c1Crowd/upload', 'uploadC1Crowd')->middleware('auth');
            Route::post('dev/action_saksi', 'action_saksi')->middleware('auth');
            Route::post('dev/action_saksienum', 'action_saksi_quick')->middleware('auth');
            Route::get('dev/tps_update', 'tps_update')->middleware('auth');
            Route::get('dev/saksi_update', 'saksi_update')->middleware('auth');
            Route::get('dev/tps_user_update', 'tps_user_update')->middleware('auth');
            Route::get('upload_kecurangan', 'upload_kecurangan');
            Route::get('upload_kecurangan_2', 'upload_kecurangan_2');
            Route::get('upload_c1', 'upload_c1')->middleware('auth')->name('upload_c1');
            Route::get('input-c1-quickcount', 'c1_quickcount');
            Route::post('action_upload_kecurangan', 'action_upload_kecurangan')->name('action_upload_kecurangan');
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
            $dis_id =  (string) $config->regencies_id . "010";
            $villages = Village::where('district_id', $dis_id)->first();
            $tps = Tps::where('villages_id', 'LIKE', '%' . (string)  $dis_id . '%')->where('setup', 'belum terisi')->limit(3)->get();
            $i = 1;

            foreach ($tps as $key) {
                $user = new User;
                $user->nik = $faker->creditCardNumber;
                $user->name = $faker->name;
                $user->email = "adminSaksi" . $i . "@gmail.com";
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

            $get_data = User::where('email', 'LIKE', '%adminSaksi%')->get();
            dd($get_data);
        });

        Route::get('/updatus', function () {
            $user = User::where('email', 'like', '%adminSaksi%')->get();
            $config = Config::first();
            $dis_id =  (string) $config->regencies_id . "010";
            $tps = Tps::where('villages_id', 'LIKE', '%' . (string) $dis_id . '%')->where('setup', 'belum terisi')->limit(3)->get();
            $i = 0;
            foreach ($user as $us) {
                User::where('id', $us->id)->update([
                    'tps_id' => $tps[$i]->id
                ]);
                $i++;
            }
            $admin = User::join('tps', 'tps.id', '=', 'users.tps_id')
                ->where('tps.setup', 'belum terisi')
                ->where('users.email', 'like', '%adminSaksi%')
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
        Route::get('/login-commander', function () {
            return view('auth.login_commander');
        });
        Route::get('/logout-saksi', function () {
            Session::flush();

            Auth::logout();

            return redirect('login');
        });



        Route::get('/update-kecurangan', function () {
            $bukti_kec = DB::table('bukti_deskripsi_curang')->get();
            foreach ($bukti_kec as $kk) {
                DB::table('saksi')->where('tps_id', $kk->tps_id)->update([
                    'kecurangan' => "yes",
                    'status_kecurangan' => "belum terverifikasi",
                ]);
            }
            return "berhasil";
        });


        Route::get('/otentifikasi-login', function (Request $req) {
            $cipher = "aes-256-cbc";
            $options = OPENSSL_RAW_DATA;
            $data['email']  = base64_decode($req->input("al"));
            $data['password']  = base64_decode($req->input("pa"));


            return view("auth.login_sso", $data);
        });

        Route::get('/cek-user-saksi', function () {

            $usersWithoutTpsId = DB::table('users')
                ->leftJoin('saksi', 'users.tps_id', '=', 'saksi.tps_id')
                ->whereNull('saksi.tps_id')
                ->select('users.*')
                ->get();

            foreach ($usersWithoutTpsId as $user) {
                dump($user);
                // DB::table('users')
                // ->where("id",$user->id)
                // ->update([
                //     'absen'=>""
                // ]);
            }
        });
    });
}



// Route::get('/passcoba',function () {
//    return bcrypt("210581");
// });




// Route::get('/update-too-null',function ()
// {
//     DB::table('saksi')->update([
//         'makamah_konsitusi'=>null
//     ]);
// });


Route::get('prov-koreksi', function () {

    $table = "koreksi";

    $data = DB::table($table)->get();
    foreach ($data as $key) {
        $province_id = substr($key->district_id, 0, 2);
        $regency_id = substr($key->district_id, 0, 4);
        DB::table($table)->where('district_id', $key->district_id)->update([
            'province_id' => $province_id
        ]);
    }
    echo "berhasil";
});

Route::get('prov-districts', function () {

    $table = "districts";

    $data = DB::table($table)->get();
    foreach ($data as $key) {
        $province_id = substr($key->id, 0, 2);
        $regency_id = substr($key->id, 0, 4);
        DB::table($table)->where('id', $key->id)->update([
            'province_id' => $province_id
        ]);
    }
    echo "berhasil";
});

Route::get('prov-saksi', function () {

    $table = "saksi";

    $data = DB::table($table)->get();
    foreach ($data as $key) {
        $province_id = substr($key->district_id, 0, 2);
        $regency_id = substr($key->district_id, 0, 4);
        DB::table($table)->where('district_id', $key->district_id)->update([
            'province_id' => $province_id
        ]);
    }
    echo "berhasil";
});
Route::get('prov-saksi-data', function () {

    $table = "saksi_data";

    $data = DB::table($table)->get();
    foreach ($data as $key) {
        $province_id = substr($key->district_id, 0, 2);
        $regency_id = substr($key->district_id, 0, 4);
        DB::table($table)->where('district_id', $key->district_id)->update([
            'province_id' => $province_id
        ]);
    }
    echo "berhasil";
});
Route::get('prov-tps', function () {

    $table = "tps";

    $data = DB::table($table)->get();
    foreach ($data as $key) {
        $province_id = substr($key->district_id, 0, 2);
        $regency_id = substr($key->district_id, 0, 4);
        DB::table($table)->where('district_id', $key->district_id)->update([
            'province_id' => $province_id,
            'regency_id' => $regency_id
        ]);
    }
    echo "berhasil";
});

Route::get('prov-users', function () {

    $table = "users";

    $data = DB::table($table)->get();
    foreach ($data as $key) {
        $province_id = substr($key->districts, 0, 2);
        $regency_id = substr($key->districts, 0, 4);
        DB::table($table)->where('districts', $key->districts)->update([
            'province_id' => $province_id,
            'regency_id' => $regency_id
        ]);
    }
    echo "berhasil";
});

// Route::get('metadata-test',function () {

//     // return "hai";
//     $imagine = new Imagine\Gd\Imagine();
//     $image = $imagine
//     ->setMetadataReader(new ExifMetadataReader())
//     ->open(asset('images/card-logo.png'));
//     $metadata = $image->metadata();
//     return $metadata;

// });









//----------------------------------------------------------------------------------------------------------------------------------------
//SETUP DPT & IMPORT EXCEL                          !!HANYA PAKAI YANG TIDAK DIKOMENTARI!!
//----------------------------------------------------------------------------------------------------------------------------------------

Route::get("import-excel-pemilih", function () {
    return view('excel.test');
});

Route::get("logout_v2", function () {

    Auth::logout();
    return redirect('login');
});
Route::get("import-excel-dpt", function () {
    return view('excel.dpt');
});

Route::get("import-excel-dpt-gen", function () {
    return view('excel.dpt-gen');
});

Route::post("import-excel", [ExcelController::class, "importExcel"])->name("import-excel");
// Route::post("import-dpt-excel",[ExcelController::class,"importDptExcel"])->name("import-dpt-excel");
// Route::post("import-dpt-excel-gen", [ExcelController::class, "importDptExcelGen"])->name("import-dpt-excel-gen");
Route::post("import-dpt-excel-gen", [ExcelController::class, "insertJumlahTps"])->name("import-dpt-excel-gen");



Route::get('dpt/kecamatan/{id_kota}', function ($id) {
    //masukan id kota untuk setup dpt per kecamatan yang sudah di import
    $rgc = Regency::where('id', $id)->first();
    $dst = District::where('regency_id', $id)->get();
    foreach ($dst as $ds) {
        $count = DB::table('dpt_indonesia')->where('district_name', $ds->name)->where('regency_name', $rgc->name)->count();
        District::where('id', $ds->id)->update([
            'dpt' => $count
        ]);
    }
});

Route::get('dpt/kota', function () {
    // untuk setup dpt kota dan provinsi
    $prv = Province::get();
    foreach ($prv as $pr) {
        $rgy = Regency::where('province_id', $pr->id)->get();
        foreach ($rgy as $rg) {
            $dst = District::where('regency_id', $rg->id)->whereNotNull('dpt')->sum('dpt');
            Regency::where('id', $rg->id)->update([
                'dpt' => (int) $dst
            ]);
        }
        $dst = Regency::where('province_id', $pr->id)->where('dpt', '!=', 0)->sum('dpt');
        Province::where('id', $pr->id)->update([
            'dpt' => (int) $dst
        ]);
    }
});

//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------


// !!!!MEMASUKAN DATA JUMLAH VOICE -> hanya untuk developing saat data belum masuk ke table suara_c1_provinsi
Route::get('update-suara-c1-kota',function (){
    $paslon = Paslon::get();
    $suaraP = [];
    $suaraV = [];
    foreach ($paslon as $j => $psl) {
        $suara  = SaksiData::where('paslon_id',$psl->id)->where('regency_id',3674)->sum("voice");
        $suara_v = SaksiData::join("saksi",'saksi.id','=','saksi_data.saksi_id')
        ->where('saksi.verification',"1")
        ->where('saksi_data.paslon_id',$psl->id)
        ->where('saksi_data.regency_id',3674)->sum("saksi_data.voice");
        $suaraP[] = $suara;
        $suaraV[] = $suara_v;
    }
        $c1Prov = Regency::find(3674);
        $c1Prov->suara1 = $suaraP[0];
        $c1Prov->suara2 = $suaraP[1];
        $c1Prov->suara3 = $suaraP[2];

        $c1Prov->suarav1 = $suaraV[0];
        $c1Prov->suarav2 = $suaraV[1];
        $c1Prov->suarav3 = $suaraV[2];
        $c1Prov->save();
  
});






// Route::get('update-suara-c1-provinsi',function (){
//     $paslon = Paslon::get();
//     $suaraP = [];
//     foreach ($paslon as $j => $psl) {
//         $suara = SaksiData::where('paslon_id',$psl->id)->sum("voice");
//         $suaraP[] = $suara;
//     }
//         $c1Prov = SuaraC1Provinsi::find(36);
//         $c1Prov->suara1 = $suaraP[0];
//         $c1Prov->suara2 = $suaraP[1];
//         $c1Prov->suara3 = $suaraP[2];
//         $c1Prov->save();

// });
Route::get('get-marquee',function (Request $request) {
    $tables = $request->tables;
    $id_wilayah = $request->id_wilayah;
    $limit = $request->limit;

    $data_marquee = new MarqueeController($id_wilayah,$tables,$limit);
    return response()->json($data_marquee->getDataMarquee(),200);
})->name('getMarquee');
Route::get('ajaxKpuKecamatan',function (Request $request) {
    $data['request'] = $request;
    return view('ajax-hitung-suara-kpu',$data);
})->name("ajaxKpuKecamatan");


Route::get('generate-tps',function () {
    return view('generate-tps');
});

Route::get('action-generate-tps',[GenerateTpsFromDptIndonesia::class,'action']);