<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class generateCommandsAndUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateCommandsAndUrls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate command dan url untuk voice command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $commandsAndUrls = [];

        $prefixAdmin = 'administrator/';
        $prefixVerifikator = 'verifikator/';
        $commandsAndUrls = [
            'dashboard' => $prefixAdmin . 'index',

            'perhitungan real count' => $prefixAdmin . 'real_count2',
            'perhitungan quick count' => $prefixAdmin . 'quick_count2',
            'perhitungan terverifikasi' => $prefixAdmin . 'terverifikasi',
            'perhitungan rekapitulasi' => $prefixAdmin . 'rekapitulasi',

            'petugas saksi' => $prefixAdmin . 'verifikasi_saksi',
            'petugas koordinator saksi' => $prefixAdmin . 'koordinator_saksi',
            'petugas relawan' => $prefixAdmin . 'relawan',
            'petugas enumerator' => $prefixAdmin . 'enumerator',
            'petugas crowd c1' => $prefixAdmin . 'verifikasi_crowd_c1',
            'petugas admin' => $prefixAdmin . 'verifikasi_akun',

            'operator verifikasi c1' => $prefixVerifikator . 'verifikasi-c1',
            'operator audit c1' => $prefixVerifikator . 'audit-c1',
            'operator crowd c1 KPU' => $prefixVerifikator . 'crowd-c1-kpu',

            'pelacakan saksi' => $prefixAdmin . 'lacak_saksi',
            'pelacakan relawan' => $prefixAdmin . 'lacak_relawan',
            'pelacakan enumerator' => $prefixAdmin . 'lacak_enumerator',
            'pelacakan admin' => $prefixAdmin . 'lacak_admin',
            'pelacakan crowd c1' => $prefixAdmin . 'lacak_crowd_c1',

            'dokumentasi data c1 saksi' => $prefixAdmin . 'data-c1',
            'dokumentasi dokumen lain' => $prefixAdmin . 'dokumen_lain',
            'dokumentasi crowd' => $prefixAdmin . 'data-crowd-c1-kpu',
            'dokumentasi riwayat' => $prefixAdmin . 'r-data',

            'sirantap verifikasi kecurangan' => $prefixVerifikator . 'verifikator_kecurangan',
            'sirantap bukti kecurangan' => $prefixVerifikator . 'fraud-data-print',
            'sirantap barcode kecurangan' => $prefixVerifikator . 'fraud-data-report',
            'sirantap jenis kecurangan' => $prefixAdmin . 'index-tsm',

            'dpt' => 'klik nav dpt',
            'urutan' => 'klik nav urutan',
        ];

        $jumlahCommandsAndUrls = count($commandsAndUrls);
        $hostname = request()->secure() ? 'https' : 'http' . '://' . request()->getHost();
        for ($i = 0; $i < $jumlahCommandsAndUrls; $i++) {
            $keysOfArray = array_keys($commandsAndUrls);
            $namaHalaman = $keysOfArray[$i];
            $route = $commandsAndUrls[$namaHalaman];

            $isRouteHasSlash = strpos($route, '/'); // jika route tidak mempunyai slash, itu berarti command tersebut berupa aksi, bukan untuk di redirect.
            if ($isRouteHasSlash) {
                $commandsAndUrls[$namaHalaman] = "$hostname/$route";
            } else {
                $commandsAndUrls[$namaHalaman] = $route;
            }
        }

        $jsonFilePath = storage_path('commandsAndUrls.json');;
        $jsonData = json_encode($commandsAndUrls, JSON_PRETTY_PRINT);
        file_put_contents($jsonFilePath, $jsonData);

        $this->info('Command dan url berhasil dibuat.');
    }
}
