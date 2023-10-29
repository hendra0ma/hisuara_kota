<?php
    
    use App\Models\Config;
    use App\Models\District;
    use App\Models\Regency;
    use App\Models\SaksiData;
    use App\Models\Tps;
    use App\Models\Village;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    use App\Models\Saksi;
    use App\Models\RegenciesDomain;
    use App\Models\Province;
    
    $config = Config::all()->first();
    $regency = District::where('regency_id', $config['regencies_id'])->get();
    $kota = Regency::where('id', $config['regencies_id'])->first();
    $dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
    $tps = Tps::count();
    $marquee = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
    $total_tps = Tps::where('setup','belum terisi')->count();;
    $tps_masuk = Tps::where('setup','terisi')->count();
    $tps_kosong = $total_tps - $tps_masuk;
    $suara_masuk = SaksiData::count('voice');
    $verification = Saksi::where('verification', 1)->with('saksi_data')->get();
    $total_verification_voice = 0;
    foreach ($verification as $key) {
        foreach ($key->saksi_data as $verif) {
            $total_verification_voice += $verif->voice;
        }
    }
    $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));
    $urutan = $paslon_tertinggi;
    $props = Province::where('id',$kota['province_id'])->first();
    $cityProp = Regency::where('province_id',$kota['province_id'])->get();
?>

<style>
    .header .btn {
        margin-left: 0px !important;
        position: relative;
    }

    .for-kolapse-kurangin > .side-app > .row:first-child {
        margin-top: 90px !important;
        transition: all 0.5s ease-in-out;
    }

    .for-kolapse-kurangin > .side-app > .row.kurangin {
        margin-top: 0px !important;
        transition: all 0.5s ease-in-out;
    }
    .sidenav-toggled .header-baru {
        padding-left: 80px !important
    }

    .tooltip-inner {
        background-color: #f82649 !important;
    }

    .bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: #f82649 !important;
    }

    .active-button{
        background-color: rgb(0, 156, 133) !important;
    }

    .custom-urutan:nth-child(1) {
        border-radius: 25px 0px 0px 25px
    }

    .custom-urutan:nth-child(2) {
        border-radius: 0px
    }

    .custom-urutan:nth-child(3) {
        border-radius: 0px 25px 25px 0px
    }

    /* custom scrollbar */
    .row.items::-webkit-scrollbar {
      display: none
    }
    
    /* ::-webkit-scrollbar-track {
      background-color: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
      background-color: #d6dee1;
      border-radius: 20px;
      background-clip: content-box;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background-color: #a8bbbf;
    }

    ::-webkit-scrollbar-corner {
        background: transparent;
    } */
    
</style>

