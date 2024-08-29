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
                <h3><?= $title ?>, <?= $this->session->userdata('username') ?></h3>
            </div>
			<button type="button" class="btn btn-outline-primary block mb-3" data-bs-toggle="modal" data-bs-target="#default">
            Cari Buku
            </button>
			<!-- modal -->
			<div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true"
				style="display: none;">
				<div class="modal-dialog modal-dialog-scrollable" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel1">Cari Buku</h5>
							<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
								<i data-feather="x"></i>
							</button>
						</div>
						<div class="modal-body">
							<form action="<?= base_url('member/dashboard/search') ?>" method="get">
								<label for="" class="form-label">Nama Buku</label>
								<input type="search" name="keyword" class="form-control">
						</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-dark" data-bs-dismiss="modal">
								<i class="bx bx-x d-block d-sm-none"></i>
								<span class="d-none d-sm-block">Close</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			 <!-- modal -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
							<div id="autohide">
								<?= $this->session->flashdata('alert'); ?>
							</div>
							<?php foreach($buku as $row){ ?>
                            <div class="col-4">
                                <div class="card">
									<div class="card-content">
									<div class="card-body">
										<a href="<?= base_url('member/dashboard/detail_buku/'.$row['id_buku']) ?>">
                                       <h4><?= $row['judul'] ?></h4>
									   <p>Kategori : <?= $row['nama_kategori'] ?></p>
									   <p>Penulis : <?= $row['penulis'] ?></p>
									   <p>Penerbit : <?= $row['penerbit'] ?></p>
									   <p>Tahun terbit : <?= $row['tahun_terbit'] ?></p>
									   <p>Ratings : ⭐<?= number_format($this->Buku_model->rating_buku($row['id_buku']), 1)  ?></p>
									   </a>
									   <div class="row">
										<div class="col-6">
										<form action="<?= base_url('member/koleksi/tambah_koleksi') ?>" method="post" >
										<input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>" >
										<input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>" >
										<button class="btn btn-info" type="submit" ><i class="bi bi-bookmark"></i></button>
									   </form>
										</div>
										<div class="col-6">
										<div class="d-flex justify-content-end">
									   <button type="submit" class="btn btn-outline-success block mb-3" data-bs-toggle="modal" data-bs-target="#ulasan<?= $row['id_buku'] ?>">
										<i class="bi bi-chat"></i>
            							</button>
									   </div>
										</div>
									   </div>
										<!-- modal -->
										<div class="modal fade text-left" id="ulasan<?= $row['id_buku'] ?>" tabindex="-1" aria-labelledby="myModalLabel1"
											aria-hidden="true" style="display: none;">
											<div class="modal-dialog modal-dialog-scrollable" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="myModalLabel1">Beri Ulasan</h5>
														<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
															<i data-feather="x"></i>
														</button>
													</div>
													<div class="modal-body">
														<form action="<?= base_url('member/dashboard/tambah_ulasan') ?>" method="post">
															<input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>"  >
															<input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>"  >
															<div class="mb-2">
															<label for="" class="form-label">Ulasan</label>
															<textarea name="ulasan" id="" class="form-control" required ></textarea>
															</div>
															<div class="mb-2">
																<label for="" class="form-label">Ratings</label>
																<select name="rating" class="form-control" id="">
																	<option value="1">⭐</option>
																	<option value="2">⭐⭐</option>
																	<option value="3">⭐⭐⭐</option>
																	<option value="4">⭐⭐⭐⭐</option>
																	<option value="5">⭐⭐⭐⭐⭐</option>
																</select>
															</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn" data-bs-dismiss="modal">
															<i class="bx bx-x d-block d-sm-none"></i>
															<span class="d-none d-sm-block">Close</span>
														</button>
														<button type="submit" class="btn btn-primary ml-1">
															<i class="bx bx-check d-block d-sm-none"></i>
															<span class="d-none d-sm-block">Submit</span>
														</button>
													</div>
														</form>
												</div>
											</div>
										</div>
										<!-- modal -->
                                    </div>
									</div>
                                    
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include('layout/_js.php') ?>
</body>

</html>
