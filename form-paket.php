<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Layanan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="text-white">
                    <b>
                        Form Layanan
                    </b>
                </h5>
            </div>

            <div class="card-body">
                <?php
                
                if (isset($_GET["id_paket"])) {
                    # form untuk edit
                    $id_paket = $_GET["id_paket"];
                    $sql = "select * from paket where id_paket = '$id_paket'";

                    include "connection.php";

                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);

                    if (mysqli_error($connect)) {
                        var_dump(mysqli_error($connect));
                        exit(1);
                    }

                    # konversi array
                    $paket = mysqli_fetch_array($hasil);                    
                    ?>

                    <form action="process-paket.php" method="post" enctype="multipart/form-data"
                    onsubmit="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                        ID Layanan
                       <input type="number" name="id_paket"
                        class="form-control mb-3" required
                        value="<?=$paket["id_paket"]?>" readonly>

                        Jenis Layanan
                        <select type="text" name="jenis" class="form-control mb-3" required value="<?=$paket["jenis_kelamin"]?>">
                            <option value="Kiloan">Kiloan</option>
                            <option value="Selimut">Selimut</option>
                            <option value="Bed Cover">Bed Cover</option>
                            <option value="Kaos">Kaos</option>
                        </select>

                        Harga
                       <input type="text" name="harga"
                        class="form-control mb-3" required
                        value="<?=$paket["harga"]?>">

                        <button type="submit" class="btn btn-success btn-block" name="update_paket">
                            Simpan
                        </button>
                    </form>

                    <?php
                } else { 
                    # Untuk menambahkan data baru
                    ?>
                    
                    <form action="process-paket.php" method="post" enctype="multipart/form-data">

                        Jenis Layanan
                        <select type="text" name="jenis" class="form-control mb-3" required>
                            <option value="Kiloan">Kiloan</option>
                            <option value="Selimut">Selimut</option>
                            <option value="Bed Cover">Bed Cover</option>
                            <option value="Kaos">Kaos</option>
                        </select>

                        Harga
                       <input type="text" name="harga"
                        class="form-control mb-3" required>
 
                        <button type="submit" class="btn btn-success btn-block" name="simpan_paket">
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