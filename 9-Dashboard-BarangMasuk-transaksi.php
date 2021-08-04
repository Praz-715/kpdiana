<?php


session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

// $_SESSION['data']=  null;
require 'functions/functions-pelanggan.php';
// var_dump(query("SELECT * FROM barang_masuk ORDER BY kode_trans_masuk DESC LIMIT 1"));die;
if(empty(query("SELECT * FROM barang_masuk ORDER BY kode_trans_masuk DESC LIMIT 1"))){
    $lastkodetransaksi = 1;
}
else{
    $lastkodetransaksi = (int) explode("-",query("SELECT * FROM barang_masuk ORDER BY kode_trans_masuk DESC LIMIT 1")[0]['kode_trans_masuk'])[1] + 1;
    
}
$daftarbarang = query("SELECT * FROM identitas_barang");
$daftarbarangjs = json_encode($daftarbarang);



function getTotal(){
    if(isset($_SESSION['data']['isi'])){

        $_SESSION['data']['total'] = 0;
        for($i=0;$i<count($_SESSION['data']['isi']);$i++){
            $_SESSION['data']['total'] += (int)$_SESSION['data']['isi'][$i]['harga'];
            $_SESSION['data']['isi'][$i]['qtsesudahnya'] = $_SESSION['data']['isi'][$i]['qtsebelumnya'] + $_SESSION['data']['isi'][$i]['qt'];
            // var_dump($_SESSION['data']['total']);
        }
    }
}

if(isset($_POST['add'])){

    if(is_null($_SESSION['data'])){
        $_SESSION['data']['isi'][] = $_POST;
        $_SESSION['data']['total'] = (int)$_POST['harga'];
        getTotal();
    }else{
        if (in_array($_POST['barang'], array_column($_SESSION['data']['isi'], "barang") )){
            $find = array_search($_POST['barang'], array_column($_SESSION['data']['isi'], "barang") );
            $_SESSION['data']['isi'][$find]['qt'] += $_POST['qt'];
            $_SESSION['data']['isi'][$find]['harga'] = (int)$_SESSION['data']['isi'][$find]['qt'] * (int)$_SESSION['data']['isi'][$find]['subharga'];
        }else{
            $_SESSION['data']['isi'][] = $_POST;
            getTotal();
        }

        getTotal();  
    }
    // echo json_encode($_SESSION['data']);die;
    // echo $find;die;
}

if(isset($_POST['btnhapus'])){
    $hapus = $_POST['btnhapus'];
    $find = (int)array_search($hapus, array_column($_SESSION['data']['isi'], "barang") );
    // unset($_SESSION['data']['isi'][$find]);
    array_splice($_SESSION['data']['isi'], $find, $find == 0? 1 : $find);
    
    // echo json_encode($_SESSION['data']);die;
    getTotal();

}
if(isset($_POST['hapussemua'])){
    // echo json_encode($_SESSION['data']);die;
    array_splice($_SESSION['data']['isi'], 0, count($_SESSION['data']['isi']));
    getTotal();

}

if(isset($_POST['simpantransaksi'])){
    // var_dump($_POST);die;
    $notransaksi = $_POST['notransaksi'];
    $tempatbeli = $_POST['tempatbeli'];
    $tgltr = date('Y-m-d',strtotime($_POST['tgltr']));
    $isi = json_encode($_SESSION['data']['isi']);
    $total = (int)$_SESSION['data']['total'];

	$query = "INSERT INTO barang_masuk
				VALUES
			  ('$notransaksi', '$tgltr', CURRENT_TIME(), '$tempatbeli', '$isi', '$total')
			";
			// var_dump($query);die;
	mysqli_query($conn, $query);


    if( mysqli_affected_rows($conn) > 0 ) {
        foreach($_SESSION['data']['isi'] as $data){
            $id = $data['barang'];
            $qtsebelumnya = (int)query("SELECT Quantity from identitas_barang WHERE Kode_Barang = '$id'")[0]['Quantity'];
            $qtbaru = $qtsebelumnya + (int)$data['qt'];
            $query = "UPDATE identitas_barang SET Quantity = '$qtbaru' WHERE Kode_Barang = '$id'";
            mysqli_query($conn, $query);
        }
        $_SESSION['data']=  null;
        header("location:9-Dashboard-BarangMasuk.php");
        setcookie('pesan', ' Transaksi berhasil ditambahkan ', time() + 5);

	}
}

getTotal();
// die;

// echo json_encode($_SESSION['data']);die;
// var_dump(query("SELECT Quantity from identitas_barang WHERE Kode_Barang = 'BR-1'")[0]['Quantity']);die;
?>


<!doctype html>
<html lang="en">

<head>
    <title>Transaksi Barang Masuk</title>
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
                        <li><a href="9-Dashboard-BarangMasuk.php" class="active"><i class="lnr lnr-code"></i></i> <span>Barang</span></a></li>
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
                            <div class="inibreadcumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="1-Dashboard-Home.html">Home</a></li>
                                        <li class="breadcrumb-item">Data Master</li>
                                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
                                    </ol>
                                </nav>
                            </div>
                        </div> -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="" method="post">
                                        <input type="hidden" name="namabarang" id="namabarang">
                                        <input type="hidden" name="qtsebelumnya" id="qtsebelumnya">
                                        <input type="hidden" name="unit" id="unit">
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
                                                        <input class="form-control" type="text" name="tgltr" id="tgltr" value="<?= date("m/d/Y") ?>">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="tempatbeli" id="tempatbeli" value="Umum">
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
                                                    <th><button class="btn" name="hapussemua" type="submit">Hapus Semua</button></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($_SESSION['data']['isi'])): ?>
                                                    <?php foreach($_SESSION['data']['isi'] as $data): ?>
                                                        <tr>
                                                            <td><?= $data['barang'] ?></td>
                                                            <td><?= $data['namabarang'] ?></td>
                                                            <td><?= $data['qt'] ?></td>
                                                            <td><?= $data['unit'] ?></td>
                                                            <td><?= $data['subharga'] ?></td>
                                                            <td><?= $data['harga'] ?></td>
                                                            <td><button class="btn" name="btnhapus" value="<?= $data['barang'] ?>" type="submit">Hapus</button></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                <tr>
                                                    <td colspan="5">Total harga keseluruhan</td>
                                                    <td colspan="2" id="totalhargakeseluruhan"><?php if(isset($_SESSION['data']['total'])){echo $_SESSION['data']['total'];} ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8"><button class="btn btn-block btn-success" name="simpantransaksi" type="submit">Simpan</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
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
                $('#qtsebelumnya').val(daftarbarang[kode_barang]['Quantity']);
                $('#unit').val(daftarbarang[kode_barang]['Unit']);
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