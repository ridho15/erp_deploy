<div>
    @include('helper.alert-message')
        <div class="text-center">
            @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
        </div>
        <div class="row mb-5">
            <div class="col-md-3">
                @include('helper.form-pencarian', ['model' => 'cari'])
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-rounded table-striped border gy-7 gs-7">
                <thead>
                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                    <th>No</th>
                    <th>User Pengirim</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @if (count($listQuotationSendLog) > 0)
                    @foreach ($listQuotationSendLog as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->tanggal_formatted }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
</div>
