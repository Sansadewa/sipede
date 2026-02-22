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
            <h1 class="m-0 text-dark">Master Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Pegawai</li>
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
                <h4 class="card-title"> Daftar Pegawai </h4>
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
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>Jabatan</th>
                      <th>Pangkat/Golongan</th>
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

    <form class="form" action="<?= base_url('pegawai/add_pegawai')?>" method="POST" id="add_pegawai">
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Pegawai</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                    <label>NIP</label>
                  <input type="text" name="nip" class="form-control" maxlength="18" id="nip">
                  </div>
                  <div class="col-md-4">
                     <label>ID Absensi</label>
                  <input type="text" name="id_absensi" class="form-control" maxlength="18" id="id_absensi">
                  </div>    
                  </div>            
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required="required" id="nama">
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <?php
                    echo '<select class="form-control select2" name="jabatan" style="width: 100%;" required="required">';
                    $i=0;
                    foreach ($opsi_jabatan as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->des_jabatan. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
                <div id="pangkat" class="form-group">
                  <label>Pangkat</label>
                  <?php
                    echo '<select class="form-control select2" name="pangkat" style="width: 100%;" required="required">';
                    $i=0;
                    foreach ($opsi_pangkat as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->des_pangkat. "</option>";
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

    <!-- Modal edit -->
    <form class="form" action="<?= base_url('pegawai/edit')?>" method="POST" id="edit_pegawai">
      <div class="modal fade" id="modal-edit" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Pegawai</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                    <label>NIP</label>
                  <input type="text" name="nip" class="form-control" maxlength="18" id="nip_edit">
                  </div>
                  <div class="col-md-4">
                     <label>ID Absensi</label>
                  <input type="text" name="id_absensi" class="form-control" maxlength="18" id="id_absensi_edit">
                  </div>    
                  </div>            
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" id="nama_edit">
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <?php
                    echo '<select class="form-control select2" name="jabatan" style="width: 100%;" id="jabatan_edit">';
                    $i=0;
                    foreach ($opsi_jabatan as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->des_jabatan. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
                <div id="pangkat" class="form-group">
                  <label>Pangkat</label>
                  <?php
                    echo '<select class="form-control select2" name="pangkat" style="width: 100%;" id="pangkat_edit">';
                    $i=0;
                    foreach ($opsi_pangkat as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->des_pangkat. "</option>";
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
     if (!$('#nip').val()) {
        return alert('Nip wajib diisi');
      }
      if (!$('#nama').val()) {
        return alert('Nama wajib diisi');
      }
    document.getElementById("add_pegawai").submit();
   }  
  function form_edit() {
    document.getElementById("edit_pegawai").submit();
   }   
 $(document).ready(function() {

  $('select').select2({
    width: '100%'
  });

      oTable = $('#table_pegawai').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": "<?= base_url('/pegawai/get_pegawai')?>",
        "columns": [
            {data: 'nama', name: 'nama'},
            {data: 'nip', name: 'nip'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'pangkat', name: 'pangkat'},
            {data: 'aksi', name:'aksi'}
        ]
    });

    $('#modal-konfirmasi').on('show.bs.modal', function (event) {
    let div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    let nip = div.data('nip')
    let nama = div.data('nama')

     
    let modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#hapus-true-data').attr("href","<?= base_url('pegawai/delete?nip=')?>"+nip);
    modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus "+nama+" ?");
    });

    $('#modal-edit').on('show.bs.modal', function (event) {
    let div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    let nip = div.data('nip')
    let nama = div.data('nama')
    let jabatan = div.data('jabatan')
    let pangkat = div.data('pangkat')
    let id_absensi = div.data('id_absensi')
     
    let modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#jabatan_edit').val(jabatan);
    modal.find('#jabatan_edit').change();
    modal.find('#pangkat_edit').val(pangkat);
    modal.find('#pangkat_edit').change();
    modal.find('#nip_edit').val(nip);
    modal.find('#nama_edit').val(nama);
    modal.find('#id_absensi_edit').val(id_absensi);
    });
  });

  $('#modal-default').on('hidden.bs.modal', function (e) {
  $(this)
  .find("input,textarea")
  .val('')
  .end()
  .find("select")
  .val(0).change()
  .end()
  .find("input[type=checkbox], input[type=radio]")
  .prop("checked", "")
  .end();
})

</script>

</body>
</html>
