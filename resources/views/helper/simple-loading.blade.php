<div class="text-center" wire:loading wire:target="{{ $target }}">
    <img src="{{ asset('/assets/images/loading.svg') }}" style="height: 50px; width: 50px; object-fit: contain">
    <span class="d-block">{{ $message }}</span>
</div>
