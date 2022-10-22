<div style="text-align: center">
    <div style="position: absolute">
        <img src="{{ asset($web_logo) }}" alt="" style="height: 75px; width: 75px; object-fit: contain">
    </div>
    <span style="font-size: 13pt; font-weight: bold">{{ $web_name }}</span><br>
    <span>{{ $web_alamat }}</span><br>
    <span>Phone: +62-{{ (int)$web_phone }}; Email: {{ $web_email }}</span>
</div>
<hr>
