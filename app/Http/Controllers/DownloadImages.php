<?php 
namespace App\Http\Controllers;

use App\Models\CrowdC1;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\Image;
use File;

class DownloadImages extends Controller
{
    public function downloadImages($status)
    {
        // Ambil semua data gambar dari database
        $images = CrowdC1::where('status',(string)$status)->get();

        // Nama file ZIP yang akan diunduh
        $zipFileName = 'downloaded_images.zip';

        // Inisialisasi objek ZipArchive
        $zip = new ZipArchive;
        $zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Loop through setiap gambar dan tambahkan ke ZIP
        foreach ($images as $image) {
          
            $imagePath = public_path('storage/c1_plano/' . $image->crowd_c1);
            $relativePath = 'storage/c1_plano/' . $image->crowd_c1; // Sesuaikan dengan struktur data gambar di database
            $zip->addFile($relativePath);
        }

        // Tutup ZIP setelah semua gambar ditambahkan
        $zip->close();

        // Unduh file ZIP dan hapus setelah diunduh
        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
}