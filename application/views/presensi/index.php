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
            <h1 class="m-0 text-dark">Rekap Presensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Rekap Presensi</li>
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
                <h4 class="card-title"> Rekap Presensi </h4>
                <div class="card-tools">
                     <i data-last_run="<?= $sinkronisasi['last_run']?>" id="last_run"> Terakhir Sinkronisasi: <?= @format_tanggal($sinkronisasi['last_run'],true)?> </i>
                    <button type="button" onClick="form_sync()" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Sinkronisasi Presensi">
                      <div id="spinner"><i class="fa fa-spinner"></i></div>
                    </button> 
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="tahun" name="tahun" class="form-control">
                      <option value="<?= date('Y') ?>" <?php echo ($waktu[0] == date('Y') ? ' selected="selected"' : '');?>><?php echo date('Y');?></option>
                      <option value="<?= (date('Y')-1) ?>" <?php echo ($waktu[0] == (date('Y') - 1) ? ' selected="selected"' : '');?>><?php echo date('Y') - 1;?></option> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="bulan" name="bulan" class="form-control">
                      <?php foreach ($bulan as $bln_no=>$bln_nama):?><option value="<?php echo $bln_no;?>"<?php echo ($waktu[1] == $bln_no ? ' selected="selected"' : '');?>><?php echo $bln_nama;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="pegawai" name="pegawai" class="form-control select2">
                      <?php foreach ($pegawai as $p):?><option value="<?php echo $p->pin?>"><?php echo $p->nama ?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <button type="button" onClick="form_load()"class="btn btn-primary">Tampilkan</button>
                  </div>
                </div>
                <div class="container-fluid">
                  <table id="table_presensi" class="table table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Jam Kerja</th>
                        <th>Lebih Jam</th>
                        <th>SPPD</th>
                      </tr>
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

  $(document).ready(function(){
    load_table(n,y);
      $('select').select2({
      width: '100%'
     });
  });

  function form_sync(){
    $("#spinner").html("<img class='img' width='25px' src='http://10.63.0.234/sipede_dev/assets/img/loading.gif' />");
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('presensi/sync') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{last_run:$('#last_run').data('last_run')},
      success: function(respond){
        if(respond.status){
          alert(respond.message);
          $("#spinner").html("<i class='fa fa-spinner'></i>");
        }else{
          alert(respond.message);
        }
      }
    });
  }

  function load_table(n,y) {
     $('#table_presensi').dataTable().fnDestroy();
      var table = $('#table_presensi').DataTable( {
        "aLengthMenu": [[10, 15, 31, -1], [10, 15, 31, "All"]],
        "iDisplayLength": 31,
        "scrollX": true,
        "orderable": false,
        "ajax": {
          url: '<?= base_url('presensi/get_rekap')?>',
          type: 'POST',
          data: {bulan:n,tahun:y,id_absensi:$('#pegawai').val()}
        },
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'jam_masuk', name: 'jam_masuk'},
            {data: 'jam_pulang', name: 'jam_pulang'},
            {data: 'jam_kerja', name:'jam_kerja'},
            {data: 'lebih_jam', name:'lebih_jam'},
            {data: 'sppd', name:'sppd'},
        ],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      if (aData.sppd != "") {
        if (aData.sppd == "Libur") {
          $('td', nRow).css('background-color', 'red');
        }else{
          $('td', nRow).css('background-color', 'orange');
        }
      } 
    }
    });

  }
</script>

</body>
</html>
