<div>
    <form action="#" wire:submit.prevent="store">
        <div class="row justify-content-center no-gutters">
            <div class="col-8 mt-2 mb-2">
                <input wire:model="pesan" type="text" style="border: 1px solid black; border-top-right-radius: 0px; border-bottom-right-radius: 0px;" class="form-control">
            </div>
            <div class="col-4 mt-2 mb-2">
                <button type="submit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" class="btn btn-success w-100 h-100"><i class="fa fa-paper-plane-o"></i>&nbsp;send</button>
            </div>
        </div>
    </form>
</div>

<script>
  
        // setInterval(()=>{
        //     @this.send_to = send_toObj.id
        // },500);
  
</script>           
