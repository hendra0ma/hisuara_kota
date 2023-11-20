<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
        Jumlah Saksi : {{count($surat_suaras)}}
    </h4>
    <hr style="border: 1px solid">
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark"
                placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($surat_suaras as $surat_suara)
        <div class="col-3">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="mb-0 mx-auto text-white card-title text-center">Data Pemlih Dan Penggunaan Hak Pilih <br>
                        (TPS 1 / Kelurahan CIPUTAT)</h4>
                </div>
                <div class="card-body p-0">
                <table class="table table-striped">
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Jumlah Hak Pilih (DPT)</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->dpt:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Surat Suara Sah</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->surat_suara_sah:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Suara Tidak Sah</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->surat_suara_tidak_sah:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Jumlah Suara Sah dan Suara Tidak Sah</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->jumlah_sah_dan_tidak:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Total Surat Suara</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->total_surat_suara:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Sisa Surat Suara</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->sisa_surat_suara:"0"}}</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        @endforeach
       
    </div>
</div>
