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
								Tambah Kategori
							</button>
							<!-- modal -->
						<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel1">Tambah Kategori</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form action="<?= base_url('admin/kategori/tambah') ?>" method="post" >
									<div class="modal-body">
										<div class="row">
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Nama Kategori</label>
												<input type="text" id="dobBasic" name="nama_kategori" class="form-control">
											</div>
										</div>
										<!-- <div class="row">
										<div class="col mb-0">
												<label for="nameBasic" class="form-label">Username</label>
												<input type="text" id="nameBasic" class="form-control" name="username" placeholder="Enter Username">
											</div>
										</div> -->
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
									<th>ID kategori</th>
									<th>Nama Kategori</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($kategori as $kat){ ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $kat['id_kategori'] ?></td>
									<td><?= $kat['nama_kategori'] ?></td>
									<td>
									<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal<?= $kat['id_kategori'] ?>">
										Edit
									</button>
									<a href="<?= base_url('admin/kategori/delete/'.$kat['id_kategori']) ?>" class="btn btn-danger mb-3" onclick="return confirm('yakin delete data')" >Delete</a>
									</td>
								</tr>
								<div class="modal fade" id="basicModal<?= $kat['id_kategori'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel1">Update Kategori</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form action="<?= base_url('admin/kategori/update') ?>" method="post" >
									<input type="hidden" name="id_kategori" value="<?= $kat['id_kategori'] ?>" >
									<div class="modal-body">
										<div class="row">
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Nama Kategori</label>
												<input type="text" id="dobBasic" name="nama_kategori" value="<?= $kat['nama_kategori'] ?>" class="form-control">
											</div>
										</div>
										<!-- <div class="row">
										<div class="col mb-0">
												<label for="nameBasic" class="form-label">Username</label>
												<input type="text" id="nameBasic" class="form-control" name="username" placeholder="Enter Username">
											</div>
										</div> -->
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
