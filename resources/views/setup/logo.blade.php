@extends('layouts.setup')

@section('content')
     <div class="row mt-5 text-white">
         <div class="col-lg-12">
            <form method="POST" enctype="multipart/form-data" id="upload-image" action="setup_logo_action" >
                 @csrf
                <div class="row justify-content-center">
                    <h1>Upload Siapkan Logo Kota/kabupaten wilayah pemilihan & Siapkan logo Bendera partai</h1>
                    
                    <div class="mt-3">
                        <label for="formFileLg" class="form-label">Logo Kota/Kabupaten</label>
                        <input class="form-control form-control-lg"  placeholder="Choose image" id="image" name="image" type="file">
                      </div>
                      <div class="mt-3 mb-4">
                        <label for="formFileLg" class="form-label">Logo Partai</label>
                        <input class="form-control form-control-lg"  placeholder="Choose image" id="image2" name="image2" type="file">
                      </div>

              
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row justify-content-end my-2">
                    <button type="submit" class="btn btn-outline-light">Lanjutkan</button>
                </div>
             </form>
         </div>
     </div>
@endsection