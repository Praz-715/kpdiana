<?php

require 'functions/functions-pelanggan.php';
$daftarpelanggan = query("SELECT * FROM pelanggan");
$lastkodepelanggan = query("SELECT * FROM pelanggan ORDER BY Kode_Pelanggan DESC LIMIT 1")[0];
$lastkodepelanggan = $lastkodepelanggan['Kode_Pelanggan'];
$lastkodepelanggan = (int) explode("-",$lastkodepelanggan)[1] + 1;

if(isset($_POST['submit'])){
    // var_dump($_POST);die;
    if( tambahpelanggan($_POST) > 0 ) {
        header("location:3-Dashboard-Pelanggan.php");
        setcookie('pesan', ' Pelanggan berhasil ditambahkan ', time() + 5);

	}
    
}

if(isset($_POST['delete'])){
    // var_dump($_POST);die;
    if( hapuspelanggan($_POST['Kode_Pelanggan'])  > 0){
        header("location:3-Dashboard-Pelanggan.php");
        setcookie('pesan', ' Pelanggan berhasil Dihapus ', time() + 5);
    }

}
if(isset($_POST['edit'])){
    // var_dump($_POST);die;
    if( ubahbarang($_POST)  > 0){
        header("location:3-Dashboard-Pelanggan.php");
        setcookie('pesan', ' Pelanggan berhasil Diubah ', time() + 5);
    }

}
// echo $daftarpelanggan;

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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="7-Dashboard-Profile.html"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="4-Dashboard-Penjualan.html"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
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
                        <li><a href="1-Dashboard-Home.php" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li>
                            <a href="#subPages" data-toggle="collapse" class="collapsed active"><i class="lnr lnr-file-empty"></i>
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
                                        <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (isset($_COOKIE['pesan'])) : ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <i class="fa fa-check-circle"></i><?= $_COOKIE['pesan'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus"></i> Tambah Data</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button> -->
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="kodepelanggan">Kode Pelanggan</label>
                                                            <input class="form-control" type="text" name="kodepelanggan" id="kodepelanggan" value="PLG-<?= $lastkodepelanggan ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan Nama Anda">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kota">Kota</label>
                                                            <select id="kota" name="kota" class="custom-select form-control">
                                                                <option selected hidden>Pilih salah satu</option>
                                                                <option value="Jakarta Barat">Jakarta Barat</option>
                                                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                                <option value="Jakarta Utara">Jakarta Utara</option>
                                                                <option value="Jakarta Tenggara">Jakarta Tenggara</option>
                                                              </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">email</label>
                                                            <input class="form-control" type="email" name="email" id="email" placeholder="Contoh: mail@mail.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telepon">telepon</label>
                                                            <input class="form-control" type="text" name="telepon" id="telepon" placeholder="Contoh: 085xxxx">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" class="btn btn-primary">Tambah data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <h2>Data Pelanggan</h2>
                                    <!-- TABLE STRIPED -->

                                    <table id="table_barang" class="display">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Pelanggan</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Kota</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach($daftarpelanggan as $pelanggan): ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $pelanggan['Kode_Pelanggan'] ?></td>
                                                    <td><?= $pelanggan['Nama_Pelanggan'] ?></td>
                                                    <td><?= $pelanggan['Alamat_Pelanggan'] ?></td>
                                                    <td><?= $pelanggan['Kota_Pelanggan'] ?></td>
                                                    <td><?= $pelanggan['Email_Pelanggan'] ?></td>
                                                    <td><?= $pelanggan['Telp_Pelanggan'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-whatever="<?= $pelanggan['Kode_Pelanggan'] ?>~<?= $pelanggan['Nama_Pelanggan'] ?>~<?= $pelanggan['Alamat_Pelanggan'] ?>~<?= $pelanggan['Kota_Pelanggan'] ?>~<?= $pelanggan['Email_Pelanggan'] ?>~<?= $pelanggan['Telp_Pelanggan'] ?>"><i class="fas fa-edit"></i></button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="<?= $pelanggan['Kode_Pelanggan'] ?>_<?= $pelanggan['Nama_Pelanggan'] ?>"><i class="fas fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                            <?php $i++; ?>
                                            <?php endforeach ?>
                                            

                                        </tbody>
                                    </table>

                                    <!-- END TABLE STRIPED -->
                                    <!-- Modal DELETE -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Peringatan !!!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Anda Yakin Ingin Menghapus <span class="kodenya"></span> </h4>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="" method="POST">
                                                    <input id="kodebarang" type="hidden" name="Kode_Pelanggan" value="">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="delete" class="btn btn-primary">Hapus permanen</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <!-- END Modal DELETE -->
                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Peringatan !!!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="kodepelanggan">Kode Pelanggan</label>
                                                            <input class="form-control" type="text" name="kodepelanggan" id="kodepelanggan" value="" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan Nama Anda">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kota">Kota</label>
                                                            <select id="kota" name="kota" class="custom-select form-control">
                                                                <option selected hidden>Pilih salah satu</option>
                                                                <option value="Jakarta Barat">Jakarta Barat</option>
                                                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                                <option value="Jakarta Utara">Jakarta Utara</option>
                                                                <option value="Jakarta Tenggara">Jakarta Tenggara</option>
                                                              </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">email</label>
                                                            <input class="form-control" type="email" name="email" id="email" placeholder="Contoh: mail@mail.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telepon">telepon</label>
                                                            <input class="form-control" type="text" name="telepon" id="telepon" placeholder="Contoh: 085xxxx">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="edit" class="btn btn-primary">Edit data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>  
                                    <!-- END MODAL EDIT -->
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
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_barang').DataTable();
        });
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var datanya = recipient;
            var datanya = datanya.split("_");
            var kodebarang = datanya[0];
            var namabarang = datanya[1];
            modal.find('.kodenya').text(namabarang)
            modal.find('#kodebarang').val(kodebarang)
        })
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal           = $(this)
            var datanya         = recipient;
            var datanya         = datanya.split("~");
            var kodepelanggan   = datanya[0];
            var nama            = datanya[1];
            var alamat          = datanya[2];
            var kota            = datanya[3];
            var email           = datanya[4];
            var telepon         = datanya[5];

            modal.find('#kodepelanggan').val(kodepelanggan)
            modal.find('#nama').val(nama)
            modal.find('#alamat').text(alamat)
            modal.find('#kota').val(kota)
            modal.find('#email').val(email)
            modal.find('#telepon').val(telepon)
            
        })
    </script>

</body>

</html>