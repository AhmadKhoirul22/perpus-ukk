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
                <section class="row">
                    <div class="col-12">
                        <div class="row">
							<div id="autohide">
								<?= $this->session->flashdata('alert'); ?>
							</div>
							<?php foreach($buku as $row){ ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<div class="row">
									<div class="col-lg-4 col-md-12 mb-4">
										<!-- col-lg = col-large -->
										 <!-- col-md = col-medium -->
										<h4><?= $row['judul'] ?></h4>
										<h4>Rating : ⭐<?= number_format($this->Buku_model->rating_buku($row['id_buku']), 1) ?></h4>
										<p>Kategori : <?= $row['nama_kategori'] ?></p>
										<p>Penulis : <?= $row['penulis'] ?></p>
										<p>Penerbit : <?= $row['penerbit'] ?></p>
										<p>Tahun terbit : <?= $row['tahun_terbit'] ?></p>
									</div>
									
									<div class="col-lg-8 col-md-12">
										<?php foreach($rating as $rat){ ?>
											<div class="row mb-3">
												<div class="col-12">
													<h6><i class="iconly-boldProfile"></i> <?= $rat['username'] ?></h6>
													<?php if($rat['id_user'] == $this->session->userdata('id_user')){ ?>
													<div class="col-4">
														<a href="<?= base_url('member/dashboard/hapus_ulasan/'.$rat['id_ulasan']) ?>" onclick="return confirm('yakin dihapus?')" class="btn-sm btn-danger" ><i class="bi bi-trash"></i></a>
														<a href="" class="btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ulasan<?= $rat['id_ulasan'] ?>" ><i class="bi bi-pencil"></i></a>
													</div>
														<!-- modal -->
														<div class="modal fade text-left" id="ulasan<?= $rat['id_ulasan'] ?>" tabindex="-1"
															aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
															<div class="modal-dialog modal-dialog-scrollable" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="myModalLabel1">Update Ulasan</h5>
																		<button type="button" class="close rounded-pill" data-bs-dismiss="modal"
																			aria-label="Close">
																			<i data-feather="x"></i>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form action="<?= base_url('member/dashboard/update_ulasan') ?>" method="post">
																			<input type="hidden" name="id_buku" value="<?= $rat['id_buku'] ?>">
																			<input type="hidden" name="id_ulasan" value="<?= $rat['id_ulasan'] ?>">
																			<input type="hidden" name="id_user"
																				value="<?= $this->session->userdata('id_user') ?>">
																			<div class="mb-2">
																				<label for="" class="form-label">Ulasan</label>
																				<textarea name="ulasan" id="" class="form-control" required><?= $rat['ulasan'] ?></textarea>
																			</div>
																			<div class="mb-2">
																				<label for="" class="form-label">Ratings</label>
																				<select name="rating" class="form-control" id="">
																					<option value="1"<?php if($rat['rating'] == 1){echo 'selected';} ?>  >⭐</option>
																					<option value="2"<?php if($rat['rating'] == 2){echo 'selected';} ?>  >⭐⭐</option>
																					<option value="3"<?php if($rat['rating'] == 3){echo 'selected';} ?>  >⭐⭐⭐</option>
																					<option value="4"<?php if($rat['rating'] == 4){echo 'selected';} ?>  >⭐⭐⭐⭐</option>
																					<option value="5"<?php if($rat['rating'] == 5){echo 'selected';} ?>  >⭐⭐⭐⭐⭐</option>
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
													<?php } ?>
												</div>
												<div class="col-12">
													<p><?= str_repeat('⭐',$rat['rating']) ?></p>
													<p><?= $rat['ulasan'] ?></p>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
								<?php } ?>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include('layout/_js.php') ?>
</body>

</html>
