<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function tambah($data) {
  global $conn;
  $nim = htmlspecialchars($data["nim"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);


  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  // query insert data
  $query = "INSERT INTO mahasiswa VALUES('', '$nama', '$nim', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
  return mysqli_affected_rows($conn);
}



function ubah($data) {
  global $conn;
  $id = $data["id"];
  $nim = htmlspecialchars($data["nim"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambarLama = $data["gambarLama"];

  // cek apakah user mengupload gambar atau tidak
  if ($_FILES["gambar"]["error"] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }



  // query insert data
  $query = "UPDATE mahasiswa SET
              nim = '$nim',
              nama = '$nama',
              email = '$email',
              jurusan = '$jurusan',
              gambar = '$gambar'
            WHERE id = $id
          ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
;


function upload() {
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  if ($error == 4) {

    return "nophoto.png ";
  }

  // cek apakah yang diupload gambar atau bukan
  $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'svg'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>alert('File tidak valid (bukan gambar)')</script>";
    return false;
  }
  ;

  // cek jika ukurannya besar
  if ($ukuranFile > 5000000) {
    echo "<script>alert('Ukuran gambar terlalu besar')</script>";
    return false;
  }

  // lolos pengecekan, gambar siap di uplod

  // generate nama gambar baru jika namafilenya sama
  $namaFileBaru = uniqid();
  $namaFileBaru .= ".";
  $namaFileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, "img/" . $namaFileBaru);

  return $namaFileBaru;
}

function cari($keyword) {
  $query = "SELECT * FROM mahasiswa
              WHERE
            nama LIKE '%$keyword%' OR
            nim LIKE  '%$keyword%' OR
            email LIKE  '%$keyword%' OR
            jurusan LIKE  '%$keyword%'
          ";
  return query($query);
}

function registrasi($data) {
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password1"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  // cek username is exist or not
  $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "
      <script>
        alert('Username yang anda inputkan sudah terdaftar');
      </script>";
    return false;
  }

  if ($password !== $password2) {
    echo "
      <script>
        alert('Password tidak sesuai');
      </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // insert ke database
  mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

  return mysqli_affected_rows($conn);
}
?>