<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
   <center> <h2>Grafik Data Pengunjung</h2></center><br>
    <div style="width: 1500px; height: 1500px;"> <!-- div untuk dpt mengatur ukuran/lebar grafik -->
        <canvas id="grafik"></canvas> <!-- wadah untuk meletakkan chart -->
        <input onchange="filterData()" type="date" id="startdate"> <!--membuat tanggal di bawah chart-->
        <input onchange="filterData()" type="date" id="enddate"> 

    </div>
    <script>
        // Data awal (inisialisasi)
        var data = {
            labels : ["Mahasiswa", "Staff/Dosen", "Keluarga Staff", "Keluarga Dosen", "Guest"],
            datasets : [{
                label: 'Jumlah Pengunjung',
                data:[
                    <?php
                    $koneksi = mysqli_connect("localhost", "root", "", "apk_perpusdel");

                    $mahasiswa = mysqli_query($koneksi, "select * from tbl_pengunjung where status='Mahasiswa'");
                    echo mysqli_num_rows($mahasiswa);
                    ?>,


                    <?php
                    $dosen = mysqli_query($koneksi, "select * from tbl_pengunjung where status='Staff/Dosen'");
                    echo mysqli_num_rows($dosen);
                    ?>,

<?php
                    $keldosen = mysqli_query($koneksi, "select * from tbl_pengunjung where status='Keluarga Staff'");
                    echo mysqli_num_rows($keldosen);
                    ?>,

                    <?php
                    $keldosen = mysqli_query($koneksi, "select * from tbl_pengunjung where status='Keluarga Dosen'");
                    echo mysqli_num_rows($keldosen);
                    ?>,

                    <?php
                    $guest = mysqli_query($koneksi, "select * from tbl_pengunjung where status='Guest'");
                    echo mysqli_num_rows($guest);
                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 132, 192, 0.2)',
                    'rgb(255, 99, 13, 0.2)'
                ],
                borderColor:[
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 132, 192, 0.2)',
                    'rgb(255, 99, 13, 0.2)'
                ],
                borderWidth: 1
            }]
        };

        var ctx = document.getElementById("grafik").getContext('2d');
        var myChart = new Chart(ctx, {
            type:'bar',
            data: data
        });

        function filterData() {
            // Ambil tanggal dari input
            const startdate = new Date(document.getElementById("startdate").value);
            const enddate = new Date(document.getElementById("enddate").value);

            // Buat array kosong untuk menyimpan data yang difilter
            const filteredData = [];

            // Lakukan loop pada data untuk menambahkan data yang sesuai dengan rentang tanggal
            for (let i = 0; i < data.labels.length; i++) {
                const jumlahData = data.datasets[0].data[i];
                const label = data.labels[i];
                filteredData.push(jumlahData);
            }

            // Update data di chart dengan data yang telah difilter
            myChart.data.datasets[0].data = filteredData;
            myChart.update();
        }
    </script>
</body>
</html>
