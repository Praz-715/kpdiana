<?php

if (isset($_POST['datanya'])) {
    require "functions/functions-dashboard.php";

    $nama = $_POST['nama'];
    $datanya = $_POST['datanya'];

    if ($nama == "pembelian") {
        $daftar = query("SELECT * FROM barang_masuk");
        if ($datanya == "berdasarkantanggal") {
            if ($_POST['daritgl'] == "" || $_POST['sampaitgl'] == "") {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            $from = date("Y-m-d", strtotime($_POST['daritgl']));
            $to = date("Y-m-d", strtotime($_POST['sampaitgl']));
            $daftar = query("SELECT * FROM barang_masuk WHERE tgl_trans_masuk BETWEEN '$from' AND '$to'");
            // var_dump("SELECT * FROM barang_masuk WHERE tgl_trans_masuk BETWEEN '$from' AND '$to'");die;
            if (empty($daftar)) {
                echo "<script>
                        alert('Data yg anda minta Kosong');
                        window.close();
                      </script>";
            }
        }
    }
    if ($nama == "penjualan") {
        $daftar = query("SELECT * FROM data_penjualan INNER JOIN pelanggan ON fk_pelanggan = Kode_Pelanggan");
        if ($datanya == "berdasarkantanggal") {
            if ($_POST['daritgl'] == "" || $_POST['sampaitgl'] == "") {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            $from = date("Y-m-d", strtotime($_POST['daritgl']));
            $to = date("Y-m-d", strtotime($_POST['sampaitgl']));
            $daftar = query("SELECT * FROM data_penjualan  INNER JOIN pelanggan ON fk_pelanggan = Kode_Pelanggan WHERE tgl_trans_penjualan  BETWEEN '$from' AND '$to'");
            if (empty($daftar)) {
                echo "<script>
                        alert('Data yg anda minta Kosong');
                        window.close();
                      </script>";
            }
        }
    }
    // echo json_encode($daftar);
    // die;


} else {
    // header("location:11-Dashboard-LaporanPenjualan.php");
    echo "<script> alert('tidak valid'); window.close(); </script>";
    header("location:1-Dashboard-Home.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cetek transaksi</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- <div class="float-left"> -->
            <h2 class=" bg-dark text-white p-2">REKAPITULASI TRANSAKSI <?= strtoupper($nama) ?> BARANG</h2>
            <!-- </div> -->
            <div class="float-right ml-3 mt-2">
                <img src="assets/img/logo-dark.png" alt="" srcset="">
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <table class="table table-borderless text-left">
                    <tbody>
                        <tr>
                            <td>Nama Usaha</td>
                            <td>: UMKM SLM</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: Jl. Jelambar Utara 111 No. 57 B Jakarta Barat</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-4">
                <table class="table table-borderless text-left">
                    <tbody>
                        <tr>
                            <td>Periode</td>
                            <td>: <?= date("d-m-Y"); ?></td>
                        </tr>
                        <tr>
                            <td>Petugas</td>
                            <td>: Administrator</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <center>
            <h2 class="text-center mb-3">Info Transaksi</h2>
            <div class="table-responsive">


                <table class="table table-bordered">

                    <?php if ($nama == 'pembelian') : ?>
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Tgl</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Tempat Beli</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qt</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Harga Beli Unit</th>
                                <th scope="col">HargaTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $qt = 0;
                            $grand = 0; ?>
                            <?php foreach ($daftar as $daf) : ?>
                                <?php $isi = json_decode($daf['isi'], true); ?>
                                <?php for ($i = 0; $i < count($isi); $i++) : ?>
                                    <tr>
                                        <?php if ($i == 0) : ?>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['tgl_trans_masuk'] ?></td>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['kode_trans_masuk'] ?></td>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['nama_tempat_beli'] ?></td>
                                        <?php endif ?>
                                        <td><?= $isi[$i]['namabarang'] ?></td>
                                        <td><?= $isi[$i]['qt'] ?></td>
                                        <td><?= $isi[$i]['unit'] ?></td>
                                        <td><?= $isi[$i]['subharga'] ?></td>
                                        <td><?= $isi[$i]['harga'] ?></td>
                                    </tr>
                                    <?php $qt += $isi[$i]['qt'] ?>
                                    <?php $grand += $isi[$i]['harga'] ?>
                                <?php endfor ?>
                            <?php endforeach ?>
                            <tr class="table-danger">
                                <td colspan="4">Total</td>
                                <td><?= $qt ?></td>
                                <td colspan="2"></td>
                                <td><?= $grand ?></td>
                            </tr>
                        </tbody>
                    <?php elseif ($nama == 'penjualan') : ?>
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Tgl</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qt</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Harga Jual per Unit</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Biaya Kirim</th>
                                <th scope="col">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $qt = 0;
                            $grand = 0; ?>
                            <?php foreach ($daftar as $daf) : ?>
                                <?php $isi = json_decode($daf['isi'], true); ?>
                                <?php for ($i = 0; $i < count($isi); $i++) : ?>
                                    <tr>
                                        <?php if ($i == 0) : ?>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['tgl_trans_penjualan'] ?></td>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['no_trans_penjualan'] ?></td>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['Nama_Pelanggan'] ?></td>
                                        <?php endif ?>
                                        <td><?= $isi[$i]['namabarang'] ?></td>
                                        <td><?= $isi[$i]['qt'] ?></td>
                                        <td><?= $isi[$i]['unit'] ?></td>
                                        <td><?= $isi[$i]['subharga'] ?></td>
                                        <td><?= $isi[$i]['harga'] ?></td>
                                        <?php if ($i == 0) : ?>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['biaya_kirim'] ?></td>
                                            <td style="vertical-align : middle;text-align:center;" rowspan="<?= count($isi) ?>"><?= $daf['grand_total'] ?></td>
                                        <?php endif ?>
                                    </tr>
                                    <?php $qt += $isi[$i]['qt'] ?>
                                <?php endfor ?>
                                <?php $grand += $daf['grand_total'] ?>
                            <?php endforeach ?>
                            <tr class="table-danger">
                                <td colspan="4">Total</td>
                                <td><?= $qt ?></td>
                                <td colspan="4"></td>
                                <td><?= $grand ?></td>
                            </tr>
                        </tbody>
                    <?php endif ?>
                </table>
                <div class="row mt-5">
                    <div class="col-4">
                        <center>
                            <p>Issued By</p>
                        </center>
                        <br><br>
                        <center>
                            <p>(Administrator)</p>
                        </center>
                    </div>
                    <div class="col-4">
                        <center>
                            <p>Verified By</p>
                        </center>
                        <br><br>
                        <center>
                            <p>(Diana Lingga Saputro)</p>
                        </center>
                    </div>
                    <div class="col-4">
                        <center>
                            <p>Approved By</p>
                        </center>
                        <br><br>
                        <center>
                            <p>(Salimah)</p>
                        </center>
                    </div>
                </div>
            </div>
        </center>
    </div>
</body>

</html>