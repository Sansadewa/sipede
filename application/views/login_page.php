<?php include_once(VIEWPATH.'template/head.php'); ?> 

</style>
<body>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>" style="color: blue;font-weight: 200;"><b>SIPEDE</b> Sistem Informasi Perjalanan Dinas</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login Dahulu</p>

      <form action="<?php echo base_url('login/aksi_login'); ?>" method="post">
        <div class="form-group has-feedback">
          <input class="form-control" placeholder="Username" name="username" type="text">
        </div>
        <div class="form-group has-feedback">
          <input class="form-control" placeholder="Password" name="password" type="password" value="">
        </div>
        <div class="row">
        	<div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include_once(VIEWPATH.'template/footer-script.php'); ?> 
<script type="text/javascript" src="<?php echo base_url('assets/js/backstretch.min.js') ?>"></script>
<script type="text/javascript">
  $.backstretch("<?php echo base_url('assets/img/login-bg.jpg')?>", {speed: 500});

</script>
</body>
