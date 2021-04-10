<div class="row">
    <div class="container-fluid col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tickets by category</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="ticketPie" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        var url = "/ticketsByCategory";

        $.getJSON(url, function (result){
            var labels = result.map(function (e){
                return e.name;
            });

            var ticketsByCategory = result.map(function (e){
                return e.numberOfTickets;
            });

            var setData = {
                labels: labels,
                datasets: [
                    {
                        label: "Tickets by category",
                        data: ticketsByCategory,
                        backgroundColor: ["#669911", "#119966", "#544568" ],
                        hoverBackgroundColor: ["#66A2EB", "#FCCE56", "#AC44EB"]
                    }]
            }

            var graphTicket = $("#ticketPie").get(0).getContext('2d');

            createPieGraph(setData, labels, graphTicket);
        });
    });

    function createPieGraph(setData, labelsActive, graphActive){
        new Chart(graphActive, {
            type: 'pie',
            data: setData
        });
    }

</script>