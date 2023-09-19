<?php
$menu = ["Bakso", "Nasi Goreng", "Mie Ayam", "Capjay"]

?>
<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- Navbar -->
		<?php include("navbar.php"); ?>
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("logo.php") ?>
			<!-- Sidebar -->
			<?php include("sidebar.php") ?>
			<!-- /.sidebar -->
		</aside>
		<div class="content-wrapper">
			<?php include("contentHeader.php") ?>
			<!-- Main content -->
			<div class="content">
				<section class="container-fluid">
					<form action="dataPesanan.php" method="post">
						<!-- select -->
						<div id="form-container">
							<div id="form-input">
								<label>Menu</label>
								<select class="form-control" name="menu[]">
									<option value="" disabled selected>--- Pilih Menu ---</option>
									<?php foreach ($menu as $nama) : ?>
										<option value="<?= $nama ?>"><?= $nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="jumlah">
								<div class="row">
									<div class="col-3">
										<input type="number" class="form-control" placeholder="jumlah" name="jumlah[]">
									</div>
								</div>
							</div>
						</div>
						<div id="form-copy"></div>
						<div class="button mb-3">
							<button type="button" class="btn btn-primary mt-4" onclick="copyForm()">Tambah</button>
							<button type="submit" class="btn btn-warning mt-4">Kirim</button>
						</div>
					</form>
				</section>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?php include("footer.php") ?>
	</div>
	<!-- ./wrapper -->
	<script>
		function copyForm() {
			$("#form-container").clone().appendTo($("#form-copy"))
		}
	</script>
</body>

</html>