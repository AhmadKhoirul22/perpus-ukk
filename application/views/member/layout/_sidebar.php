<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?= base_url('member/dashboard') ?>"><img src="<?= base_url('assets/mazer/dist/') ?>assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
						<?php $menu = $this->uri->segment(2); ?>
                        <li class="sidebar-item <?php if($menu == 'dashboard'){echo 'active';} ?>">
                            <a href="<?= base_url('member/dashboard') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if($menu == 'data_peminjaman'){echo 'active';} ?>">
                            <a href="<?= base_url('member/data_peminjaman') ?>" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Data Peminjaman</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if($menu == 'data_pengembalian'){echo 'active';} ?>">
                            <a href="<?= base_url('member/data_pengembalian') ?>" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Data Pengembalian</span>
                            </a>
                        </li>

						<li class="sidebar-item <?php if($menu == 'koleksi'){echo 'active';} ?>">
                            <a href="<?= base_url('member/koleksi/') ?>" class='sidebar-link'>
                                <i class="bi bi-bookmark"></i>
                                <span>Koleksi</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Account</li>
						<li class="sidebar-item">
                            <a href="<?= base_url('member/user/profile/'.$this->session->userdata('id_user')) ?>" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Profile</span>
                            </a>
                        </li>
						<li class="sidebar-item">
                            <a href="<?= base_url('member/user/password/'.$this->session->userdata('id_user')) ?>" class='sidebar-link'>
                                <i class="bi bi-eye"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
						<li class="sidebar-item">
                            <a href="<?= base_url('auth/logout') ?>" onclick="return confirm('yakin logout?')" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
