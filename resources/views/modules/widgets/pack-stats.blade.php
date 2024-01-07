<div class="card col-lg-4 col-12">
    <div class="card-header">
        <h3 class="card-title">{{__("Portfolio composition")}}</h3>

        <div class="card-tools">
{{--            <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                <i class="fas fa-minus"></i>--}}
{{--            </button>--}}
{{--            <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                <i class="fas fa-times"></i>--}}
{{--            </button>--}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                </div>
                <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <ul class="chart-legend clearfix">
                    <li><i class="far fa-circle text-primary"></i> Packs </li>
                    <li><i class="far fa-circle text-success"></i> Commission </li>
                    <li><i class="far fa-circle text-info"></i> Bonus </li>
                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    United States of America
                    <span class="float-right text-danger">
                        <i class="fas fa-arrow-down text-sm"></i>
                        12%</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    India
                    <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> 4%
                      </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    China
                    <span class="float-right text-warning">
                        <i class="fas fa-arrow-left text-sm"></i> 0%
                      </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.footer -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

    <script>

        var nb_packs = {{\App\Models\Transaction::where('portefeuille_id', \App\Models\Portefeuille::current()->id)
                            ->where('type', \App\Enums\TransactionType::ACHAT)->sum('montant')}};
        var nb_commissions = {{\App\Models\Transaction::where('portefeuille_id', \App\Models\Portefeuille::current()->id)
                            ->where('type', 'commission')->sum('montant')}};

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Packs',
                'Commission',
                'Bonus',
            ],
            datasets: [
                {
                    data: [nb_packs, nb_commissions, ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12',]
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

        //-----------------
        // - END PIE CHART -
        //-----------------

    </script>
</div>
