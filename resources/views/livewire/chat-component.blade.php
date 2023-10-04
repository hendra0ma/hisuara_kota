<div>
    <form action="#" wire:submit.prevent="store">
        <div class="row justify-content-center">
            <div class="col-8 mt-2 mb-2">
                <input wire:model="pesa" type="text" class="form-control">
             
            </div>
            <div class="col-3 mt-2 mb-2">
                <button type="submit" class="btn btn-dark btn-block"><i class="fa fa-paper-plane-o"></i>&nbsp;send</button>
            </div>
        </div>
    </form>
</div>