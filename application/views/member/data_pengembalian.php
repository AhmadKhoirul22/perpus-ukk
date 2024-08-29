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
				<section class="section">
					<div class="card">
						<div class="card-body">
							<table class="table" id="table1">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Peminjaman</th>
										<th>Tanggal Peminjaman</th>
										<th>Tanggal Pengembalian</th>
										<th>Tanggal Kembali</th>
										<th>Denda</th>
										<th>Status</th>
										<th>AKsi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; foreach($pengembalian as $minjam){ ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $minjam['kode_peminjaman'] ?></td>
										<td><?= tanggal_indo($minjam['tanggal_peminjaman']) ?></td>
										<td><?= tanggal_indo($minjam['tanggal_pengembalian']) ?></td>
										<td><?= tanggal_indo($minjam['tanggal_kembali']) ?></td>
										<td>
										<?php
											$this->db->from('detail');
											$this->db->where('kode_peminjaman',$minjam['kode_peminjaman']);
											$detail = $this->db->get()->result_array();
									
											$this->db->from('peminjaman');
											$this->db->where('kode_peminjaman',$minjam['kode_peminjaman']);
											$peminjaman = $this->db->get();
											$row1 = $peminjaman->row();
											$tanggal_pengembalian = $row1->tanggal_pengembalian;
											$tanggal_kembali = $row1->tanggal_kembali;
									
											$this->db->from('denda')->where('status','AKTIF');
											$row = $this->db->get()->row();
											$denda = $row->harga_denda;
									
											$jml = count($detail) * $denda;
									
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
										<td><?= $minjam['status'] ?></td>
										<td>
											<a href="<?= base_url('member/data_pengembalian/detail/'.$minjam['kode_peminjaman']) ?>" class="btn btn-info" >Detail</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>

				</section>
			</div>
		</div>
	</div>
	<?php include('layout/_js.php') ?>
</body>

</html>
