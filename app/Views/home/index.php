<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<!-- Card -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Transaksi</h4>
                </div>
                <div class="card-body">
                    <?= $total_transaksi; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Selesai</h4>
                </div>
                <div class="card-body">
                    <?= $pengambilan; ?> / <?= $total_transaksi; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Saldo (Rupiah)</h4>
                </div>
                <div class="card-body">
                    <?= number_format($saldo); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total User</h4>
                </div>
                <div class="card-body">
                    <?= $user; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Table -->
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header h5 d-flex justify-content-between" style="min-height: 0; line-height: normal;">Transaksi terbaru <i class="fas fa-tasks"></i></div>
            <div class="card-body">
                <?php if (!$transaksi_masuk) : ?>
                    <h6 class="text-center">belum ada transaksi</h6>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Layanan</th>
                                    <th>Tgl. Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi_masuk as $tm) : ?>
                                    <tr>
                                        <td class="text-center"><?= $tm['id']; ?></td>
                                        <td class="px-3"><?= $tm['nama']; ?></td>
                                        <td class="text-center"><?= strtoupper($tm['nama_layanan']); ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($tm['tgl_selesai'])); ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="/transactions/transaksi-masuk" class="btn btn-sm btn-info">Lihat transaksi</a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <!-- Chart -->
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header h5 d-flex justify-content-between" style="min-height: 0; line-height: normal;">Statistik <i class="far fa-chart-bar"></i></div>
            <div class="card-body">
                <canvas id="chartTransaksi" height="180"></canvas>
                <hr>
                <canvas id="chartPemasukan" height="180"></canvas>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-libraries'); ?>
<script src="/vendor/chart.js/Chart.min.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('custom-script'); ?>
<?php
$labelChartTransaksi = [];
$labelChartPemasukan = [];
$dataChartTransaksi = [];
$dataChartPemasukan = [];
foreach ($chart_transaksi_masuk as $chart) {
    $labelChartTransaksi[] = $chart['tanggal'];
    $dataChartTransaksi[] = $chart['jumlah'];
}
foreach ($chart_pemasukan as $chart2) {
    $labelChartPemasukan[] = $chart2['tanggal'];
    $dataChartPemasukan[] = $chart2['jumlah'];
}
?>
<script>
    // Chart Transaksi
    var chartLabelTransaksi = <?= json_encode($labelChartTransaksi) ?>;
    var chartDataTransaksi = <?= json_encode($dataChartTransaksi) ?>;
    var ctxTransaksi = document.getElementById("chartTransaksi").getContext('2d');
    var chartTransaksi = new Chart(ctxTransaksi, {
        type: 'bar',
        data: {
            // labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            labels: chartLabelTransaksi,
            datasets: [{
                label: 'Transaksi',
                // data: [460, 458, 330, 502, 430, 610, 488],
                data: chartDataTransaksi,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderColor: 'transparent',
                borderWidth: 0,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 150
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
            title: {
                display: true,
                text: 'Transaksi Masuk',
                // fontColor: '#858796',
                // fontSize: 20,
                // fontFamily: "'Nunito', 'Roboto', sans-serif"
            }
        }
    });

    // Chart Pemasukan
    var chartLabelPemasukan = <?= json_encode($labelChartPemasukan) ?>;
    var chartDataPemasukan = <?= json_encode($dataChartPemasukan) ?>;
    var ctxPemasukan = document.getElementById("chartPemasukan").getContext('2d');
    var chartPemasukan = new Chart(ctxPemasukan, {
        type: 'line',
        data: {
            // labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            labels: chartLabelPemasukan,
            datasets: [{
                label: 'Jumlah',
                // data: [460, 458, 330, 502, 430, 610, 488],
                data: chartDataPemasukan,
                fill: false,
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.7)',
                borderColor: 'rgba(254,86,83,.7)',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 150
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
            title: {
                display: true,
                text: 'Pemasukan',
            }
        }
    });
</script>
<?= $this->endSection(); ?>