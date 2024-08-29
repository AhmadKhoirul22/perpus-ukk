<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/sneat') ?>/assets/"
  data-template="vertical-menu-template-free">
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
							
							<div class="col-lg-12 col-md-4 order-1">
								<!-- pembuka row -->
                  <div class="row">
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="<?= base_url('assets/sneat') ?>/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                            </div>
                          </div>
                          <span class="">Total Buku</span>
                          <h3 class="card-title mb-2"><?= count($buku) ?></h3>
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="<?= base_url('assets/sneat') ?>/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                            </div>
                          </div>
                          <span>Total Kategori</span>
                          <h3 class="card-title text-nowrap mb-2"><?= count($kategori) ?></h3>
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                      </div>
                    </div>
										<div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <!-- <img src="<?= base_url('assets/sneat') ?>/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded"> -->
															 <i class="bx bx-user"></i>
                            </div>
                          </div>
                          <span>Total Member</span>
                          <h3 class="card-title text-nowrap mb-2"><?= count($member) ?></h3>
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                      </div>
                    </div>
										<div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <!-- <img src="<?= base_url('assets/sneat') ?>/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded"> -->
															 <i class="bx bx-dollar"></i>
                            </div>
                          </div>
                          <span>Denda Perbuku</span>
                          <h3 class="card-title text-nowrap mb-2">Rp <?= number_format($denda->harga_denda) ?></h3>
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                      </div>
                    </div>
                  </div>
									<!-- penutup row -->
									 <div class="row">
									 <div class="col-md-6 col-lg-6 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Peminjaman Buku Terbanyak</h5>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
												<?php foreach($peminjaman_terbanyak as $row){ ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="<?= base_url('assets/sneat') ?>/assets/img/icons/unicons/cc-success.png" alt="User" class="rounded">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <!-- <small class="text-muted d-block mb-1"><?= $row['judul'] ?></small> -->
                              <h6 class="mb-0"><?= $row['judul'] ?></h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0"><?= $row['jumlah_peminjaman'] ?></h6>
                              <span class="text-muted">Buku</span>
                            </div>
                          </div>
                        </li>
												<?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
								<div class="col-md-6 col-lg-6 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Aktivitas Peminjaman Buku Terbaru</h5>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
												<?php foreach($activity as $row){ ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="<?= base_url('assets/sneat') ?>/assets/img/icons/unicons/cc-success.png" alt="User" class="rounded">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0"><?= $row['nama'] ?></h6>
                              <small class="text-muted d-block mb-1"><?= tanggal_indo($row['tanggal_peminjaman']) ?></small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <a href="<?= base_url('admin/peminjaman/detail_pinjam/'.$row['kode_peminjaman']) ?>" class="btn btn-success" ><i class="bx bx-book"></i></a>
                            </div>
                          </div>
                        </li>
												<?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
									 </div> //penutup row
									 
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
