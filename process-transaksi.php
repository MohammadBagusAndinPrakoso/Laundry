<?php
if (isset($_POST["simpan_transaksi"])) {
    include "connection.php";
    // tampung inputan
    $tgl = $_POST["tgl"];
    $id_member = $_POST["id_member"];
    $id_user = $_POST["id_user"];
    $batas_waktu = $_POST["batas_waktu"];
    $paket = $_POST["id_paket"];
    $qty = $_POST["qty"];

    //  var_dump($id_user);
    //  exit(1);

    // perintah sql utk insert ke tabel pinjam
    $sql = "insert into transaksi values
    ('','$id_member', '$tgl', '$batas_waktu', '', 'Baru', 'Belum Dibayar', '$id_user`')";
    if (mysqli_query($connect, $sql)) {
        # jika insert berhasil
        # insert ke tabel detail_pinjam
        $sql = "select * from transaksi order by id_transaksi desc";
        $transaksi = mysqli_query($connect, $sql);
        $array = mysqli_fetch_array($transaksi);

        $id_transaksi= $array["id_transaksi"];
        $id_paket = $paket[$id_paket];
        $sql = "insert into detil_transaksi values ('','$id_transaksi','$id_paket','$qty')";
        if (mysqli_query($connect, $sql)) {
            header("location:list-transaksi.php");
        } else {
            echo mysqli_error($connect);
        } 
    }
    else {
        # jika gagal
        echo mysqli_error($connect);
    }

} elseif (isset($_POST["edit_transaksi"])) {
    include "connection.php";
    $id_transaksi = $_POST["id_transaksi"];
    $status = $_POST["status"];

    $sql = "update transaksi set status='$status' where id_transaksi='$id_transaksi'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-transaksi.php");
    } else {
        echo mysqli_error($connect);
    } 
}

?>