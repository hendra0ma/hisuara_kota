@extends('layouts.setup')

@section('content')
<div class="container">
    <div class="row mt-5 text-white">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <h1>Pilih Provinsi & Kota Sesuai Wilayah Pemilihan Anda</h1>
                <div class="container">
              

                    <form action="setup_logo" method="post">
                        @csrf
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <img src="assets/images/inddonesia.png" alt="" class="img-fluid">
                            </div>

                            <div class="col-lg-6 mt-3">
                                <select class="form-select form-select-lg mb-3" name="province" id="province"
                                    aria-label=".form-select-lg example">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($province as $kc)
                                    <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('province'))
                                <span class="text-danger">{{ $errors->first('province') }}</span>
                                @endif

                            </div>
                            <div class="col-lg-6 mt-3">
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                    name="regency" id="regency">
                                    <option value="">Pilih Kota</option>
                                </select>
                                @if ($errors->has('regency'))
                                <span class="text-danger">{{ $errors->first('regency') }}</span>
                                @endif

                            </div>
                        </div>
                        <div class="row justify-content-end my-2">
                            <button type="submit" class="btn btn-outline-light">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#province').on('change', function () {
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    url: '/getCourse/' + categoryID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#regency').empty();
                            $('#regency').append(
                                '<option valie="">Pilih Kota</option>');
                            $.each(data, function (key, course) {
                                $('select[name="regency"]').append(
                                    '<option value="' + course.id + '">' +
                                    course.name + '</option>');
                            });
                        } else {
                            $('#regency').empty();
                        }
                    }
                });
            } else {
                $('#regency').empty();
            }
        });
    });

</script>
@endsection
