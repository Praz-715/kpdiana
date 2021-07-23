<?php


session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions/functions-pelanggan.php';

$daftartransaksi = query("SELECT * FROM data_penjualan INNER JOIN pelanggan ON fk_pelanggan = Kode_Pelanggan");


if(isset($_GET['tgl1'])  && isset($_GET['tgl2']) && !empty($_GET['tgl1']) && !empty($_GET['tgl2'])){
    $tgl1 = $_GET['tgl1'];
    $tgl2 = $_GET['tgl2'];
    $daftartransaksi = query("SELECT * FROM data_penjualan  INNER JOIN pelanggan ON fk_pelanggan = Kode_Pelanggan WHERE tgl_trans_penjualan  BETWEEN '$tgl1' AND '$tgl2'");
    // var_dump("SELECT * FROM barang_masuk WHERE tgl_trans_masuk BETWEEN '$tgl1' AND '$tgl2'");die;
}

// var_dump(empty($_GET['tgl1']));die;
// echo json_encode(json_decode($daftartransaksi[0]['isi']));die;

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
    <link rel="stylesheet" href="assets/vendor/datatables/jquery.dataTables.min.css">


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
                        <li><a href="1-Dashboard-Home.php" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
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
                        <li><a href="4-Dashboard-Penjualan.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>Penjualan</span></a></li>
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
                        <div class="panel-heading">
                            <div class="inibreadcumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="1-Dashboard-Home.html">Home</a></li>
                                        <li class="breadcrumb-item">Data Master</li>
                                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="label label-success">Filter data berdasarkan tanggal</span>
                                    <div class="row">
                                        <form action="" method="get">
                                            <div class="col-md-3">
                                                <input class="form-control" type="date" name="tgl1" id="tgl1" <?php if(isset($_GET['tgl1'])):?> value="<?= $_GET['tgl1'] ?>" <?php endif?> >
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" type="date" name="tgl2" id="tgl2" <?php if(isset($_GET['tgl2'])):?> value="<?= $_GET['tgl2'] ?>" <?php endif?> >
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                    <br>
                                    <a href="4-Dashboard-Penjualan-transaksi.php" class="btn btn-primary"> <i class="fas fa-plus"></i> Tambah Data</a>
                                    <h2>Data Penjualan</h2>
                                    <!-- TABLE STRIPED -->

                                    <table id="table_barang" class="display">
                                        <thead>
                                            <tr>
                                                <th>No Transaki</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Total Harga</th>
                                                <th>Biaya Kirim</th>
                                                <th>Grand Total</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($daftartransaksi as $daftar): ?>
                                                <tr>
                                                    <td><?= $daftar['no_trans_penjualan'] ?></td>
                                                    <td><?= $daftar['tgl_trans_penjualan'] ?></td>
                                                    <td><?= $daftar['Nama_Pelanggan'] ?></td>
                                                    <td><?= number_format($daftar['total'],0,',','.')  ?></td>
                                                    <td><?= number_format($daftar['biaya_kirim'],0,',','.')  ?></td>
                                                    <td><?= number_format($daftar['grand_total'],0,',','.')  ?></td>
                                                    <td><button class="btn-primary" onclick="return cetak('data_penjualan','<?= $daftar['no_trans_penjualan'] ?>')"><i class="fas fa-print"></i></button></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    
                                </div>

                            </div>
                        </div>
                        <!-- END OVERVIEW -->



                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
            <div class="clearfix "></div>
            <footer>
                <div class="container-fluid ">
                    <p class="copyright ">&copy; 2017 <a href="https://www.themeineed.com " target="_blank ">Theme I Need</a>. All Rights Reserved.</p>
                </div>
            </footer>
        </div>
        <!-- END WRAPPER -->
        <!-- Javascript -->
        <script src="assets/vendor/jquery/jquery.min.js "></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.min.js "></script>
        <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js "></script>
        <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js "></script>
        <script src="assets/vendor/chartist/js/chartist.min.js "></script>
        <script src="assets/scripts/klorofil-common.js "></script>
        <script src="assets/vendor/datatables/datatables.min.js "></script>
        <script>
            function cetak(tb,id){
                window.open("cetak.php?tb="+tb+"&id="+id,"Cetak Transaksi", "width=900,height=600")
            }

            $(document).ready(function() {
                $('#table_barang').DataTable();
            });
        </script>

</body>

</html>