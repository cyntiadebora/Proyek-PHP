<?php
include "koneksi.php";

// jika ada get act
if(isset($_GET['act'])){

    //proses simpan data
    if($_GET['act']=='insert'){
        //variabel dari elemen form
        $nim     = $_POST['nim'];
        $foto    = $_FILES['upload_gambar']['name'];
        $nama    = $_POST['nama'];
        $status  = $_POST['id_status'];
        $tgl     = $_POST['tgl'];
        $alamat  = $_POST['alamat'];

        if($foto !="") { //jika foto tidak kosong
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $foto); //memisahkan nama file dgn ekstensi
            $ekstensi = strtolower(end($x)); //mengambil ekstensi file dari array yang dihasilkan oleh explode(), kemudian mengonversinya menjadi huruf kecil (lowercase) menggunakan fungsi strtolower().
            $file_tmp = $_FILES['upload_gambar']['tmp_name']; // ganti 'foto' menjadi 'upload_gambar'
            $angka_acak = rand(1, 999); //memberikan nama unik pada gambar yang diunggah, untuk menghindari konflik nama file.
            $nama_gambar_baru = $angka_acak.'-'.$foto;
            
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, '../image/'.$nama_gambar_baru); // ganti $file_temp menjadi $file_tmp

                // Tentukan ukuran yang diinginkan
                $lebar_baru = 200; 
                $tinggi_baru = 200; 

                // Ambil informasi gambar yang diunggah
                list($lebar, $tinggi) = getimagesize('../image/'.$nama_gambar_baru);

                // Buat gambar baru dengan ukuran yang diinginkan
                $gambar_baru = imagecreatetruecolor($lebar_baru, $tinggi_baru);

                // Salin dan ubah ukuran gambar yang diunggah ke gambar baru
                $gambar_asli = imagecreatefromjpeg('../image/'.$nama_gambar_baru);
                imagecopyresampled($gambar_baru, $gambar_asli, 0, 0, 0, 0, $lebar_baru, $tinggi_baru, $lebar, $tinggi);

                // Simpan gambar baru
                imagejpeg($gambar_baru, '../image/'.$nama_gambar_baru);

                // Hapus gambar yang tidak diperlukan lagi
                imagedestroy($gambar_baru);
                imagedestroy($gambar_asli);
            }else {
                echo "<script>alert('Ekstensi gambar hanya bisa dalam bentuk png dan jpg!');window.location='data_pengunjung.php';</script>";
            }
        }
        
        if($nim=='' || $foto=='' || $nama=='' || $status=='' || $tgl=='' || $alamat==''){
            header('location:data_pengunjung.php?view=tambah');
        }else{          
            //proses simpan data pengunjung
            $simpan = mysqli_query($konek, "INSERT INTO tbl_pengunjung(nim,foto,nama,id_status,tgl,alamat) 
                            VALUES ('$nim', '$nama_gambar_baru','$nama','$status','$tgl','$alamat')"); // ganti $foto menjadi $nama_gambar_baru
            
            if($simpan){
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
                //PROSES QR CODE
                #parameter inputan
                $isi_teks = $nomor; //Isi teks yang akan disematkan dalam QR Code, dalam hal ini adalah $nomor.
                $namafile = $nama.".png"; //Nama file untuk QR Code yang akan disimpan, dalam hal ini disesuaikan dengan nama pengunjung.
                $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
                $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
                $padding = 2;
            
                QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

                header('location:tambah-pengunjung.php');
            }else{
                header('location:tambah-pengunjung.php');
            }
        }
    } // akhir proses simpan data

    else{
        header('location:data_pengunjung.php');
    }

} // akhir get act

else{
    header('location:data_pengunjung.php');
}
?>
