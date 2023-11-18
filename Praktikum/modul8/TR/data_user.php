<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$data_all_user = getAllUser();

if (isset($_POST["b_tambah"])) {
    if (tambah_user($_POST) > 0) {
        header("location: data_user.php");
    } else {
        header("location: data_user.php");
    }
}
if (isset($_POST["b_ubah"])) {
    if (ubah_user($_POST) > 0) {
        header("location: data_user.php");
    } else {
        header("location: data_user.php");
    }
}
if (isset($_POST["b_hapus"])) {
    if (hapus_user($_POST["id_user"]) > 0) {
        header("location: data_user.php");
    } else {
        header("location: data_user.php");
    }
}
$title = "Data user";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card">
        <h5 class="card-header">Data User</h5>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <!-- Modal tambah -->
                <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_user" class="form-label">Nama User</label>
                                        <input type="text" class="form-control" name="nama_user" id="nama_user">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="Alamat" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">Nomor HP</label>
                                        <input type="tel" class="form-control" name="no_hp" id="no_hp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_user" class="form-label">Jenis User</label>
                                        <select class="form-select" name="level" id="jenis_user" aria-label="Default select example">
                                            <option value="" selected disabled>Pilih Jenis User</option>
                                            <option value="1">Admin</option>
                                            <option value="2">User Biasa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="sumbit" name="b_tambah" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end modal tambah -->
                <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal_tambah">Tambah User</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>NO</th>
                            <th>USERNAME</th>
                            <th>NAMA</th>
                            <th>LEVEL</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_all_user as $user) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user["username"] ?></td>
                                <td><?= $user["nama"] ?></td>
                                <?php $user_level = ($user["level"] == 1 ? "Admin" : "User Biasa") ?>
                                <td><?= $user_level ?></td>
                                <td style="width: 150px;">
                                    <div class="d-flex justify-content-around">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_ubah<?= $user["id_user"] ?>">Ubah</button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus<?= $user["id_user"] ?>">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- modal hapus -->
                            <div class="modal fade" id="modal_hapus<?= $user["id_user"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_user" value="<?= $user["id_user"] ?>">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                                                    <input type="text" class="form-control" placeholder="inputkan nama product" value="<?= $user["username"] ?>" name="username">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="b_hapus">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal hapus -->

                            <!-- modal ubah -->
                            <div class="modal fade" id="modal_ubah<?= $user["id_user"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Form Ubah User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_user" value="<?= $user["id_user"] ?>">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username" value="<?= $user["username"] ?>" id="username">
                                                    <div class="mb-3">
                                                        <label for="nama_user" class="form-label">Nama User</label>
                                                        <input type="text" class="form-control" name="nama_user" id="nama_user" value="<?= $user["nama"] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="Alamat" class="form-label">Alamat</label>
                                                        <textarea class="form-control" name="alamat" id="Alamat" rows="3"><?= $user["alamat"] ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="no_hp" class="form-label">Nomor HP</label>
                                                        <input type="tell" class="form-control" name="no_hp" id="no_hp" value="<?= $user["hp"] ?>">

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jenis_user" class="form-label">Jenis User</label>
                                                        <select class="form-select" name="level" id="jenis_user" aria-label="Default select example">
                                                            <?php
                                                            foreach ($ket_level as $key => $level) :
                                                                $selected = ($user["level"] == $key) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?= $key ?>" <?= $selected ?>><?= $level ?></option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="sumbit" name="b_ubah" class="btn btn-primary">Simpan</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal ubah -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include "layout/footer.php"
?>