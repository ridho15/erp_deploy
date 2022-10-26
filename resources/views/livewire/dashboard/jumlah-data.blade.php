<div class="card shadow-sm card-flush h-xl-100">
    <div class="card-header pt-7 mb-3">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">Jumlah Data</span>
            <span class="text-gray-400 mt-1 fw-semibold fs-6">Total {{ $barang + $customers + $users + $suplier + $project + $preOrder + $customerOrder }} Data</span>
        </h3>
        <div class="card-toolbar">
            {{-- <a href="#" class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-dismiss="click"
                data-bs-custom-class="tooltip-inverse" data-kt-initialized="1">Review Fleet</a> --}}
        </div>
    </div>
    <div class="card-body pt-4">
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fa-solid fa-cubes-stacked fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Barang</a>
                    {{-- <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">234 Ships</span> --}}
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $barang }}</span>
                Jenis
            </div>
        </div>
        <div class="separator separator-dashed my-5"></div>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fa-solid fa-diagram-project fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Project</a>
                    {{-- <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">234 Ships</span> --}}
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $project }}</span>
                Project
            </div>
        </div>
        <div class="separator separator-dashed my-5"></div>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fas fa-sort-amount-up-alt fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Pre Order</a>
                    {{-- <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">234 Ships</span> --}}
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $preOrder }}</span>
                order
            </div>
        </div>
        <div class="separator separator-dashed my-5"></div>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fas fa-sort-amount-down-alt fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Kostumer Order</a>
                    {{-- <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">234 Ships</span> --}}
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $customerOrder }}</span>
                order
            </div>
        </div>
        <div class="separator separator-dashed my-5"></div>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fas fa-user fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Kostumer</a>
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $customers }}</span>
                Orang
            </div>
        </div>
        <div class="separator separator-dashed my-5"></div>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fas fa-house-user fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Admin & Karyawan</a>
                    {{-- <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">8 Aircrafts</span> --}}
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $users }}</span>
                Orang
            </div>
        </div>
        <div class="separator separator-dashed my-5"></div>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-5">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label">
                        <i class="fas fa-user-secret fs-1 p-0 text-gray-600"></i>
                    </span>
                </div>
                <div class="me-5">
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Jumlah Supplier</a>
                </div>
            </div>
            <div class="text-gray-400 fw-bold fs-7 text-end">
                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $suplier }}</span>
                Orang
            </div>
        </div>
    </div>
</div>
