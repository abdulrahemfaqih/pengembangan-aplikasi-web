<?php
require "../functions.php";

$keyword = $_GET["keyword"];
$query = "SELECT * FROM mahasiswa 
          WHERE
          nama LIKE '%$keyword%' OR
          nim LIKE  '%$keyword%' OR
          email LIKE  '%$keyword%' OR
          jurusan LIKE  '%$keyword%'
          ";
$mahasiswa = query($query);
?>

<?php if (count($mahasiswa) > 0): ?>
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
    <?php $i = 1 ?>
    <?php foreach ($mahasiswa as $mhs): ?>
      <tr>
        <td class="nomor">
          <p>
            <?= $i ?>
          </p>
        </td>
        <td class="aksi">
          <a href="ubah.php?id=<?= $mhs["id"] ?>" style="color: cornflowerblue;"><img src="img/edit.svg">Ubah</a>
          <a href="hapus.php?id=<?= $mhs["id"] ?>" style="color: red;" onclick="return confirm('Yakin ingin dihapus?')"><img src="img/trash.svg">Hapus</a>
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
<?php else: ?>
  <h1>Data tidak ditemukan</h1>
<?php endif; ?>