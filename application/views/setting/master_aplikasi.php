<?php include_once(VIEWPATH.'template/head.php'); ?> 


<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php  include_once(VIEWPATH.'template/navbar.php'); ?> 
<?php  include_once(VIEWPATH.'template/sidebar.php'); ?> 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Aplikasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Aplikasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title"> Pengaturan </h4>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                  <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Umum</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Pejabat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Kode wilayah</a></li>
                  </ul>
                  <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form action="<?= base_url('master_aplikasi/add_setting_umum') ?>" method="POST">
                          <div class="container-fluid">
                            <ul class="nav nav-pills ml-auto p-2">
                              <li class="nav-item"><a class="nav-link active" href="#tab_u_1" data-toggle="tab">Kab/kot</a></li>
                              <li class="nav-item"><a class="nav-link" href="#tab_u_2" data-toggle="tab">Provinsi</a></li>
                              <li class="nav-item"><a class="nav-link" href="#tab_u_3" data-toggle="tab">Pusat</a></li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active" id="tab_u_1">
                              <div class="row">
                                <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Kode Satker</label>
                          <input type="text" name="bps_satker_kode_kab" id="bps_satker_kode_kab" class="form-control" value="<?= $setting['bps_satker_kode_kab']?>" >
                        </div>
                        <div class="form-group">
                          <label>Wilayah Satker</label>
                          <input type="text" name="bps_satker_name_kab" id='bps_satker_name_kab' class="form-control" value="<?= $setting['bps_satker_name_kab']?>" >
                        </div>
                        <div class="form-group">
                          <label>Kota Kantor Berada</label>
                          <input type="text" name="bps_city_kab" id="bps_city_kab" class="form-control" value="<?= $setting['bps_city_kab']?>" >
                        </div>
                        <div class="form-group">
                          <label>Alamat Kantor</label>
                          <input type="text" name="bps_address_kab" id="bps_address_kab" class="form-control" value="<?= $setting['bps_address_kab']?>" >
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Alamat Website</label>
                          <input type="text" name="bps_website_kab" id="bps_website_kab" class="form-control" value="<?= $setting['bps_website_kab']?>" >
                        </div>
                        <div class="form-group">
                          <label>Alamat Email</label>
                          <input type="email" name="bps_email_kab" id="bps_email_kab" class="form-control" value="<?= $setting['bps_email_kab']?>" >
                        </div>
                        <div class="form-group">
                          <label>No Telepon</label>
                          <input type="text" name="bps_phone_kab" id="bps_phone_kab" class="form-control" value="<?= $setting['bps_phone_kab']?>" >
                        </div>
                        <div class="form-group">
                          <label>No Fax</label>
                          <input type="text" name="bps_fax_kab" id="bps_fax_kab" class="form-control" value="<?= $setting['bps_fax_kab']?>" >
                        </div>
                      </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="tab_u_2">
                              <div class="row">
                                <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Kode Satker</label>
                          <input type="text" name="bps_satker_kode_prov" id="bps_satker_kode_prov" class="form-control" value="<?= $setting['bps_satker_kode_prov']?>" >
                        </div>
                        <div class="form-group">
                          <label>Wilayah Satker</label>
                          <input type="text" name="bps_satker_name_prov" id='bps_satker_name_prov' class="form-control" value="<?= $setting['bps_satker_name_prov']?>" >
                        </div>
                        <div class="form-group">
                          <label>Kota Kantor Berada</label>
                          <input type="text" name="bps_city_prov" id="bps_city_prov" class="form-control" value="<?= $setting['bps_city_prov']?>" >
                        </div>
                        <div class="form-group">
                          <label>Alamat Kantor</label>
                          <input type="text" name="bps_address_prov" id="bps_address_prov" class="form-control" value="<?= $setting['bps_address_prov']?>" >
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Alamat Website</label>
                          <input type="text" name="bps_website_prov" id="bps_website_prov" class="form-control" value="<?= $setting['bps_website_prov']?>" >
                        </div>
                        <div class="form-group">
                          <label>Alamat Email</label>
                          <input type="email" name="bps_email_prov" id="bps_email_prov" class="form-control" value="<?= $setting['bps_email_prov']?>" >
                        </div>
                        <div class="form-group">
                          <label>No Telepon</label>
                          <input type="text" name="bps_phone_prov" id="bps_phone_prov" class="form-control" value="<?= $setting['bps_phone_prov']?>" >
                        </div>
                        <div class="form-group">
                          <label>No Fax</label>
                          <input type="text" name="bps_fax_prov" id="bps_fax_prov" class="form-control" value="<?= $setting['bps_fax_prov']?>" >
                        </div>
                      </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="tab_u_3">
                              <div class="row">
                                <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Kode Satker</label>
                          <input type="text" name="bps_satker_kode_ind" id="bps_satker_kode_ind" class="form-control" value="<?= $setting['bps_satker_kode_ind']?>" >
                        </div>
                        <div class="form-group">
                          <label>Wilayah Satker</label>
                          <input type="text" name="bps_satker_name_ind" id='bps_satker_name_ind' class="form-control" value="<?= $setting['bps_satker_name_ind']?>" >
                        </div>
                        <div class="form-group">
                          <label>Kota Kantor Berada</label>
                          <input type="text" name="bps_city_ind" id="bps_city_ind" class="form-control" value="<?= $setting['bps_city_ind']?>" >
                        </div>
                        <div class="form-group">
                          <label>Alamat Kantor</label>
                          <input type="text" name="bps_address_ind" id="bps_address_ind" class="form-control" value="<?= $setting['bps_address_ind']?>" >
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Alamat Website</label>
                          <input type="text" name="bps_website_ind" id="bps_website_ind" class="form-control" value="<?= $setting['bps_website_ind']?>" >
                        </div>
                        <div class="form-group">
                          <label>Alamat Email</label>
                          <input type="email" name="bps_email_ind" id="bps_email_ind" class="form-control" value="<?= $setting['bps_email_ind']?>" >
                        </div>
                        <div class="form-group">
                          <label>No Telepon</label>
                          <input type="text" name="bps_phone_ind" id="bps_phone_ind" class="form-control" value="<?= $setting['bps_phone_ind']?>" >
                        </div>
                        <div class="form-group">
                          <label>No Fax</label>
                          <input type="text" name="bps_fax_ind" id="bps_fax_ind" class="form-control" value="<?= $setting['bps_fax_ind']?>" >
                        </div>
                      </div>
                              </div>
                            </div>
                            </div>
                          </div>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>

                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <form action="<?= base_url('master_aplikasi/add_setting_pejabat') ?>" method="POST">
                      <div class="container-fluid">
                            <ul class="nav nav-pills ml-auto p-2">
                              <li class="nav-item"><a class="nav-link active" href="#tab_u_4" data-toggle="tab">Kab/kot</a></li>
                              <li class="nav-item"><a class="nav-link" href="#tab_u_5" data-toggle="tab">Provinsi</a></li>
                              <li class="nav-item"><a class="nav-link" href="#tab_u_6" data-toggle="tab">Pusat</a></li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active" id="tab_u_4">
                              <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label>KPA dengan Gelar</label>
                                      <input type="text" name="bps_head_kab" id="bps_head_kab" class="form-control" value="<?= $setting['bps_head_kab']?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label>KPA tanpa Gelar</label>
                                      <input type="text" name="bps_head_kab" id="bps_head_kab" class="form-control" value="<?= $setting['bps_head_kab']?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>NIP Kuasa Pengguna Anggaran</label>
                                    <input type="text" name="bps_head_nip_kab" id="bps_head_nip_kab" class="form-control" value="<?= $setting['bps_head_nip_kab']?>">
                                  </div>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>Pejabat Pembuat Komitmen</label>
                                    <input type="text" name="bps_ppk_kab" id="bps_ppk_kab" class="form-control" value="<?= $setting['bps_ppk_kab']?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Bendahara Pengeluaran</label>
                                    <input type="text" name="bps_bendahara_kab" id="bps_bendahara_kab" class="form-control" value="<?= $setting['bps_bendahara_kab']?>">
                                  </div>

                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>NIP Pejabat Pembuat Komitmen</label>
                                    <input type="text" name="bps_ppk_nip_kab" id="bps_ppk_nip_kab" class="form-control" value="<?= $setting['bps_ppk_nip_kab']?>">
                                  </div>
                                  <div class="form-group">
                                    <label>NIP Bendahara Pengeluaran</label>
                                    <input type="text" name="bps_bendahara_nip_kab" id="bps_bendahara_nip_kab" class="form-control" value="<?= $setting['bps_bendahara_nip_kab']?>">
                                  </div>
                                </div>
                            </div>
                          </div>
                            <div class="tab-pane" id="tab_u_5">
                              <div class="row">
                              <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                  <label>KPA dengan gelar</label>
                                  <input type="text" name="bps_head_prov" id="bps_head_prov" class="form-control" value="<?= $setting['bps_head_prov']?>">
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                  <label>KPA tanpa gelar</label>
                                  <input type="text" name="bps_head_prov2" id="bps_head_prov2" class="form-control" value="<?= $setting['bps_head_prov2']?>">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                  <label>NIP Kuasa Pengguna Anggaran</label>
                                  <input type="text" name="bps_head_nip_prov" id="bps_head_nip_prov" class="form-control" value="<?= $setting['bps_head_nip_prov']?>">
                                </div>
                              </div>
                            </div>
                              <div class="row">
                              <div class="col-lg-6 col-md-6">                              
                                <div class="form-group">
                                  <label>Pejabat Pembuat Komitmen</label>
                                  <input type="text" name="bps_ppk_prov" id="bps_ppk_prov" class="form-control" value="<?= $setting['bps_ppk_prov']?>">
                                </div>
                                <div class="form-group">
                                  <label>Bendahara Pengeluaran</label>
                                  <input type="text" name="bps_bendahara_prov" id="bps_bendahara_prov" class="form-control" value="<?= $setting['bps_bendahara_prov']?>">
                                </div>

                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                  <label>NIP Pejabat Pembuat Komitmen</label>
                                  <input type="text" name="bps_ppk_nip_prov" id="bps_ppk_nip_prov" class="form-control" value="<?= $setting['bps_ppk_nip_prov']?>">
                                </div>
                                <div class="form-group">
                                  <label>NIP Bendahara Pengeluaran</label>
                                  <input type="text" name="bps_bendahara_nip_prov" id="bps_bendahara_nip_prov" class="form-control" value="<?= $setting['bps_bendahara_nip_prov']?>">
                                </div>
                              </div>
                            </div>
                            </div>
                            <div class="tab-pane" id="tab_u_6">
                              <div class="row">
                                <div class="col-lg-3 col-md-3">
                                  <div class="form-group">
                                    <label>KPA dengan Gelar</label>
                                    <input type="text" name="bps_head_ind" id="bps_head_ind" class="form-control" value="<?= $setting['bps_head_ind']?>">
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                  <div class="form-group">
                                    <label>KPA tanpa Gelar</label>
                                    <input type="text" name="bps_head_ind" id="bps_head_ind" class="form-control" value="<?= $setting['bps_head_ind']?>">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>NIP Kuasa Pengguna Anggaran</label>
                                    <input type="text" name="bps_head_nip_ind" id="bps_head_nip_ind" class="form-control" value="<?= $setting['bps_head_nip_ind']?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>Kuasa Pengguna Anggaran</label>
                                    <input type="text" name="bps_head_ind" id="bps_head_ind" class="form-control" value="<?= $setting['bps_head_ind']?>">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>Pejabat Pembuat Komitmen</label>
                                    <input type="text" name="bps_ppk_ind" id="bps_ppk_ind" class="form-control" value="<?= $setting['bps_ppk_ind']?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Bendahara Pengeluaran</label>
                                    <input type="text" name="bps_bendahara_ind" id="bps_bendahara_ind" class="form-control" value="<?= $setting['bps_bendahara_ind']?>">
                                  </div>

                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>NIP Kuasa Pengguna Anggaran</label>
                                    <input type="text" name="bps_head_nip_ind" id="bps_head_nip_ind" class="form-control" value="<?= $setting['bps_head_nip_ind']?>">
                                  </div>
                                  <div class="form-group">
                                    <label>NIP Pejabat Pembuat Komitmen</label>
                                    <input type="text" name="bps_ppk_nip_ind" id="bps_ppk_nip_ind" class="form-control" value="<?= $setting['bps_ppk_nip_ind']?>">
                                  </div>
                                  <div class="form-group">
                                    <label>NIP Bendahara Pengeluaran</label>
                                    <input type="text" name="bps_bendahara_nip_ind" id="bps_bendahara_nip_ind" class="form-control" value="<?= $setting['bps_bendahara_nip_ind']?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                           <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                  </div>
                  <div class="tab-pane" id="tab_3">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card card-default">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                              <label> Masukkan kode wilayah Kab/kota</label>
                              <input type="text" name="kode" id="kode" class="form-control" value="<?= $kode ?>">
                              <br>
                              <button class="btn btn-sm btn-primary" onclick="simpan_kode()">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                  </div>
                  <!-- /.tab-pane -->
