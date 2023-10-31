<div style="overflow:auto">
    <div class="row justify-content-center">
        <div class="col-lg-5" style="height:100vh">
            <div class="card border-0">

                <div class="card-header bg-primary text-light text-center fw-bold">
                Surat Suara
                </div>
                
                <form action="{{route('logout')}}" method="post" class="py-2 pe-2 ps-3">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        Sign out
                    </button>
                </form>
                <div class="card-body">

                    <h1 class="text-center">
                        <img src="{{asset('')}}images/logo/hisuara.png" class="hadow-4 mb-3 mt-3 bg-dark rounded-2" style="width: 150px;" alt="Avatar" />
                    </h1>
                    <h4> Halo, {{Auth::user()->name}}</h4>
                    <form action="{{route('actionSuratSuara')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(session()->has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul>
                                @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="row no-gutters">
                            <div class="col-lg-12">
                                <label for="total_surat_suara">Total Surat Suara</label>
                                <input type="number" class="form-control" id="total_surat_suara" value="{{old('total_surat_suara')}}" name="total_surat_suara" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="surat_suara_tidak_sah">Surat Suara Tidak Sah</label>
                                <input type="number" class="form-control" id="surat_suara_tidak_sah" value="{{old('surat_suara_tidak_sah')}}" name="surat_suara_tidak_sah" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="surat_suara_terpakai">Surat Suara Terpakai</label>

                                <input type="number" class="form-control" id="surat_suara_terpakai" value="{{old('surat_suara_terpakai')}}" name="surat_suara_terpakai" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="sisa_surat_suara">Sisa Surat Suara</label>

                                <input type="number" class="form-control" id="sisa_surat_suara" value="{{old('sisa_surat_suara')}}" name="sisa_surat_suara" required>
                            </div>
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <h4 class="card-title">Foto Surat Suara</h4>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <h1>
                                                    <label for="Surat Suara" type="button">
                                                        <i class="mdi mdi-camera"></i>
                                                    </label>
                                                </h1>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="file" name="surat_suara[]" multiple required id="Surat Suara">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-block btn-primary mt-2" value="Kirim" id="send">
                            </div>



                        </div>

                </div>
            </div>
        </div>
    </div>
</div>