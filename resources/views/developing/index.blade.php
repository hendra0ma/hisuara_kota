

{{$dev['name']}}
{{$dev['email']}}

Kelurahan {{$kelurahan['name']}}
<table border="1px solid">
    <tr>
        <td>Tp 1</td>
        <td>Tp 2</td>
    </tr>
    <tr>
        <td>3674040</td>
        <td>{{$dev['districts']}}</td>
    </tr>
    <tr>
        <td>{{$kelurahan['id']}}</td>
        <td>{{$dev['villages']}}</td>
    </tr>
</table>

<marquee behavior="" direction=""><h1 style="color: red">LEK ANGKA TP 1 & TP 2  NDUKUR GA PODO HUBUNGI ADIT GANTENG</h1></marquee>


<h2>
    TPS {{$dev['number']}}
</h2>

<div style="border: 3px solid">
    <form action="action_saksi" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tps" value="{{$dev['number']}}" id="">
        <input type="hidden" name="email" value="{{$dev['email']}}" id="">
        @foreach ($paslon as $item)
        Suara 0{{$item['id']}} - {{ $item['candidate']}}
        <input type="number" class="form-control" id="suara[]" name="suara[]" required placeholder="Suara Paslon">
        <br>
        <br>
        @endforeach
        <input type="file" name="c1_plano" required id="c1_plano">
      <button type="submit">Send</button>
    </form>
</div>
