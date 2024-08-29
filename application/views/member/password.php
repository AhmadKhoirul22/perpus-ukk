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
                        <div class="card">
							<div class="card-body">
							<div id="autohide">
								<?= $this->session->flashdata('alert'); ?>
							</div>
							<form action="<?= base_url('member/user/update_password') ?>" method="post" >
								<input type="hidden" name="id_user" value="<?= $user->id_user ?>" >
								<input type="hidden" name="password" value="<?= $user->password ?>" >
								<div class="mb-2">
									<label for="" class="form-label">Old Password</label>
									<input type="password" name="old_password" class="form-control">
								</div>
								<div class="mb-2">
									<label for="" class="form-label">New Password</label>
									<input type="password" name="new_password" class="form-control">
								</div>
								<div class="mb-2">
									<button class="btn btn-info" type="submit" >Change Password</button>
								</div>
							</form>
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
