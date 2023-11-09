</div>
</div>
<!-- CONTAINER END -->
</div>

<style>
    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        width: 400px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width textarea */
    .form-container textarea {
        width: 500px;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        resize: none;
        min-height: 200px;
    }

    /* When the textarea gets focus, do something */
    .form-container textarea:focus {
        background-color: #ddd;
        outline: none;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-labelledby="chatMessage" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chat Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="message-menu" style="overflow-y:scroll;height:500px">
                        <?php

 $allUser = App\Models\User::where('id',"!=",Auth::user()->id)->where('role_id','!=',8)->where('role_id','!=',0)->where('role_id','!=',14)->get(); ?>
                        @foreach($allUser as $usr)
                        <button class="btn btn-primary rounded-0 w-100 mb-2" data-bs-dismiss="modal" type="button"
                            onclick="openForm('{{$usr->id}}')">{{$usr->name}}</button>
                        @endforeach
                    </div>
                </div>
             </div>
               
        </div>
    </div>
</div>

<div class="chat-popup" style="z-index: 1070;" id="myForm">
    <div class="form-container text-center">
        <h1 class="mb-0 mt-2 mb-2"><img src="{{url('/')}}/images/logo/rekapitung_gold.png" style="width:75px;height:auto"></h1>
        <h5 class="fw-bold">Live Chat Support Sistem</h5>

        <div class="main-content-app pt-0">
            <div class="main-content-body main-content-body-chat">
                <hr>
                <livewire:chat-person />

                <livewire:chat-input-person />
                <button onclick="closeForm()" class="btn btn-danger">TUTUP</button>
            </div>
        </div>
    </div>
</div>




<script>
    var chat = document.getElementById('chat');

    chat.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });

</script>

<!-- FOOTER -->
<footer class="footer mt-auto">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © 2024 <a href="#">Hisuara Smart Count</a>. Designed with <span
                    class="fa fa-heart text-danger"></span>
                by <a href="https://yudicp.com"> Yudi C Prawira </a> All rights reserved
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
