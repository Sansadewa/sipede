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
            <h1 class="m-0 text-dark">Master Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Data</li>
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
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Master Jabatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Master Pangkat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Master Akun Bayar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Kategori Surat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_6" data-toggle="tab">Mesin Absensi</a></li>
                   <!--  <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Backup Data</a></li> -->
                  </ul>
                  <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <br>
                    <button type="button" class="btn btn-success btn-sm"
                            data-toggle="modal"
                            data-target="#modal-add-jabatan"
                            title="Tambah Jabatan">
                            Tambah
                      <i class="fa fa-plus"></i>
                    </button>
                      <br><br>
                        <table id="table_jabatan" style="width: 100%;" class="table table-striped">
                          <thead>
                            <th>Id</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                          </thead>
                        </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2"><br>
                    <button type="button" class="btn btn-success btn-sm"
                            data-toggle="modal"
                            data-target="#modal-add-pangkat"
                            title="Tambah Pangkat">
                            Tambah
                      <i class="fa fa-plus"></i>
                    </button><br><br>
                            <table id="table_pangkat" style="width: 100%;" class="table table-striped">
                          <thead>
                            <th>Id</th>
                            <th>Deskripsi</th>
                            <th>Pangkat</th>
                            <th>Aksi</th>
                          </thead>
                        </table>
                  </div>
                  <div class="tab-pane" id="tab_3"><br>
                    <button type="button" class="btn btn-success btn-sm"
                            data-toggle="modal"
                            data-target="#modal-add-akun"
                            title="Tambah Akun Bayar">
                            Tambah
                      <i class="fa fa-plus"></i>
                    </button><br><br>
                        <table id="table_akun" style="width: 100%;" class="table table-striped">
                          <thead>
                            <th>No Akun</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                          </thead>
                        </table>
                  </div>
                  <div class="tab-pane" id="tab_4"><br>
                      <button type="button" class="btn btn-success btn-sm"
                            data-toggle="modal"
                            data-target="#modal-add-kategori"
                            title="Tambah Kategori Surat">
                            Tambah
                      <i class="fa fa-plus"></i>
                    </button><br><br>
                        <table id="table_kategori_surat" style="width: 100%;" class="table table-striped">
                          <thead>
                            <th>Id</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                          </thead>
                        </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_5">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card card-default">
                            <div class="card-header">
                              <h3 class="card-title">
                                <i class="fa fa-refresh"></i>
                                  Backup/restore data
                              </h3>
                            </div>
                            <div class="card-body">
                              Coming soon...
                            </div>
                          </div>
                        </div>
                      </div>
                      
                  </div>
                  <div class="tab-pane" id="tab_6">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card card-default">
                            <div class="card-header">
                              <h3 class="card-title">
                                <i class="fa fa-refresh"></i>
                                  Koneksi Mesin Absen
                              </h3>
                            </div>
                            <div class="card-body">
                              <label> Masukkan ip mesin absen</label>
                              <input type="text" name="ip_mesin" id="ip_mesin" class="form-control" value="<?= $ip_mesin ?>">
                              <br>
                              <button class="btn btn-sm btn-primary" onclick="simpan_mesin()">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                  </div>
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

    <!-- MODAL ADD -->
    <div class="modal fade" id="modal-add-pangkat" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Pangkat</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="deskripsi_pangkat" class="form-control" id="deskripsi_pangkat">
                </div>
                <div class="form-group">
                  <label>Golongan</label>
                  <input type="text" name="golongan" class="form-control" maxlength="18" id="golongan">
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_pangkat()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <div class="modal fade" id="modal-add-jabatan" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="deskripsi_jabatan" class="form-control" id="deskripsi_jabatan">
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_jabatan()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <div class="modal fade" id="modal-add-akun" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Akun Bayar</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Akun Bayar</label>
                  <input type="text" name="no_akun" class="form-control" maxlength="50" id="no_akun">
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="deskripsi_akun" class="form-control" id="deskripsi_akun">
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_akun_bayar()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <div class="modal fade" id="modal-add-kategori" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Surat</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="deskripsi_kategori" class="form-control" id="deskripsi_kategori">
                </div>
                <div class="form-group">
                  <label>Template</label>
                  <input type="text" name="template_kategori" class="form-control" id="template_kategori">
                  {NUM} : generate angka
                  {BLN} : generate bulan
                  {THN} : generate tahun
                </div>
                <div class="form-group">
                  <label>Set Jenis</label>
                  <select class="form-control" name="jenis" id="jenis">
                    <option value="1">Surat Tugas</option>
                    <option value="2">Surat Perjadin</option>
                    <option value="3">Surat Bayar</option>
                    <option value="4">Surat Umum</option>
                  </select>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_kategori()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

    <!-- END MODAL ADD -->

    <!-- MODAL EDIT KONFIRMASI -->
    <!-- Modal edit -->
    <div class="modal fade" id="modal-edit-pangkat" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Pangkat</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Id</label>
                  <input type="text" name="id_pangkat_edit" class="form-control" maxlength="18" id="id_pangkat_edit" readonly>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="deskripsi_pangkat_edit" class="form-control" id="deskripsi_pangkat_edit">
                </div>
                <div class="form-group">
                  <label>Golongan</label>
                  <input type="text" name="golongan" class="form-control" id="golongan_edit">
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_edit_pangkat()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

        <div class="modal fade" id="modal-edit-kategori" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Ketegori</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Id</label>
                  <input type="text" name="id_kategori_edit" class="form-control" maxlength="18" id="id_kategori_edit" readonly>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="nama" class="form-control" id="deskripsi_kategori_edit">
                </div>
                <div class="form-group">
                  <label>Template</label>
                  <input type="text" name="template_kategori_edit" class="form-control" id="template_kategori_edit">
                  {NUM} : generate angka
                  {BLN} : generate bulan
                  {THN} : generate tahun
                </div>
                <div class="form-group">
                  <label>Set Jenis</label>
                  <select class="form-control" name="jenis_edit" id="jenis_edit">
                    <option value="1">Surat Tugas</option>
                    <option value="2">Surat Perjadin</option>
                    <option value="3">Surat Bayar</option>
                    <option value="4">Surat Umum</option>
                  </select>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_edit_kategori()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <div class="modal fade" id="modal-edit-akun" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Akun Bayar</h5>
              </div>
              <div class="modal-body">
                <input type="hidden" name="no_akun_lama" id="no_akun_lama">
                <div class="form-group">
                  <label>Nomor Akun</label>
                  <input type="text" name="no_akun" class="form-control" id="no_akun_edit">
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="nama" class="form-control" id="deskripsi_akun_edit">
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_edit_akun_bayar()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <div class="modal fade" id="modal-edit-jabatan" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Jabatan</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Id</label>
                  <input type="text" name="id_jabatan_edit" class="form-control" maxlength="18" id="id_jabatan_edit" readonly>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="text" name="nama" class="form-control" id="deskripsi_jabatan_edit">
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_edit_jabatan()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>


      <!-- Konfirmasi hapus -->
      <div class="modal modal-danger fade" id="modal-konfirmasi-jabatan" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Jabatan</h5>
              </div>
              <div class="modal-body" id="pesan_konfirmasi_jabatan">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="javascript:;" class="btn btn-danger" id="hapus-true-data-jabatan">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <div class="modal modal-danger fade" id="modal-konfirmasi-pangkat" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Pangkat</h5>
              </div>
              <div class="modal-body" id="pesan_konfirmasi_pangkat">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="javascript:;" class="btn btn-danger" id="hapus-true-data-pangkat">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <div class="modal modal-danger fade" id="modal-konfirmasi-akun" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Akun Bayar</h5>
              </div>
              <div class="modal-body" id="pesan_konfirmasi_akun">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="javascript:;" class="btn btn-danger" id="hapus-true-data-akun">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <div class="modal modal-danger fade" id="modal-konfirmasi-kategori" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Kategori Surat</h5>
              </div>
              <div class="modal-body" id="pesan_konfirmasi_kategori">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="javascript:;" class="btn btn-danger" id="hapus-true-data-kategori">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


       <!-- END Konfirmasi hapus -->
    <!-- END MODAL EDIT KONFIRMASI -->

  </div>
  <!-- /.content-wrapper -->


