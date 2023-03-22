<div>
    <div class="h4 fw-bold">Purchase Order</div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
        <thead>
        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
        <th>No</th>
        <th>Tanggal</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @if (count($listPreOrderLog) > 0)
                @foreach ($listPreOrderLog as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal_formatted }}</td>
                        <td><?= $item->status_formatted ?></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
        </table>
    </div>
</div>
