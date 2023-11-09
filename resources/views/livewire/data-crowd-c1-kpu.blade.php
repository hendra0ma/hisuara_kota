<div class="d-flex flex-wrap" style="gap: 5px;">

    <div class="col-12 mb-3 px-0">
        <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
    </div>

    <style>
        .dalem-flex {
            width: 24.7625%;
        }
    </style>
    @foreach($all_c1 as $c1)

    <img class="dalem-flex mb-2" src="{{asset('')}}storage/c1_plano/{{$c1->crowd_c1}}" >


    @endforeach


    <div class="my-3">
        {{$all_c1->links()}}
    </div>
</div>