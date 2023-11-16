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
            'buka verifikasi saksi' => 'klik tab verifikasi saksi(nav petugas saksi)',
            'buka saksi teregistrasi' => 'klik tab saksi teregistrasi(nav petugas saksi)',
            'buka saksi hadir' => 'klik tab saksi hadir(nav petugas saksi)',
            'buka saksi tidak hadir' => 'klik tab saksi tidak hadir(nav petugas saksi)',
            'buka saksi ditolak' => 'klik tab saksi ditolak(nav petugas saksi)',
            'buka petugas koordinator saksi' => $prefixAdmin . 'koordinator_saksi',
            'buka koordinator saksi kota' => 'klik tab koordinator saksi kota(nav petugas koordinator saksi)',
            'buka koordinator saksi kecamatan' => 'klik tab koordinator saksi kecamatan(nav petugas koordinator saksi)',
            'buka koordinator saksi kelurahan' => 'klik tab koordinator saksi kelurahan(nav petugas koordinator saksi)',
            'buka koordinator saksi rt' => 'klik tab koordinator saksi rt(nav petugas koordinator saksi)',
            'buka koordinator saksi rw' => 'klik tab koordinator saksi rw(nav petugas koordinator saksi)',
            'buka petugas relawan' => $prefixAdmin . 'relawan',
            'buka relawan terdaftar' => 'klik tab relawan terdaftar(nav petugas relawan)',
            'buka relawan dihapus' => 'klik tab relawan dihapus(nav petugas relawan)',
            'buka petugas enumerator' => $prefixAdmin . 'enumerator',
            'buka enumerator' => 'klik tab enumerator(nav petugas enumerator)',
            'buka enumerator teregistrasi' => 'klik tab enumerator teregistrasi(nav petugas enumerator)',
            'buka enumerator hadir' => 'klik tab enumerator hadir(nav petugas enumerator)',
            'buka enumerator tidak hadir' => 'klik tab enumerator tidak hadir(nav petugas enumerator)',
            'buka enumerator ditolak' => 'klik tab enumerator ditolak(nav petugas enumerator)',
            'buka petugas crowd c1' => $prefixAdmin . 'verifikasi_crowd_c1',
            'buka verifikasi crowd c1' => 'klik tab verifikasi crowd c1(nav petugas crowd c1)',
            'buka crowd c1 terverifikasi' => 'klik tab crowd c1 terverifikasi(nav petugas crowd c1)',
            'buka petugas admin' => $prefixAdmin . 'verifikasi_akun',
            'buka verifikasi admin' => 'klik tab verifikasi admin(nav petugas admin)',
            'buka admin terverifikasi' => 'klik tab admin terverifikasi(nav petugas admin)',

            'buka operator verifikasi c1' => $prefixVerifikator . 'verifikasi-c1',
            'buka c1 saksi' => 'klik tab c1 saksi(nav operator verifikasi c1)',
            'buka c1 relawan tps' => 'klik tab c1 relawan tps(nav operator verifikasi c1)',
            'buka c1 crowd kpu' => 'klik tab c1 crowd kpu(nav operator verifikasi c1)',
            'buka operator audit c1' => $prefixVerifikator . 'audit-c1',
            'buka audit c1' => 'klik tab audit c1(nav operator audit c1)',
            'buka c1 lolos audit' => 'klik tab c1 lolos audit(nav operator audit c1)',
            'buka operator crowd c1 KPU' => $prefixVerifikator . 'crowd-c1-kpu',

            'buka pelacakan saksi' => $prefixAdmin . 'lacak_saksi',
            'buka pelacakan relawan' => $prefixAdmin . 'lacak_relawan',
            'buka pelacakan enumerator' => $prefixAdmin . 'lacak_enumerator',
            'buka pelacakan admin' => $prefixAdmin . 'lacak_admin',
            'buka pelacakan crowd c1' => $prefixAdmin . 'lacak_crowd_c1',

            'buka dokumentasi data c1 saksi' => $prefixAdmin . 'data-c1',
            'buka dokumentasi dokumen lain' => $prefixAdmin . 'dokumen_lain',
            'buka data pemilih' => 'klik tab data pemilih(dokumentasi dokumen lain)',
            'buka c7' => 'klik tab c7(dokumentasi dokumen lain)',
            'buka koreksi c1' => 'klik tab koreksi c1(dokumentasi dokumen lain)',
            'buka dokumentasi crowd' => $prefixAdmin . 'data-crowd-c1-kpu',
            'buka dokumentasi riwayat' => $prefixAdmin . 'r-data',

            'buka sirantap verifikasi kecurangan' => $prefixVerifikator . 'verifikator_kecurangan',
            'buka sirantap bukti kecurangan' => $prefixVerifikator . 'fraud-data-print',
            'buka data kecurangan masuk' => 'klik tab data kecurangan masuk(sirantap bukti kecurangan)',
            'buka data tercetak' => 'klik tab data tercetak(sirantap bukti kecurangan)',
            'buka sirantap barcode kecurangan' => $prefixVerifikator . 'fraud-data-report',
            'buka sirantap jenis kecurangan' => $prefixAdmin . 'index-tsm',

            'buka dpt' => 'klik nav dpt',
            'buka urutan' => 'klik nav urutan',
        ];

        $jumlahCommandsAndUrls = count($commandsAndUrls);
        for ($i = 0; $i < $jumlahCommandsAndUrls; $i++) {
            $keysOfArray = array_keys($commandsAndUrls);
            $namaHalaman = $keysOfArray[$i];
            $route = $commandsAndUrls[$namaHalaman];

            $isRouteHasSlash = strpos($route, '/'); // jika route tidak mempunyai slash, itu berarti command tersebut berupa aksi, bukan untuk di redirect.
            $commandsAndUrls[$namaHalaman] = $route;
        }

        $jsonFilePath = storage_path('commandsAndUrls.json');;
        $jsonData = json_encode($commandsAndUrls, JSON_PRETTY_PRINT);
        file_put_contents($jsonFilePath, $jsonData);

        $this->info('Command dan url berhasil dibuat.');
    }
}
