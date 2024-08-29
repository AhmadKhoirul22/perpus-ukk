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
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-lg-4">
												<div class="card">
													<div class="card-body">
													<form action="<?= base_url('admin/peminjaman/tambah_temp') ?>"
													method="post">
													<input type="hidden" name="id_user" value="<?= $user->id_user ?>"
														id="">
													<div class="mb-3">
														<label class="form-label"
															for="basic-default-fullname">Nama</label>
														<input type="text" class="form-control"
															id="basic-default-fullname" readonly
															value="<?= $user->nama ?>">
													</div>
													<div class="mb-3">
														<label class="form-label" for="basic-default-phone">Buku</label>
														<select name="id_buku" class="form-control" id="">
															<?php foreach($buku as $buku){ ?>
															<option value="<?= $buku['id_buku'] ?>"><?= $buku['judul'] ?>-<?= $buku['penerbit'] ?>-<?= $buku['tahun_terbit'] ?></option>
															<?php } ?>
														</select>
													</div>
													<button type="submit" class="btn btn-primary">Send</button>
												</form>
													</div>
												</div>
												
											</div>
											<div class="col-lg-8">
												<div class="card">
													<div class="card-body">
													<?php if($temp == NULL){ ?>
													<h3 class="text-center" >Tambahkan Buku Dahulu</h3>
													<?php } else if($temp != NULL){?>
													<table class="table">
													<thead>
														<tr>
															<th>No</th>
															<th>Judul</th>
															<th>Penerbit</th>
															<th>Tahun</th>
															<th>Aksi</th>
														</tr>
													</thead>
													<tbody>
														<?php $no=1; foreach($temp as $temp){ ?>
														<tr>
															<td><?= $no++ ?></td>
															<td><?= $temp['judul'] ?></td>
															<td><?= $temp['penerbit'] ?></td>
															<td><?= $temp['tahun_terbit'] ?></td>
															<td>
																<a href="<?= base_url('admin/peminjaman/delete_temp/'.$temp['id_temp']) ?>" onclick="return confirm('yakin untuk hapus')" class="btn btn-danger">delete</a>
															</td>
														</tr>
														<?php } ?>
													</tbody>
													</table>
													<form action="<?= base_url('admin/peminjaman/pinjam_buku') ?>" method="post" class="mt-3" >
													<input type="hidden" name="id_user" value="<?= $user->id_user ?>" >
													<div class="footer mt-3">
														<button class="btn btn-primary" onclick="return confirm('meminjam buku maksimal 3 hari, jika lebih dari 3 hari maka akan dikenakan denda')" type="submit" >pinjam</button>
													</div>
													</form>
													<?php } 	?>
													</div>
												</div>
												
											</div>
										</div>
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
