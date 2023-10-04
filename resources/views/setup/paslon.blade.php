@extends('layouts.setup')

@section('content')
<div class="row mt-5 text-white">
    <div class="col-lg-12">
        <form method="POST" enctype="multipart/form-data" id="upload-image" action="setup_logo_action">
            @csrf
            <div class="row justify-content-center">
                <h1>Siapkan foto semua paslon yang bertarung dan nama-namanya</h1>
                <div class="col-lg-12 my-5">
                    <div class="row justify-content-end">
                        <div class="col-lg-2">
                            @if ($count == 4)
                                @else
                                <button type="button" class="btn btn-outline-light justify-content-end"
                                data-bs-toggle="modal" data-bs-target="#modalPaslon">Tambah Pasangan calon</button>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row text-dark">
                        @foreach ($candidate as $cd)
                        <div class="col-lg-12">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{asset('storage/'. $cd['picture'])}}" class="img-fluid rounded-start"
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $cd['candidate'] }} </h5>
                                            <p class="card-title"> {{ $cd['deputy_candidate'] }} </p>
                                            <span>Paslon 0{{$cd['id']}} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row justify-content-end my-2">
                <a href="setup_dpt" class="btn btn-outline-light">Lanjutkan</a>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalPaslon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-pri text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Paslon @if ($count == 0)
                    01
                    @elseif ($count == 1)
                    02
                    @elseif ($count == 3)
                    04
                  
                    @endif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="setup_paslon_action" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @error('img_candidate')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Kandidat</label>
                        <input type="text" class="form-control" required name="candidate" id="exampleFormControlInput1"
                            placeholder="Hj. Moch xxxxxx">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Nama Wakil Kandidat</label>
                        <input type="text" class="form-control" required name="d_candidate"
                            id="exampleFormControlInput2" placeholder="Saif xxxxxxxx">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Kandidat dan wakil kandidat</label>
                        <input class="form-control" type="file" required name="img_candidate" id="formFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