<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>

<script type="text/javascript">

  $(document).ready(function(){
    load_data_akun();
    load_data_pangkat();
    load_data_jabatan();
    load_kategori_surat();
  });

  //FORM SUBMIT
  function form_submit_jabatan() {
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/add_jabatan') ?>",
      cache: false,
    });

    $.ajax({
      data:{deskripsi:$('#deskripsi_jabatan').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-add-jabatan').modal('hide')
        $('#table_jabatan').DataTable().destroy();
          load_data_jabatan();
        }
      }
    })
   }  

   function form_edit_jabatan(){
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/edit_jabatan') ?>",
      cache: false,
    });

    $.ajax({
      data:{id:$('#id_jabatan_edit').val(),deskripsi:$('#deskripsi_jabatan_edit').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-edit-jabatan').modal('hide')
        $('#table_jabatan').DataTable().destroy();
          load_data_jabatan();
        }
      }
    })
   }

   function form_submit_pangkat() {
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/add_pangkat') ?>",
      cache: false,
    });

    $.ajax({
      data:{deskripsi:$('#deskripsi_pangkat').val(),golongan:$('#golongan').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-add-pangkat').modal('hide')
        $('#table_pangkat').DataTable().destroy();
          load_data_pangkat();
        }
      }
    })
   }  

   function form_edit_pangkat(){
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/edit_pangkat') ?>",
      cache: false,
    });

    $.ajax({
      data:{id:$('#id_pangkat_edit').val(),deskripsi:$('#deskripsi_pangkat_edit').val(),golongan:$('#golongan_edit').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-edit-pangkat').modal('hide')
        $('#table_pangkat').DataTable().destroy();
          load_data_pangkat();
        }
      }
    })
   }

   function simpan_mesin(){
     $.ajaxSetup({
      type:"POST",
      url: "<?php echo base_url('master_data/add_mesin') ?>",
      cache: false,
    });

    $.ajax({
      data:{ip_mesin:$('#ip_mesin').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
          $('#ip_mesin').val(respond['ip']);
        }
      }
    })
   }

   function form_submit_akun_bayar() {
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/add_akun_bayar') ?>",
      cache: false,
    });

    $.ajax({
      data:{deskripsi:$('#deskripsi_akun').val(),no_akun:$('#no_akun').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-add-akun').modal('hide')
        $('#table_akun').DataTable().destroy();
          load_data_akun();
        }
      }
    })
   }  

   function form_edit_akun_bayar(){
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/edit_akun_bayar') ?>",
      cache: false,
    });

    $.ajax({
      data:{deskripsi:$('#deskripsi_akun_edit').val(),no_akun:$('#no_akun_edit').val(),no_akun_lama:$('#no_akun_lama').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-edit-akun').modal('hide')
        $('#table_akun').DataTable().destroy();
          load_data_akun();
        }
      }
    })
   }

   function form_submit_kategori() {
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/add_kategori_surat') ?>",
      cache: false,
    });

    $.ajax({
      data:{deskripsi:$('#deskripsi_kategori').val(),template:$('#template_kategori').val(),jenis:$('#jenis').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-add-kategori').modal('hide')
        $('#table_kategori_surat').DataTable().destroy();
          load_kategori_surat();
        }
      }
    })
   }  

   function form_edit_kategori(){
    $.ajaxSetup({
      type:"GET",
      url: "<?php echo base_url('master_data/edit_kategori_surat') ?>",
      cache: false,
    });

    $.ajax({
      data:{deskripsi:$('#deskripsi_kategori_edit').val(),id:$('#id_kategori_edit').val(),template:$('#template_kategori_edit').val()},
      dataType: 'json',
      success: function(respond){
        if(respond['status']){
          alert(respond['message']);
        $('#modal-edit-kategori').modal('hide')
        $('#table_kategori_surat').DataTable().destroy();
          load_kategori_surat();
        }
      }
    })
   }
  //END FORM SUBMIT

  //EDIT
  $('#modal-edit-jabatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) 
    var id = div.data('id')
    var deskripsi = div.data('deskripsi')
    var modal = $(this)
    modal.find('#id_jabatan_edit').val(id);
    modal.find('#deskripsi_jabatan_edit').val(deskripsi);
    });
  $('#modal-edit-pangkat').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) 
    var id = div.data('id')
    var deskripsi = div.data('deskripsi')
    var golongan = div.data('golongan')
    var modal = $(this)
    modal.find('#id_pangkat_edit').val(id);
    modal.find('#deskripsi_pangkat_edit').val(deskripsi);
    modal.find('#golongan_edit').val(golongan);
    });
  $('#modal-edit-akun').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) 
    var id = div.data('no_akun')
    var deskripsi = div.data('deskripsi')
    var modal = $(this)
    modal.find('#no_akun_edit').val(id);
    modal.find('#no_akun_lama').val(id);
    modal.find('#deskripsi_akun_edit').val(deskripsi);
    });
  $('#modal-edit-kategori').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) 
    var id = div.data('id')
    var deskripsi = div.data('deskripsi')
    var template = div.data('template')
    //var jenis = div.data('jenis')
    var modal = $(this)
    modal.find('#id_kategori_edit').val(id);
    modal.find('#deskripsi_kategori_edit').val(deskripsi);
    modal.find('#template_kategori_edit').val(template);
    });
  //END EDIT

  //KONFRIMASI
  $('#modal-konfirmasi-jabatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget)
    var id = div.data('id')
    var deskripsi = div.data('deskripsi')
    var modal = $(this)
    modal.find('#hapus-true-data-jabatan').attr("href","<?= base_url('master_data/delete_jabatan?id=')?>"+id);
    modal.find('#pesan_konfirmasi_jabatan').html("Apakah anda yakin ingin menghapus "+deskripsi+" ?");
    });
  $('#modal-konfirmasi-pangkat').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget)
    var id = div.data('id')
    var deskripsi = div.data('deskripsi')
    var modal = $(this)
    modal.find('#hapus-true-data-pangkat').attr("href","<?= base_url('master_data/delete_pangkat?id=')?>"+id);
    modal.find('#pesan_konfirmasi_pangkat').html("Apakah anda yakin ingin menghapus "+deskripsi+" ?");
    });
  $('#modal-konfirmasi-akun').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget)
    var id = div.data('no_akun')
    var deskripsi = div.data('deskripsi')
    var modal = $(this)
    modal.find('#hapus-true-data-akun').attr("href","<?= base_url('master_data/delete_akun_bayar?no_akun=')?>"+id);
    modal.find('#pesan_konfirmasi_akun').html("Apakah anda yakin ingin menghapus "+deskripsi+" ?");
    });
  $('#modal-konfirmasi-kategori').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget)
    var id = div.data('id')
    var deskripsi = div.data('deskripsi')
    var modal = $(this)
    modal.find('#hapus-true-data-kategori').attr("href","<?= base_url('master_data/delete_kategori_surat?id=')?>"+id);
    modal.find('#pesan_konfirmasi_kategori').html("Apakah anda yakin ingin menghapus "+deskripsi+" ?");
    });
  //END KONFRIMASI

  function load_data_pangkat(){
    $('#table_pangkat').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": "<?= base_url('/master_data/get_pangkat')?>",
        "columns": [
            {data: 'id', name: 'id',width: "20%"},
            {data: 'des_pangkat', name: 'des_pangkat',width: "70%"},
            {data: 'golongan', name: 'golongan',width: "70%"},
            {data: 'aksi', name:'aksi',width: "20%"}
        ]
    });
  }

  function load_data_jabatan(){
    $('#table_jabatan').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": "<?= base_url('/master_data/get_jabatan')?>",
        "columns": [
            {data: 'id', name: 'id',width: "20%"},
            {data: 'des_jabatan', name: 'des_jabatan',width: "50%"},
            {data: 'aksi', name:'aksi',width: "30%"}
        ]
    });
  }

  function load_data_akun(){
    $('#table_akun').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": "<?= base_url('/master_data/get_akun_bayar')?>",
        "columns": [
            {data: 'no_akun', name: 'no_akun'},
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'aksi', name:'aksi'}
        ]
    });
  }

  function load_kategori_surat(){
    $('#table_kategori_surat').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": "<?= base_url('/master_data/get_kategori_surat')?>",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'aksi', name:'aksi'}
        ]
    });
  }

</script>

</body>
</html>
