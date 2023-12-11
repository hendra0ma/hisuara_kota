<div class="d-flex flex-wrap" style="gap: 5px;">

    <div class="col-12 mb-3 px-0">
        <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
    </div>

    <style>
        .dalem-flex {
            width: 24.7625%;
        }
    </style>

    <div class="row">
        @foreach($all_c1 as $c1)
        <div class="col-3 px-2 my-2">
            <a type="button" class="moda-cek-1" data-bs-toggle="modal" data-bs-target="#modaCek1" data-id="{{Crypt::encrypt($c1->tps_id)}}">
                <img class="dalem-flex" style="height: 600px; width: 450px; object-fit: cover" src="{{asset('')}}storage/c1-plano/{{$c1->c1_images}}" alt="">
            </a>
        </div>
        @endforeach
    </div>

    <div class="my-3">
        {{$all_c1->links()}}
    </div>
    <script>
        $(document).ready(function () {
            $('#modaCek1').modal();
        });
    </script>
</div>