<!--                   <div class="tab-pane" id="tab_3">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card card-default">
                            <div class="card-header">
                              <h3 class="card-title">
                                <i class="fa fa-refresh"></i>
                                  Input File Update
                              </h3>
                            </div>
                            <div class="card-body">
                              <form action="<?= base_url('master_aplikasi/update')?>" method="POST">
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="file_update" name="file_update">
                                      <label class="custom-file-label">Pilih File</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Update</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card card-default">
                            <div class="card-header">
                              <h3 class="card-title">
                                <i class="fa fa-history"></i>
                                  History Updates
                              </h3>
                            </div> -->
                            <!-- /.card-header -->
<!--                             <div class="card-body">

                              <div class="callout callout-info">
                                <h5>Versi 1</h5>
                                <p>Daftar Pembaharuan:</p>
                                <ul>
                                  <li>Inisial Release</li>
                                </ul>
                              </div>
                             
                            </div> -->
                            <!-- /.card-body -->
                         <!--  </div> -->
                          <!-- /.card -->
<!--                         </div>
                    </div>
                  </div> -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>

<script type="text/javascript">
   function simpan_kode(){
     $.ajaxSetup({
      type:"POST",
      url: "<?php echo base_url('master_aplikasi/add_wilayah') ?>",
      cache: false,
    });

    $.ajax({
      data:{kode:$('#kode').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
          $('#kode').val(respond['kode']);
          window.location.href = '<?= base_url('login/logout') ?>'
          
        }
      }
    })
   }
</script>

</body>
</html>
