<?php
if(isset($_GET['nomor']) && $_GET['nomor'] !=''){ //GET = mengambil data
    //tampung data kiriman
    $nama=$_GET['nama'];
    $nomor = $_GET['nomor'];

    // include file qrlib.php
    include "phpqrcode/qrlib.php";

    //Nama Folder file QR Code kita nantinya akan disimpan
    $tempdir = "temp/";

    //jika folder belum ada, buat folder 
    if (!file_exists($tempdir)){
        mkdir($tempdir);
    }

    #parameter inputan
    $isi_teks = $nomor; //nim yang dijadikan sebagai QR Code
    $namafile = $nama.".png"; //nama file gambar QR Code
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 10; //batasan 1 paling kecil, 10 paling besar
    $padding = 2;

    QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

    header('location:data_mahasiswa.php');

}else{
    header('location:data_mahasiswa.php');
}
?>