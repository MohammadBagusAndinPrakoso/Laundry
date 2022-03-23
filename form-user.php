<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="text-white">
                    <b>
                        Form User
                    </b>
                </h5>
            </div>

            <div class="card-body">
                <?php
                
                if (isset($_GET["id_user"])) {
                    # form untuk edit
                    $id_user = $_GET["id_user"];
                    $sql = "select * from user where id_user = '$id_user'";

                    include "connection.php";

                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);

                    # konversi array
                    $user = mysqli_fetch_array($hasil);                    
                    ?>

                    <form action="process-user.php" method="post" enctype="multipart/form-data"
                    onsubmit="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                        ID User
                       <input type="number" name="id_user"
                        class="form-control mb-3" required
                        value="<?=$user["id_user"]?>" readonly>

                        Nama User
                       <input type="text" name="nama_user"
                        class="form-control mb-3" required
                        value="<?=$user["nama_user"]?>">

                        Username
                       <input type="text" name="username"
                        class="form-control mb-3" required
                        value="<?=$user["username"]?>">`

                        Password
                       <input type="text" name="password"
                        class="form-control mb-3" required
                        value="<?=$user["password"]?>">

                        Role
                        <select type="text" name="role" class="form-control mb-3" required value="<?=$user["role"]?>">
                            <option value="Admin">Admin</option>
                            <option value="Kasir">Kasir</option>
                        </select>

                        <button type="submit" class="btn btn-success btn-block" name="update_user">
                            Simpan
                        </button>
                    </form>

                    <?php
                } else { 
                    # Untuk menambahkan data baru
                    ?>
                    
                    <form action="process-user.php" method="post" enctype="multipart/form-data">

                        Nama User
                       <input type="text" name="nama_user"
                        class="form-control mb-3" required>

                        Username
                       <input type="text" name="username"
                        class="form-control mb-3" required>

                        Password
                       <input type="text" name="password"
                        class="form-control mb-3" required>

                        Role
                        <select type="text" name="role" class="form-control mb-3" required>
                            <option value="Admin">Admin</option>
                            <option value="Kasir">Kasir</option>
                        </select>
 
                        <button type="submit" class="btn btn-success btn-block" name="simpan_user">
                            Simpan
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