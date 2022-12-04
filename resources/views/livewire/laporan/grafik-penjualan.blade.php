<div>
    <div class="card shadow-sm mb-5">
        <div class="card-header">
            <h3 class="card-title">
                Grafik Penjualan Harian
            </h3>
        </div>
        <div class="card-body">
            <input type="text" name="listTanggal" value="{{ json_encode($listTanggal) }}" hidden>
            <input type="text" name="listProfit" value="{{ json_encode($listProfit) }}" hidden>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="form-label required">Tanggal Awal</label>
                    <input type="date" class="form-control form-control-solid" name="tanggal_awal" wire:model="tanggal_awal" required>
                    @error('tanggal_awal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label required">Tanggal Akhir</label>
                    <input type="date" class="form-control form-control-solid" name="tanggal_akhir" wire:model="tanggal_akhir" required>
                    @error('tanggal_akhir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div id="kt_apexcharts_3" style="height: 350px;"></div>
        </div>
    </div>
</div>

@push('js')
    <script>
        var listTanggal;
        var listProfit;
        var element = document.getElementById('kt_apexcharts_3');

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
        var baseColor = KTUtil.getCssVariableValue('--kt-info');
        var lightColor = KTUtil.getCssVariableValue('--kt-info-light');

        $(document).ready(function () {
            listTanggal = JSON.parse($('input[name="listTanggal"]').val())
            listProfit = JSON.parse($('input[name="listProfit"]').val())
            renderChart()
        });

        window.addEventListener('contentChange', function(){
            listTanggal = JSON.parse($('input[name="listTanggal"]').val())
            listProfit = JSON.parse($('input[name="listProfit"]').val())
            renderChart()
        })

        function renderChart(){
            var options = {
                series: [{
                    name: 'Net Profit',
                    // data: [30, 40, 40, 90, 90, 70, 70]
                    data: listProfit
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {

                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    // categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    categories: listTanggal,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: baseColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return 'Rp.' + val + ''
                        }
                    }
                },
                colors: [lightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    strokeColor: baseColor,
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);

            if (!element) {
                return;
            }
            chart.render();
        }


    </script>
@endpush
