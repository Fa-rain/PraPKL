<?php
    session_start(); 
    require "koneksi.php";

    // Pastikan user sudah login
    if (!isset($_SESSION['id_users'])) {
        header("Location: login.php");
        exit;
    }

    $id_users = $_SESSION['id_users'];

    // Ambil data user yang sedang login
    $sql = "SELECT * FROM users WHERE id_users='$id_users'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sepatu | Profil</title>
    <link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome/css/all.min.css">
</head>
<style>
    .no-decoration{
            text-decoration: none;
            color: black;
        }

</style>
<body>
<?php require "navbar.php"; ?>    

     <!-- body -->
     <div class="container py-5">
        <div class="row">

            <div class="col-lg-3 mb-5">
                <h3>Profil</h3>
                <ul class="list-group mt-3">
                    <a class="no-decoration" href="profil.php"> <!-- aku -->
                        <li class="list-group-item"><i class="fa-solid fa-circle-user"></i> Profil</li>
                    </a>
                    <a class="no-decoration" href="pesanan.php"> <!-- aku -->
                        <li class="list-group-item"><i class="fa-solid fa-bag-shopping"></i> Pesanan</li>
                    </a>
                    <a class="no-decoration" href="logout.php" id="logout-profil">
                        <li class="list-group-item"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</li>
                    </a>
                </ul>
            </div>

            <div class="col-lg-9" >
            <h4 class=" mb-3">Data Diri</h4>
                <div class="row mt-3">

                    <h1><i class="fa-solid fa-circle-user"></i></h1>
                    
                    <form action="" method="post" enctype="multipart/form-data">

                        <div>
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" value = "<?php echo $data['username']; ?>" class="form-control" autocomplete="off" >
                        </div>
                        <div>
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" value = "<?php echo $data['nama']; ?>" class="form-control">
                        </div>
                        <div>
                            <label for="">Alamat Lengkap</label>
                            <input type="text" name="alamat" id="alamat" value = "<?php echo $data['alamat']; ?>" class="form-control">
                        </div><br>
                        <div>
                            <h3><i class="fa-solid fa-phone"></i> Kontak</h3>
                        </div>
                        <div>
                            <label for="">No.HP/Whatsapp</label>
                            <input type="number" name="no_tlpn" id="no_tlpn" value = "<?php echo $data['no_tlpn']; ?>" class="form-control">
                        </div>
                        <div>
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" value = "<?php echo $data['email']; ?>" class="form-control">
                        </div><br>
                        <div>
                            <h3><i class="fa-solid fa-lock"></i> Pengaturan Passowrd</h3>
                        </div>
                        <div>
                            <label for="">Password Saat Ini</label>
                            <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>" readonly class="form-control">
                        </div>
                        <div>
                            <label for="">Password Baru</label>
                            <input type="password" name="password_baru" id="password_baru" class="form-control">
                        </div><br>
                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
    
<!-- peoses update -->

<?php
if(isset($_POST['update'])) {
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlpn = $_POST['no_tlpn'];
  $email = $_POST['email'];
  $password_baru = $_POST['password_baru'];


    // Update data pada database
    $sql = "UPDATE users SET username='$username', nama='$nama', alamat='$alamat', no_tlpn='$no_tlpn', email='$email', password = md5('$password_baru') WHERE id_users='$data[id_users]'";
    $query = mysqli_query($koneksi, $sql);

    // Periksa apakah data berhasil diupdate
    if($query) {
        ?>
        <div class="form-control alert alert-primary mt-3" role="alert">
            Data Berhasil Terupdate
        </div>
        <meta http-equiv="refresh" content="2 ; url=profil.php" />
        <?php
    } else {
        ?>
        <div class="form-control alert alert-danger mt-3" role="alert">
            Data Gagal Terupdate
        </div>
        <meta http-equiv="refresh" content="2 ; url=profil.php" />
        <?php
    }
}
?>

<?php require "footer.php"; ?>

<!-- js untuk logout -->
<script>
  document.getElementById("logout-profil").addEventListener("click", function (e) {
    e.preventDefault();
    localStorage.removeItem("isLoggedIn");
    window.location.href = "logout.php";
  });
</script>

<script src="bootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/fontawesome/js/all.min.js"></script>
</body>
</html>
