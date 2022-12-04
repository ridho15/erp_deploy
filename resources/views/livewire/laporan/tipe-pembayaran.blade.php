<div>
    <div class="card shadow-sm mb-5">
        <div class="card-header">
            <h3 class="card-title">
                Tipe Pembayaran
            </h3>
        </div>
        <div class="card-body">
            <div id="tipe_pembayaran" style="height: 500px;"></div>
        </div>
    </div>
</div>

@push('js')
    <script>

        $(document).ready(function () {
            renderGrafikTipePembayaran()
        });

        window.addEventListener('contentChangeTipePembayaran', function(){
            renderGrafikTipePembayaran()
        })

        function renderGrafikTipePembayaran(){
            var root = am5.Root.new("tipe_pembayaran");
            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));
            var series = chart.series.push(am5percent.PieSeries.new(root, {
                alignLabels: true,
                calculateAggregates: true,
                valueField: "value",
                categoryField: "category"
            }));
            am5.ready(function () {

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            series.slices.template.setAll({
                strokeWidth: 3,
                stroke: am5.color(0xffffff)
            });

            series.labelsContainer.set("paddingTop", 30)

            series.slices.template.adapters.add("radius", function (radius, target) {
                var dataItem = target.dataItem;
                var high = series.getPrivate("valueHigh");

                if (dataItem) {
                    var value = target.dataItem.get("valueWorking", 0);
                    return radius * value / high
                }
                return radius;
            });

            series.data.setAll(@this.get('listData'));

            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50,
                marginTop: 15,
                marginBottom: 15
            }));

            legend.data.setAll(series.dataItems);

            series.appear(1000, 100);

        }); // end am5.ready()
        }
    </script>
@endpush
