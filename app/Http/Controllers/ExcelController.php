<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    // use IOFactory;
    public function importExcel(Request $request)
    {

        set_time_limit(99999999);
        $files = $request->file('excel_files');

        foreach ($files as $file) {
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $filteredExcelData = $rows;
            foreach ($filteredExcelData as $j => $row) {
                foreach ($row as $i => $cell) {
                    if (trim($cell) == "") {
                        unset($filteredExcelData[$j][$i]);
                        unset($filteredExcelData[$j]);
                    }
                    if (!isset($row[2])) {
                        unset($filteredExcelData[$j][$i]);
                    }
                }
                if (empty($row)) {
                    unset($filteredExcelData[$j]);
                }
            }
            foreach ($filteredExcelData as  $j => $row) {
                if (empty($row)) {
                    continue;
                }
                DB::table('dpt_indonesia')->insert([
                    'province_name' => $row[0],
                    'regency_name' => $row[1],
                    'district_name' => $row[2],
                    'village_name' => $row[3],
                    'tps' => $row[4],
                    'nama_pemilih' => $row[6],
                    'usia' => $row[7],
                    'rw' => $row[8],
                    'rt' => $row[9],
                ]);
            }
            echo "berhasil";
        }



        // Lakukan sesuatu dengan data yang dibaca, seperti menampilkan dalam view
        // return view('excel.display-excel-data', ['excelData' => $rows]);
    } 
    public function importDptExcel(Request $request)
    {

       
        $files = $request->file('excel_files');

      
            $spreadsheet = IOFactory::load($files);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
           
            $filteredExcelData = $rows;

            foreach ($filteredExcelData as $j => $row) {
                foreach ($row as $i => $cell) {
                    if (trim($cell) == "") {
                        unset($filteredExcelData[$j][$i]);
                    }
                    if (isset($row[2])) {
                        unset($filteredExcelData[$j][$i]);
                    }
                }
            }
            
            $filteredExcelData[2][1]; //kecamatan
            $filteredExcelData[3][1]; //kelurahan
            $filteredExcelData[7][1]; //dpt
            $regency = Regency::where('name',$filteredExcelData[1][1])->first();
            $district = District::where('name',$filteredExcelData[2][1])->where('regency_id',$regency->id)->first();

            // $districts = District::where('regency_id',$regency->id)->get();



            //     foreach ($districts as $district) {
            //         District::where('id',$district->id)->update([
            //             'dpt' => null
            //         ]);
            //     }
            
            
            if ($district->dpt  == null) {
                District::where('id',$district->id)->update([
                    'dpt' =>  (int) $filteredExcelData[7][1]
                ]);
            }else{
                $dptBaru = $district->dpt + (int) $filteredExcelData[7][1];
                District::where('id',$district->id)->update([
                    'dpt' =>  (int) $dptBaru
                ]);
            }
            return District::where('name',$filteredExcelData[2][1])->where('regency_id',$regency->id)->first();

        // Lakukan sesuatu dengan data yang dibaca, seperti menampilkan dalam view
        // return view('excel.display-excel-data', ['excelData' => $rows]);
    } 
}
