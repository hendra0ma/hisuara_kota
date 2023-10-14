@extends('layouts.mainlayout')

@section('content')

<div class="row">

    <div class="col-lg-12 col-md-12 mt-3">
    <div class="card">
    <div class="tab mt-5">
        <div class="row">
            <div class="col-md">
                <?php
                $count_suara = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                    ->join('users', 'users.tps_id', '=', 'tps.id')
                    // ->where('tps.villages_id', (string)$village->id)
                    ->where('saksi.verification', '')
                    ->whereNull('saksi.pending')
                    ->where('saksi.overlimit', 0)
                    ->count();
                $count_kecurangan = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                    ->join('users', 'users.tps_id', '=', 'tps.id')
                    ->where('saksi.kecurangan', 'yes')
                    ->where('saksi.status_kecurangan', 'belum terverifikasi')
                    ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
                    ->count();
                
                ?>
                <button class="btn tablink w-100 rounded-0 c1saksi" onclick="openPage('C1-Saksi', this, '#45aaf2 ')"
                    id="defaultOpen">C1 Saksi <span
                        class="badge rounded-pill bg-danger">{{ $count_suara }}</span></button>
            </div>
            <!-- <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1partai" onclick="openPage('C1-Partai', this, '#f7b731')">C1 Partai</button>
            </div> -->
            <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1relawan"
                    onclick="openPage('C1-Relawan', this, '#f82649')">C1 Relawan Partai</button>
            </div>
          
            <!-- <div class="col-md">
                <button class="btn tablink w-100 rounded-0 kecurangan" onclick="openPage('Kecurangan', this, '#09ad95')">Kecurangan <span class="badge rounded-pill bg-danger">{{ $count_kecurangan }}</span></button>
            </div> -->
        </div>
    </div>
</div>
<div class="card-body">
    <div id="C1-Saksi" class="tabcontent">
        <livewire:c1-saksi-kota />
    </div>
    <div id="C1-Relawan" class="tabcontent">
        <livewire:c1-relawan-kota />
    </div>
    
</div>

<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>



<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data C1 TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="periksaC1Relawan" tabindex="-1" aria-labelledby="periksaC1RelawanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1RelawanLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-relawan">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="periksaC1Pending" tabindex="-1" aria-labelledby="periksaC1PendingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1PendingLabel">Data C1 Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-c1-pending">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<script>
    const buttonperiksaC1Relawan = $("button.periksa-c1-relawan");
    //   const buttonkecurangan = $("button.periksa-c1-kecurangan");
    // const buttonC1Pending = $("button.periksa-c1-pending");
    const buttonperiksaC1 = $("button.periksa-c1-plano");
    buttonperiksaC1.on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: "{{ route('verifikator.getSaksiData') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id
            },
            type: "post",
            dataType: "html",
            success: function(data) {
                $('#container-view-modal').html(data)
            }
        });
    });
    buttonC1Pending.on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: "{{ route('verifikator.getSaksiPending') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id
            },
            type: "get",
            dataType: "html",
            success: function(data) {
                $('#container-view-modal-c1-pending').html(data)
            }
        });
    });

    // buttonperiksaC1Relawan.on('click', function() {
    //     const id = $(this).data('id');
    //     $.ajax({
    //         url: "{{ route('verifikator.getRelawanData') }}",
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             id
    //         },
    //         type: "post",
    //         dataType: "html",
    //         success: function(data) {
    //             $('#container-view-modal-relawan').html(data)
    //         }
    //     });
    // });

    //   buttonkecurangan.on('click', function() {
    //     const id = $(this).data('id');
    //     $.ajax({
    //       url: "{{ route('verifikator.getKecuranganSaksi') }}",
    //       data: {
    //         id
    //       },
    //       type: "get",
    //       dataType: "html",
    //       success: function(data) {
    //         $('#container-view-modal-kecurangan').html(data)
    //       }
    //     });
    //   })
</script>

    </div>

</div>

@endsection