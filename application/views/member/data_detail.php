<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('layout/_css.php') ?>
</head>

<body>
	<div id="app">
		<?php include('layout/_sidebar.php') ?>
		<div id="main">
			<header class="mb-3">
				<a href="#" class="burger-btn d-block d-xl-none">
					<i class="bi bi-justify fs-3"></i>
				</a>
			</header>
			<div class="page-heading">
				<h3><?= $title ?></h3>
			</div>
			<div class="page-content">
				<div class="col-12">
					<div class="row">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
							<form action=""method="post">
													<div class="mb-3">
														<label class="form-label"
															for="basic-default-fullname">Tanggal Peminjaman</label>
														<input type="text" class="form-control"
															id="basic-default-fullname" readonly
															value="<?= $user->tanggal_peminjaman ?>">
													</div>
													<div class="mb-3">
														<label class="form-label"
															for="basic-default-fullname">Tanggal Pengembalian</label>
														<input type="text" class="form-control"
															id="basic-default-fullname" readonly
															value="<?= $user->tanggal_pengembalian ?>">
													</div>
													<div class="mb-3">
														<label class="form-label"
															for="basic-default-fullname">Tanggal Kembali</label>
														<input type="text" class="form-control"
															id="basic-default-fullname" readonly
															value="<?= $user->tanggal_kembali ?>">
													</div>
													<div class="mb-3">
														<label class="form-label"
															for="basic-default-fullname">Status</label>
														<input type="text" class="form-control"
															id="basic-default-fullname" readonly
															value="<?= $user->status ?>">
													</div>
							</form>
							</div>
							
						</div>
					</div>
					<div class="col-lg-6">
					<div class="card">
							<div class="card-body">
							<form action="">
								<div class="mb-3">
								<label for="" class="form-label">Nama</label>
								<input type="text" value="<?= $user->nama ?>" readonly class="form-control">
								</div>
								<div class="mb-3">
								<label for="" class="form-label">Kode Peminjaman</label>
								<input type="text" value="<?= $user->kode_peminjaman ?>" readonly class="form-control">
								</div>
							</form>
							<table class="table" id="table1">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Buku</th>
										<th>Penerbit</th>
										<th>Tahun Terbit</th>
										<th>Penulis</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; foreach($detail as $minjam){ ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $minjam['judul'] ?></td>
										<td><?= $minjam['penerbit'] ?></td>
										<td><?= $minjam['tahun_terbit'] ?></td>
										<td><?= $minjam['penulis'] ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							</div>
						</div>
					</div>
					</div>
					
				</div>
				</div>
					
				</div>
			</div>
		</div>
	</div>
	<?php include('layout/_js.php') ?>
</body>

</html>
