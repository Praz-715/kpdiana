<?php

if (isset($_GET['tb'])) {
    $table  = $_GET['tb'];
    $id     = $_GET['id'];

    if($table == "barang_masuk"){
        $namakode = "kode_trans_masuk";
    }else if($table == "data_penjualan"){
        $namakode = "no_trans_penjualan";
    }
    require 'functions/functions-pelanggan.php';
    // $query = "SELECT * FROM $table WHERE $namakode = '$id'";
    // var_dump($query);die;

    $daftartransaksi = query("SELECT * FROM $table WHERE $namakode = '$id'")[0];
    if($table == "barang_masuk"){
        $kodetransaksi = $daftartransaksi['kode_trans_masuk'];
        $tanggaltransaksi = $daftartransaksi['tgl_trans_masuk'];
        $namaopsional   = "Tempat Beli";
        $opsional = $daftartransaksi['nama_tempat_beli'];
        $isi = json_decode($daftartransaksi['isi']);
        $total = $daftartransaksi['grand_total'];
        // var_dump($isi);die;

    }elseif ($table == "data_penjualan"){
        $daftartransaksi = query("SELECT * FROM $table INNER JOIN pelanggan ON fk_pelanggan = Kode_Pelanggan WHERE $namakode = '$id'")[0];

        $kodetransaksi = $daftartransaksi['no_trans_penjualan'];
        $tanggaltransaksi = $daftartransaksi['tgl_trans_penjualan'];
        $namaopsional   = "Pelanggan";
        $opsional = $daftartransaksi['Nama_Pelanggan'];
        $isi = json_decode($daftartransaksi['isi']);
        $total = $daftartransaksi['total'];
        $ongkir = $daftartransaksi['biaya_kirim'];
        $grand_total = $daftartransaksi['grand_total'];
    }
} else {
    header("location:9-Dashboard-BarangMasuk.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <title>Cetek transaksi</title>
</head>

<body>
    <div class="container mt-5">
        <span class="border border-dark p-2 ml-4"><?= $kodetransaksi ?></span>
        <div class="float-right">
            <img src="assets/img/logo-dark.png" alt="" srcset="">
        </div>
        <div class="row">
            <div class="col-md-4">
                <table class="table table-borderless text-left">
                    <tbody>
                        <tr>
                            <td>Tanggal</td>
                            <td><?= $tanggaltransaksi ?></td>
                        </tr>
                        <tr>
                            <td><?= $namaopsional  ?></td>
                            <td><?= $opsional  ?></td>
                        </tr>
                    </tbody>
                </table>    

            </div>    
        </div>
        <center>
            <h2 class="text-center mb-3">Info Transaksi</h2>
            <div class="table-responsive">
                
                
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Qt</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($daftartransaksi)): ?>
                            <?php foreach($isi as $data): ?>
                                <tr>
                                    <td><?= $data->barang ?></td>
                                    <td><?= $data->namabarang ?></td>
                                    <td><?= $data->qt ?></td>
                                    <td><?= $data->subharga ?></td>
                                    <td><?= number_format( $data->harga,0,',','.') ?></td>
                                    
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        <?php if($table == 'barang_masuk'): ?>
                            <tr>
                                <td colspan="4" class="text-right">Total harga keseluruhan</td>
                                <td colspan="2" class="text-left"><?= number_format($total,0,',','.') ?></td>
                            </tr>
                        <?php elseif($table == "data_penjualan"): ?>
                            <hr>
                            <tr>
                                <td>Biaya Kirim</td>
                                <td><?= number_format($ongkir,0,',','.') ?></td>
                                <td colspan="2">Total harga keseluruhan</td>
                                <td colspan="2" id="totalhargakeseluruhan"><?= number_format($total,0,',','.') ?></td>
                            </tr>
                            <tr>
                                <td class="bg-primary" colspan="3">Grand Total</td>
                                <td class="bg-primary" colspan="4"><?= number_format($grand_total,0,',','.') ?></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </center>
    </div>
</body>

</html>