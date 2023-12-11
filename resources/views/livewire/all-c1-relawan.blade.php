<div class="row">
    @foreach($all_c1 as $c1)
    <div class="col-md-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <img src="{{asset('')}}storage/c1_plano/{{$c1->c1_images}}" alt=""class="img-fluid">
            </div>
        </div>
    </div>
    @endforeach
    {{$all_c1->links()}}
</div>
