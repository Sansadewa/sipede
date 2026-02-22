  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:;" data-target="#modal-kontak" data-toggle="modal" class="nav-link">Kontak</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
<!--    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> --!>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-sign-out-alt"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <a href="<?php echo base_url('login/logout') ?>" class="dropdown-item">Logout</a>
            </div>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      
<!--       <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li> -->
    </ul>

  </nav>
  <!-- /.navbar -->


    <div class="modal modal-primary fade" id="modal-kontak" tabindex="-1" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Kontak Kami</h5>
              </div>
              <div class="modal-body">
                <div class="col-sm-12">
                  <p> Jika memerlukan bantuan terkait aplikasi ini, ataupun ingin melaporkan permasalahan, silahkan hubungi melalui email berikut. </p>
                <ul>
                  <li>
                    <a href="mailto:habibpamungkas@bps.go.id"><i class="fa fa-envelope-o"></i> habibpamungkas@bps.go.id</a>
                  </li>
                  <li>
                    <a href="https://kalsel.bps.go.id"><i class="fa fa-building"></i> BPS Provinsi Kalimantan Selatan</a>
                  </li>
                </ul>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>