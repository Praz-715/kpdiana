<?php

session_start();
require 'functions/functions-pelanggan.php';
$lastkodetransaksi = (int) explode("-",query("SELECT * FROM barang_masuk ORDER BY kode_trans_masuk DESC LIMIT 1")[0]['kode_trans_masuk'])[1] + 1;
$daftarbarang = query("SELECT * FROM identitas_barang");
$daftarbarangjs = json_encode($daftarbarang);

if(isset($_POST['add'])){
    echo json_encode($_POST);die;
}


$data1 = array("nama"=>"teguh","status"=>"ganteng","umur"=>"22");
$data2 = array("nama"=>"ferdi","status"=>"playboy","umur"=>"30");

$_SESSION['data'][] = $data1;
$_SESSION['data'][] = $data2;
$data = json_encode($_SESSION['data']);
// echo $lastkodetransaksi;die;

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
    <link rel="stylesheet" href="assets/css/jquery-ui.css">


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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="7-Dashboard-Profile.html"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href=""><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                                <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                                <li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
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
                        <li><a href="1-Dashboard-Home.html" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li>
                            <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i>
							<span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages" class="collapse ">
                                <ul class="nav">
                                    <li><a href="2-Dashboard-BeliBarang.html" class="">Barang</a></li>
                                    <li><a href="3-Dashboard-Pelanggan.html" class="">Pelanggan</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="9-Dashboard-BarangMasuk .html" class="active"><i class="lnr lnr-code"></i></i> <span>Barang</span></a></li>
                        <li><a href="4-Dashboard-Penjualan.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Penjualan</span></a></li>
                        <li><a href="5-Dashboard-DataStock.html" class=""><i class="lnr lnr-cog"></i> <span>Data Stock</span></a></li>
                        <li>
                            <a href="#Laporan" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i>
							<span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="Laporan" class="collapse ">
                                <ul class="nav">
                                    <li><a href="10-Dashboard-LaporanPembelian.html" class="">Laporan Pembelian</a></li>
                                    <li><a href="11-Dashboard-LaporanPenjualan.html" class="">Laporan Penjualan</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="page-profile.html" class=""><i class="lnr lnr-user"></i> <span>Profile</span></a></li>
                        <li><a href="" class=""><i class="lnr lnr-dice"></i> <span>Keluar</span></a></li>
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
                                <div class="col-md-8">
                                    <form action="" method="post">
                                        <input type="hidden" name="namabarang" id="namabarang">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama </th>
                                                    <th> Barang</th>
                                                    <th>Qt</th>
                                                    <th>Sub Harga</th>
                                                    <th>Harga</th>
                                                    <th>Tambah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-group">
                                                            <select id="barang" name="barang" class="custom-select form-control" required>
                                                                <option selected hidden>Pilih salah satu</option>
                                                                <?php foreach($daftarbarang as $barang): ?>
                                                                    <option value="<?= $barang['Kode_Barang'] ?>"><?= $barang['Nama_Barang'] ?></option>
                                                                <?php endforeach ?>
                                                            </select>                                                
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" name="qt" id="qt" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" name="subharga" id="subharga" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" name="harga" id="harga" readonly>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-warning" type="submit" name="add">add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="" method="post">
                                        
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Transaksi</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Tempat Beli</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" name="notransaksi" id="notransaksi" value="TRBM-<?= $lastkodetransaksi ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="tgltr" id="tgltr">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="tempatbeli" id="tempatbeli">
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qt</th>
                                                    <th>Unit</th>
                                                    <th>Harga Unit</th>
                                                    <th>Harga Total</th>
                                                    <th><a href="" id="hapussemua">Hapus semua</a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5">Total harga keseluruhan</td>
                                                    <td colspan="2" id="totalhargakeseluruhan">8.500.000</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8"><button class="btn btn-block btn-success" type="submit">Simpan</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <h2>Transaksi Barang Masuk</h2>

                                    <div class="row">
                                        <form action="" method="post">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="notransaksi">Nomor Transaksi</label>
                                                    <input class="form-control" type="text" name="notransaksi" id="notransaksi" value="TRBM-<?= $lastkodetransaksi ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgltr">Tanggal Transaksi</label>
                                                    <input class="form-control" type="text" name="tgltr" id="tgltr">
                                                </div>
                                                <div class="form-group">
                                                    <label for="barang">Nama Barang</label>
                                                    <select id="barang" name="barang" class="custom-select form-control">
                                                        <option selected hidden>Pilih salah satu</option>
                                                        <?php foreach($daftarbarang as $barang): ?>
                                                            <option value="<?= $barang['Kode_Barang'] ?>"><?= $barang['Nama_Barang'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>                                                
                                                </div>
                                                <div class="form-group">
                                                    <label for="notransaksi">Tempat Beli</label>
                                                    <input class="form-control" type="text" name="notransaksi" id="notransaksi">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="notransaksi">Quantity</label>
                                                    <input class="form-control" type="text" name="notransaksi" id="notransaksi">
                                                </div>
                                                <div class="form-group">
                                                    <label for="notransaksi">Unit</label>
                                                    <input class="form-control" type="text" name="notransaksi" id="notransaksi">
                                                </div>
                                                <div class="form-group">
                                                    <label for="notransaksi">Harga per Unit</label>
                                                    <input class="form-control" type="text" name="notransaksi" id="notransaksi">
                                                </div>
                                                <div class="form-group">
                                                    <label for="notransaksi">Total Harga</label>
                                                    <input class="form-control" type="text" name="notransaksi" id="notransaksi">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-block" type="submit">Tambahkan</button>
                                        </form>
                                    </div>
                                    <h2>Konfirmasi Transaksi Masuk</h2>
                                    <!-- BORDERED TABLE -->
                                    <table class="table table-bordered">
                                        <form action="" method="post">
                                            <thead>
                                                <tr>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qt</th>
                                                    <th>Unit</th>
                                                    <th>Tempat Beli</th>
                                                    <th>Harga per Unit</th>
                                                    <th>Total Harga</th>
                                                    <th><a href="">Hapus Semua</a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>TR-1</td>
                                                    <td>Bawang Merah</td>
                                                    <td>100</td>
                                                    <td>Kg</td>
                                                    <td>Aneka Pangan</td>
                                                    <td>35.000</td>
                                                    <td>3.500.000</td>
                                                    <td><a href="">hapus</a></td>
                                                </tr>
                                                <tr>
                                                    <td>TR-2</td>
                                                    <td>Bawang Putih</td>
                                                    <td>500</td>
                                                    <td>Kg</td>
                                                    <td>Aneka Pangan</td>
                                                    <td>10.000</td>
                                                    <td>5.000.000</td>
                                                    <td><a href="">hapus</a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">Total harga keseluruhan</td>
                                                    <td colspan="2">8.500.000</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8"><button class="btn btn-block btn-success" type="submit">Simpan</button></td>
                                                </tr>

                                            </tbody>
                                        </form>
                                    </table>

                                    <!-- END BORDERED TABLE -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END OVERVIEW -->



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
    <script src="assets/scripts/jquery-ui.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script>
        var daftarbarang = <?php echo $daftarbarangjs; ?>;
        console.log();




        $(document).ready(function() {
            $('#table_barang').DataTable();

            $('#barang').change(function(){
                var kode_barang = daftarbarang.map(function(e) { return e.Kode_Barang; }).indexOf(this.value);
                $('#subharga').val(daftarbarang[kode_barang]['Harga_Beli']);
                $('#namabarang').val(daftarbarang[kode_barang]['Nama_Barang']);
                var subharga = $('#subharga').val();
                var qt = $('#qt').val();
                // alert(subharga);
                $('#harga').val(qt * subharga);
            });
            $('#qt').change(function(){
                var qt = this.value;
                var subharga = $('#subharga').val();
                // alert(subharga);
                $('#harga').val(qt * subharga);
            });
            
        });
        $( function() {
            $( "#tgltr" ).datepicker();
        } );
    </script>

</body>

</html>