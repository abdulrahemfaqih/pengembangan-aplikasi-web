<?php
if (isset($_POST["menu"]) && isset($_POST["jumlah"])) {
	$item = $_POST["menu"];
	$jumlahItem = $_POST["jumlah"];
	$menu = [
		"Bakso" => 8_000,
		"Nasi Goreng" => 10_000,
		"Mie Ayam" => 9_000,
		"Capjay" => 9_000
	];
	function formatHarga($harga)
	{
		return "Rp " . number_format($harga, 0, ",", ".");
	}
	$total = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("header.php") ?>

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
			<!-- Main content -->
			<div class="content">
				<section class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card mt-2">
								<div class="card-header">
									<h3 class="card-title">Pesanan</h3>
								</div>
								<div class="card-body">
									<?php if (isset($item) && isset($jumlahItem) && !empty($item) && !empty($jumlahItem)) : ?>
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Menu yang dibeli</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($item as $x => $nama) :
												$harga = $menu[$nama];
												$totalItem = $jumlahItem[$x] * $harga
											?>
												<tr>
													<td><?= $x + 1 ?></td>
													<td><?= $nama ?></td>
													<td><?= formatHarga($harga) ?></td>
													<td><?= $jumlahItem[$x] ?></td>
													<td><?= formatHarga($totalItem) ?></td>
												</tr>
												<?php $total += $totalItem  ?>
											<?php endforeach; ?>
											<tr>
												<td colspan="5">
													<p>Total = <?= formatHarga($total) ?> </p>
												</td>
											</tr>
										</tbody>
									</table>
									<?php else : ?>
										<p>data tidak ada</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- /.content -->
		</div>
		<?php include("footer.php") ?>
</body>
</html>