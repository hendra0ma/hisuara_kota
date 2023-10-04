@extends('layouts.main-bantuan')
@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Lapor Masalah
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lapor Masalah
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporkan Masalah</h5>
            </div>
            <div class="card-body">
                <b style="font-size: 12px;">* Silakan isi formulir ini sepenuhnya sehingga kami dapat memahami masalah
                    dengan lebih baik ketika kami menghubungi untuk membantu sebuah solusi.</b>
                <form class="mt-5" method="get" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control rounded-1" name="email" id="email"
                            aria-describedby="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label">No Telepon</label>
                        <input type="number" class="form-control rounded-1" name="no_telpon" id="no_telpon"
                            aria-describedby="no_telpon" placeholder="No Telepon">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control rounded-1" name="nama" id="nama" aria-describedby="nama"
                            placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="tipe_dukungan">Tipe Dukungan</label>
                        <select id="tipe_dukungan" class="form-control" name="tipe_dukungan">
                            <option disabled selected>Pilih</option>
                            <option>Langgaran</option>
                            <option>Fitur</option>
                            <option>Laporkan Masalah</option>
                            <option>Komentar/Saran</option>
                            <option>Perlindungan Data</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subyek" class="form-label">Subyek</label>
                        <input type="text" class="form-control rounded-1" name="subyek" id="subyek"
                            aria-describedby="subyek" placeholder="Subyek">
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan Anda</label>
                        <textarea class="form-control" name="pesan" id="pesan" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Tambahkan File</label>
                        <div class="dropify-wrapper">
                            <div class="dropify-message"><span class="file-icon">
                                    <p>Drag and drop a file here or click</p>
                                </span>
                                <p class="dropify-error">Ooops, something wrong appended.</p>
                            </div>
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div><input type="file" class="dropify" data-bs-height="180"><button type="button"
                                class="dropify-clear">Remove</button>
                            <div class="dropify-preview"><span class="dropify-render"></span>
                                <div class="dropify-infos">
                                    <div class="dropify-infos-inner">
                                        <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                        <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
