<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Member</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="text-white">
                    <b>
                        Form Member
                    </b>
                </h5>
            </div>

            <div class="card-body">
                <?php
                
                if (isset($_GET["id_member"])) {
                    include "connection.php";

                    # form untuk edit
                    $id_member = $_GET["id_member"];
                    $sql = "select * from member where id_member = '$id_member'";

                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);

                    # konversi array
                    $member = mysqli_fetch_array($hasil);                    
                    ?>

                    <form action="process-member.php" method="post" enctype="multipart/form-data"
                    onsubmit="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                        ID Member
                       <input type="number" name="id_member"
                        class="form-control mb-3" required
                        value="<?=$member["id_member"]?>" readonly>

                        Nama Member
                       <input type="text" name="nama_member"
                        class="form-control mb-3" required
                        value="<?=$member["nama_member"]?>">

                        Alamat
                       <input type="text" name="alamat"
                        class="form-control mb-3" required
                        value="<?=$member["alamat"]?>">

                        Jenis Kelamin
                        <select type="text" name="jenis_kelamin" class="form-control mb-3" required value="<?=$member["jenis_kelamin"]?>">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Peremuan</option>
                        </select>

                        No. Telepon
                       <input type="text" name="tlp"
                        class="form-control mb-3" required
                        value="<?=$member["tlp"]?>">

                        <button type="submit" class="btn btn-success btn-block" name="update_member">
                            Simpan
                        </button>
                    </form>

                    <?php
                } else { 
                    # Untuk menambahkan data baru
                    ?>
                    
                    <form action="process-member.php" method="post" enctype="multipart/form-data">

                        Nama Member
                       <input type="text" name="nama_member"
                        class="form-control mb-3" required>

                        Alamat
                       <input type="text" name="alamat"
                        class="form-control mb-3" required>

                        Jenis Kelamin
                        <select type="text" name="jenis_kelamin" class="form-control mb-3" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Peremuan</option>
                        </select>

                        No. Telepon
                       <input type="text" name="tlp"
                        class="form-control mb-3" required>
 
                        <button type="submit" class="btn btn-success btn-block" name="simpan_member">
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