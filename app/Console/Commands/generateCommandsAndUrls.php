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
            'buka dashboard' => $prefixAdmin . 'index',

            'buka perhitungan real count' => $prefixAdmin . 'real_count2',
            'buka perhitungan quick count' => $prefixAdmin . 'quick_count2',
            'buka perhitungan terverifikasi' => $prefixAdmin . 'terverifikasi',
            'buka perhitungan rekapitulasi' => $prefixAdmin . 'rekapitulasi',

            'buka petugas saksi' => $prefixAdmin . 'verifikasi_saksi',
            'buka petugas koordinator saksi' => $prefixAdmin . 'koordinator_saksi',
            'buka petugas relawan' => $prefixAdmin . 'relawan',
            'buka petugas enumerator' => $prefixAdmin . 'enumerator',
            'buka petugas crowd c1' => $prefixAdmin . 'verifikasi_crowd_c1',
            'buka petugas admin' => $prefixAdmin . 'verifikasi_akun',

            'buka operator verifikasi c1' => $prefixVerifikator . 'verifikasi-c1',
            'buka operator audit c1' => $prefixVerifikator . 'audit-c1',
            'buka operator crowd c1 KPU' => $prefixVerifikator . 'crowd-c1-kpu',

            'buka pelacakan saksi' => $prefixAdmin . 'lacak_saksi',
            'buka pelacakan relawan' => $prefixAdmin . 'lacak_relawan',
            'buka pelacakan enumerator' => $prefixAdmin . 'lacak_enumerator',
            'buka pelacakan admin' => $prefixAdmin . 'lacak_admin',
            'buka pelacakan crowd c1' => $prefixAdmin . 'lacak_crowd_c1',

            'buka dokumentasi data c1 saksi' => $prefixAdmin . 'data-c1',
            'buka dokumentasi dokumen lain' => $prefixAdmin . 'dokumen_lain',
            'buka dokumentasi crowd' => $prefixAdmin . 'data-crowd-c1-kpu',
            'buka dokumentasi riwayat' => $prefixAdmin . 'r-data',

            'buka sirantap verifikasi kecurangan' => $prefixVerifikator . 'verifikator_kecurangan',
            'buka sirantap bukti kecurangan' => $prefixVerifikator . 'fraud-data-print',
            'buka sirantap barcode kecurangan' => $prefixVerifikator . 'fraud-data-report',
            'buka sirantap jenis kecurangan' => $prefixAdmin . 'index-tsm',

            'buka dpt' => 'klik nav dpt',
            'buka urutan' => 'klik nav urutan',
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
