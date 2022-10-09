<div>
    @include('helper.alert-message')
    <div class="row mb-7">
        <div class="col-md-4">
            Kostumer
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $kostumerOrder->customer->nama }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            User Order
        </div>
        <div class="col-md">
            : <span class="fw-bold text-capitalize">{{ $kostumerOrder->user->name }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Status Order
        </div>
        <div class="col-md">
            : <span class="fw-bold">
                <span
                    class="badge badge-light-@if ($kostumerOrder->status_order == 1)warning @elseif($kostumerOrder->status_order == 2)primary @elseif($kostumerOrder->status_order == 3)info @elseif($kostumerOrder->status_order == 4)success  @elseif($kostumerOrder->status_order == 0)danger @endif">{{
                    $kostumerOrder->status_order_formatted }}
                </span>
            </span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Total Harga
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $kostumerOrder->total_harga_formatted }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Total Produk
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $kostumerOrder->total_produk }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Keterangan
        </div>
        <div class="col-md">
            : <span class="fw-bold text-capitalize">{{ $kostumerOrder->keterangan }}</span>
        </div>
    </div>
</div>
