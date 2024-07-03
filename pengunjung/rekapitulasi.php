<?php include "headerr.php";?>
<?php include "connec.php";?>
<!-- Awal row -->
<div class="row">
    <div class="col-md-12"> <!--Awal col-md-12 -->
    <div class="card shadow mb-4 mt-3"> <!--Awal card shadow -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6> <!-- Untuk menampilkan tanggal sekarang -->
        </div>
            <div class="card-body"> <!--Awal card body -->
                <form method="POST"action="" class="text-center">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d')  ?>" required> <!-- arti tanda ? $_POST adalah "maka" -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Hingga Tanggal</label>
                                <input class="form-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d')  ?>" required> <!-- Jika tanggal kedua tidak kosong, maka akan menampilkan tanggal yg dipilih, selain itu maka akan otomatis menampilkan tanggal sekarang -->
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <button class="btn btn-primary form-control" name ="btntampilkan"><i class="fa fa-search"></i> Tampilkan</button>
                    </div>
                    <div class="col-md-2">
                        <a href="layout-static.php" class= "btn btn-danger form-control"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>

                </form>

                <?php 
                if(isset($_POST['btntampilkan'])) : //awal isset

                ?>
                <div class="table-responsive"> <!-- Awal table responsive -->
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <!-- Untuk header di bawah tabel-->
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            //Untuk menampilkan data pada tanggal yang difilter
                                            $tgl1 = $_POST['tanggal1'];
                                            $tgl2 = $_POST['tanggal2'];

                                            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengunjung where tanggal BETWEEN '$tgl1' AND '$tgl2' order by id desc"); 
                                            $no = 1;
                                            while($data = mysqli_fetch_array($tampil)){
                                                ?>

                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data['tanggal'] ?></td>
                                                    <td><?= $data['nama'] ?></td>
                                                    <td><?= $data['alamat'] ?></td>
                                                    <td><?= $data['status'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        
                                    
                                    </tbody>
                                </table>
                </div> <!-- Akhir table responsive -->
                <?php endif; ?> <!-- akhir isset -->
            </div> <!--Akhir card body -->
    </div> <!--Akhir card shadow -->
    </div> <!--Akhir col-md-12 -->
    
</div>
<!-- Akhir row -->

