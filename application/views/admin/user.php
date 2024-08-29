<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/sneat') ?>/assets/"data-template="vertical-menu-template-free">
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
				<div class="card">
					<div class="card-body">
					<div id="autohide" >
							<?= $this->session->flashdata('alert') ?>
						</div>
						<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
							Tambah User
						</button>
						<!-- modal -->
						<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel1">Tambah users</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form action="<?= base_url('admin/user/tambah') ?>" method="post" >
									<div class="modal-body">
										<div class="row g-2">
										<div class="col mb-0">
												<label for="dobBasic" class="form-label">Email</label>
												<input type="email" id="dobBasic" name="email" class="form-control">
											</div>
											<div class="col mb-0">
												<label for="nameBasic" class="form-label">Username</label>
												<input type="text" id="nameBasic" class="form-control" name="username" placeholder="Enter Username">
											</div>
										</div>
										<div class="row g-2">
										<div class="col mb-0">
												<label for="nameBasic" class="form-label">Name</label>
												<input type="text" id="nameBasic" class="form-control" name="nama" placeholder="Enter Name">
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Password</label>
												<input type="password" id="dobBasic" name="password" class="form-control">
											</div>
										</div>
										<div class="row g-2">
										<div class="col mb-0">
												<label for="nameBasic" class="form-label">Level</label>
												<select name="level" class="form-control" id="">
													<option value="ADMIN">ADMIN</option>
													<option value="MEMBER">MEMBER</option>
													<option value="PETUGAS">PETUGAS</option>
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
              			<div class="row">
								<table class="table datatable datatable-table">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Username</th>
											<th>Email</th>
											<th>Level</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach($user as $row){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $row['nama']; ?></td>
											<td><?= $row['username']; ?></td>
											<td><?= $row['email']; ?></td>
											<td><?= $row['level'] ?></td>
											<td>
											<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal<?= $row['id_user'] ?>">
												Update
											</button>
											<a href="<?= base_url('admin/user/delete/'.$row['id_user']) ?>" class="btn btn-danger" onclick="return confirm('yakin dihapus?')" >Delete</a>
											</td>
										</tr>
										<div class="modal fade" id="basicModal<?= $row['id_user'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel1">Update users</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<form action="<?= base_url('admin/user/update') ?>" method="post">
														<input type="hidden" name="id_user" value="<?= $row['id_user'] ?>" id="">
														<div class="modal-body">
															<div class="row g-2">
															<div class="col mb-0">
																	<label for="nameBasic" class="form-label">Email</label>
																	<input type="text" id="nameBasic" class="form-control" name="email"
																		value="<?= $row['email'] ?>" >
																</div>
																<div class="col mb-0">
																	<label for="nameBasic" class="form-label">Username</label>
																	<input type="text" id="nameBasic" class="form-control" name="username"
																		value="<?= $row['username'] ?>" >
																</div>
															</div>
															<div class="row g-2">
															<div class="col mb-0">
																	<label for="nameBasic" class="form-label">Name</label>
																	<input type="text" id="nameBasic" class="form-control" name="nama" value="<?= $row['nama'] ?>" >
																</div>
															</div>
															<div class="row g-2">
															<div class="col mb-0">
																	<label for="nameBasic" class="form-label">Level</label>
																	<select name="level" class="form-control" id="">
																		<option value="ADMIN"<?php if($row['level'] == 'ADMIN'){ echo "selected"; } ?>>ADMIN</option>
																		<option value="MEMBER"<?php if($row['level'] == 'MEMBER'){ echo "selected"; } ?>>MEMBER</option>
																		<option value="PETUGAS"<?php if($row['level'] == 'PETUGAS'){ echo "selected"; } ?>>PEMINJAM</option>
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
