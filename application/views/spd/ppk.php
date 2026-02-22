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
            <h1 class="m-0 text-dark">Master Surat Bayar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Surat Bayar</li>
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
                <h4 class="card-title"> Daftar SPPD Terinput </h4>
                <div class="card-tools">
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
                    <button type="button" onClick="form_submit()"class="btn btn-primary">Tampilkan</button>
                  </div>
                </div>
                <div class="container-fluid">
                  <table id="table_data" class="table table-striped">
                    <thead>
                      <th>Id</th>
                      <th>Nama Pegawai</th>
                      <th>Kegiatan</th>
                      <th>Periode Awal</th>
                      <th>Periode Akhir</th>
                      <th>No PPK</th>
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

function form_submit(){
    n = $('#bulan').val();
    y=$('#tahun').val();
    load_table(n,y);  
  }

$(document).ready(function() {
    load_table(n,y);
  });

 function form_print_ppk(is_spd,id_matriks){
  if(is_spd == 0){
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('surat_bayar/set_bisa_bayar_ppk') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{id_matriks:id_matriks},
      success: function(respond){
        if(respond.status == 'ok'){
          alert(respond.message);
          load_table(n,y);
        }else{
          alert(respond.message);
        }
      }
    });
  }else{
    alert('SPD sudah disetujui untuk dibayar')
  }
 }


 function load_table(n,y){

  $('#table_data').dataTable().fnDestroy();
  oTable = $('#table_data').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          type: "POST",
          url: "<?= base_url('matriks_kegiatan/get_all_kelola_spd_ppk') ?>",
          data: {bulan:n,tahun:y} 
        },
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'keg_nama',name:'keg_nama'},
            {data: 'periode_waktu_awal', name: 'periode_waktu_awal'},
            {data: 'periode_waktu_akhir', name: 'periode_waktu_akhir'},
            {data: 'no_ppk', name: 'no_ppk'},
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
