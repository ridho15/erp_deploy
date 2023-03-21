@php
    $web_config = [
    'web_logo' => App\CPU\Helpers::config('logo')->first() ? App\CPU\Helpers::config('logo')->first()->value : '',
    'web_name' => App\CPU\Helpers::config('name')->first() ? App\CPU\Helpers::config('name')->first()->value : '',
    ];
@endphp
<div style="text-align: center">
    <div style="position: absolute">
        <img src="{{ asset($web_config['web_logo']) }}" alt="" style="height: 75px; width: 75px; object-fit: contain">
    </div>
    <span style="font-size: 13pt; font-weight: bold">PT. MITRA GLOBAL KENCANA</span><br>
    <span>Komplek Green Garden, Blok y3 No.50</span><br>
    <span>Kodoya Utara, Kebon Jeruk, Jakarta Barat 11520, Indonesia</span><br>
    <span>Phone: +62-21-2258-5000 (Hunting); Email: support3@mgkasia.com</span>
</div>
<hr>
