<?php
require "functions.php";

$id = $_GET["id"];

if (hapus($id) > 0) : mysqli_close($conn); ?>
    <script>
        alert('Data berhasil dihapus');
        window.location.href = 'index.php';
    </script>";
<?php else : ?>
    <script>
        alert('Data gagal dihapus');
        window.location.href = 'index.php';
    </script>";
<?php endif; ?>