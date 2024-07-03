<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$koneksi = mysqli_connect('localhost', 'root', '', 'apk_perpusdel');

//REGISTER
//Ketika tombol register ditekan
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_pengguna = $_POST['nama_pengguna']; // Tambahkan ini untuk mengambil input nama pengguna

     // Validasi input kosong
     if(empty($username) || empty($password)){
        echo '<script>
        alert("Harap lengkapi username dan password Anda!");
        window.location.href="register.php";
        </script>';
        exit(); // Menghentikan eksekusi jika input kosong
    }

    // Fungsi enkripsi password
    $enkripassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert ke database
    $insert = mysqli_query($koneksi, "INSERT INTO tbl_users (username, password, nama_pengguna) VALUES ('$username','$enkripassword', '$nama_pengguna')");

    if($insert){
        // Registrasi berhasil
        echo '<script>
        alert("Registrasi berhasil");
        window.location.href="index.php";
        </script>';
    } else {
        // Registrasi gagal
        echo '<script>
        alert("Registrasi gagal");
        window.location.href="register.php";
        </script>';
    }
}

//LOGIN
//Ketika tombol login ditekan
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input kosong
    if(empty($username) || empty($password)){
        echo '<script>
        alert("Harap masukkan username dan password Anda!");
        window.location.href="register.php";
        </script>';
        exit(); // Menghentikan eksekusi jika input kosong
    }

    // Ambil data dari database
    $cekdb = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE username='$username'");
    $hitung = mysqli_num_rows($cekdb); //untuk menghitung data apakah ada atau tidak
    
    if($hitung > 0){
        // Jika username ditemukan, verifikasi password
        $pw = mysqli_fetch_assoc($cekdb);
        $passwordsekarang = $pw['password'];

        if(password_verify($password, $passwordsekarang)){
            // Jika password benar, ambil role dari database
            $role = $pw['role'];
            $nama_pengguna = $pw['nama_pengguna']; // Tambahkan ini untuk mengambil nama pengguna

            // Simpan data dalam sesi
            $_SESSION['id_user'] = $pw['id_user'];
            $_SESSION['username'] = $pw['username'];
            $_SESSION['role'] = $pw['role'];
            $_SESSION['nama_pengguna'] = $nama_pengguna; // Simpan nama pengguna dalam sesi


            if($role == '1'){
                // Jika role adalah admin, atur session dan redirect ke halaman admin
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = 'Admin';
                header('location:admin/index.php');
            } else {
                // Jika bukan admin, atur session dan redirect ke halaman pengunjung
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = 'User';
                header('location:pengunjung/index.php');
            }
        } else {
            // Jika password salah
            echo '<script>
            alert("Password salah");
            window.location.href="index.php";
            </script>';
        }
    } else {
        // Jika username tidak ditemukan
        echo '<script>
        alert("Username tidak ditemukan");
        window.location.href="index.php";
        </script>';
    }
}
?>
