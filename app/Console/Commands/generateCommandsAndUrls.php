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

            'buka real count' => $prefixAdmin . 'real_count2',
            'buka quick count' => $prefixAdmin . 'quick_count2',
            'buka terverifikasi' => $prefixAdmin . 'terverifikasi',
            'buka rekapitulasi' => $prefixAdmin . 'rekapitulasi',

            'buka saksi' => $prefixAdmin . 'verifikasi_saksi',
            'buka tab verifikasi saksi' => 'klik tab verifikasi saksi(nav petugas saksi)',
            'buka tab saksi teregistrasi' => 'klik tab saksi teregistrasi(nav petugas saksi)',
            'buka tab saksi hadir' => 'klik tab saksi hadir(nav petugas saksi)',
            'buka tab saksi tidak hadir' => 'klik tab saksi tidak hadir(nav petugas saksi)',
            'buka tab saksi ditolak' => 'klik tab saksi ditolak(nav petugas saksi)',
            'buka koordinator saksi' => $prefixAdmin . 'koordinator_saksi',
            'buka tab koordinator saksi kota' => 'klik tab koordinator saksi kota(nav petugas koordinator saksi)',
            'buka tab koordinator saksi kecamatan' => 'klik tab koordinator saksi kecamatan(nav petugas koordinator saksi)',
            'buka tab koordinator saksi kelurahan' => 'klik tab koordinator saksi kelurahan(nav petugas koordinator saksi)',
            'buka tab koordinator saksi rt' => 'klik tab koordinator saksi rt(nav petugas koordinator saksi)',
            'buka tab koordinator saksi rw' => 'klik tab koordinator saksi rw(nav petugas koordinator saksi)',
            'buka relawan' => $prefixAdmin . 'relawan',
            'buka tab relawan terdaftar' => 'klik tab relawan terdaftar(nav petugas relawan)',
            'buka tab relawan dihapus' => 'klik tab relawan dihapus(nav petugas relawan)',
            'buka enumerator' => $prefixAdmin . 'enumerator',
            'buka tab enumerator' => 'klik tab enumerator(nav petugas enumerator)',
            'buka tab enumerator teregistrasi' => 'klik tab enumerator teregistrasi(nav petugas enumerator)',
            'buka tab enumerator hadir' => 'klik tab enumerator hadir(nav petugas enumerator)',
            'buka tab enumerator tidak hadir' => 'klik tab enumerator tidak hadir(nav petugas enumerator)',
            'buka tab enumerator ditolak' => 'klik tab enumerator ditolak(nav petugas enumerator)',
            'buka petugas crowd c1' => $prefixAdmin . 'verifikasi_crowd_c1',
            'buka tab verifikasi crowd c1' => 'klik tab verifikasi crowd c1(nav petugas crowd c1)',
            'buka tab crowd c1 terverifikasi' => 'klik tab crowd c1 terverifikasi(nav petugas crowd c1)',
            'buka petugas admin' => $prefixAdmin . 'verifikasi_akun',
            'buka tab verifikasi admin' => 'klik tab verifikasi admin(nav petugas admin)',
            'buka tab admin terverifikasi' => 'klik tab admin terverifikasi(nav petugas admin)',

            'buka operator verifikasi c1' => $prefixVerifikator . 'verifikasi-c1',
            'buka tab c1 saksi' => 'klik tab c1 saksi(nav operator verifikasi c1)',
            'buka tab c1 relawan tps' => 'klik tab c1 relawan tps(nav operator verifikasi c1)',
            'buka tab c1 crowd kpu' => 'klik tab c1 crowd kpu(nav operator verifikasi c1)',
            'buka operator audit c1' => $prefixVerifikator . 'audit-c1',
            'buka tab audit c1' => 'klik tab audit c1(nav operator audit c1)',
            'buka tab c1 lolos audit' => 'klik tab c1 lolos audit(nav operator audit c1)',
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
            'buka data tercetak' => 'klik tab data tercetak(sirantap data tercetak)',
            'buka sirantap barcode kecurangan' => $prefixVerifikator . 'fraud-data-report',
            'buka sirantap jenis kecurangan' => $prefixAdmin . 'index-tsm',

            'buka dpt' => 'klik nav dpt',
            'buka urutan' => 'klik nav urutan',
            'berapa jumlah dpt kabupaten tangerang selatan' => 'hitung jumlah kabupaten tangerang selatan',
        ];

        // jika route tidak mempunyai slash, itu berarti command tersebut berupa aksi, bukan untuk di redirect.
        $jumlahCommandsAndUrls = count($commandsAndUrls);
        for ($i = 0; $i < $jumlahCommandsAndUrls; $i++) {
            $keysOfArray = array_keys($commandsAndUrls);
            $namaHalaman = $keysOfArray[$i];
            $route = $commandsAndUrls[$namaHalaman];

            $commandsAndUrls[$namaHalaman] = $route;
        }

        $jsonFilePath = storage_path('commandsAndUrls.json');;
        $jsonData = json_encode($commandsAndUrls, JSON_PRETTY_PRINT);
        file_put_contents($jsonFilePath, $jsonData);

        $this->info('Command dan url berhasil dibuat.');
    }
}
