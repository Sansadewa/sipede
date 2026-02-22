<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url() ?>" class="brand-link">
      <img src="<?php echo base_url('assets/img') ?>/image002.png" alt="Logo BPS" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text" style="font-size: 11pt; font-weight: bold;"><?php echo $this->session->userdata('wilayah')->nama; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/img') ?>/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('username'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- /.ipd sidebar -->
          <li class="nav-item has-treeview">
            <a href="<?= base_url()?>" class="nav-link <?= ($sidebar_aktif=='dashboard' ? 'active':'') ?> ">
              <i class="nav-icon fa fa-home "></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- /.end ipd sidebar -->

          <?php if($this->session->userdata('username') == 'habibpamungkas'): ?>
             <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='spdku' ? 'menu-open':'') ?>">
              <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='spdku' ? 'active':'') ?>">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                  SPD-Ku
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('/spdku') ?>" class="nav-link <?= ($sidebar_aktif=='spdku_index' ? 'active':'') ?>">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('/spdku/kelola') ?>" class="nav-link <?= ($sidebar_aktif=='spdku_kelola' ? 'active':'') ?>">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Kelola</p>
                  </a>
                </li>
              </ul>
          </li> 

          <?php endif; ?>

          <!-- /.ipd sidebar -->
		      <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='mtx' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='mtx' ? 'active':'') ?>">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Matriks Kegiatan
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/matriks_kegiatan') ?>" class="nav-link <?= ($sidebar_aktif=='mtx_main' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Kelola Matriks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kegiatan') ?>" class="nav-link <?= ($sidebar_aktif=='mtx_kegiatan' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Kelola Kegiatan</p>
                </a>
              </li>
            </ul>
          </li> 

          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='baru' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='baru' ? 'active':'') ?>">
              <i class="nav-icon fa fa-envelope fa-fw"></i>
              <p>
                Surat Menyurat
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/kelolanomorsurat/add_form') ?>" class="nav-link <?= ($sidebar_aktif=='baru_tambah_surat_kelola' ? 'active':'') ?>">
                  <i class="fa fa-circle "></i>
                  <p>Tambah Nomor Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kelolanomorsurat') ?>" class="nav-link <?= ($sidebar_aktif=='baru_surat_kelola' ? 'active':'') ?>">
                  <i class="fa fa-circle "></i>
                  <p>Daftar Nomor Surat</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='spd' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='spd' ? 'active':'') ?>">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                SPD
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/spd') ?>" class="nav-link <?= ($sidebar_aktif=='spd_view' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/spd/kelola') ?>" class="nav-link <?= ($sidebar_aktif=='spd_kelola' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Kelola SPD/ST</p>
                </a>
              </li>
              <?php if($this->session->userdata('akses') == 2){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url('/persetujuan_ppk') ?>" class="nav-link <?= ($sidebar_aktif=='spd_ppk' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Persetujuan PPK</p>
                </a>
              </li>
            <?php } ?>
              <li class="nav-item">
                <a href="<?php echo base_url('/surat_bayar') ?>" class="nav-link <?= ($sidebar_aktif=='spd_bayar' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Surat Bayar</p>
                </a>
              </li>
          <!--<li class="nav-item">
                <a href="<?php echo base_url('/podes') ?>" class="nav-link <?= ($sidebar_aktif=='spd_arsip' ? 'active':'') ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kelola Arsip</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- /.end ipd sidebar -->

          <!-- /.Kda sidebar -->
          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='presensi' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='presensi' ? 'active':'') ?>">
              <i class="nav-icon fa fa-spinner fa-fw"></i>
              <p>
                Proses SPD
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/presensi') ?>" class="nav-link <?= ($sidebar_aktif=='presensi_rekap' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Rekap Presensi</p>
                </a>
              </li>
            </ul>
          </li>

          <?php if($this->session->userdata('akses') == 1): ?>

          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='user' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='user' ? 'active':'') ?>">
              <i class="nav-icon fa fa-users fa-fw"></i>
              <p>
                Kelola Pengguna
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/pegawai') ?>" class="nav-link <?= ($sidebar_aktif=='user_pegawai' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php echo base_url('/user') ?>" class="nav-link <?= ($sidebar_aktif=='user_pengguna' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Data Pengguna</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='export' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-download"></i>
              <p>
                Ekspor Data
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/export/spd') ?>" class="nav-link <?= ($sidebar_aktif=='spd' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Rekap SPD</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='master' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-wrench fa-fw"></i>
              <p>
                Pengaturan
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/master_aplikasi') ?>" class="nav-link <?= ($sidebar_aktif=='master_aplikasi' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Master Aplikasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/master_data') ?>" class="nav-link <?= ($sidebar_aktif=='master_data' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Master Data</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-item has-treeview <?= (explode('_', $sidebar_aktif)[0]=='surat' ? 'menu-open':'') ?>">
            <a href="#" class="nav-link <?= (explode('_', $sidebar_aktif)[0]=='surat' ? 'active':'') ?>">
              <i class="nav-icon fa fa-envelope fa-fw"></i>
              <p>
                Surat Menyurat<br>(Sebelum 2023)
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('/kelola_no_surat/add_form') ?>" class="nav-link <?= ($sidebar_aktif=='surat_kelola_tambah' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Tambah Nomor Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/kelola_no_surat') ?>" class="nav-link <?= ($sidebar_aktif=='surat_kelola' ? 'active':'') ?>">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Daftar Nomor Surat</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- /.end kda sidebar -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>