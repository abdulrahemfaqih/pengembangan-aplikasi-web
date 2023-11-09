<?php
include("functions.php");

$query = "DELETE FROM `order` WHERE id_order NOT IN (SELECT id_order FROM order_detil)";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "query gagal : " . mysqli_error($conn);
}

if (isset($_POST["submit"]) && !empty($_POST["pelayan"]) && !empty($_POST["no_meja"])) {
    $nama_pelayan = $_POST["pelayan"];
    $no_meja = $_POST["no_meja"];
    $query = "INSERT INTO `order` (pelayan, no_meja) VALUES ('$nama_pelayan', '$no_meja')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "query gagal : " . mysqli_error($conn);
    } else {
        $last_id = mysqli_insert_id($conn);
    }
    header("Location: order_detil.php?last_id=$last_id&no_meja=$no_meja");

}


?>
<?php include "layout/header.php" ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Order</h5>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="pelayan" class="form-label">Pelayan</label>
                    <select required class="form-select" id="pelayan" aria-label="Default select example" name="pelayan">
                        <option value="" disabled selected>Pilih pelayan</option>
                        <option value="Faqih">Faqih</option>
                        <option value="Farish">Farish</option>
                        <option value="Wafda">Wafda</option>
                        <option value="Lisa">Lisa</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="no_meja" class="form-label">No Meja</label>
                    <input type="number" placeholder="inputkan no meja" class="form-control" id="no_meja" name="no_meja">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include "layout/footer.php" ?>