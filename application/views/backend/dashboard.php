<?php $this->view('messages') ?>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <?php $IncomeTotal = 0;
    foreach ($income as $c => $data) {
        $IncomeTotal += $data->nominal;
    } ?>
    <?php $ExpenditureTotal = 0;
    foreach ($expenditure as $c => $data) {
        $ExpenditureTotal += $data->nominal;
    } ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Kas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= indo_currency($IncomeTotal - $ExpenditureTotal) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wallet fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <?php $IncomeTotalThisMonth = 0;
    foreach ($incomeThisMonth as $c => $data) {
        $IncomeTotalThisMonth += $data->nominal;
    } ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Bulan ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= indo_currency($IncomeTotalThisMonth) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <?php $ExpenditureTotalThisMonth = 0;
    foreach ($ExpenditureThisMonth as $c => $data) {
        $ExpenditureTotalThisMonth += $data->nominal;
    } ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengeluaran Bulan Ini</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= indo_currency($ExpenditureTotalThisMonth) ?></div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <?php $Totalpending = 0;
    foreach ($TotalpendingPayment as $c => $data) {
        $Totalpending += $data->total;
    } ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunngu Pembayaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: small"><?= $pendingPayment ?> Tagihan (<?= indo_currency($Totalpending) ?>)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pemasukan Tahun ini</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myAreaChart" style="display: block; height: 320px; width: 560px;" width="1120" height="640" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Panel Kendali</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pb-2">
                    <div class="row">
                        <div class="col-lg-6  col-sm-12 mb-4">
                            <a href="<?= site_url('package/item') ?>" style="text-decoration: none">
                                <div class="card h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-10 text-gray-800">
                                                <h3 class="font-weight-bold"><?= $totalServices ?></h3>
                                                <h6>Layanan</h6>
                                            </div>
                                            <div class="col-2">
                                                <i class="fa fa-sitemap "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6  col-sm-12 mb-4">
                            <a href="<?= site_url('customer') ?>" style="text-decoration: none">
                                <div class="card  shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-10 text-gray-800">
                                                <h3 class="font-weight-bold"><?= $totalCustomer ?></h3>
                                                <h6>Pelanggan</h6>
                                            </div>
                                            <div class="col-2">
                                                <i class="fa fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6  col-sm-12 mb-4">
                            <a href="<?= site_url('bill') ?>" style="text-decoration: none">
                                <div class="card  shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-10 text-gray-800">
                                                <h3 class="font-weight-bold text-gray-800"><?= $pendingPayment ?></h3>
                                                <h6>Tagihan</h6>
                                            </div>
                                            <div class="col-2">
                                                <i class="fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12 mb-4">
                        <a href="<?= site_url('setting') ?>" style="text-decoration: none">
                            <div class="card  shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col ">
                                            <center>
                                                <i class="fa fa-cog fa-4x"></i>
                                            </center>
                                            <h6 class="text-gray-800" style="text-align: center; margin-top:10px">Pengaturan</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="mt-4 text-center small">
                <span class="mr-2">

                </span>
            </div>
        </div>
    </div>
</div>
</div>

<?php $Jan = 0;
foreach ($incomeJan as $c => $data) {
    $Jan += $data->nominal;
} ?>
<?php $Feb = 0;
foreach ($incomeFeb as $c => $data) {
    $Feb += $data->nominal;
} ?>
<?php $Mar = 0;
foreach ($incomeMar as $c => $data) {
    $Mar += $data->nominal;
} ?>
<?php $Apr = 0;
foreach ($incomeApr as $c => $data) {
    $Apr += $data->nominal;
} ?>
<?php $May = 0;
foreach ($incomeMay as $c => $data) {
    $May += $data->nominal;
} ?>
<?php $Jun = 0;
foreach ($incomeJun as $c => $data) {
    $Jun += $data->nominal;
} ?>
<?php $Jul = 0;
foreach ($incomeJul as $c => $data) {
    $Jul += $data->nominal;
} ?>
<?php $Aug = 0;
foreach ($incomeAug as $c => $data) {
    $Aug += $data->nominal;
} ?>
<?php $Sep = 0;
foreach ($incomeSep as $c => $data) {
    $Sep += $data->nominal;
} ?>
<?php $Oct = 0;
foreach ($incomeOct as $c => $data) {
    $Oct += $data->nominal;
} ?>
<?php $Nov = 0;
foreach ($incomeNov as $c => $data) {
    $Nov += $data->nominal;
} ?>
<?php $Dec = 0;
foreach ($incomeDec as $c => $data) {
    $Dec += $data->nominal;
} ?>
<script src="<?= base_url('assets/backend/') ?>js/Chart.min.js"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Income",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?php echo "$Jan"; ?>, <?php echo "$Feb"; ?>, <?php echo "$Mar"; ?>, <?php echo "$Apr"; ?>, <?php echo "$May"; ?>, <?php echo "$Jun"; ?>, <?php echo "$Jul"; ?>, <?php echo "$Aug"; ?>, <?php echo "$Sep"; ?>, <?php echo "$Oct"; ?>, <?php echo "$Nov"; ?>, <?php echo "$Dec"; ?>],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Rp.' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>