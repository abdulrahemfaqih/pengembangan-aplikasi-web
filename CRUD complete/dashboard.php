<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

// PAGINATION
$limitDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $limitDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($limitDataPerHalaman * $halamanAktif) - $limitDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $limitDataPerHalaman");

$pesan = "";  

if (isset($_POST["button"])) {
  $mahasiswa = cari($_POST["keyword"]);

  if (empty($mahasiswa)) {
    $pesan = "Data tidak ditemukan.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/dashboard.css">
  <title>Halaman Admin</title>
</head>
<body>
  <form action="" method="post">
    <div class="container">
      <h1>Daftar Mahasiswa</h1>
      <div class="container-search">
        <div class="search-bar">
          <div class="search-logo"><img src="img/search.png" alt=""></div>
          <input type="text" name="keyword" id="keyword" placeholder="Masukkan keyword pencarian..." autofocus
            autocomplete="off">
        </div>
        <button type="submit" name="button" id="cari">Cari</button>
      </div>
      <div class="menu">
        <ul>
          <li><a href="tambah.php" class='tambah'>Tambah Data Mahasiswa</a></li>
          <li><a href="logout.php" class='logout' id='logout'>Logout</a></li>
        </ul>
      </div>
      <?php if (!empty($mahasiswa)): ?>
        <div class="table-container" id="table-container">
          <table border="1" cellspacing="0">
            <tr>
              <th>No.</th>
              <th>Aksi</th>
              <th>Foto</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jurusan</th>
            </tr>
            <?php $i = 1 + $awalData ?>
            <?php foreach ($mahasiswa as $mhs): ?>
              <tr>
                <td class="nomor">
                  <p>
                    <?= $i ?>
                  </p>
                </td>
                <td class="aksi">
                  <a href="ubah.php?id=<?= $mhs["id"] ?>" style="color: cornflowerblue;"><img src="img/edit.svg">Ubah</a>
                  <a href="hapus.php?id=<?= $mhs["id"] ?>" style="color: red;"
                    onclick="return confirm('yakin ingin dihapus?')"><img src="img/trash.svg">Hapus</a>
                </td>
                <td class="profil">
                  <p><img src="img/<?= $mhs["gambar"] ?>" width="50px" alt="profil"></p>
                </td>
                <td class="nim">
                  <p>
                    <?= $mhs["nim"] ?>
                  </p>
                </td>
                <td class="nama">
                  <p>
                    <?= $mhs["nama"] ?>
                  </p>
                </td>
                <td class="email">
                  <p>
                    <?= $mhs["email"] ?>
                  </p>
                </td>
                <td class="jurusan">
                  <p>
                    <?= $mhs["jurusan"] ?>
                  </p>
                </td>
              </tr>
              <?php $i++ ?>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- navigasi -->
        <div class="navigasi">
          <?php if ($halamanAktif > 1): ?>
            <a href="?halaman=<?= $halamanAktif - 1 ?>"><img src="img/right.png" alt="left"></a>
          <?php endif ?>
          <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
            <?php if ($i == $halamanAktif): ?>
              <a href="?halaman=<?= $i ?>" style="background-color:rgb(60, 114, 214);color:white;"><?= $i ?></a>
            <?php else: ?>
              <a href="?halaman=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($halamanAktif < $jumlahHalaman): ?>
            <a href="?halaman=<?= $halamanAktif + 1 ?>"><img src="img/left.png" alt="right"></a>
          <?php endif ?>
        </div>
      <?php endif; ?>
      <h2>
        <?= $pesan ?>
      </h2>
      <div class="container-footer">
        <div class="footer">&copy; 2023 Abdul Rahem Faqih</div>
      </div>
    </div>
  </form>
  <script src="js/code.jquery.com_jquery-3.7.0.min.js"></script>
  <script src="js/dashboard.js"></script>
</body>
</html>