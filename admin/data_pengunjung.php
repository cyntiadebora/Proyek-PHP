<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/img/logo.png">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/style.css" rel="stylesheet">
</head>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
    default:
    ?>
    
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #007b;">
                <h3 class="panel-title">Data Pengunjung</h3>
            </div>
            <div class="panel-body">
                <a class="btn btn-primary" style="margin-bottom: 10px; background-color: #007b;" href="data_pengunjung.php?view=tambah">Tambah Data</a>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>NIM/NIK</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tanggal Menjadi Anggota</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $limit = isset($_GET['limit']) && $_GET['limit'] === 'all' ? '' : 'LIMIT 5';
                    //$sql = mysqli_query($konek, "SELECT * FROM tbl_pengunjung, status_pengunjung WHERE tbl_pengunjung.id_status = status_pengunjung.id_status ORDER BY id ASC $limit") or die (mysqli_error($konek));
                    $sql = mysqli_query($konek, "SELECT * FROM tbl_pengunjung, status_pengunjung WHERE tbl_pengunjung.id_status = status_pengunjung.id_status AND tbl_pengunjung.validation_status = 'approved' ORDER BY id ASC $limit") or die (mysqli_error($konek));
                    $no = 1;
                    while ($d = mysqli_fetch_array($sql)) {
                        echo "<tr>
                            <td width='40px' align='center'>$no</td>
                            <td>$d[nim]</td>
                            <td><img src=\"../image/$d[foto]\" style='max-width: 100px;' /></td>
                            <td>$d[nama]</td> 
                            <td>$d[nama_status]</td>
                            <td>$d[tgl]</td>
                            <td>$d[alamat]</td>
                            <td width='180px' align='center'>
                            <a class='btn btn-danger btn-sm' href='buatQRCode.php?nama=$d[nama]&nomor=$d[nim]' style='background-color: #808080; border: none;'>Buat Kode QR</a>
                            <a class='btn btn-success btn-sm' href='cetak_kartu.php?id=$d[id]' target='_blank' style='background-color: #4caf50;'>Cetak</a>
                            <a class='btn btn-info btn-sm' href='data_pengunjung.php?view=detail&id=$d[id]' style='background-color: #2e8b57;'>Detail</a>
                            <a class='btn btn-danger btn-sm' href='hapus_data.php?id=$d[id]' style='background-color: #f44336;' onclick='return konfirmasiHapus();'>Hapus</a>
                            </td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </table>
                <?php if (!isset($_GET['limit']) || $_GET['limit'] !== 'all') { ?>
                    <a id="lihatSelengkapnya" class="btn btn-primary" href="?limit=all" style="background-color: rgba(54, 162, 235, 1); color: white;">Lihat Selengkapnya</a>
                <?php } else { ?>
                    <a id="lihatLebihSedikit" class="btn btn-primary" href="?limit=5" style="background-color: rgba(54, 162, 235, 1); color: white;">Lihat Lebih Sedikit</a>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
    break;
    case "tambah":
?>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #007;">
                <h3 class="panel-title">Daftar Sebagai Anggota Baru</h3>
            </div>
            <div class="panel-body">
                
                <form method="post" action="aksi_pengunjung.php?act=insert" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td width="160">NIM/NIK</td>
                            <td>
                                <div class="col-md-4"><input class="form-control" type="text" name="nim" required /></div>
                            </td>
                        </tr>
                        <tr>
                            <td width='200'>Foto</td>
                            <td><div class="col-md-6"><input type="file" name="upload_gambar" id="upload_gambar"/></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><div class="col-md-6"><input class="form-control" type="text" name="nama" required /></div></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                            <div class="col-md-6"><select name="id_status">
                                    <option>Pilih Status Pengunjung</option>
                        <?php
                        $query = mysqli_query($konek, "SELECT * FROM status_pengunjung") or die (mysqli_error($konek));
                        while($d = mysqli_fetch_array($query)){
                            echo "<option value=$d[id_status]> $d[nama_status] </option>";
                        }
                        ?>
                        </select></div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Menjadi Anggota</td>
                        <td><div class="col-md-4"><input class="form-control" type="date" name="tgl" required /></div></td>
                    </tr>
                    <tr>
                        <tr>
                            <td>Alamat</td>
                            <td><div class="col-md-6"><input class="form-control" type="text" name="alamat" required /></div></td>
                        </tr>
                        <td></td>
                        <td>
                            <div class="col-md-6">
                            <input id="simpanButton" class="btn btn-primary" type="submit" value="Simpan" style="background-color: #1e7e34;" />

                                <a class="btn btn-danger" href="tambah-pengunjung.php">Batal</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
    break;
    case "detail":
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $sql = mysqli_query($konek, "SELECT * FROM tbl_pengunjung, status_pengunjung WHERE tbl_pengunjung.id_status = status_pengunjung.id_status AND tbl_pengunjung.id = $id") or die (mysqli_error($konek));
        if($d = mysqli_fetch_array($sql)){
?>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #007b;">
            <h3 class="panel-title">Detail Pengunjung</h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td>NIM/NIK</td>
                    <td>:</td>
                    <td><?php echo $d['nim']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>:</td>
                    <td><img src="../image/<?php echo $d['foto']; ?>" style='max-width: 100px;'></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $d['nama']; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?php echo $d['nama_status']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Menjadi Anggota</td>
                    <td>:</td>
                    <td><?php echo $d['tgl']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $d['alamat']; ?></td>
                </tr>
            </table>
            <a class="btn btn-primary" href="tambah-pengunjung.php" style="background-color: #f44336;">Kembali</a>
        </div>
    </div>
</div>
<?php
        } else {
            echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
        }
    break;
}
?>

</div>
</html>

<script>
    function konfirmasiHapus() {
        return confirm("Apakah Anda yakin untuk menghapus data ini?");
    }
</script>
