<div class="modal-header">
    <h5 class="modal-title">LAPORAN KEJADIAN TPS</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

</div>
<form action="action/proses_kecurangan/{{ Crypt::encrypt($tps['id']); }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <h6>
                    {{ $kecamatan['name'] }} - TPS {{$tps['number']}} </h6>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-justify">Admin Hukum dapat mengkoreksi / menghapus dan atau menambahkan item
                            kecurangan jika data kecurangan yang dikirimkan saksi kurang lengkap atau salah. Admin Hukum
                            juga dapat memberi keterangan yang relevan pada kolom BAP Admin Hukum atau abaikan jika
                            keterangan saksi dirasa cukup. </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <table class="table">
            <thead class="bg-danger text-light">
                <tr>
                    <th>Cek</th>
                    <th>Deskripsi Kecurangan Saksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_kecurangan as $item)
                <tr>
                    <td><input type="checkbox" name="bukti_text[]" checked="" value="{{ $item['text'] }}"></td>
                    <td>{{ $item['text'] }}</td>
                </tr>
                @endforeach
            </tbody>
            <thead>
                <input type="hidden" name="id_relawan">
                <tr>
                    <td class="bg-dark text-light"></td>
                    <th class="bg-dark text-light">
                        TAMBAHKAN JENIS PELANGGARAN UMUM (+)
                    </th>
                </tr>
                @foreach ($pelanggaran_umum as $item)
                <tr>
                    <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}">
                    </td>
                    <td><label>{{ $item['kecurangan'] }} </label></td>
                </tr>
                @endforeach
            </thead>
            <thead>
                <input type="hidden" name="id_relawan">
                <tr>
                    <td class="bg-dark text-light"></td>
                    <th class="bg-dark text-light">
                        TAMBAHKAN JENIS PELANGGARAN PETUGAS (+)
                    </th>
                </tr>
                @foreach ($pelanggaran_petugas as $item)
                <tr>
                    <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}">
                    </td>
                    <td><label>{{ $item['kecurangan'] }} </label></td>
                </tr>
                @endforeach
            </thead>
            <tbody>
                <tr class="bg-primary text-light">
                    <td></td>
                    <td>BAP Admin Hukum</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="kecurangan" placeholder="catatan hukum" class="form-control" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td class="bg-dark text-light"></td>
                    <th class="bg-dark text-light">
                        Bukti Kejadian TPS
                    </th>
                </tr>
                @if (count($bukti_foto) > 0)
                <tr>
                    <td>
                        <input type="checkbox" name="bukti[]" value="1" checked="">
                    </td>
                    <td>
                        <label for="bukti_foto">Bukti Foto</label>
                    </td>
                </tr>
                @else
                <tr>
                    <td>
                        <input type="checkbox" name="bukti[]" value="1">
                    </td>
                    <td>
                        <label for="bukti_foto">Bukti Foto</label>
                    </td>
                </tr>
                @endif
               
                <tr>
                    <td>
                        <input type="checkbox" name="bukti[]" value="2">
                    </td>
                    <td>
                        <label for="bukti_video">Bukti Video</label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Cetak atau Download Kecurangan</button>
        <button type="button" class="btn btn-danger">Tolak Kecurangan</button>
    </div>
</form>
