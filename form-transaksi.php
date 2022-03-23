<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg karyawan
if (!isset($_SESSION["user"])) {
    header("location:login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Pemesanan Layanan Laundry</title>
    <style>
    body
        {
            background-color: lightgrey;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-primary mt-2">
                <h5 class="text-white">Form Pemesanan Layanan Laundry</h5>
            </div>
            <div class="card-body">
                <?php
                
                if (!isset($_GET["id_transaksi"])) {?>
                    <form action="process-transaksi.php" method="post">
                    <!-- input kode sewa-->
                    <!-- input tgl_sewa otomatis -->
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    ?>
                    Tanggal Memesan
                    <input type="text" name="tgl" class="form-control mb-2"
                    value="<?=(date("Y-m-d H:i:s"))?>"readonly>

                    <!-- petugas ambil dari data login-->
                    <input type="hidden" name="id_user"
                    value="<?=($_SESSION["user"]["id_user"])?>">
                    Nama User
                    <input type="text" name="nama_user" class="form-control mb-2"
                    value="<?=($_SESSION["user"]["nama_user"])?>" readonly>

                    <!-- pilih anggota melalui nama -->
                    Pilih Data Member
                    <select name="id_member" class="form-control mb-2" required>
                        <?php
                        include "connection.php";
                        $sql="select * from member";
                        $hasil= mysqli_query($connect, $sql);
                        while ($member= mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?=($member["id_member"])?>">
                                <?=($member["nama_member"])?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>

                    <!-- tampilkan pilihan buku yg akan disewa-->
                    Pilih Jenis Layanan
                    <select name="id_paket" class="form-control mb-2" required>
                        <?php
                        include "connection.php";
                        $sql="select * from paket";
                        $hasil= mysqli_query($connect, $sql);
                        while ($paket= mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?=($paket["id_paket"])?>">
                                <?=($paket["jenis"])?> => Rp<?=($paket["harga"])?>/qty
                            </option>
                            <?php
                        }
                        ?>
                    </select>

                    Quantity
                    <input type="number" name="qty" class="form-control mb-2" required>

                    Batas Waktu
                    <input type="date" name="batas_waktu" class="form-control mb-2" required>

                    <button name="simpan_transaksi" class="btn btn-block btn-success" type="submit">
                        Sewa
                    </button>
                </form>
                <?php
                } elseif (isset($_GET["id_transaksi"])){ 
                    include "connection.php";
                    $id_transaksi = $_GET["id_transaksi"];
                    $sql = "select * from transaksi where id_transaksi = $id_transaksi";
                    $hasil = mysqli_query($connect, $sql);
                    $transaksi = mysqli_fetch_array($hasil);
                    ?>

                    <form action="process-transaksi.php" method="post">
                        ID Transaksi
                        <input type="number" name="id_transaksi"
                        class="form-control mb-3" required
                        value="<?=$transaksi["id_transaksi"]?>" readonly>

                        Status
                        <select name="status" class="form-control mb-3" required
                        value="<?$transaksi["status"]?>">
                            <option value="Baru">Baru</option>
                            <option value="Dalam Proses">Dalam Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Picked Up">Picked Up</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-block"
                        name="edit_transaksi" onclick="return confirm('Apakah anda yakin?')">
                            Save
                        </button>
                    </form>
                <?php
                }
                
                ?>
            </div>
        </div>
    </div>
</body>
</html>