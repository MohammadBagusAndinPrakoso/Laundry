<?php
include("connection.php");

# untuk insert buku
if (isset($_POST["simpan_paket"])) {
    // tampung data input paket dari orang yang menginput
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    // membuat perintah sql utk insert data ke tbl pelanggan
    $sql = "insert into paket values ('$id_paket', 
    '$jenis','$harga')";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    if (mysqli_error($connect)) {
        var_dump(mysqli_error($connect));
        exit(1);
    }

    // direct ke halaman list pelanggan
    header("location: list-paket.php");
    
}

# untuk edit paket
elseif (isset($_POST["update_paket"])) {
    // tampung data yg akan diupdate
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    // membuat perintah sql untuk update data
    $sql = "update paket set jenis='$jenis', harga='$harga' where id_paket='$id_paket'";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    if (mysqli_error($connect)) {
        var_dump(mysqli_error($connect));
        exit(1);
    }

    // direct ke halaman list pelanggan
    header("location: list-paket.php");
}

elseif (isset($_GET["id_paket"])) {
    $id_paket = $_GET['id_paket'];
    $sql ="delete from paket where id_paket = '".$id_paket."'" ;

    $result = mysqli_query($connect,$sql);

    if ($result) {
        header('Location:list-paket.php');
    } else {
        printf('Gagal ya'.mysqli_error($connect));
        exit();
    }
}

?>