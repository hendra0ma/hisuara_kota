<?php
use App\Models\Paslon;
?>
<div class="modal-header ">
    <h5 class="modal-title">KELURAHAN {{$kelurahan['name']}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <thead class="bg-dark text-light">
            <tr>
                <th class="text-light" rowspan="2">no</th>
                <th class="text-light" rowspan="2">TPS</th>
                <th class="text-light" colspan="4">Suara Masuk</th>
            </tr>
            <tr class="bg-dark text-light">
                @foreach ($candidate as $item)
                <td>{{ $item['candidate']}}</td>
                @endforeach


            </tr>
        </thead>

        <tbody>
            @foreach ($tps as $item)
            <?php
            $id = $item['id'];
             $paslon = Paslon::with(['saksi_data' => function ($query) use ($id) {
                $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')->where('saksi.tps_id', $id);
            }])->get();
            $voice = 0;
            ?>

            <tr>
                <td>{{$item['id']}}</td>
                <td>
                    TPS {{$item['number']}}
                </td>
                @foreach ($paslon  as $pas)
                @foreach ($pas->saksi_data as $dataTps)
                <?php
                            $voice += $dataTps->voice;
                            ?>
                @endforeach
                <td>{{ $voice }}</td>
                @endforeach

            </tr>
        @endforeach

        </tbody>
    </table>

</div>