<div class="app-header header header-baru py-0 pe-0" style="padding-left: 0px !important">
    <div class="container-fluid px-0">

        <div class="d-flex" style="position: relative">

            <div class="col-12 px-0">
                <div class="card mb-0 border-0">
                    <div class="card-body for-kolapse py-1 pl-5" style="background: #000; padding-right: 2.5rem">
                        <div class="row py-4 justify-content-between" style="gap: 15px">
                            
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-md-auto pe-0 my-auto">
                                        <img src="{{asset('')}}storage/{{$config->regencies_logo}}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col-lg-auto ps-3 mb-0">
                                       <h3 class="text-white mb-0">PILPRES 2024
                                           <!-- Kota -->
                                       </h3>
                                       <ol class="breadcrumb">
                                           <li class="breadcrumb-item active text-white" aria-current="page">{{ $kota->name }}
                                               <!-- Kota -->
                                           </li>
                                       </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto my-auto">
                                <div class="row h-100 justify-content-end" style="gap: 10px;">
                                    <div class="col-md-auto px-0">
                                        <a class="w-100 mx-auto btn text-white" style="background-color: #528bff; width: 40px; height: 36px;" href="{{url('')}}/administrator/index">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dashboard">    
                                                <i class="fa-solid fa-gauge-high"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="petugas">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Petugas">    
                                                <i class="fa-solid fa-user-tie"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="operator">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Operator">    
                                                <i class="fa-solid fa-computer"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="perhitungan">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Perhitungan">    
                                                <i class="fa-solid fa-chart-simple"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="rekapitulasi">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Rekapitulasi">
                                                <i class="fa-solid fa-folder-closed"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="dokumentasi">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dokumentasi">
                                                <i class="fa-solid fa-book"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="kecurangan">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Kecurangan">
                                                <i class="fa-solid fa-file-circle-xmark"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md my-auto">
                                <div class="row">

                                    <div class="col-md-auto my-auto">
                                        <h4 class="mb-0 fw-bold dashboard tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Dashboard
                                        </h4>
                                        <h4 class="mb-0 fw-bold petugas tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Petugas
                                        </h4>
                                        <h4 class="mb-0 fw-bold operator tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Operator
                                        </h4>
                                        <h4 class="mb-0 fw-bold perhitungan tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Perhitungan
                                        </h4>
                                        <h4 class="mb-0 fw-bold rekapitulasi tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Rekapitulasi
                                        </h4>
                                        <h4 class="mb-0 fw-bold dokumentasi tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Dokumentasi
                                        </h4>
                                        <h4 class="mb-0 fw-bold kecurangan tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Kecurangan
                                        </h4>
                                        <h4 class="mb-0 fw-bold suara tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Urutan
                                        </h4>
                                        <h4 class="mb-0 fw-bold tabulasi tugel-content" style="color: #009c85; font-size: 16px">
                                            Tabulasi
                                        </h4>
                                        <h4 class="mb-0 fw-bold kota tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Kota
                                        </h4>
                                        <h4 class="mb-0 fw-bold support tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Support
                                        </h4>
                                        <h4 class="mb-0 fw-bold setting tugel-content" style="color: #009c85; font-size: 16px; display: none;">
                                            Settings
                                        </h4>
                                    </div>

                                    <div class="col-md petugas tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/verifikasi_saksi" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 25px 0px 0px 25px;">
                                                    Saksi
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/relawan" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0;">
                                                    Relawan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/enumerator" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0;">
                                                    Enumerator
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/verifikasi_akun" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px 25px 25px 0px;">
                                                    Admin
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md operator tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/verifikator/verifikasi-c1" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 25px 0px 0px 25px;">
                                                    Verifikasi C1
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/auditor/audit-c1" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px;">
                                                    Audit C1
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/verifikasi_koreksi" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px 25px 25px 0px;">
                                                    Koreksi
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md perhitungan tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/real_count2" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 25px 0px 0px 25px;">
                                                    Real Count
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/quick_count2" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px">
                                                    Quick Count
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/terverifikasi" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px 25px 25px 0px;">
                                                    Terverifikasi
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md rekapitulasi tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/rekapitulasi_kelurahan" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 25px 0px 0px 25px;">
                                                    Rekapitulasi Kelurahan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/rekapitulasi_kecamatan" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px 25px 25px 0px;">
                                                    Rekapitulasi Kecamatan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md dokumentasi tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/data-c1" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 25px 0px 0px 25px;">
                                                    C1
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0;">
                                                    C6
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0;">
                                                    Riwayat
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0;">
                                                    Realisasi DPT
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn btn-primary fs-6 w-100" style="border-radius: 0px 25px 25px 0px;">
                                                    Surat Suara
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md text-white tabulasi tugel-content">
                                        <div class="row">
                                            <div class="col py-2 judul text-center bg-secondary text-white"
                                                style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">
                                                <div class="text">Total TPS : <b>{{ $total_tps }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-danger text-white">
                                                <div class="text">TPS Masuk : <b>{{ $tps_masuk }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-primary text-white">
                                                <div class="text">TPS Kosong : <b>{{ $tps_kosong }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-info text-white">
                                                <div class="text">Suara Masuk : <b>{{ $suara_masuk }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-success text-white"
                                                style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">
                                                <div class="text">Terverifikasi : <b>{{$total_verification_voice}}</b></div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .items.active {
                                          cursor: grabbing;
                                          cursor: -webkit-grabbing;
                                        }
                                    </style>

                                    <div class="col-md text-white kota tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <input type="text" class="w-100 form-control py-0" style="border-radius: 25px; height: 30px" name="" id="" placeholder="Cari Kota..." >
                                            </div>
                                            <div class="col-6">
                                                <?php $domainKota = RegenciesDomain::join("regencies",'regency_domains.regency_id','=','regencies.id')->where("regency_domains.province_id",$props->id)->get(); ?>
                                                <div class="row items" style="width: 515px; overflow: scroll; flex-wrap: nowrap">
                                                    @foreach($domainKota as $dokota)
                                                        <div class="col">    
                                                            <a class="text-white btn btn-secondary rounded-0 item" href="{{$dokota->domain}}">{{$dokota->name}}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        const $slider = $('.items');
                                        let isDown = false;
                                        let startX;
                                        let scrollLeft;                                        

                                        $slider.on('mousedown', (e) => {
                                          isDown = true;
                                          $slider.addClass('active');
                                          startX = e.pageX - $slider.offset().left;
                                          scrollLeft = $slider.scrollLeft();
                                          setTimeout(() => {
                                            $('.items.active .item').prop('disabled', true)
                                          }, 100);
                                        });                                        

                                        $slider.on('mouseleave', () => {
                                          isDown = false;
                                          $slider.removeClass('active');
                                        });                                        

                                        $slider.on('mouseup', () => {
                                          isDown = false;
                                          $slider.removeClass('active');
                                        });                                        

                                        $slider.on('mousemove', (e) => {
                                          if (!isDown) return;
                                          e.preventDefault();
                                          const x = e.pageX - $slider.offset().left;
                                          const walk = (x - startX) * 1; // scroll-fast
                                          $slider.scrollLeft(scrollLeft - walk);
                                          console.log(walk);
                                        });

                                    </script>

                                    <div class="col-md text-white support tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md-auto px-1 my-auto">
                                                <img src="https://plus.unsplash.com/premium_photo-1661510749856-47c47ea10fc7?auto=format&fit=crop&q=80&w=1932&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="avatar profile-user brround" style="width: 35px; height: 35px; object-fit: cover" alt="">
                                            </div>
                                            <div class="col-md my-auto">
                                                <input class="w-100 form-control py-0" style="border-radius: 25px; height: 30px" type="text" name="" id="" placeholder="Kirim pesan ...">
                                            </div>
                                            <div class="col-md-auto my-auto p-0">
                                                <button class="btn text-white my-auto"><i class="fa-solid fa-paper-plane" style="font-size: 16px;"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md setting tugel-content settings" style="display: none; top: 0; position: relative;">
                                        {{-- Settings --}}
                                        <div class="row px-5 my-auto" style="gap: 25px;">
                                            <div class="col-md">
                                                <div class="mid">
                                                
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('multi_admin',this)"
                                                            {{($config->multi_admin == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Multi
                                                </div>
                                            </div>
                                        
                                            <div class="col-md">
                                                <div class="mid">
                                                
                                                    <label class="switch">
                                                        <input type="checkbox" data-target="mode" onclick="settings('otonom',this)"
                                                            {{($config->otonom == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Otonom
                                                </div>
                                            </div>
                                        
                                            <div class="col-md">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('show_terverifikasi',this)"
                                                            {{($config->show_terverifikasi == "hide") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Verifikasi
                                                </div>
                                            </div>
                                        
                                            <div class="col-md">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('show_public',this)"
                                                            {{($config->show_public == "hide") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Publish C1
                                                </div>
                                            </div>
                                        
                                            <div class="col-md">
                                                <div class="mid">
                                                
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('lockdown',this)"
                                                            {{($config->lockdown == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Lockdown
                                                </div>
                                            </div>
                                        
                                            <div class="col-md">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('quick_count',this)"
                                                            {{($config->quick_count == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Quick Count
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                
                                    <div class="col-md suara tugel-content"style="display: none">
                                        <div class="row">
                                            @foreach ($urutan as $urutPaslon)
                                            <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                                            <div class="col py-2 judul text-center text-white custom-urutan"
                                                style="background: {{ $pasangan->color }}">
                                                <div class="text">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} : {{$urutPaslon->total}}</b></div>
                                            </div>
                                            @endforeach
                                        </div>
                                        {{-- <div class="row">
                                            @foreach ($urutan as $urutPaslon)
                                                <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                                                <div class="col-auto">
                                                    <div class="card shadow text-center mb-0 mx-auto mt-1 border-0">
                                                        <div class="card-header pt-1 pb-1 px-2 border-0" style="background: {{ $pasangan->color }}">
                                                            <span class="card-title text-white mx-auto">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} : {{$urutPaslon->total}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div> --}}
                                    </div>
                                
                                </div>
                            </div>
                        
                            <div class="col-md-auto my-auto">
                                <div class="row h-100 justify-content-end" style="gap: 10px;">
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="suara">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Urutan Suara">    
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white active-button" style="background-color: #656064; width: 40px; height: 36px;" data-target="tabulasi">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Tabulasi">    
                                                <i class="fa-solid fa-database"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="kota">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Kota">    
                                                <i class="fa-solid fa-city"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0" style="color: #212529 !important">
                                        <a class="w-100 mx-auto btn nav-link theme-layout nav-link-bg layout-setting px-3 text-white" onclick="darktheme()" style="background-color: #656064; width: 40px; height: 36px; margin: 0px; font-size: 16px" data-target="">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                title="Dark Theme"><i class="fe fe-moon"></i></span>
                                            <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                title="Light Theme"><i class="fe fe-sun"></i></span>
                                        </a>
                                    </div>
                                    {{-- <div class="dropdown d-none d-md-flex">
                                        <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="darktheme()">
                                            
                                        </a>
                                    </div><!-- Theme-Layout --> --}}
                                    <script>
                                        let darktheme = function() {
                                            setTimeout(function() {
                                                let body = document.body;
                                                let themes = body.className.split(" ");
                                                let theme = (themes.length == 3) ? "yes" : "no";
                                                $.ajax({
                                                    url: `{{ route('superadmin.theme') }}`,
                                                    data: {
                                                        theme,
                                                        "_token": "{{ csrf_token() }}"
                                                    },
                                                    type: "post",
                                                    success: function(res) {
                                                    
                                                    }
                                                });
                                            }, 300);
                                        }

                                    </script>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="support">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Support">
                                                <i class="fa-solid fa-headset"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="setting">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Settings">
                                                <i class="fa-solid fa-gear"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <div class="dropdown d-none d-md-flex profile-1">
                                            <a href="#" data-bs-toggle="dropdown" class="nav-link pt-0 leading-none d-flex">
                                                <span>
                                                    @if (Auth::user()->profile_photo_path == NULL)
                                                    <img class="avatar profile-user brround" style="object-fit: cover; width: 33px; height: 33px" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                                                    @else
                                                    <img class="avatar profile-user brround" style="object-fit: cover; width: 33px; height: 33px" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user"s>
                                                    @endif
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                                        <small
                                                            class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a class="dropdown-item" href="/user/profile">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                            
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                
                                                
                                                    <button class="dropdown-item"type="submit">
                                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                    </div>
                </div>
                <div class="card-footer p-0 border-0" id="marquee1" style="position: relative; background-color: #343a40">
                    {{-- <button class="btn-dark btn-kolapse-sidebar text-white" style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i class="fa-solid fa-align-left"></i></button> --}}
                    <button class="btn-dark btn-kolapse text-white h-100" style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i class="fa-solid fa-bars"></i></button>
                    <button class="btn-danger text-white h-100 rounded-0" style="position: absolute; left: 28px; z-index: 20">Suara Masuk</button>
                    {{-- <button class="btn btn-kolapse text-white" style="background-color: #30304d; z-index: 20"><i class="fa-solid fa-bars"></i></button>
                    <button class="btn btn-danger text-white rounded-0" style="z-index: 20">Suara Masuk</button> --}}
                    <marquee>
                        @foreach ($marquee as $item)
                        <?php $kecamatan =  District::where('id', $item['districts'])->first(); ?>
                        <?php $kelurahan =  Village::where('id', $item['villages'])->first(); ?>
                        <?php $tps =  Tps::where('id', $item['tps_id'])->first(); ?>
                        <span class="text-success">▼ </span><span class="text-white" style="font-size: 20px;">{{$item['name']}}
                            Kecamatan {{$kecamatan['name']}}, Kelurahan {{$kelurahan['name']}}, TPS {{$tps['number']}}
                        </span>
                        @endforeach
                    </marquee>
                </div>
            </div>

            <script>
                $('.btn-kolapse').on('click', function() {
                    $('.for-kolapse').toggle(500);
                    $('.for-kolapse-kurangin > .side-app > .row:first').toggleClass('kurangin')
                })

                // $('.btn-kolapse-sidebar').on('click', function() {
                //     $('body.app.sidebar-mini').toggleClass('sidenav-toggled')
                // })
            
                $('.tugel-kolaps').on('click', function() {
                
                    let target = $(this).data('target')
                    // console.log(target)
                    $('.tugel-content').hide()
                    $(`.${target}`).show(200)
                })

                $('.tugel-kolaps-menu').on('click', function() {
                
                    let target = $(this).data('target')
                    // console.log(target)
                    const cek = $(`.${target}`).css('display') == 'block';

                    $('.tugel-content-menu').hide(500)
                    
                    if (cek) {
                        $('.tugel-content-menu').hide(500)
                    }else{
                        $(`.${target}`).show(500)
                    }
                })

                $('.tugel-kolaps').on('click',function () {
                    const btnIni = $(this);
                    $('.tugel-kolaps').removeClass('active-button');
                    btnIni.addClass('active-button');
                });

                

                // $('.tugel-kolaps-menu.content-toggled').on('click', function() {
                
                    // let target = $(this).data('target')
                    // console.log(target)
                    // $('.tugel-content-menu').removeClass('content-toggled')
                    // $(`.${target}`).toggleClass('content-toggled')
                // })

               
            
            </script>

        </div>
    </div>
</div>
<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ms-auto">


            <div class="dropdown d-md-flex message">
                <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                    <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <div class="message-menu">
                        <?php
                        $allUser = App\Models\User::where('id', '!=', Auth::user()->id)
                            ->where('role_id', '!=', 8)
                            ->where('role_id', '!=', 0)
                            ->where('role_id', '!=', 14)
                            ->get(); ?>
                        @foreach ($allUser as $usr)
                            <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?= $usr->id ?>`)">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{ url('/') }}/assets/images/users/1.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">{{ $usr->name }}</h5>
                                        <small class="text-muted ms-auto text-end">

                                        </small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-divider m-0"></div>

                </div>
            </div><!-- MESSAGE-BOX -->
            <div class="dropdown d-md-flex profile-1">
                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex pt-0">
                    <span>
                        @if (Auth::user()->profile_photo_path == NULL)
                        <img class="avatar profile-user brround" style="object-fit: cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                        @else
                        <img class="avatar profile-user brround" style="object-fit: cover" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user"s>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading">
                        <div class="text-center">
                            <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                            <small
                                class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                        </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item" href="/user/profile">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <button class="dropdown-item"type="submit">
                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right"
                    data-target=".sidebar-right">
                    <i class="fe fe-menu"></i>
                </a>
            </div><!-- SIDE-MENU -->
        </div>
    </div>
</div>
<!-- /Mobile Header -->

<!--app-content open-->
<div class="app-content for-kolapse-kurangin" style="margin-top: 40px; margin-left: 0px !important">
    <div class="side-app">
