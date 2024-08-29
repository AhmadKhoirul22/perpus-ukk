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
						
						<!-- modal -->
						<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel1">Tambah Peminjaman</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<table class="table">
										<thead>
											<tr>
												<th>NO</th>
												<th>Nama</th>
												<th>Username</th>
												<th>Level</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($user as $user){ ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $user['nama'] ?></td>
												<td><?= $user['username'] ?></td>
												<td><?= $user['level'] ?></td>
												<td>
													<a href="<?= base_url('admin/peminjaman/transaksi/'.$user['id_user']) ?>" class="btn btn-info" >Pilih</a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- modal end -->
						<div class="card">
							<div class="card-body">
							<div class="row">
								<div class="col-6">
									<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
										Tambah Peminjaman
									</button>
								</div>
								<div class="col-6">
									<div class="d-flex justify-content-end">
										<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#member">
											Tambah Member
										</button>
									</div>
								</div>

							</div>
							
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Kode Peminjaman</th>
										<th>Tanggal Peminjaman</th>
										<th>Tanggal Pengembalian</th>
										<th>Status</th>
										<th>Denda</th>
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
										<td><?= $det['status'] ?></td>
										<span class="badge "></span>
										<td>
											<?php
											$this->db->from('detail');
											$this->db->where('kode_peminjaman',$det['kode_peminjaman']);
											$detail = $this->db->get()->result_array();
									
											$this->db->from('peminjaman');
											$this->db->where('kode_peminjaman',$det['kode_peminjaman']);
											$peminjaman = $this->db->get();
											$row1 = $peminjaman->row();
											$tanggal_pengembalian = $row1->tanggal_pengembalian;
									
											$this->db->from('denda')->where('status','AKTIF');
											$row = $this->db->get()->row();
											$denda = $row->harga_denda;
									
											$jml = count($detail) * $denda;
									
											date_default_timezone_set("Asia/Jakarta");
											$tanggal_kembali = date('Ymd');
									
											$selisih_hari = (strtotime($tanggal_kembali) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24);
											// waktu lalu di kalikan 60 60 24
									
											// menentukan apakah peminjaman kena denda 
											if($selisih_hari > 0){
												$harga_denda = $selisih_hari * $jml;
												echo 'Rp '.number_format($harga_denda);
											} else {
												$harga_denda = 0;
												echo 'tidak punya denda';
											}
											?>
										</td>
										<td>
											<a href="<?= base_url('admin/peminjaman/detail_pinjam/'.$det['kode_peminjaman']) ?>" class="btn btn-info mb-1" ><i class="bx bx-detail"></i></a>
											<a href="<?= base_url('admin/pengembalian/mengembalikan_buku/'.$det['kode_peminjaman']) ?>" class="btn btn-success mb-1" onclick="return confirm('yakin mengembalikan buku')" ><i class="bx bx-book"></i></a>
											<a href="<?= base_url('admin/peminjaman/delete/'.$det['kode_peminjaman']) ?>" class="btn btn-danger mb-1" onclick="return confirm('yakin menghapus?')"><i class="bx bx-trash"></i></a>
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
	 <!-- modal -->
	 <div class="modal fade" id="member" tabindex="-1" style="display: none;" aria-hidden="true">
	 	<div class="modal-dialog" role="document">
	 		<div class="modal-content">
	 			<div class="modal-header">
	 				<h5 class="modal-title" id="exampleModalLabel1">Tambah Member</h5>
	 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	 			</div>
				<div class="modal-body">
				<form action="<?= base_url('admin/user/tambah') ?>" method="post" >
					<input type="hidden" name="level" value="MEMBER" >
					<div class="mb-3">
						<label for="" class="form-label">Nama</label>
						<input type="text" name="nama" class="form-control">
					</div>
					<div class="mb-3">
						<label for="" class="form-label">Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="mb-3">
						<label for="" class="form-label">Email</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="mb-3">
						<label for="" class="form-label">Password</label>
						<input type="password" name="password" class="form-control">
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
	<?php include('layout/_js.php') ?>
</body>

</html>
