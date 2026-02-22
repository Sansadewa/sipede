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
            <h1 class="m-0 text-dark">Kelola SPD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Kelola SPD</li>
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
                <h4 class="card-title"> Daftar Rencana Kerja</h4>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="bulan" name="bulan" class="form-control">
                      <?php foreach ($bulan as $bln_no=>$bln_nama):?><option value="<?php echo $bln_no;?>"<?php echo ($waktu[1] == $bln_no ? ' selected="selected"' : '');?>><?php echo $bln_nama;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="tahun" name="tahun" class="form-control">
                      <option value="<?= date('Y') ?>" <?php echo ($waktu[0] == date('Y') ? ' selected="selected"' : '');?>><?php echo date('Y');?></option>
                      <option value="<?= (date('Y')-1) ?>" <?php echo ($waktu[0] == (date('Y') - 1) ? ' selected="selected"' : '');?>><?php echo date('Y') - 1;?></option> 
                      <option value="<?= (date('Y')-2) ?>" <?php echo ($waktu[0] == (date('Y') -2) ? ' selected="selected"' : '');?>><?php echo date('Y') - 2;?></option> 
                      <option value="<?= (date('Y')-3) ?>" <?php echo ($waktu[0] == (date('Y') -3) ? ' selected="selected"' : '');?>><?php echo date('Y') - 3;?></option> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <select id="tipe" name="tipe" class="form-control">
                      <option value="1">Surat Perjalanan Dinas</option>
                      <option value="2">Surat Tugas</option>
                    </select> 
                  </div>
                  <div class="form-group col-lg-3 col-sm-3">
                    <button type="button" onClick="form_submit()"class="btn btn-primary">Tampilkan</button>
                    <button type="button" onclick="checkbox_sent()" class="btn btn-success">Print Massal</button>
                  </div>
                </div>
                <div class="container-fluid">
                      <table id="table_matriks" class="table table-striped">
                      <thead>
                        <th></th>
                        <th>Nama Pegawai</th>
                        <th>Kegiatan</th>
                        <th>Periode Awal</th>
                        <th>Periode Akhir</th>
                        <th>Status</th>
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
</div>
<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

<script type="text/javascript">
  var d = new Date(),
        n = d.getMonth()+1;
        n='0'+n; 
        y = d.getFullYear();
        oTable = '';

 $(document).ready(function() {
    load_table(n,y);
  });

 function checkbox_sent(){
    var table = $('#table_matriks').DataTable();
 
    var rows = $(table.rows({selected: true}).$('input[type="checkbox"]').map(function() {
            return $(this).prop("checked") ? $(this).closest('tr').attr('data-id') : null;
        }));
        selected = table.column(0).checkboxes.selected();

        if(selected.length == 0){
          alert('Pilih terlebih dahulu SPD yang akan di print')
        }

        for (var i = selected.length - 1; i >= 0; i--) {
          id_print = selected[i].split('_')
          window.open("<?= base_url('spd/print_spd?id=')?>"+id_print[0]+"&only_st="+id_print[1]+"&attachment=1");
        }
 }

 function form_print(is_spd,id_matriks,only_st){
  if(is_spd == 1){
    window.open("<?= base_url('spd/print_spd?id=')?>"+id_matriks+"&only_st="+only_st+"&attachment=0",'_blank');
  }else{
    alert('Silahkan lengkapi rincian spd dahulu.')
  }
 }

function form_bayar(is_spd,id_matriks){
  if(is_spd == 1){
    $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('surat_bayar/set_bisa_bayar') ?>",
          dataType:'json',
          cache: false,
    });
    $.ajax({
      data:{id_matriks:id_matriks},
      success: function(respond){
        if(respond.status == 'ok'){
          alert(respond.message);
        }else{
          alert(respond.message);
        }
      }
    });
  }else{
    alert('Silahkan lengkapi rincian spd dahulu.')
  }
}

function form_submit(){
    n = $('#bulan').val();
    y =$('#tahun').val();
    load_table(n,y);  
  }

 function load_table(n,y){
  $('#table_matriks').dataTable().fnDestroy();
  oTable = $('#table_matriks').DataTable({
        "bScrollCollapse": true,
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          type: "POST",
          url: "<?= base_url('/matriks_kegiatan/get_all_kelola_spd') ?>",
          data: {bulan:n,tahun:y,tipe:$('#tipe').val()} 
        },
         select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0,
            checkboxes: {
                'selectRow': true
            }
        } ],
        "columns": [
            {data: 'checkbox', name:'checkbox'},
            {data: 'nama', name: 'nama'},
            {data: 'keg_nama',name:'keg_nama'},
            {data: 'periode_waktu_awal', name: 'periode_waktu_awal'},
            {data: 'periode_waktu_akhir', name: 'periode_waktu_akhir'},
            {data: 'status', name: 'status'},
            {data: 'aksi', name:'aksi'}
        ]
    });
 }

</script>

</body>
</html>
