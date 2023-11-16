@if ($koorId->id == 1)
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
        <?php
        $provinsi = App\Models\Province::get();
        ?>
        <option disabled selected>Pilih Provinsi</option>
        @foreach ($provinsi as $kc)
        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kota_koor" id="kota_koor">
        <option disabled selected>Pilih Kota</option>
    </select>
</div>
@elseif ($koorId->id == 2)
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
        <?php
        $provinsi = App\Models\Province::get();
        ?>
        <option disabled selected>Pilih Provinsi</option>
        @foreach ($provinsi as $kc)
        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kota_koor" id="kota_koor">
        <option disabled selected>Pilih Kota</option>
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kecamatan_koor" id="kecamatan_koor">
        <option disabled selected>Pilih Kecamatan</option>
    </select>
</div>
@elseif ($koorId->id == 3)
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
        <?php
        $provinsi = App\Models\Province::get();
        ?>
        <option disabled selected>Pilih Provinsi</option>
        @foreach ($provinsi as $kc)
        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kota_koor" id="kota_koor">
        <option disabled selected>Pilih Kota</option>
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kecamatan_koor" id="kecamatan_koor">
        <option disabled selected>Pilih Kecamatan</option>
    </select>
</div>

<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kelurahan_koor" id="kelurahan_koor">
        <option disabled selected>Pilih Kelurahan</option>
    </select>
</div>
@elseif ($koorId->id == 4)
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
        <?php
        $provinsi = App\Models\Province::get();
        ?>
        <option disabled selected>Pilih Provinsi</option>
        @foreach ($provinsi as $kc)
        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kota_koor" id="kota_koor">
        <option disabled selected>Pilih Kota</option>
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kecamatan_koor" id="kecamatan_koor">
        <option disabled selected>Pilih Kecamatan</option>
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kelurahan_koor" id="kelurahan_koor">
        <option disabled selected>Pilih Kelurahan</option>
    </select>
</div>
<div class="wrap-input100 validate-input" data-bs-validate="RW is required">
    <input class="input100" type="number" name="rw_koor"id="rw_koor" placeholder="Masukkan Nomor RW anda">
    <span class="focus-input100"></span>
    <span class="symbol-input100">
        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
    </span>
</div>
<div class="wrap-input100 validate-input" data-bs-validate="RT is required">
    <input class="input100" type="number" name="rt_koor"id="rt_koor" placeholder="Masukkan Nomor RT anda">
    <span class="focus-input100"></span>
    <span class="symbol-input100">
        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
    </span>
</div>
@elseif ($koorId->id == 4)
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
        <?php
        $provinsi = App\Models\Province::get();
        ?>
        <option disabled selected>Pilih Provinsi</option>
        @foreach ($provinsi as $kc)
        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kota_koor" id="kota_koor">
        <option disabled selected>Pilih Kota</option>
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kecamatan_koor" id="kecamatan_koor">
        <option disabled selected>Pilih Kecamatan</option>
    </select>
</div>
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="kelurahan_koor" id="kelurahan_koor">
        <option disabled selected>Pilih Kelurahan</option>
    </select>
</div>
@endif







@foreach ($koordinator as $koor)
<div class="form-group">
    <select class="form-control select2-show-search form-select" name="tipe{{$koor->id}}" id="koor{{$koor->id}}">
        <option disabled selected>Pilih {{$koor->name}}</option>
    </select>
</div>
@endforeach