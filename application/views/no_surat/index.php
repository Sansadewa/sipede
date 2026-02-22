<?php include_once(VIEWPATH.'template/head.php'); ?> 
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
    );
$waktu = explode('-', date("Y-m-d"));
?>

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
            <h1 class="m-0 text-dark">Master Nomor Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Nomor Surat</li>
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
                <h4 class="card-title"> Daftar Nomor Surat </h4>
                <div class="card-tools">
                  <a href="<?= base_url('/kelola_no_surat/add_form') ?>" class="btn btn-warning btn-md" title="Tambah No Surat"> <i class="fa fa-plus"></i> Tambah</a>
                   <!--  <button type="button" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Tambah Pegawai">
                      <i class="fa fa-plus"></i>
                    </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="jenis_load" name="jenis_load" class="form-control">
                      <option value="0">--Semua--</option>
                      <?php foreach ($opsi_jenis as $key):?>
                        <option value="<?php echo $key->id;?>"><?php echo $key->nama.' '.$key->wilayah;?></option>
                      <?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="bulan" name="bulan" class="form-control">
                      <?php foreach ($bulan as $bln_no=>$bln_nama):?><option value="<?php echo $bln_no;?>"<?php echo ($waktu[1] == $bln_no ? ' selected="selected"' : '');?>><?php echo $bln_nama;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="tahun" name="tahun" class="form-control">
                      <option value="<?= date('Y') ?>" <?php echo ($waktu[0] == date('Y') ? ' selected="selected"' : '');?>><?php echo date('Y');?></option>
                      <option value="<?= (date('Y')-1) ?>" <?php echo ($waktu[0] == (date('Y') - 1) ? ' selected="selected"' : '');?>><?php echo date('Y') - 1;?></option> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <button type="button" onClick="form_load()"class="btn btn-primary">Tampilkan</button>
                  </div>
                </div>
                <div class="container-fluid">
                  <table id="table_nomor" class="table table-striped">
                    <thead>
                      <th>No Id</th>
                      <th>Nomor Surat</th>
                      <th>Kegiatan</th>
                      <th>Jenis</th>
                      <th>Tujuan</th>
                      <th>Perihal</th>
                      <th>Tanggal</th>
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

    <form class="form" action="<?= base_url('kelola_no_surat/add')?>" method="POST" id="add_nomor">
      <div class="modal fade" id="modal-default" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Nomor</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Jenis</label>
                  <?php
                    echo '<select class="form-control select2" onchange="current_number()" id="jenis" name="jenis" style="width: 100%;" required="required">';
                    $i=0;
                    echo "<option value='0'/>-Pilih Jenis Surat-</option>";
                    foreach ($opsi_jenis as $var) {
                      echo "<option value='" . $var->id . "'/>"  .$var->nama.' '.$var->wilayah ."</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
                <div class="form-group">
                  <label>Nomor</label>
                  <div class="row">
                    <div class="col-sm-6">
                  <input type="text" name="nomor" class="form-control" id="nomor" readonly="TRUE">
                    
                  </div>
                  <div class="col-sm-6">
                <input type="checkbox" name="is_edit_num" id="is_edit_num" onchange="set_edit()">Edit Nomor
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                  <label>Kegiatan</label>
                  <?php
                    echo '<select class="form-control select2" id="kegiatan" name="kegiatan" style="width: 100%;" required="required">';
                    $i=0;
                    echo "<option value='0'/>-Pilih Kegiatan-</option>";
                    foreach ($opsi_kegiatan as $var) {
                      echo "<option value='" . $var->id . "'/>"  .$var->nama. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
                

                  </div>
                  <div class="col-sm-6">
                                      <div class="form-group">
                      <label>Tanggal</label>
                        <input type="text" name="tanggal" class="form-control tanggal" required="required" id="tanggal" autocomplete="off">
                      </div>
                  </div>
                </div>
                <div class="row">
                 <div class="col-sm-6">
                      <div class="form-group">
                    <label>Tujuan</label>
                    <input name="tujuan" class="form-control" id="tujuan"/>
                  </div>
                 </div>
                 <div class="col-sm-6">
                    <div class="form-group">
                    <label>Perihal</label>
                    <textarea name="perihal" class="form-control" required="required" id="perihal"></textarea>
                  </div>
                 </div>
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
    <form class="form" action="<?= base_url('kelola_no_surat/edit')?>" method="POST" id="edit_nomor">
      <div class="modal fade" id="modal-edit">
      <input type="hidden" name="id" id="id">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Nomor Surat</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nomor</label>
                  <input type="text" name="nomor_edit" class="form-control" id="nomor_edit">
                </div>
                <div class="form-group">
                  <label>Kegiatan</label>
                  <?php
                    echo '<select class="form-control select2" id="kegiatan_edit" name="kegiatan_edit" style="width: 100%;" required="required">';
                    $i=0;
                    echo "<option value='0'/>-Pilih Kegiatan-</option>";
                    foreach ($opsi_kegiatan as $var) {
                      echo "<option value='" . $var->id . "'/>"  .$var->nama. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
                <div class="form-group">
                  <label>Jenis</label>
                  <?php
                    echo '<select class="form-control select2" id="jenis_edit" name="jenis_edit" style="width: 100%;" required="required">';
                    $i=0;
                    echo "<option value=''/>-Pilih Jenis Surat-</option>";
                    foreach ($opsi_jenis as $var) {
                      echo "<option id='chk' class='chk' value='" . $var->id . "'/>"  .$var->nama. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?> 
                </div>
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="text" name="tanggal_edit" class="form-control tanggal" required="required" id="tanggal_edit">
                </div>
               <div class="row">
                 <div class="col-sm-6">
                      <div class="form-group">
                    <label>Tujuan</label>
                    <input name="tujuan_edit" class="form-control" id="tujuan_edit"/>
                  </div>
                 </div>
                 <div class="col-sm-6">
                    <div class="form-group">
                    <label>Perihal</label>
                    <textarea name="perihal_edit" class="form-control" required="required" id="perihal_edit"></textarea>
                  </div>
                 </div>
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
    <div class="modal modal-danger fade" id="modal-konfirmasi" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Nomor</h5>
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

  var d = new Date(),
        n = d.getMonth()+1;
        n='0'+n; 
        y = d.getFullYear();


  function form_load(){
    n = $('#bulan').val(); 
    y=$('#tahun').val();
    jenis = $('#jenis_load').val();
    load_table(n,y,jenis);  
  }

  function current_number(){
    $.ajaxSetup({
            type:"POST",
            url: "<?php echo base_url('kelola_no_surat/get_current_nomor') ?>",
            dataType:'json',
            cache: false,
      });
      $.ajax({
        data:{jenis:$('#jenis').val()},
        success: function(respond){
          if(respond.status == 'ok'){
            $('#nomor').val(respond.nomor)
          }else{
            alert(respond.status);
          }
        }
      });
   }

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
 
  function form_submit() {
     if (!$('#nomor').val()) {
        return alert('Nomor wajib diisi');
      }
      if ($('#kegiatan').val()==0) {
        return alert('Kegiatan wajib diisi');
      }
      if ($('#jenis').val()==0) {
        return alert('Jenis wajib diisi');
      }
      if (!$('#perihal').val()) {
        return alert('Perihal wajib diisi');
      }
      if (!$('#tanggal').val()) {
        return alert('Tanggal wajib diisi');
      }
    document.getElementById("add_nomor").submit();
   }  
  function form_edit() {
    if (!$('#nomor_edit').val()) {
        return alert('Nomor wajib diisi');
      }
      if ($('#kegiatan_edit').val()==0) {
        return alert('Kegiatan wajib diisi');
      }
      if ($('#jenis_edit').val()==0) {
        return alert('Jenis wajib diisi');
      }
      if (!$('#perihal_edit').val()) {
        return alert('Perihal wajib diisi');
      }
      if (!$('#tanggal_edit').val()) {
        return alert('Tanggal wajib diisi');
      }
    document.getElementById("edit_nomor").submit();
   }   

 function set_edit(){
    if ($('#is_edit_num').is(':checked')) {
      $("#nomor").prop("readonly", false);
    }else{
      $("#nomor").prop("readonly", true);
    }
 }


  function load_table(n,y,jenis){
    $('#table_nomor').dataTable().fnDestroy();
    oTable = $('#table_nomor').DataTable({
                  "rowReorder":{
                  selector: 'td:nth-child(2)'
              },
        "responsive":true,
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          url: '<?= base_url('/kelola_no_surat/get_all_table')?>',
          type: 'POST',
          data: {bulan:n,tahun:y,jenis:jenis} 
        },
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'nomor', name: 'nomor'},
            {data: 'kegiatan', name: 'kegiatan'},
            {data: 'jenis', name: 'jenis'},
            {data: 'tujuan', name: 'tujuan'},
            {data: 'perihal', name: 'perihal'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'aksi', name:'aksi'}
        ]
    });
  }
 $(document).ready(function() {
   $('.tanggal').datepicker({ dateFormat: 'dd-mm-yy' }).val();
  load_table(n,y,0)

    $('select').select2({
    width: '100%'
    });

    $('#modal-konfirmasi').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    var id = div.data('id')
    var nomor = div.data('nomor')

     
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#hapus-true-data').attr("href","<?= base_url('kelola_no_surat/delete?id=')?>"+id);
    modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus "+nomor+" ?");
    });

    $('#modal-edit').on('show.bs.modal', function (event) {
      var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
      
      // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
      var id = div.data('id')
      var nomor = div.data('nomor')
      var kegiatan = div.data('kegiatan')
      var jenis = div.data('jenis')
      var perihal = div.data('perihal')
      var tujuan = div.data('tujuan')
      var tanggal = div.data('tanggal')
      
      var modal = $(this)
      
      // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
      modal.find('#id').val(id);
      modal.find('#nomor_edit').val(nomor);
      modal.find('#kegiatan_edit').val(kegiatan).change();
      modal.find('#jenis_edit').val(jenis).change();
      modal.find('#perihal_edit').val(perihal);
      modal.find('#tujuan_edit').val(tujuan);
      modal.find('#tanggal_edit').val(tanggal);
    });
  });

</script>

</body>
</html>
