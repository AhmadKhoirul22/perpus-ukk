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
							<?= $this->session->flashdata('alert') ?>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
											Tambah Denda
										</button>
									</div>
									<div class="col-6">
										<div class="float-end">
										<button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#denda">
											<i class="bx bx-printer"></i> Laporan Denda
										</button>
										</div>
									</div>
								</div>
								<!-- modal -->
								<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;"
									aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel1">Tambah Denda</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"
													aria-label="Close"></button>
											</div>
											<form action="<?= base_url('admin/denda/tambah') ?>" method="post">
												<div class="modal-body">
													<div class="row">
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Harga Denda</label>
															<input type="number" id="dobBasic" name="harga_denda"
																class="form-control" required >
														</div>
													</div>
													<div class="row">
														<div class="col mb-0">
															<label for="nameBasic" class="form-label">Level</label>
															<select name="status" class="form-control" id="">
																<option value="AKTIF">AKTIF</option>
																<option value="TIDAK AKTIF">TIDAK AKTIF</option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-outline-secondary"
														data-bs-dismiss="modal">
														Close
													</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- modal end -->
								 	<!-- modal denda -->
								 	<div class="modal fade" id="denda" tabindex="-1" style="display: none;" aria-hidden="true">
								 		<div class="modal-dialog" role="document">
								 			<div class="modal-content">
								 				<div class="modal-header">
								 					<h5 class="modal-title" id="exampleModalLabel1">Tambah Denda</h5>
								 					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								 				</div>
								 				<form action="<?= base_url('admin/denda/cetak_denda') ?>" target="_blank" method="post">
								 					<div class="modal-body">
								 						<div class="row">
								 							<div class="col mb-0">
								 								<label for="dobBasic" class="form-label">Tanggal Awal</label>
								 								<input type="date" id="dobBasic" name="tanggal_1" class="form-control"
								 									required>
								 							</div>
								 						</div>
								 						<div class="row">
								 							<div class="col mb-0">
								 								<label for="nameBasic" class="form-label">Tanggal Akhir</label>
								 								<input type="date" name="tanggal_2" class="form-control" required >
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
								 	<!-- modal end denda -->
								<div class="row">
									<table class="table datatable datatable-table">
										<thead>
											<tr>
												<th>No</th>
												<th>Harga Denda</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($denda as $row){ ?>
											<tr>
												<td><?= $no++; ?></td>
												<td>Rp <?= number_format($row['harga_denda']); ?></td>
												<td><?= $row['status']; ?></td>
												<td>
													<button type="button" class="btn btn-success" data-bs-toggle="modal"
														data-bs-target="#basicModal<?= $row['id_denda'] ?>">
														Update
													</button>
													<a href="<?= base_url('admin/denda/delete/'.$row['id_denda']) ?>"
														class="btn btn-danger"
														onclick="return confirm('yakin dihapus?')">Delete</a>
												</td>
											</tr>
											<div class="modal fade" id="basicModal<?= $row['id_denda'] ?>" tabindex="-1"
												style="display: none;" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel1">Update Denda
															</h5>
															<button type="button" class="btn-close"
																data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<form action="<?= base_url('admin/denda/update') ?>"
															method="post">
															<input type="hidden" name="id_denda"
																value="<?= $row['id_denda'] ?>" id="">
															<div class="modal-body">
																<div class="row">
																	<div class="col mb-0">
																		<label for="dobBasic" class="form-label">Harga
																			Denda</label>
																		<input type="number" id="dobBasic"
																			value="<?= $row['harga_denda']?>"
																			name="harga_denda" class="form-control">
																	</div>
																</div>
																<div class="row">
																	<div class="col mb-0">
																		<label for="nameBasic"
																			class="form-label">Level</label>
																		<select name="status" class="form-control"
																			id="">
																			<option value="AKTIF"
																				<?php if($row['status'] == 'AKTIF'){echo "selected";} ?>>
																				AKTIF</option>
																			<option value="TIDAK AKTIF"
																				<?php if($row['status'] == 'TIDAK AKTIF'){echo "selected";} ?>>
																				TIDAK AKTIF</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-outline-secondary"
																	data-bs-dismiss="modal">
																	Close
																</button>
																<button type="submit" class="btn btn-primary">Save
																	changes</button>
															</div>
														</form>
													</div>

												</div>
											</div>
								</div>
								<?php } ?>
								</tbody>
								</table>
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
