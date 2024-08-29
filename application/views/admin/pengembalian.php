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
							<div class="float-end">
								<button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
									<i class="bx bx-printer"></i> Laporan Peminjaman Buku
								</button>
								<!-- modal -->
								<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel1">Cetak Laporan</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<form action="<?= base_url('admin/peminjaman/cetak_laporan') ?>" target="_blank" method="post">
												<div class="modal-body">
													<div class="row g-2">
														<div class="col mb-0">
															<label for="dobBasic" class="form-label">Tanggal Awal</label>
															<input type="date" id="dobBasic" name="tanggal_1" class="form-control">
														</div>
														<div class="col mb-0">
															<label for="nameBasic" class="form-label">Tanggal Akhir</label>
															<input type="date" id="nameBasic" class="form-control" name="tanggal_2">
														</div>
													</div>
													<div class="row g-2">
														<div class="col mb-0">
															<label for="nameBasic" class="form-label">Status</label>
															<select name="status" class="form-control" id="">
																<option value="1">DIPINJAM</option>
																<option value="2">DIKEMBALIKAN</option>
																<option value="3">SEMUA</option>
															</select>
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
								<!-- modal end -->
							</div>
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Kode Peminjaman</th>
										<th>Tanggal Peminjaman</th>
										<th>Tanggal Pengembalian</th>
										<th>Tanggal Kembali</th>
										<th>Denda</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; foreach($peminjaman as $det){ ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $det['nama'] ?></td>
										<td><?= $det['kode_peminjaman'] ?></td>
										<td><?= tanggal_indo($det['tanggal_peminjaman']) ?></td>
										<td><?= tanggal_indo($det['tanggal_pengembalian']) ?></td>
										<td><?= tanggal_indo($det['tanggal_kembali']) ?></td>
										<td>
										<?php
										if($det['status'] == 'DIKEMBALIKAN'){
											echo 'Rp '.number_format($det['denda']);
										} else {
											$this->db->from('detail');
											$this->db->where('kode_peminjaman',$det['kode_peminjaman']);
											$detail = $this->db->get()->result_array();
									
											$this->db->from('peminjaman');
											$this->db->where('kode_peminjaman',$det['kode_peminjaman']);
											$peminjaman = $this->db->get();
											$row1 = $peminjaman->row();
											$tanggal_pengembalian = $row1->tanggal_pengembalian;
											// $tanggal_kembali = $row1->tanggal_kembali;
											date_default_timezone_set("Asia/Jakarta");
											$tanggal_kembali = date('Ymd');
									
											$this->db->from('denda')->where('status','AKTIF');
											$row = $this->db->get()->row();
											$denda = $row->harga_denda;
									
											$jml = count($detail) * $denda;
									
											$selisih_hari = (strtotime($tanggal_kembali) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24);
											// waktu lalu di kalikan 60 60 24
									
											// menentukan apakah peminjaman kena denda 
											if($selisih_hari > 0){
												$harga_denda = $selisih_hari * $jml;
												echo 'Rp'.number_format($harga_denda);
											} else {
												$harga_denda = 0;
												echo 'tidak punya denda';
											}
										}
											?>
										</td>
										<td><?= $det['status'] ?></td>
										<td>
											<a href="<?= base_url('admin/peminjaman/detail_pinjam/'.$det['kode_peminjaman']) ?>" class="btn btn-info mb-2" ><i class="bx bx-detail"></i> </a>
										</td>
									</tr>
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
