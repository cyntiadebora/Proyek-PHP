<?php
session_start();
include "koneksi.php";

// jika ada get act
if(isset($_GET['act'])){

    // Cek apakah pengguna sudah mendaftar sebelumnya
    $id_user = $_SESSION['id_user']; // Ambil ID pengguna dari sesi
    $cek_daftar = mysqli_query($konek, "SELECT * FROM tbl_pengunjung WHERE id_user = '$id_user'");
    if(mysqli_num_rows($cek_daftar) > 0) {
        echo '<script>alert("Anda sudah melakukan pendaftaran dengan akun ini.");window.location="mendaftar.php";</script>';
        exit();
    }

    //proses simpan data
    if($_GET['act']=='insert'){
        //variabel dari elemen form
        $nim     = $_POST['nim'];
        $foto    = $_FILES['upload_gambar']['name'];
        $nama    = $_POST['nama'];
        $status  = $_POST['id_status'];
        $alamat  = $_POST['alamat'];

        if($foto != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['upload_gambar']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak.'-'.$foto;
            
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, '../image/'.$nama_gambar_baru);

                // Tentukan ukuran yang diinginkan
                $lebar_baru = 200; 
                $tinggi_baru = 200; 

                // Ambil informasi gambar yang diunggah
                list($lebar, $tinggi) = getimagesize('../image/'.$nama_gambar_baru);

                // Buat gambar baru dengan ukuran yang diinginkan
                $gambar_baru = imagecreatetruecolor($lebar_baru, $tinggi_baru);

                // Pilih fungsi yang sesuai berdasarkan ekstensi file
                switch ($ekstensi) {
                    case 'jpeg':
                    case 'jpg':
                        $gambar_asli = imagecreatefromjpeg('../image/'.$nama_gambar_baru);
                        break;
                    case 'png':
                        $gambar_asli = imagecreatefrompng('../image/'.$nama_gambar_baru);
                        break;
                    default:
                        die("Format file tidak didukung.");
                }

                // Salin dan ubah ukuran gambar yang diunggah ke gambar baru
                if($gambar_asli !== false) {
                    imagecopyresampled($gambar_baru, $gambar_asli, 0, 0, 0, 0, $lebar_baru, $tinggi_baru, $lebar, $tinggi);
                    
                    // Simpan gambar baru
                    imagejpeg($gambar_baru, '../image/'.$nama_gambar_baru);
                    
                    // Hapus gambar yang tidak diperlukan lagi
                    imagedestroy($gambar_baru);
                    imagedestroy($gambar_asli);
                } else {
                    die("Gagal membuka gambar.");
                }

            } else {
                echo "<script>alert('Ekstensi gambar hanya bisa dalam bentuk png, jpg, dan jpeg!');window.location='data_mahasiswa.php';</script>";
            }
        }
        
        if($nim=='' || $foto=='' || $nama=='' || $status=='' || $alamat==''){
            echo "<script>alert('Semua field harus diisi!');window.location='data_mahasiswa.php';</script>";
        } else {
            $tgl = date('Y-m-d'); // Tetapkan tanggal saat ini di server
            //proses simpan data pengunjung
            $simpan = mysqli_query($konek, "INSERT INTO tbl_pengunjung(nim, foto, nama, id_status, tgl, alamat, id_user) 
                            VALUES ('$nim', '$nama_gambar_baru', '$nama', '$status', '$tgl', '$alamat', '$id_user')");
            
            if($simpan){
                $last_id = mysqli_insert_id($konek);
                $_SESSION['pengunjung_id'] = $last_id;
                
                // BUAT QRCODE
                // tampung data kiriman
                $nomor = $nim;
            
                // include file qrlib.php
                include "phpqrcode/qrlib.php";
            
                //Nama Folder file QR Code kita nantinya akan disimpan
                $tempdir = "temp/";
            
                //jika folder belum ada, buat folder 
                if (!file_exists($tempdir)){
                    mkdir($tempdir);
                }
            
                #parameter inputan
                $isi_teks = $nomor;
                $namafile = $nama.".png";
                $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
                $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
                $padding = 2;
            
                QRCode::png($isi_teks, $tempdir.$namafile, $quality, $ukuran, $padding);

                echo '<script>alert("Pendaftaran berhasil. Menunggu persetujuan staf perpustakaan.");window.location="mendaftar.php";</script>';

              //  header('location:view_mahasiswa.php');
            } else {
                echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.');window.location='data_mahasiswa.php';</script>";
            }
        }
    } // akhir proses simpan data

    else {
        header('location:data_mahasiswa.php');
    }

} // akhir get act

else {
    header('location:data_mahasiswa.php');
}
?>
