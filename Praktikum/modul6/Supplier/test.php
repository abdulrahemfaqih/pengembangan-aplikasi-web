<!DOCTYPE html>
<html>

<head>
   <title>Detail Supplier</title>
</head>

<body>
   <?php
   // Hubungkan ke database (gantilah dengan koneksi database Anda)
   $koneksi = new mysqli("localhost", "root", "", "penjualan");

   // Periksa koneksi
   if ($koneksi->connect_error) {
      die("Koneksi gagal: " . $koneksi->connect_error);
   }

   // Ambil ID supplier dari parameter URL
   $id_supplier = $_GET['id'];

   // Ambil informasi supplier
   $query_supplier = "SELECT * FROM supplier WHERE id = $id_supplier";
   $result_supplier = $koneksi->query($query_supplier);

   if ($result_supplier->num_rows > 0) {
      $row_supplier = $result_supplier->fetch_assoc();
      echo "<h2>Detail Supplier: " . $row_supplier['nama'] . "</h2>";
      echo "<p>Alamat: " . $row_supplier['alamat'] . "</p>";
      echo "<p>No Telepon: " . $row_supplier['telp'] . "</p>";

      // Ambil barang-barang yang disuplai oleh supplier
      $query_barang = "SELECT * FROM barang WHERE supplier_id = $id_supplier";

      $result_barang = $koneksi->query($query_barang);

      if ($result_barang->num_rows > 0) {
         echo "<h3>Barang yang Disuplai:</h3>";
         echo "<table border='1'>";
         echo "<tr><th>ID Barang</th><th>Nama Barang</th><th>Harga</th><th>Stok</th></tr>";
         while ($row_barang = $result_barang->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_barang['id'] . "</td>";
            echo "<td>" . $row_barang['nama_barang'] . "</td>";
            echo "<td>" . $row_barang['kode_barang'] . "</td>";
            echo "<td>" . $row_barang['harga'] . "</td>";
            echo "<td>" . $row_barang['stok'] . "</td>";
            echo "</tr>";
         }
         echo "</table>";
      } else {
         echo "Supplier ini belum mensuplai barang apapun.";
      }
   } else {
      echo "Supplier tidak ditemukan.";
   }

   // Tutup koneksi database
   $koneksi->close();
   ?>
</body>

</html>