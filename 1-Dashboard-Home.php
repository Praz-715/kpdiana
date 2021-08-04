<?php

session_start();
// var_dump($_SESSION['login']);die;
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require "functions/functions-dashboard.php";



$pembelian = query("SELECT * FROM barang_masuk ORDER BY kode_trans_masuk LIMIT 20 ");
$penjualan = query("SELECT * FROM data_penjualan ORDER BY no_trans_penjualan LIMIT 20 ");
$daftartransaksi = query("SELECT * FROM data_penjualan INNER JOIN pelanggan ON fk_pelanggan = Kode_Pelanggan");

$totalstokbarang = (int)query("SELECT SUM(Quantity) as qt FROM identitas_barang")[0]['qt'];
$totalpelanggan = (int)query("SELECT COUNT(Kode_Pelanggan) as p FROM pelanggan WHERE deleted = 0")[0]['p'];

$totalpembelian = (int)query("SELECT SUM(grand_total) as total FROM barang_masuk ")[0]['total'];
$totalpenjualan = (int)query("SELECT SUM(total) as total FROM data_penjualan ")[0]['total'];

$persenpembelian = $totalpembelian / ($totalpembelian + $totalpenjualan) * 100;
$persenpenjualan = $totalpenjualan / ($totalpembelian + $totalpenjualan) * 100;

$datapenjualan = [];
foreach($penjualan as $x){
    $datapenjualan[] = [$x['no_trans_penjualan'], round((int)$x['total'] / $totalpenjualan * 100, 2) ];
}
$datapembelian = [];
foreach($pembelian as $x){
    $datapembelian[] = [$x['kode_trans_masuk'], round((int)$x['grand_total'] / $totalpembelian * 100, 2) ];
}




// var_dump( round($persenpenjualan, 2) );die;
// echo json_encode($datapembelian);die;

// die;

?>


<!doctype html>
<html lang="en">

