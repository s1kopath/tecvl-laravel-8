<div class="card h-380">
    <div class="card-header">
        <h5>{{ __('ORDER STATUS THIS MONTH') }}</h5>
    </div>
    <div class="card-block">
        <canvas id="chart-donut-1" style="width: 100%; height: 300px"></canvas>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var bar = document.getElementById("chart-donut-1").getContext('2d');
        var data = {
            labels: @json($orderStatus['status']),
            datasets: [{
                data: @json($orderStatus['count']),
                backgroundColor: [
                    "#33cbe8",
                    "#a1d4af",
                    "#7f5cbf",
                    "#9aa3d8",
                    "#07914c"
                ],
                hoverBackgroundColor: [
                    "#33cbe8",
                    "#a1d4af",
                    "#7f5cbf",
                    "#9aa3d8",
                    "#07914c"
                ]
            }]
        };
        var myPieChart = new Chart(bar, {
            type: 'doughnut',
            data: data,
            responsive: true,
            options: {
                maintainAspectRatio: false,
            }
        });
    });
</script>
