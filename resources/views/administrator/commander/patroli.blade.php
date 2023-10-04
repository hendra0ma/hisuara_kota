@extends('layouts.main-patroli-mode ')
@section('content')
<style>
    .layers {
  position: relative;
}

.layers::before,
.layers::after {
  content: attr(data-text);
  position: absolute;
  width: 110%;
  z-index: -1;
}

.layers::before {
  top: 10px;
  left: 15px;
  color: #e0287d;
}

.layers::after {
  top: 5px;
  left: -10px;
  color: #1bc7fb;
}

.single-path {
  clip-path: polygon(
    0% 12%,
    53% 12%,
    53% 26%,
    25% 26%,
    25% 86%,
    31% 86%,
    31% 0%,
    53% 0%,
    53% 84%,
    92% 84%,
    92% 82%,
    70% 82%,
    70% 29%,
    78% 29%,
    78% 65%,
    69% 65%,
    69% 66%,
    77% 66%,
    77% 45%,
    85% 45%,
    85% 26%,
    97% 26%,
    97% 28%,
    84% 28%,
    84% 34%,
    54% 34%,
    54% 89%,
    30% 89%,
    30% 58%,
    83% 58%,
    83% 5%,
    68% 5%,
    68% 36%,
    62% 36%,
    62% 1%,
    12% 1%,
    12% 34%,
    60% 34%,
    60% 57%,
    98% 57%,
    98% 83%,
    1% 83%,
    1% 53%,
    91% 53%,
    91% 84%,
    8% 84%,
    8% 83%,
    4% 83%
  );
}

.paths {
  animation: paths 5s step-end infinite;
}

@keyframes paths {
  0% {
    clip-path: polygon(
      0% 43%,
      83% 43%,
      83% 22%,
      23% 22%,
      23% 24%,
      91% 24%,
      91% 26%,
      18% 26%,
      18% 83%,
      29% 83%,
      29% 17%,
      41% 17%,
      41% 39%,
      18% 39%,
      18% 82%,
      54% 82%,
      54% 88%,
      19% 88%,
      19% 4%,
      39% 4%,
      39% 14%,
      76% 14%,
      76% 52%,
      23% 52%,
      23% 35%,
      19% 35%,
      19% 8%,
      36% 8%,
      36% 31%,
      73% 31%,
      73% 16%,
      1% 16%,
      1% 56%,
      50% 56%,
      50% 8%
    );
  }

  5% {
    clip-path: polygon(
      0% 29%,
      44% 29%,
      44% 83%,
      94% 83%,
      94% 56%,
      11% 56%,
      11% 64%,
      94% 64%,
      94% 70%,
      88% 70%,
      88% 32%,
      18% 32%,
      18% 96%,
      10% 96%,
      10% 62%,
      9% 62%,
      9% 84%,
      68% 84%,
      68% 50%,
      52% 50%,
      52% 55%,
      35% 55%,
      35% 87%,
      25% 87%,
      25% 39%,
      15% 39%,
      15% 88%,
      52% 88%
    );
  }

  30% {
    clip-path: polygon(
      0% 53%,
      93% 53%,
      93% 62%,
      68% 62%,
      68% 37%,
      97% 37%,
      97% 89%,
      13% 89%,
      13% 45%,
      51% 45%,
      51% 88%,
      17% 88%,
      17% 54%,
      81% 54%,
      81% 75%,
      79% 75%,
      79% 76%,
      38% 76%,
      38% 28%,
      61% 28%,
      61% 12%,
      55% 12%,
      55% 62%,
      68% 62%,
      68% 51%,
      0% 51%,
      0% 92%,
      63% 92%,
      63% 4%,
      65% 4%
    );
  }

  45% {
    clip-path: polygon(
      0% 33%,
      2% 33%,
      2% 69%,
      58% 69%,
      58% 94%,
      55% 94%,
      55% 25%,
      33% 25%,
      33% 85%,
      16% 85%,
      16% 19%,
      5% 19%,
      5% 20%,
      79% 20%,
      79% 96%,
      93% 96%,
      93% 50%,
      5% 50%,
      5% 74%,
      55% 74%,
      55% 57%,
      96% 57%,
      96% 59%,
      87% 59%,
      87% 65%,
      82% 65%,
      82% 39%,
      63% 39%,
      63% 92%,
      4% 92%,
      4% 36%,
      24% 36%,
      24% 70%,
      1% 70%,
      1% 43%,
      15% 43%,
      15% 28%,
      23% 28%,
      23% 71%,
      90% 71%,
      90% 86%,
      97% 86%,
      97% 1%,
      60% 1%,
      60% 67%,
      71% 67%,
      71% 91%,
      17% 91%,
      17% 14%,
      39% 14%,
      39% 30%,
      58% 30%,
      58% 11%,
      52% 11%,
      52% 83%,
      68% 83%
    );
  }

  76% {
    clip-path: polygon(
      0% 26%,
      15% 26%,
      15% 73%,
      72% 73%,
      72% 70%,
      77% 70%,
      77% 75%,
      8% 75%,
      8% 42%,
      4% 42%,
      4% 61%,
      17% 61%,
      17% 12%,
      26% 12%,
      26% 63%,
      73% 63%,
      73% 43%,
      90% 43%,
      90% 67%,
      50% 67%,
      50% 41%,
      42% 41%,
      42% 46%,
      50% 46%,
      50% 84%,
      96% 84%,
      96% 78%,
      49% 78%,
      49% 25%,
      63% 25%,
      63% 14%
    );
  }

  90% {
    clip-path: polygon(
      0% 41%,
      13% 41%,
      13% 6%,
      87% 6%,
      87% 93%,
      10% 93%,
      10% 13%,
      89% 13%,
      89% 6%,
      3% 6%,
      3% 8%,
      16% 8%,
      16% 79%,
      0% 79%,
      0% 99%,
      92% 99%,
      92% 90%,
      5% 90%,
      5% 60%,
      0% 60%,
      0% 48%,
      89% 48%,
      89% 13%,
      80% 13%,
      80% 43%,
      95% 43%,
      95% 19%,
      80% 19%,
      80% 85%,
      38% 85%,
      38% 62%
    );
  }

  1%,
  7%,
  33%,
  47%,
  78%,
  93% {
    clip-path: none;
  }
}

