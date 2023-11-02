<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    // use IOFactory;
    public function importExcel(Request $request)
    {
        // return $request;
        $file = $request->file('excel_file');
    
        // Baca isi file Excel
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
    
        // Lakukan sesuatu dengan data yang dibaca, seperti menampilkan dalam view
        return $rows;
    }//
}
