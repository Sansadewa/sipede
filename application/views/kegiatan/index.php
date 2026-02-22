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
<style>
    .ui-datepicker{ z-index:1151 !important; }
</style>

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
            <h1 class="m-0 text-dark">Master Kegiatan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Kegiatan</li>
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
                <h4 class="card-title"> Daftar Kegiatan </h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Tambah kegiatan">
                      <i class="fa fa-plus"></i>
                    </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-lg-4 col-sm-4">
                    <select id="bulan" name="bulan" class="form-control">
                      <?php foreach ($bulan as $bln_no=>$bln_nama):?><option value="<?php echo $bln_no;?>"<?php echo ($waktu[1] == $bln_no ? ' selected="selected"' : '');?>><?php echo $bln_nama;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-4 col-sm-4">
                    <select id="tahun" name="tahun" class="form-control">
                      <option value="<?= date('Y') ?>" <?php echo ($waktu[0] == date('Y') ? ' selected="selected"' : '');?>><?php echo date('Y');?></option>
                      <option value="<?= (date('Y')-1) ?>" <?php echo ($waktu[0] == (date('Y') - 1) ? ' selected="selected"' : '');?>><?php echo date('Y') - 1;?></option> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-4 col-sm-4">
                    <button type="button" onClick="form_load()"class="btn btn-primary">Tampilkan</button>
                  </div>
                </div>
              </div>
                <div class="container-fluid">
                  <table id="table_kegiatan" class="table table-striped">
                    <thead>
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Periode Awal</th>
                      <th>Periode Akhir</th>
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

      <div class="modal fade" id="modal-default" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah kegiatan</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" id="nama">
                </div>
               <div class="form-group">
                  <label>Jangka Waktu:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right periode_waktu_awal" autocomplete="off" name="periode_waktu_awal" id="periode_waktu_awal" placeholder="periode_waktu_awal">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right periode_waktu_akhir" autocomplete="off"  name="periode_waktu_akhir" id="periode_waktu_akhir" placeholder="periode_waktu_akhir">
                  </div>
                  <!-- /.input group -->
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

    <!-- Modal edit -->
      <div class="modal fade" id="modal-edit" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit kegiatan</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Id</label>
                <input type="text" name="id" id="id_edit" class="form-control" readonly>
                </div>
               <div class="form-group">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama_edit" class="form-control" id="nama_edit">
                </div>
               <div class="form-group">
                  <label>Jangka Waktu:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right periode_waktu_awal" id="periode_waktu_awal_edit" name="periode_waktu_awal_edit" autocomplete="off" placeholder="periode_waktu_awal">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right periode_waktu_akhir" id="periode_waktu_akhir_edit"  name="periode_waktu_akhir_edit" autocomplete="off" placeholder="periode_waktu_akhir">
                  </div>
                  <!-- /.input group -->
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
      </div>
        <!-- /.modal -->

        <!-- Konfirmasi hapus -->
    <div class="modal modal-danger fade" id="modal-konfirmasi" tabindex="-1" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Kegiatan</h5>
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
    load_table(n,y);  
  }

  function form_submit() {
      if (!$('#nama').val()) {
        return alert('Nama wajib diisi');
      }
      if (!$('#periode_waktu_awal').val()) {
        return alert('Periode waktu awal wajib diisi');
      }
      if (!$('#periode_waktu_akhir').val()) {
        return alert('Periode waktu akhir wajib diisi');
      }
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('kegiatan/add') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{nama:$('#nama').val(),periode_waktu_awal:$('#periode_waktu_awal').val(),periode_waktu_akhir:$('#periode_waktu_akhir').val()},
      success: function(respond){
        if(respond.status == 'ok'){
          alert(respond.message);
          $('#modal-default').modal('hide');
          $('#table_kegiatan').dataTable().fnDestroy();
          n = $('#bulan').val(); 
          y=$('#tahun').val();
          load_table(n,y);
        }else{
          alert(respond.message);
        }
      }
    });
   }  

  function form_edit() {
    if (!$('#nama_edit').val()) {
        return alert('Nama wajib diisi');
    }
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('kegiatan/edit') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{nama:$('#nama_edit').val(),id:$('#id_edit').val(),periode_waktu_awal:$('#periode_waktu_awal_edit').val(),periode_waktu_akhir:$('#periode_waktu_akhir_edit').val()},
      success: function(respond){
        if(respond.status == 'ok'){
          alert(respond.message);
          $('#modal-edit').modal('hide');
          $('#table_kegiatan').dataTable().fnDestroy();
          n = $('#bulan').val(); 
          y=$('#tahun').val();
          load_table(n,y);
        }else{
          alert(respond.message);
        }
      }
    });
   }  
   
 $(document).ready(function() {
    load_table(n,y);
    $('.periode_waktu_awal').datepicker({ dateFormat: 'dd-mm-yy' }).val();
    $('.periode_waktu_akhir').datepicker({ dateFormat: 'dd-mm-yy' }).val();

    $('#modal-konfirmasi').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    var id = div.data('id')
    var nama = div.data('nama')
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#hapus-true-data').attr("href","<?= base_url('kegiatan/delete?id=')?>"+id);
    modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus "+nama+" ?");
    });

    $('#modal-edit').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    var id = div.data('id')
    var nama = div.data('nama')
    var periode_waktu_awal = div.data('periode_waktu_awal')
    var periode_waktu_akhir = div.data('periode_waktu_akhir')
     
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#id_edit').val(id);
    modal.find('#nama_edit').val(nama);
    modal.find('#periode_waktu_awal_edit').val(periode_waktu_awal);
    modal.find('#periode_waktu_akhir_edit').val(periode_waktu_akhir);
    });
  });

 function load_table(n,y){
    $('#table_kegiatan').dataTable().fnDestroy();
        oTable = $('#table_kegiatan').DataTable({
                            "rowReorder":{
                  selector: 'td:nth-child(2)'
              },
        "responsive":true,
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          url: '<?= base_url('/kegiatan/get_all')?>',
          type: 'POST',
          data: {bulan:n,tahun:y} 
        },
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'periode_waktu_awal', name: 'periode_waktu_awal'},
            {data: 'periode_waktu_akhir', name: 'periode_waktu_akhir'},
            {data: 'aksi', name:'aksi'}
        ]
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

</script>

</body>
</html>
