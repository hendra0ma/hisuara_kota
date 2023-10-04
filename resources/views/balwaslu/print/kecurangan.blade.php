TPS {{ $tps['number'] }}

No berkas {{ $qrcode['nomor_berkas'] }}

{!! QrCode::size(250)->generate($qrcode['nomor_berkas']); !!}
{{$kota['name']}} <br>
Kecamatan {{$kecamatan['name']}}
Kelurahan {{$kelurahan['name']}}
<br>
<br>
Data saksi
<br>
{{$user['name']}}
{{$user['no_hp']}}
{{$kecamatan['name']}}
<br>
Data Verifikatr<br> 
{{ $verifikator['name'] }}
{{ $verifikator['no_hp']}} 
{{ $qrcode['created_at'] }}
<br>
Data admin hukum
<br>
{{ $hukum['name'] }}
{{ $hukum['no_hp'] }}
{{ date("d - M - Y") }}
<br>
Daftar Kecurangan
<br>
@foreach ($list_kecurangan as $item)
    {{ $item['text'] }} <br>
@endforeach

Bukti <br>
@if ($databukti['bukti'] == "1")
    V bukti <br>
    X bukti Vidio <br>
    Bukti Foto <br>
    @foreach ($foto_kecurangan as $foto)
    <img class="d-block w-100" alt=""
    src="{{asset('storage\hukum\bukti_foto')}}\{{ $foto['url'] }}"
    data-bs-holder-rendered="true">
    @endforeach
    @elseif($databukti['bukti'] == "2")
    X bukti <br>
    V bukti Vidio <br>
    @else
    V bukti <br>
    V bukti Vidio <br>

    <br>
    Bukti Foto <br>
    @foreach ($foto_kecurangan as $foto)
    <img class="d-block w-100" alt=""
    src="{{asset('storage\hukum\bukti_foto')}}\{{ $foto['url'] }}"
    data-bs-holder-rendered="true">
    @endforeach
    <br>
    Bukti Vidio <br>
    {{asset('storage\hukum\bukti_video/'.$vidio_kecurangan['url'])}}
@endif


<div class="page-content-wrapper" style="width:100%;height:100%;page-break-before: auto;page-break-after: auto;page-break-inside: avoid;">
    <div class="row mt-2">
      <div class="container">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <h3 class="text-center"><u>SURAT PERNYATAAN</u></h3>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-12">

                </div>
              </div>
              <div class="row mt-1">
                <div class="col-lg-12">
                  <div class="col-lg-6">
                    <h6>Yang bertanda tangan dibawah ini :</h6>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">

                  <div class="col-lg-12 mb-2">
                    <table>
                                              <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>{{$user['nik']}}</td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$user['name']}}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$user['address']}}</td>
                      </tr>
                      <tr>
                        <td>No Hp</td>
                        <td>:</td>
                        <td>{{$user['no_hp']}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$user['email']}}</td>
                      </tr>
                      <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>{{ $kecamatan['name'] }}</td>
                      </tr>
                      <tr>
                        <td>Kelurahan</td>
                        <td>:</td>
                        <td>{{ $kelurahan['name'] }}</td>
                      </tr>
                      <tr>
                        <td>TPS</td>
                        <td>:</td>
                        <td>{{ $tps['number'] }}</td>
                      </tr>
                      <tr>
                        <td>Kota</td>
                        <td>:</td>

                        <td class="text-capitalize">{{ $kota['name'] }}</td>

                      </tr>
                    </table>

                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="col-lg-12 text-justify" style="line-height:1.8">
                    <p>
                      Dengan ini menyatakan bahwa saya siap bertanggung jawab atas data dan bukti-bukti yang saya kirimkan dari TPS tempat saya bertugas dan bisa dipertanggung jawabkan kebenaranya.
                    </p>
                    <p>
                      Saya bersedia hadir untuk memberikan keterangan sebagai saksi pada pihak-pihak terkait jika diperlukan. Demikian pernyataan ini dibuat dalam keadaan sadar sehat jasmani raohani serta tidak ada paksaan dari pihak manapun.
                    </p>
                  </div>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-lg-12">
                  <div class="col-lg-12">
                    <b>Tanggal Kirim </b>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-11">
                  <div class="col-lg-12 text-left">
                    <p>Yang Membuat Pernyataan Ini:</p>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-11">
                  <div class="col-lg-12 text-left">
                    <p class="mt-5"><u> {{$user['name']}}</u></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <p class="mb-3 text-center mt-2">
            <i>Laporan Ini Dicetak Oleh Komputer Dan Tidak Memerlukan Tanda Tangan.
              Berkas Terlampir</i>
          </p>
        </div>
      </div>
    </div>
  </div>