<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg petugas
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
    <title>Laundry</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
            <div class="card-header bg-primary">
                <h4 class="text-white">
                    <b>
                        List User
                    </b>
                </h4>
            </div>

            <div class="card-body">
                <form action="list-user.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-2"
                    placeholder="Masukkan Keyword Pencarian" />
                </form>

                <ul class="list-group">
                <?php
                    include ("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pd saat load halaman ini
                        # akan mengecek apakah ada data dgn method
                        # GET yg bernama search
                        $search = $_GET["search"];
                        $sql = "select * from user where id like '%$search%' or nama like '%$search%'
                        or username like '%$search%' or role like '%$search%'";
                    } else {
                        $sql = "select * from user";
                    }
                    
                    
                    # Eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);
                    while ($user = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6><b>ID User        : </b><?=$user["id_user"]?></h6>
                                    <h6><b>Nama User      : </b><?=$user["nama_user"]?></h6>
                                    <h6><b>Username       : </b><?=$user["username"]?></h6>
                                    <h6><b>Role           : </b><?=$user["role"]?></h6>
                                </div>

                                <div class="col-lg-2">
                                    <a href="form-user.php?id_user=<?=$user["id_user"]?>">
                                        <button class="btn btn-block btn-outline-primary mb-1">
                                            Edit
                                        </button>
                                    </a>
                                    <a href="process-user.php?id_user=<?=$user["id_user"]?>">
                                        <button class="btn btn-block btn-danger"
                                        onclick="return confirm('Apakah anda yakin?')">
                                            Remove
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <?php
                    }

                    ?>
                </ul>
            </div>
            
            <div class="card-footer">
                <a href="form-user.php">
                    <button class="btn btn-success">
                        Tambah Data User
                    </button>
                </a>
            </div>

        </div>
    </div>
</body>
</html>