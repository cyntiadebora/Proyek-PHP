<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <!-- Mengubah tag script menjadi tag link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Perbaikan penulisan width -->
                <video id="preview" width="100%"></video>
                <style>
       .bright-green {
        background-color: #00FF00; /* Kode warna hijau cerah */
        color: #000000; /* Hitam pekat untuk kalimat */
        }
       </style>

                <?php
                    if(isset($_SESSION['error'])){
                        echo"
                        <div class='alert alert-danger'>
                        <h4>Warning!</h4>
                        ".$_SESSION['error']."
                        </div>
                        ";
                    }

                    if(isset($_SESSION['success'])){
                        echo"
                        <div class='alert alert-success bright-green'>
                        <h4>Success!</h4>
                        ".$_SESSION['success']."
                        </div>
                        ";
                    }

                ?>
            </div>
            <div class="col-md-6">
                <form action="koneksii.php" method="post" class="form-horizontal">
                    <label>SCAN QR CODE PENGUNJUNG PERPUSTAKAAN</label>
                    <input type="text" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
                </form>
                <!-- Memindahkan tag table ke dalam form -->
                <form action="koneksii.php" method="post" class="form-horizontal">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>ID Pengunjung</td>
                                <td>Waktu Masuk</td>
                                <td>Waktu Keluar</td>
                                <td>Tanggal</td>
                                <td>Status Log</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            $server = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname= "apk_perpusdel";
                            
                            $conn =  new mysqli($server,$username,$password,$dbname);
                            
                            if($conn->connect_error){
                                die("Connection failed" .$conn->connect_error);
                            }
                            
                            $sql = "SELECT id_log, id, log_masuk, log_keluar, tanggal_log, statuss FROM log_pengunjung WHERE DATE(log_masuk)=CURDATE()";
                            $query = $conn->query($sql);
                            while ($row = $query->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $row['id_log']; ?></td>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['log_masuk']; ?></td>
                                <td><?php echo $row['log_keluar']; ?></td>
                                <td><?php echo $row['tanggal_log']; ?></td>
                                <td><?php echo $row['statuss']; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script>
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }
        }).catch(function(e){
            console.error(e);
        });

        scanner.addListener('scan', function(c){
            document.getElementById('text').value=c;
            document.forms[0].submit();
        });
    </script>
</body>
</html>
