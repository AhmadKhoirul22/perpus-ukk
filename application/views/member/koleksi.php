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
							<?php foreach($koleksi as $row){ ?>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
										<a href="<?= base_url('member/dashboard/detail_buku/'.$row['id_buku']) ?>">
                                       <h4><?= $row['judul'] ?></h4>
									   <p>Kategori : <?= $row['nama_kategori'] ?></p>
									   <p>Penulis : <?= $row['penulis'] ?></p>
									   <p>Penerbit : <?= $row['penerbit'] ?></p>
									   <p>Tahun terbit : <?= $row['tahun_terbit'] ?></p>
									   <p>Ratings : ⭐<?= number_format($this->Buku_model->rating_buku($row['id_buku']), 1)  ?></p>
									   <a onclick="return confirm('yakin hapus dari koleksi?')" href="<?= base_url('member/koleksi/delete/'.$row['id_koleksi']) ?>" class="btn btn-danger" ><i class="bi bi-trash"></i></a>
									   </a>
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
