@extends('layouts.mainlayoutPayrole')
@section('content')

<div class="contaiener-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>no</th>
                            <th>nama</th>
                            <th>number</th>
                            <th>bank</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;  ?>
                        @foreach ($rekening as $item)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['number']}}</td>
                            <td>{{$item['bank']}}</td>
                            <td>{{$item['status']}}</td>
                            <td>
                                <a href="{{route('payrole.updateToDiproses',Crypt::encrypt($item->id_rek))}}" class="btn btn-dark"> <i class="fa fa-money-bill"></i> Bayar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            {{$rekening->links()}}
        </div>
    </div>
</div>

@endsection