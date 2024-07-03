<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah admin
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'Admin') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

require '../function.php'; // Akses ke function.php di folder pa2
?>
	<footer class="footer">
      <div class="container">
        <p class="text-muted"><a href="index.php" target="_blank">Del Library</a> 2024</p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>