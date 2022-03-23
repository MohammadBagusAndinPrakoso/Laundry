<?php
include("connection.php");

# untuk insert buku
if (isset($_POST["simpan_user"])) {
    // tampung data input user dari orang yang menginput
    $id_user = $_POST["id_user"];
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    // sha1($password); = untuk enkripsi pasword
    $role = $_POST["role"];

    // membuat perintah sql utk insert data ke tbl pelanggan
    $sql = "insert into user values ('$id_user', 
    '$nama_user','$username', '$password', '$role')";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list pelanggan
    header("location: list-user.php");
    
}

# untuk edit user
elseif (isset($_POST["update_user"])) {
    // tampung data yg akan diupdate
    $id_user = $_POST["id_user"];
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $role = $_POST["role"];

    // membuat perintah sql untuk update data
    $sql = "update user set nama_user='$nama_user',
    username='$username', password='$password', role='$role' where id_user='$id_user'";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);
    
    if (mysqli_error($connect)) {
        var_dump(mysqli_error($connect));
        exit(1);
    }

    // direct ke halaman list pelanggan
    header("location: list-user.php");
}

elseif (isset($_GET["id_user"])) {
    $id_user = $_GET['id_user'];
    $sql ="delete from user where id_user = '".$id_user."'" ;

    $result = mysqli_query($connect,$sql);

    if ($result) {
        header('Location:list-user.php');
    } else {
        printf('Gagal ya'.mysqli_error($connect));
        exit();
    }
}

?>