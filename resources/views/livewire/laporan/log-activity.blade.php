<div>
    <div class="card shadow-sm mb-5" id="card_log_activity">
        <div class="card-header">
            <h3 class="card-title">
                List Log Activity
            </h3>
            <div class="card-toolbar">
                <div class="d-flex mx-2 align-items-center">
                    <label for="" class="form-label me-2">Tanggal</label>
                    <input type="date" class="form-control form-control-solid" name="tanggal" wire:model="tanggal" required>
                    @error('tanggal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex mx-2 align-items-center" style="width: 200px">
                    <label for="" class="form-label me-2">User</label>
                    <select name="causer_id" class="form-select form-select-solid" wire:model="causer_id" data-control="select2">
                        <option value="">Pilih</option>
                        @foreach ($listUser as $item)
                            <option value="{{ $item->id }}" @if($item->id == $causer_id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('causer_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,tanggal', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5 justify-content-between">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-3">

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>User</th>
                   <th>Aktifitas</th>
                   <th>Tanggal</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listLogActivity) > 0)
                        @foreach ($listLogActivity as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($item->updated_at)) }}</td>
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
            {{ $listLogActivity->links() }}
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){
            $('select[name="causer_id"]').select2()
        })

        $('select[name="causer_id"]').on('change', function(){
            @this.set('causer_id', $(this).val())
        })
    </script>
@endpush
