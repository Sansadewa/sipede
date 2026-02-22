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
            <h1 class="m-0 text-dark">Master Matriks </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Matriks </li>
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
                <h4 class="card-title"> Daftar Matriks matriks </h4>
                <div class="card-tools">
                   <!--  <button type="button" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Tambah Matriks">
                      <i class="fa fa-plus"></i>
                    </button> -->
                     <a class="btn btn-warning btn-md" href="<?= base_url('matriks_kegiatan/add_form') ?>"><i class="fa fa-plus"></i></a>
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
                <div class="table-responsive">
                  <table id="table_matriks" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                    <thead>
                      <th>Id</th>
                      <th>Aksi</th>
                      <th>Nama Pegawai</th>
                      <th>Kegiatan</th>
                      <th>Periode Awal</th>
                      <th>Periode Akhir</th>
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

      <div class="modal fade" id="modal-default"  >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah matriks</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    echo '<select class="form-control select2" id="nama" name="nama" style="width: 100%;" required="required">';
                    $i=0;
                    echo "<option value='0'/>-Pilih Pegawai-</option>";
                    foreach ($opsi_pegawai as $var) {
                      echo "<option value='" . $var->nip . "'/>"  .$var->nama. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?>
                </div>
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
               <div class="form-group">
                  <label>Jangka Waktu:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right periode_waktu_awal" id="periode_waktu_awal" name="periode_waktu_awal" placeholder="periode_waktu_awal" autocomplete="off">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right periode_waktu_akhir" id="periode_waktu_akhir" name="periode_waktu_akhir" placeholder="periode_waktu_akhir" autocomplete="off">
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
      <div class="modal fade" id="modal-edit" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit matriks</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Id</label>
                  <input type="text" name="id_edit" class="form-control" id="id_edit" readonly>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    echo '<select class="form-control select2" id="nama_edit" name="nama_edit" style="width: 100%;" required="required">';
                    $i=0;
                    echo "<option value='0'/>-Pilih Pegawai-</option>";
                    foreach ($opsi_pegawai as $var) {
                      echo "<option value='" . $var->nip . "'/>"  .$var->nama. "</option>";
                      $i++;
                    }
                    echo '</select>';
                    ?>
                </div>
                <div class="form-group">
                  <label>Jenis</label>
                        <select class="form-control" name="type_edit" id="type_edit" onchange="generate_kegiatan(this)">
                          <option value="0">-Pilih Jenis-</option>
                          <option value="1">Dengan SPD</option>
                          <option value="2">Hanya Surat Tugas</option>
                          <option value="3">Kegiatan Lain (Cuti,Ijin,dll)</option>
                        </select> 
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
                  <label>Jangka Waktu:</label>

                  <div class="form-group">
                    <input type="hidden" class="form-control" name="periode_waktu_awal_edit" id="periode_waktu_awal_edit" value=""  autocomplete="off">
                    <input type="hidden" class="form-control" name="periode_waktu_akhir_edit" id="periode_waktu_akhir_edit" value="" utocomplete="off">

                        <input type="text" class="form-control daterange" onchange="set_tanggal()" name="daterange" id="daterange" value="" placeholder="Tanggal Urut" autocomplete="off">
                      </div>
                 <!--   <div class="form-group">
                        <input type="text" class="form-control date" name="periode_terus" id="periode_terus"  placeholder="Tanggal Loncat" height="80px" autocomplete="off">
                      </div> -->
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

          <!-- Konfirmasi hapus -->
    <div class="modal modal-danger fade" id="modal-konfirmasi" tabindex="-1" style="overflow:hidden;position: absolute;
  z-index: 1060;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus matriks</h5>
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


<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> -->
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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

  function generate_kegiatan(sel){
  type = sel;
      var post_data ={}
      post_data['type']=$('#type_edit').val()
      $.ajax({
        url : "<?php echo base_url('matriks_kegiatan/get_kegiatan');?>",
        method : "POST",
        data : post_data,
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '<option value="" selected>--Pilih Kegiatan--</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id+'"">'+data[i].nama+'</option>';
          }
          $("#kegiatan_edit").val([]);
          $("#kegiatan_edit").html(html);
        }
      });

}

  function form_submit() {
      if ($('#nama').val()==0) {
        return alert('Pilih pegawai terlebih dahulu');
      }
      if ($('#kegiatan').val()==0) {
        return alert('Pilih kegiatan terlebih dahulu');
      }
      if (!$('#periode_waktu_awal').val()) {
        return alert('Pilih periode_waktu_awal terlebih dahulu');
      }
      if (!$('#periode_waktu_akhir').val()) {
        return alert('Pilih periode_waktu_akhir terlebih dahulu');
      }
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('matriks_kegiatan/add') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{nip:$('#nama').val(),periode_waktu_awal:$('#periode_waktu_awal').val(),cek:1,periode_waktu_akhir:$('#periode_waktu_akhir').val(),kegiatan:$('#kegiatan').val()},
      success: function(respond){
        if(respond.status == 'ok'){
          alert(respond.message);
          $('#modal-default').modal('hide');
          $('#table_matriks').dataTable().fnDestroy();
          n = $('#bulan').val(); 
          y=$('#tahun').val();
          load_table(n,y);
        }else{
          alert(respond.message);
        }
      }
    });
          
   }  

   function set_tanggal(){
    let tanggal = $('#daterange').val()
    tanggal = tanggal.split("-");
    $('#periode_waktu_awal_edit').val(tanggal[0])
    $('#periode_waktu_akhir_edit').val(tanggal[1])
    console.log(tanggal)
   }

  function form_edit() {
    set_tanggal()
      if ($('#kegiatan_edit').val()==0) {
        return alert('Pilih kegiatan terlebih dahulu');
      }
      if (!$('#periode_waktu_awal_edit').val()) {
        return alert('Pilih periode_waktu_awal terlebih dahulu');
      }
      if (!$('#periode_waktu_akhir_edit').val()) {
        return alert('Pilih periode_waktu_akhir terlebih dahulu');
      }
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('matriks_kegiatan/edit') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{nip_edit:$('#nama_edit').val(),type_edit:$('#type_edit').val(),id:$('#id_edit').val(),periode_waktu_awal:$('#periode_waktu_awal_edit').val(),cek:1,periode_waktu_akhir:$('#periode_waktu_akhir_edit').val(),kegiatan:$('#kegiatan_edit').val()},
      success: function(respond){
        if(respond.status == 'ok'){
          alert(respond.message);
          $('#modal-edit').modal('hide');
          $('#table_matriks').dataTable().fnDestroy();
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
    $('select').select2({
    width: '100%'
  });

  $('.daterange').daterangepicker({
    "drops": "up",
    autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });
   $('.date').datepicker({
      multidate: true,
      format: 'dd-mm-yyyy'
    });

     $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      daterange = this;
      var id = daterange.getAttribute('id').match(/\d+/); // 123456
      validasi_tanggal(id)

  });

  $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

   $('.periode_waktu_awal').datepicker({ 
      dateFormat: 'dd-mm-yy' }
      ).val();
    $('.periode_waktu_akhir').datepicker(
      { dateFormat: 'dd-mm-yy' }
      ).val();


    $('#modal-konfirmasi').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    var id = div.data('id')
    var nama = div.data('nama')
    var kegiatan = div.data('keg_nama')
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#hapus-true-data').attr("href","<?= base_url('matriks_kegiatan/delete?id=')?>"+id);
    modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus kegiatan "+kegiatan+" untuk "+nama+"?");
    });

    $('#modal-edit').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    var id = div.data('id')
    var nama = div.data('nip')

    if(div.data('kode_kegiatan')){
      var kegiatan = div.data('kode_kegiatan')
    }else{
      var kegiatan = div.data('keg')
    }


    var periode_waktu_awal = div.data('periode_waktu_awal')
    var periode_waktu_akhir = div.data('periode_waktu_akhir')

    var tanggal = periode_waktu_awal+" - "+periode_waktu_akhir
     
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#id_edit').val(id);
    modal.find('#nama_edit').val(nama).change();
    modal.find('#type_edit').val(div.data('tipe')).change();
    modal.find('#kegiatan_edit').val(kegiatan).change();
    modal.find('#periode_waktu_awal_edit').val(periode_waktu_awal);
    modal.find('#periode_waktu_akhir_edit').val(periode_waktu_akhir);
    modal.find('#daterange').val(tanggal)
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


 function load_table(n,y){
 $('#table_matriks').dataTable().fnDestroy();
  oTable = $('#table_matriks').DataTable({
        "responsive":true,
        "order":[[ 0, "desc" ]],
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          url: '<?= base_url('/matriks_kegiatan/get_all')?>',
          type: 'POST',
          data: {bulan:n,tahun:y} 
        },
          "columns": [
            {data:'id',name:'id'},
            {data: 'aksi', name:'aksi'},
            {data: 'nama', name: 'nama'},
            {data: 'keg_nama',name:'keg_nama'},
            {data: 'periode_waktu_awal', name: 'periode_waktu_awal'},
            {data: 'periode_waktu_akhir', name: 'periode_waktu_akhir'}
        ]
    });
 }

</script>

</body>
</html>
