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
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-lg-6">
												<form action="">
													<div class="mb-2">
														<label for="" class="form-label">Kode Peminjaman</label>
														<input type="text" class="form-control" value="<?= $user->kode_peminjaman ?>" readonly >
													</div>
													<div class="mb-2">
														<label for="" class="form-label">Tanggal Peminjaman</label>
														<input type="text" class="form-control" value="<?= tanggal_indo($user->tanggal_peminjaman) ?>" readonly >
													</div>
													<div class="mb-2">
														<label for="" class="form-label">Tanggal Pengembalian</label>
														<input type="text" class="form-control" value="<?= tanggal_indo($user->tanggal_pengembalian) ?>" readonly >
													</div>
													<div class="mb-2">
														<label for="" class="form-label">Tanggal Kembali</label>
														<input type="text" class="form-control" value="<?= $user->tanggal_kembali ?>" readonly >
													</div>
												</form>
											</div>
											<div class="col-lg-6">
												<form action="">
													<div class="mb-2">
														<label for="" class="form-label">Denda</label>
														<input type="text" class="form-control" readonly value="
<?php
if($user->status == 'DIKEMBALIKAN'){
	if($denda->denda != null){
		echo 'Rp '.number_format($denda->denda);

	} else {
		echo 'Rp 0';
	}
} else if($user->status == 'DIPINJAM'){

    // Mendapatkan data detail peminjaman
    $detail_peminjaman = $this->db->from('detail')
                        ->where('kode_peminjaman', $user->kode_peminjaman)
                        ->get()
                        ->result_array();
    
    // Mendapatkan tanggal pengembalian dari tabel peminjaman
    $row1 = $this->db->from('peminjaman')
                     ->where('kode_peminjaman', $user->kode_peminjaman)
                     ->get()
                     ->row();
    $tanggal_pengembalian = $row1->tanggal_pengembalian;
    
    // Mendapatkan harga denda yang aktif
    $row = $this->db->from('denda')
                    ->where('status', 'AKTIF')
                    ->get()
                    ->row();
    $harga_denda = $row->harga_denda;
    
    // Menghitung total denda per hari
    $jml = count($detail_peminjaman) * $harga_denda;
    
    // Mengambil tanggal saat ini
    date_default_timezone_set("Asia/Jakarta");
    $tanggal_kembali = date('Ymd');
    
    // Menghitung selisih hari keterlambatan
    $selisih_hari = (strtotime($tanggal_kembali) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24);
    
    // Menentukan apakah peminjaman kena denda
    if ($selisih_hari > 0) {
        $harga_denda_total = $selisih_hari * $jml;
        echo 'Rp ' .number_format($harga_denda_total);
    } else {
        echo 'tidak punya denda';
    }
}
?>" >
													</div>
												</form>
												<h3>Buku yang dipinjam</h3>
												<table class="table">
													<thead>
														<tr>
															<th>No</th>
															<th>Judul</th>
															<th>Penerbit</th>
															<th>Tahun</th>
														</tr>
													</thead>
													<tbody>
														<?php $no=1; foreach($detail as $detail){ ?>
														<tr>
															<td><?= $no++ ?></td>
															<td><?= $detail['judul'] ?></td>
															<td><?= $detail['penerbit'] ?></td>
															<td><?= $detail['tahun_terbit'] ?></td>
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