.movement {
  /* Normally this position would be absolute & on the layers, set to relative here so we can see it on the div */
  position: relative;
  animation: movement 8s step-end infinite;
}

@keyframes movement {
  0% {
    top: 0px;
    left: -20px;
  }

  15% {
    top: 10px;
    left: 10px;
  }

  60% {
    top: 5px;
    left: -10px;
  }

  75% {
    top: -5px;
    left: 20px;
  }

  100% {
    top: 10px;
    left: 5px;
  }
}

.opacity {
  animation: opacity 5s step-end infinite;
}

@keyframes opacity {
  0% {
    opacity: 0.1;
  }

  5% {
    opacity: 0.7;
  }

  30% {
    opacity: 0.4;
  }

  45% {
    opacity: 0.6;
  }

  76% {
    opacity: 0.4;
  }

  90% {
    opacity: 0.8;
  }

  1%,
  7%,
  33%,
  47%,
  78%,
  93% {
    opacity: 0;
  }
}

.font {
  animation: font 7s step-end infinite;
}

@keyframes font {
  0% {
    font-weight: 100;
    color: #e0287d;
    filter: blur(3px);
  }

  20% {
    font-weight: 500;
    color: #fff;
    filter: blur(0);
  }

  50% {
    font-weight: 300;
    color: #1bc7fb;
    filter: blur(2px);
  }

  60% {
    font-weight: 700;
    color: #fff;
    filter: blur(0);
  }

  90% {
    font-weight: 500;
    color: #e0287d;
    filter: blur(6px);
  }
}

.glitch span {
  animation: paths 5s step-end infinite;
}

.glitch::before {
  animation: paths 5s step-end infinite, opacity 5s step-end infinite,
    font 8s step-end infinite, movement 10s step-end infinite;
}

