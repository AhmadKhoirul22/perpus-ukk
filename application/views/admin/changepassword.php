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
							<h4>Change Password</h4>
							<form action="<?= base_url('admin/user/ubah_password') ?>" method="post" >
							<input type="hidden" id="dobBasic" name="password" value="<?= $user->password ?>" class="form-control">
							<input type="hidden" id="dobBasic" name="id_user" value="<?= $user->id_user ?>" class="form-control">
							<div class="row">
								<div class="col mb-0">
									<label for="dobBasic" class="form-label">Old Password</label>
									<input type="password" id="dobBasic" name="old_password" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col mb-0">
									<label for="dobBasic" class="form-label">New Password</label>
									<input type="password" id="dobBasic" name="new_password" class="form-control">
								</div>
							</div>
							<button type="submit" class="btn btn-primary mt-3">Submit</button>
							</form>
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
