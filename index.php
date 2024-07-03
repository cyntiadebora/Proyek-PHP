<?php
session_start(); // Mulai session di awal file
require 'function.php'; // Sertakan file function.php untuk keperluan login

// Periksa apakah tombol login telah ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        echo '<script>
        alert("Harap masukkan username dan password Anda!");
        window.location.href="index.php";
        </script>';
        exit(); // Menghentikan eksekusi jika input kosong
    }

    // Ambil data dari database
    $cekdb = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE username='$username'");
    $hitung = mysqli_num_rows($cekdb); // Untuk menghitung data apakah ada atau tidak

    if ($hitung > 0) {
        // Jika username ditemukan, verifikasi password
        $pw = mysqli_fetch_assoc($cekdb);
        $passwordsekarang = $pw['password'];

        if (password_verify($password, $passwordsekarang)) {
            // Jika password benar, ambil role dari database
            $_SESSION['id_user'] = $pw['id_user'];
            $_SESSION['username'] = $pw['username'];
            $_SESSION['role'] = $pw['role'];
            $_SESSION['nama_pengguna'] = $pw['nama_pengguna']; // Simpan nama pengguna dalam sesi
            
            if ($role == '1') {
                // Jika role adalah admin, atur session dan redirect ke halaman admin
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = 'Admin';
                header('location:admin/index.php'); // Redirect ke halaman admin
                exit();
            } else {
                // Jika bukan admin, atur session dan redirect ke halaman pengunjung
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = 'User';
                header('location:pengunjung/index.php'); // Redirect ke halaman pengunjung
                exit();
            }
        } else {
            // Jika password salah
            echo '<script>
            alert("Password salah");
            window.location.href="index.php";
            </script>';
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        echo '<script>
        alert("Username tidak ditemukan");
        window.location.href="index.php";
        </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Del Library</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h4 class="text-center font-weight-light my-4" style="font-family: 'Times New Roman', Times, serif;">Sistem Log Masuk-Keluar Pengunjung Perpustakaan IT Del <br><br><center><h3>Login</h3></center></h4><br></div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username"/>
                                            <label for="inputEmail">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Create a password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4 mb-0" style="font-family: 'Times New Roman', Times, serif;">
                                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3" style="font-family: 'Times New Roman', Times, serif;">
                                    <div class="small"><a href="register.php">Belum punya akun? Daftar!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small"  style="font-family: 'Times New Roman', Times, serif;">
                        <div class="text-muted">Copyright &copy; Kelompok 7 PA 2 2024 </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
