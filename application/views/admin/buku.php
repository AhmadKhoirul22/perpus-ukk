<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
	data-assets-path="<?= base_url('assets/sneat') ?>/assets/" data-template="vertical-menu-template-free">

<head>
	<?php include('layout/_css.php') ?>
</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->
			<?php include('layout/_menu.php') ?>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->
				<?php include('layout/_navbar.php') ?>
				<!-- / Navbar -->

				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Content -->
					<div class="container-xxl flex-grow-1 container-p-y">
						<div id="autohide">
							<?= $this->session->flashdata('alert'); ?>
						</div>
						<div class="card">
							<div class="card-body">
							<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
								Tambah Buku
							</button>
							<!-- modal -->
						<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel1">Tambah Kategori</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form action="<?= base_url('admin/buku/tambah') ?>" method="post" enctype="multipart/form-data" >
									<div class="modal-body">
										<div class="row g-2">
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Judul</label>
												<input type="text" id="dobBasic" name="judul" class="form-control">
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Penulis</label>
												<input type="text" id="dobBasic" name="penulis" class="form-control">
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Penerbit</label>
												<input type="text" id="dobBasic" name="penerbit" class="form-control">
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Tahun Terbit</label>
												<input type="number" id="dobBasic" name="tahun_terbit" class="form-control">
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
											<label for="dobBasic" class="form-label">Kategori Buku</label>
											<select name="id_kategori" class="form-control" id="">
												<?php foreach($kategori as $row){ ?>
												<option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
												<?php } ?>
											</select>
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Jumlah</label>
												<input type="number" id="dobBasic" name="jumlah" class="form-control">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
											Close
										</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end modal -->
						 <table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Judul</th>
									<th>Penulis</th>
									<th>Penerbit</th>
									<th>Kategori</th>
									<th>Tahun Terbit</th>
									<th>Jumlah</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($buku as $buku){ ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $buku['judul'] ?></td>
									<td><?= $buku['penulis'] ?></td>
									<td><?= $buku['penerbit'] ?></td>
									<td><?= $buku['nama_kategori'] ?></td>
									<td><?= $buku['tahun_terbit'] ?></td>
									<td><?= $buku['jumlah'] ?></td>
									<td>
									<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal<?= $buku['id_buku'] ?>">
										Edit
									</button>
									<a href="<?= base_url('admin/buku/delete/'.$buku['id_buku']) ?>" class="btn btn-danger mb-3" onclick="return confirm('yakin delete data')" >Delete</a>
									</td>
								</tr>
								<!-- modal update -->
								<div class="modal fade" id="basicModal<?= $buku['id_buku'] ?>" tabindex="-1" style="display: none;"
									aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel1">Update Buku</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<form action="<?= base_url('admin/buku/update') ?>" method="post" enctype="multipart/form-data" >
												<input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
												<div class="modal-body">
													<div class="row g-2">
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Judul</label>
															<input type="text" id="dobBasic" name="judul" value="<?= $buku['judul'] ?>" class="form-control">
														</div>
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Penulis</label>
															<input type="text" id="dobBasic" name="penulis" value="<?= $buku['penulis'] ?>" class="form-control">
														</div>
													</div>
													<div class="row g-2">
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Penerbit</label>
															<input type="text" id="dobBasic" name="penerbit" value="<?= $buku['penerbit'] ?>" class="form-control">
														</div>
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Tahun Terbit</label>
															<input type="number" id="dobBasic" name="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>" class="form-control">
														</div>
													</div>
													<div class="row g-2">
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Kategori Buku</label>
															<select name="id_kategori" class="form-control" id="">
																<?php foreach($kategori as $row){ ?>
																<option 
																<?php if($row['id_kategori'] == $buku['id_kategori']){echo 'selected';} ?>
																value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
																<?php } ?>
															</select>
														</div>
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Jumlah</label>
															<input type="number" id="dobBasic" value="<?= $buku['jumlah'] ?>" name="jumlah" class="form-control">
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
														Close
													</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- update modal -->
								<?php } ?>
							</tbody>
						 </table>
							</div>
						</div>
					</div>
					<!-- / Content -->
				</div>
				<!-- Content wrapper -->
			</div>
			<!-- / Layout page -->
		</div>
	</div>
	<!-- / Layout wrapper -->
	<!-- Core JS -->
	<?php include('layout/_js.php') ?>
</body>

</html>
