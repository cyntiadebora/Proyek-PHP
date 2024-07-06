### Penjelasan Singkat Direktori 
Untuk mengakses web ini pada localhost di browser, terlebih dahulu kita membuat folder utama penyimpanan seluruh folder-folder yang ada. Pada hasil screenshot di bawah ini, folder utamanya dalah "pa2". Folder utama ini berisikan beberapa folder lagi. Folder "admin" menyimpan semua code untuk sisi "staff perpustakaan". Folder "pengunjung" menyimpan semua code untuk sisi "pengunjung/anggota perpustakaan". Folder "scan" menyimpan semua code untuk tampilan scanner yaitu webcam. Untuk file-file code yang berada di luar folder yang sudah disebutkan sebelumnya adalah file code untuk menampilkan form registrasi dan login.

## Berikut Merupakan Langkah-langkah Menggunakan Sistem Log Pengunjung Perpustakaan

### Form Registrasi
- Berikut ini adalah form registrasi agar memiliki akun baik untuk staff perpustakaan dan pengunjung
  
  ![Form Registrasi](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/register.jpg?raw=true)

 
### Form Login
- Setelah melakukan registrasi akun, kita dapat melakukan login dengan akun yang telah terdaftar tersebut.
  
  ![Form Login](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/login.jpg?raw=true)

### Dahsboard Staff Perpustakaan
- Setelah berhasil login ke sistem, staff perpustakaan akan melihat tampilan awal/dashboard. Pada dashboard ini, terdapat label grafik yang kosong. Sistem akan menampilkan grafik ketika terdapat pengunjung yang telah melakukan scan QR Code. 

  ![Dashboard Staff Perpustakaan](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/dahsboard%20admin.jpg?raw=true)

### Form Daftar Anggota Perpustakaan
- Staff perpustakaan dapat mendaftarkan anggota perpustakaan yang baru. Hal ini berguna sebagai alternatif ketika pengunjung baru yang mungkin memiliki beberapa kendala.
  
  ![Form Daftar Anggota oleh Staff](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/form%20daftar%20admin.jpg?raw=true)
  
### Melihat Keseluruhan Data Anggota Perpustakaan
- Data-data anggota ini hanya akan dapat dilihat oleh staff perpustakaan ketika akun yang mendaftar sebagai anggota disetujui oleh staff perpustakaan.
  
   ![Daftar Seluruh Anggota](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/data%20pengunjung.jpg?raw=true)

### Melakukan Validasi 
- Ketika akun yang mendaftar sebagai anggota perpustakaan yang baru, maka QR Code tidak dapat mereka lihat sebelum ada validasi persetujuan dari staff perpustakaan.

  ![Form Daftar Anggota oleh Staff](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/validasi%20by%20admin.jpg?raw=true)
  
### Melihat Grafik per Bulan 
- Staff perpustakaan dapat memfilter sesuai bulan untuk melihat status pengunjung yang telah berkunjung atau yang sudah pernah melakukan scan masuk-keluar perpustakaan. Status pengunjung dibagi menjadi beberapa kategori, yaitu mahasiswa, staff, dosen, keluarga staff/dosen, dan guest.
  
  ![Grafik Pengunjung Per Bulan](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/chart.jpg?raw=true)

### Melihat Rekapitulasi Pengunjung
- Staff perpustakaan dapat melihat pengunjung dengan memilih tanggal tertentu. Ketika memilih rentang tanggal tertentu, maka data pengunjung yang tampil hanya sesuai waktu tersebut.

  ![Rekapitulasi Pengunjung](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/tabel.jpg?raw=true)


### Dashboard Pengunjung Perpustakaan
- Setelah berhasil login dengan akun sebagi pengunjung, maka dahsboard yang akan tampil adalah sebagai berikut ini.
  
  ![Dashboard Pengunjung](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/dahsboard%20pengunjung.jpg?raw=true)

### Form Daftar Anggota Perpustakaan
- Agar memiliki kartu anggota dengan QR Code, maka pengunjung harus terlebih dahulu mendaftar sebagai anggota.

    ![Form Daftar Anggota](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/form%20daftar%20pengunjung.jpg?raw=true)

### Melihat Validasi Pendaftaran 
- Ketika pengunjung telah mendaftar, harus terlebih dahulu menunggu validasi dari staff perpustakaan. Status validasi adalah pending/menunggu sebelum diapprove oleh staff.

   ![Melihat Validasi Pendaftaran](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/validasi%20before%20approved.jpg?raw=true)

### Proses Validasi Oleh Staff Perpustakaan
- Akun yang mendaftar sebagai anggota akan muncul di akun staff perpustakaan. Staff perpustakaan dapat menyetujui ataupun menolaknya.

   ![Validasi Pendaftaran oleh Staff](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/validasi%20by%20admin.jpg?raw=true)

### Melihat Validasi Pendaftaran 
- Ketika staff perpustakaan menyetujui pendaftaran, maka pengunjung dapat melihat QR Code dan kartu anggota.

   ![Melihat QR Code](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/validasi%20after%20approved.jpg?raw=true)

### Melihat Kartu Anggota
- Kartu anggota dapat diperoleh pengunjung untuk diprint sehingga dapat melakukan scan dengan QR Code yang berada pada kartu.

  ![Kartu Anggota](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/kartu%20anggota.jpg?raw=true)

### Scan Masuk
- Pengunjung yang masuk dapat melakukan scan dengan QR Code yang telah digenerate oleh sistem. Pada contoh di bawah ini, QR Code yang sudah difoto diarahkan ke webcam. Apabila statusnya adalah angka 0 (nol), maka pengunjung telah berhasil melakukan scan masuk.

  ![Scan Masuk](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/scan%20masuk%20oleh%20pengunjung.jpg?raw=true)

### Scan Keluar
- Pengunjung yang akan keluar dari perpustakaan dapat melakukan scan dengan QR Code mereka. Apabila statusnya adalah angka 1 (satu), maka pengunjung telah berhasil melakukan scan keluar.

  ![Scan Keluar](https://github.com/cyntiadebora/Proyek-PHP/blob/main/gambar%20demo/scan%20keluar%20oleh%20pengunjung.jpg?raw=true)

  