.glitch::after {
  animation: paths 5s step-end infinite, opacity 5s step-end infinite,
    font 7s step-end infinite, movement 8s step-end infinite;
}
.hero {
    font-size: 30px
    display: inline-block;
    color: #61AC27;
    z-index: 2;
    letter-spacing: 5px;
    
    /* Bright things in dark environments usually cast that light, giving off a glow */
    filter: drop-shadow(0 1px 3px);
}
</style>
<div class="row align-items-center" style="margin: 1.5rem 0rem 1.5rem;">
    <div class="col-4">
        <h1 class="page-title" class="glitch" data-text="glitch">Patroli Mode</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Patroli Mode</li>
        </ol>
    </div>
    <div class="col-4 text-center">
        <h1 class="hero glitch layers mb-0" data-text="Tracking"><span>Tracking</span></h1>
    </div>
    <div class="col-4"></div>
</div>

<div class="card mg-b-20">
    <div class="card-header">
        <div class="card-title text-uppercase">admin demography tracking  (ADT)</div>
    </div>
    <div class="card-body">
        <div class="ht-300" id="mapid" style="height:500px"></div>
    </div>
</div>


<div class="card">
    <div class="card-header text-uppercase">
        admin activity tracking (AAT)
    </div>
    <div class="card-body">
        <p class="card-text">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom w-100" id="basic-datatable">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">NIK</th>
                            <th class="border-bottom-0">Nama</th>
                            <th class="border-bottom-0">Email</th>
                            <th class="border-bottom-0">No. Hp</th>
                            <th class="border-bottom-0">Role</th>
                            <th class="border-bottom-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $tim)
                        <tr>
                            <td>{{$tim['nik']}}</td>
                            <td>{{$tim['name']}}  @if(Cache::has('is_online' . $tim['id']))
                                <span class="badge bg-success  me-1 mb-1 mt-1">Online</span>
                                @else
                                <span class="badge bg-danger  me-1 mb-1 mt-1">Offline</span>
                                @endif
                                @if ($tim['id'] == Auth::user()->id)
                                    (You)
                                @endif
                            </td>
                            <td>{{$tim['email']}}</td>
                            <td>{{$tim['no_hp']}}</td>
                            <td>
                                @if($tim['role_id'] == 1)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Administrator</span>
                                @elseif($tim['role_id'] == 2)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Verifikator</span>
                                @elseif($tim['role_id'] == 3)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Auditor</span>
                                @elseif($tim['role_id'] == 5)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Checking</span>
                                @elseif($tim['role_id'] == 6)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Hunter</span>
                                @elseif($tim['role_id'] == 7)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Hukum</span>
                                @elseif($tim['role_id'] == 8)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Saksi</span>
                                @elseif($tim['role_id'] == 9)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Rekapitulator</span>
                                @elseif($tim['role_id'] == 10)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Validator Hukum</span>
                                @elseif($tim['role_id'] == 11)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Balwaslu</span>
                                @elseif($tim['role_id'] == 12)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Payrole</span>
                                @elseif($tim['role_id'] == 14)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Relawan</span>
                                @elseif($tim['role_id'] == 20)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Huver</span>
                                @elseif($tim['role_id'] == 0)
                                <span class="badge bg-success  me-1 mb-1 mt-1">Terblokir</span>
                                @else
                                {{$tim['role_id']}}
                                @endif
                            </td>
                            <td>
                                <a href="cekmodalhistory" class="btn btn-primary cekmodalhistory" style="font-size: 0.8em;" id="Cek" data-id="{{$tim['id']}}"
                                data-bs-toggle="modal" id="" data-bs-target="#cekmodalhistory">Cek</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Kecamatan</h5>
    </div>
    <div class="card-body">
        <p class="card-text">
            @foreach ($district as $item)
            <a href="kecamatanModal" class="btn btn-lg btn-outline-success rounded-0 mt-2 kecamatanModal" data-bs-toggle="modal" data-bs-target="#kecamatanModal" data-id="{{$item['id']}}"
            data-bs-toggle="modal" id="" data-bs-target="#kecamatanModal">Kecamatan {{$item['name']}}</a>
            @endforeach
        </p>
    </div>
</div>

<div class="modal fade" id="cekmodalhistory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Tracking Activity</div>
            </div>
            <div class="container">
                <div id="container-history"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kecamatanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="container-kecamatan-tracking">
        </div>
    </div>
</div>

@endsection
