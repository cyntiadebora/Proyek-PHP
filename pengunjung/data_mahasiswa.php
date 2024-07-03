<?php
include "koneksi.php";
?>
<div class="panel panel-primary">
    <div class="panel-heading custom-panel-heading" style="font-family: 'Times New Roman', Times, serif;">
        <h3 class="panel-title">Daftar Sebagai Anggota Baru</h3>
    </div><br>
    <div class="panel-body" style="font-family: 'Times New Roman', Times, serif;">
        <form method="post" action="aksi_mahasiswa.php?act=insert" enctype="multipart/form-data">
            <div class="form-group row mb-3">
                <label for="nim" class="col-sm-2 col-form-label">NIM/NIK</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nim" name="nim" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="upload_gambar" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control-file" id="upload_gambar" name="upload_gambar">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="id_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-4">
                    <select class="form-control" id="id_status" name="id_status">
                        <option>Pilih Status Pengunjung</option>
                        <?php
                        $query = mysqli_query($konek, "SELECT * FROM status_pengunjung") or die (mysqli_error($konek));
                        while($d = mysqli_fetch_array($query)){
                            echo "<option value='".$d['id_status']."'> ".$d['nama_status']." </option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 offset-sm-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a class="btn btn-danger" href="lihat-data.php">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
