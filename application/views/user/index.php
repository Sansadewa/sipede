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
            <h1 class="m-0 text-dark">Master Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Pengguna</li>
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
                <h4 class="card-title"> Daftar Pengguna </h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Tambah Pegawai">
                      <i class="fa fa-plus"></i>
                    </button>
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                  <table id="table_pegawai" class="table table-striped">
                    <thead>
                      <th>Nip</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Hak Akses</th>
                      <th>Aksi</th>
                    </thead>
                </table>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <form class="form" action="<?= base_url('user/add_user')?>" method="POST" id="add_user">
      <div class="modal fade" id="modal-default" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" name="nip" class="form-control" maxlength="18">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" maxlength="36">
                </div>
                <div class="form-group">
                  <label>Usename</label>
                  <input type="text" name="username" class="form-control" maxlength="18">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" class="form-control" id="password" placeholder="Kosongkan jika tidak mengubah">
                </div>
                <div class="form-group">
                  <label>Jenis Akun</label>
                  <?php
                    echo '<select class="form-control select2" name="permission" style="width: 100%;">';
                    $i=0;
                    foreach ($permission as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->permission. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    <!-- model edit -->
    <form class="form" action="<?= base_url('user/edit')?>" method="POST" id="edit_user">
      <div class="modal fade" id="modal-edit" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Pengguna</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" name="nip" class="form-control" maxlength="18" id="nip" readonly>
                </div>
                 <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" maxlength="36" id="nama_edit">
                </div>
                <div class="form-group">
                  <label>username</label>
                  <input type="text" name="username" class="form-control" maxlength="18" id="username_edit">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" class="form-control" id="password_edit" placeholder="Kosongkan jika tidak mengubah">
                </div>
                <div class="form-group">
                  <label>Jenis Akun</label>
                  <?php
                    echo '<select class="form-control select2" name="permission" id="permission_edit" style="width: 100%;">';
                    $i=0;
                    foreach ($permission as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->permission. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_edit()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    <!-- Konfirmasi hapus -->
    <div class="modal modal-danger fade" id="modal-konfirmasi" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Pengguna</h5>
              </div>
              <div class="modal-body" id="pesan_konfirmasi">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>

<script type="text/javascript">

  function form_submit() {
    if (!$('#password').val()) {
        return alert('Password wajib diisi');
      }
    document.getElementById("add_user").submit();
   }   
 
 function form_edit() {
    document.getElementById("edit_user").submit();
   }  

 $(document).ready(function() {


      oTable = $('#table_pegawai').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": "<?= base_url('/user/get_user')?>",
        "columns": [
            {data: 'nip', name: 'nip'},
            {data: 'nama', name: 'nama'},
            {data: 'username', name: 'username'},
            {data: 'permission', name: 'permission'},
            {data: 'aksi', name:'aksi'}
        ]
    });

    $('#modal-konfirmasi').on('show.bs.modal', function (event) {
    let div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    let nip = div.data('nip')
    let username = div.data('username')
    let nama = div.data('nama')
    let permission = div.data('id_permission')
     
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#hapus-true-data').attr("href","<?= base_url('user/delete?nip=')?>"+nip);
    modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus "+nama+" ?");
    modal.find('#nip').val(nip);
    modal.find('#username').val(username);
    modal.find('#nama').val(nama);
    modal.find('#permission').val(permission);
    });

    $('#modal-edit').on('show.bs.modal', function (event) {
    let div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    let nip = div.data('nip')
    let username = div.data('username')
    let nama = div.data('nama')
    let permission = div.data('id_permission')
     
    let modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#nip').val(nip);
    modal.find('#username_edit').val(username);
    modal.find('#nama_edit').val(nama);
    modal.find('#permission_edit').val(permission);
    });
  });

</script>

</body>
</html>
