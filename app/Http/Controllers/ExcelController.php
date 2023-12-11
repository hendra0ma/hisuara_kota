<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Regency;
use App\Models\Tps;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class filterKelurahan implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($columnAddress, $row, $worksheetName = '')
    {
        // baca row 1 - row 8
        if ($row >= 0 && $row <= 8) {
            return true;
        }
        return false;
    }
}

class filterTps implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($columnAddress, $row, $worksheetName = '')
    {
        if ($columnAddress == 'E') {
            return true;
        }
        return false;
    }
}


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
        dd($filteredExcelData);

        $filteredExcelData[2][1]; //kecamatan
        $filteredExcelData[3][1]; //kelurahan
        $filteredExcelData[7][1]; //dpt
        $regency = Regency::where('name', $filteredExcelData[1][1])->first();
        $district = District::where('name', $filteredExcelData[2][1])->where('regency_id', $regency->id)->first();

        // $districts = District::where('regency_id',$regency->id)->get();



        //     foreach ($districts as $district) {
        //         District::where('id',$district->id)->update([
        //             'dpt' => null
        //         ]);
        //     }


        if ($district->dpt  == null) {
            District::where('id', $district->id)->update([
                'dpt' =>  (int) $filteredExcelData[7][1]
            ]);
        } else {
            $dptBaru = $district->dpt + (int) $filteredExcelData[7][1];
            District::where('id', $district->id)->update([
                'dpt' =>  (int) $dptBaru
            ]);
        }
        return District::where('name', $filteredExcelData[2][1])->where('regency_id', $regency->id)->first();

        // Lakukan sesuatu dengan data yang dibaca, seperti menampilkan dalam view
        // return view('excel.display-excel-data', ['excelData' => $rows]);
    }

    public function importDptExcelGen(Request $request)
    {
        $hasilUpload = [];
        foreach ($request->file('excel_files') as $files) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $reader->setReadFilter(new filterKelurahan());
            $spreadsheet = $reader->load($files);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet = $worksheet->toArray();

            $namaProvinsi = $worksheet[0][1];
            $namaKabupatenKota = $worksheet[1][1];
            $namaKecamatan = $worksheet[2][1];
            $namaKelurahan = $worksheet[3][1];
            $jumlahTps = (int) $worksheet[4][1];
            $jumlahDptLakiLaki = (int) $worksheet[5][1];
            $jumlahDptPerempuan = (int) $worksheet[6][1];
            $totalDpt = (int) $worksheet[7][1];

            $village = Regency::where('regencies.name', $namaKabupatenKota)
                ->join('districts', 'districts.regency_id', '=', 'regencies.id')
                ->where('districts.name', $namaKecamatan)
                ->join('villages', function ($join) use ($namaKelurahan) {
                    // $lastThreeLettersNamaKelurahan = substr($namaKelurahan, -3);
                    $join->on('villages.district_id', '=', 'districts.id')
                        ->where('villages.name', 'like', '%' . $namaKelurahan);
                })
                ->select('villages.*')
                ->first();
       
            $village = Village::where('id', (string) $village->id)->first();
            $village->update([
                'tps' => $jumlahTps,
                'dpt' => $totalDpt,
                'dpt_l' => $jumlahDptLakiLaki,
                'dpt_p' => $jumlahDptPerempuan,
            ]);

            $hasilUpload[] = $village->fresh();
        }

        return $hasilUpload;
    }


    public function insertJumlahTps(Request $request)
    {
        $hasilUpload = [];
        foreach ($request->file('excel_files') as $files) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $reader->setReadFilter(new filterTps());
            $spreadsheet = $reader->load($files);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet = $worksheet->toArray();

            $worksheetForGetLocation = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $worksheetForGetLocation->setReadFilter(new filterKelurahan());
            $spreadsheetForGetLocation = $worksheetForGetLocation->load($files);
            $worksheetForGetLocation = $spreadsheetForGetLocation->getActiveSheet();
            $worksheetForGetLocation = $worksheetForGetLocation->toArray();
            
            $namaKabupatenKota = $worksheetForGetLocation[1][1];
            $namaKecamatan = $worksheetForGetLocation[2][1];
            $namaKelurahan = $worksheetForGetLocation[3][1];
            $village = Regency::where('regencies.name', $namaKabupatenKota)
                ->join('districts', 'districts.regency_id', '=', 'regencies.id')
                ->where('districts.name', $namaKecamatan)
                ->join('villages', function ($join) use ($namaKelurahan) {
                    $lastThreeLettersNamaKelurahan = substr($namaKelurahan, -3);
                    $join->on('villages.district_id', '=', 'districts.id')
                        ->where('villages.name', 'like', '%' . $lastThreeLettersNamaKelurahan);
                })
                ->select('regencies.*', 'districts.*', 'villages.*')
                ->first();
            $filteredArray = $this->filterArrayTps($worksheet);
            $result = $this->countArrayValuesTps($filteredArray);
            
            foreach ($result as $namaTps => $jumlahTps) {
                $nomorTps = (string) intval(substr($namaTps, 3));
                $villageId = (string) $village->id;
                $provinceId = substr($villageId, 0, 2);
                $regencyId = substr($villageId, 0, 4);
                $districtId = substr($villageId, 0, 7);
                $isTpsExist = Tps::where('villages_id', $villageId)
                    ->where('number', $nomorTps)
                    ->exists();

                if ($isTpsExist) {
                    Tps::where('villages_id', $villageId)
                        ->where('number', $nomorTps)->update([
                            'dpt' => $jumlahTps
                        ]);
                    array_push($hasilUpload, "$villageId dengan tps nomor $nomorTps berhasil di update.");
                } else {
                    Tps::insert([
                        'created_at' => Carbon::now(),
                        'province_id' => $provinceId,
                        'regency_id' => $regencyId,
                        'district_id' => $districtId,
                        'villages_id' => $villageId,
                        'number' => $nomorTps,
                        'dpt' => $jumlahTps
                    ]);
                    array_push($hasilUpload, "$villageId dengan tps nomor $nomorTps berhasil di insert.");
                }
            }
        }

        return response()->json($hasilUpload);
    }

    /**
     * Fungsi untuk meng-filter array dari $worksheet->toArray()
     * @param array $worksheetAfterToArray
     *
     * @return array Contoh return
     * [
     *   "TPS 001",
     *   "TPS 001",
     *   "TPS 002",
     *   "TPS 002",
     *   "TPS 003",
     *   "TPS 003",
     *   "TPS 003",
     *   "TPS 004",
     *   "TPS 004"
     * ]
     */
    private function filterArrayTps($worksheetAfterToArray)
    {
        $filteredArray = array_map(function ($subarray) {
            return array_key_exists(4, $subarray) ? $subarray[4] : null;
        }, $worksheetAfterToArray);
        $filteredArray = array_filter($filteredArray, function ($value) {
            return $value !== null && $value != 'NAMA TPS';
        });
        $filteredArray = array_values($filteredArray);

        return $filteredArray;
    }

    /**
     * Fungsi untuk menghitung berapa kali nilai array muncul dari hasil fungsi filterArrayTps
     * @param array $filteredArray Return dari fungsi filterArrayTps
     *
     * @return array Contoh return
     * [
     *   "TPS 001" => 258,
     *   "TPS 002" => 267,
     *   "TPS 003" => 282,
     *   "TPS 004" => 287
     * ]
     */
    private function countArrayValuesTps($filteredArray)
    {
        $counts = array_count_values($filteredArray);
        $result = array();
        foreach ($counts as $key => $count) {
            $result[$key] = $count;
        }

        return $result;
    }
}