<head>
    <title>Dashboard-Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="index.html"><img src="assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                        <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                    </div>
                </form>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/profile/<?= $_SESSION['user']['gambar'] ?>" class="img-circle" alt="Avatar"> <span><?= $_SESSION['user']['nama'] ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="page-profile.php"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="1-Dashboard-Home.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li>
                            <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i>
							<span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages" class="collapse ">
                                <ul class="nav">
                                    <li><a href="2-Dashboard-BeliBarang.php" class="">Barang</a></li>
                                    <li><a href="3-Dashboard-Pelanggan.php" class="">Pelanggan</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="9-Dashboard-BarangMasuk.php" class=""><i class="lnr lnr-code"></i></i> <span>Barang</span></a></li>
                        <li><a href="4-Dashboard-Penjualan.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Penjualan</span></a></li>
                        <li><a href="5-Dashboard-DataStock.php" class=""><i class="lnr lnr-cog"></i> <span>Data Stock</span></a></li>
                        <li>
                            <a href="#Laporan" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i>
							<span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="Laporan" class="collapse ">
                                <ul class="nav">
                                    <li><a href="10-Dashboard-LaporanPembelian.php" class="">Laporan Pembelian</a></li>
                                    <li><a href="11-Dashboard-LaporanPenjualan.php" class="">Laporan Penjualan</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="page-profile.php" class=""><i class="lnr lnr-user"></i> <span>Profile</span></a></li>
                        <li><a href="logout.php" class=""><i class="lnr lnr-dice"></i> <span>Keluar</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    <div class="panel panel-headline">
                        <!-- <div class="panel-heading">
                            <h3 class="panel-title">Weekly Overview</h3>
                            <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
                        </div> -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon" style="background-color: rgb(196, 255, 221);"><img style="width: 70%;" src="assets/img/total-barang.png" alt="" srcset=""></span>
                                        <p>
                                            <span class="number"><?= number_format($totalstokbarang,0,',','.')  ?></span>
                                            <span class="title">Total Stock Barang</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon" style="background-color: rgb(196, 255, 221);"><img style="width: 70%;" src="assets/img/pembelian.png" alt="" srcset=""></i></span>
                                        <p>
                                            <span class="number"><?= number_format($totalpembelian,0,',','.')  ?></span>
                                            <span class="title">Total Pembelian</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon" style="background-color: rgb(196, 255, 221);"><img style="width: 70%;" src="assets/img/penjualan.png" alt="" srcset=""></i></span>
                                        <p>
                                            <span class="number"><?= number_format($totalpenjualan,0,',','.')  ?></span>
                                            <span class="title">Total Penjualan</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon" style="background-color: rgb(196, 255, 221);"><img style="width: 70%;" src="assets/img/customer.png" alt="" srcset=""></i></span>
                                        <p>
                                            <span class="number"><?= number_format($totalpelanggan,0,',','.')  ?></span>
                                            <span class="title">Total Customer</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END OVERVIEW -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-headline">
                                <!-- <div class="panel-heading">
                                    Penjualan vs Pembelian
                                </div> -->
                                <div class="panel-body">
                                    <div class="row">
                                        <figure class="highcharts-figure">
                                            <div id="container"></div>
                                            <!-- <p class="highcharts-description">
                                                Pie chart where the individual slices can be clicked to expose more detailed data.
                                            </p> -->
                                        </figure>

                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h4>Total penjualan</h4>
                                            </div>
                                            <div class="col-xs-4">
                                                <h4>: <?= number_format($totalpenjualan,0,',','.')  ?></h4>
                                            </div>
                                        </div>
                                        <div class="row" sty>
                                            <div class="col-xs-4">
                                                <h4>Total Pembelian</h4>
                                            </div>
                                            <div class="col-xs-4">
                                                <h4>: <?= number_format($totalpembelian,0,',','.')  ?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <div class="mt-2" style="border-bottom: 2px solid black;">
                                                    <br>
                                                    <h4></h4>
                                                </div>
                                            </div>
                                            <div class="col-xs-0">
                                                <h3>(-)</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h4>Hasil</h4>
                                            </div>
                                            <div class="col-xs-4">
                                                <h4>: <?php echo number_format(($totalpenjualan - $totalpembelian),0,',','.');  ?> (Laba)</h4>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- RECENT PURCHASES -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">History Penjualan</h3>
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                        <!-- <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button> -->
                                    </div>
                                </div>
                                <div class="panel-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Total harga</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($daftartransaksi as $daftar): ?>
                                                <tr>
                                                    <td><?= $daftar['no_trans_penjualan'] ?></td>
                                                    <td><?= $daftar['tgl_trans_penjualan'] ?></td>
                                                    <td><?= $daftar['Nama_Pelanggan'] ?></td>
                                                    <!-- <td><?= number_format($daftar['total'],0,',','.')  ?></td> -->
                                                    <!-- <td><?= number_format($daftar['biaya_kirim'],0,',','.')  ?></td> -->
                                                    <td><?= number_format($daftar['grand_total'],0,',','.')  ?></td>
                                                    <td><button class="btn-primary" onclick="return cetak('data_penjualan','<?= $daftar['no_trans_penjualan'] ?>')"><i class="fas fa-print"></i></button></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
                                        <div class="col-md-6 text-right"><a href="4-Dashboard-Penjualan.php" class="btn btn-primary">View All Purchases</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END RECENT PURCHASES -->
                        </div>

                    </div>

                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
    <script src="assets/vendor/highchart/highcharts.js"></script>
    <script src="assets/vendor/highchart/data.js"></script>
    <script src="assets/vendor/highchart/drilldown.js"></script>
    <script src="assets/vendor/highchart/exporting.js"></script>
    <script src="assets/vendor/highchart/export-data.js"></script>
    <script src="assets/vendor/highchart/accessibility.js"></script>
    <script>
        // Create the chart
        Highcharts.chart('container', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Pembelian VS Penjualan'
            },
            subtitle: {
                text: 'Perhitungan Laba & Rugi'
            },

            accessibility: {
                announceNewData: {
                    enabled: true
                },
                point: {
                    valueSuffix: '%'
                }
            },

            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [{
                name: "Statistik",
                colorByPoint: true,
                data: [{
                    name: "Penjualan",
                    y: <?= $persenpenjualan ?>,
                    drilldown: "Penjualan"
                }, {
                    name: "Pembelian",
                    y: <?= $persenpembelian ?>,
                    drilldown: "Pembelian"
                }]
            }],
            drilldown: {
                series: [{
                    name: "Penjualan",
                    id: "Penjualan",
                    data: <?php echo json_encode($datapenjualan); ?>
                }, {
                    name: "Pembelian",
                    id: "Pembelian",
                    data: <?php echo json_encode($datapembelian); ?>
                }]
            }
        });
        function cetak(tb,id){
            window.open("cetak.php?tb="+tb+"&id="+id,"Cetak Transaksi", "width=900,height=600")
        }
    </script>

</body>

</html>

