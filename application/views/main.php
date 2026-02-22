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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title_page; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title_page; ?></li>
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
          <!-- 
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $terdokumentasi ?></h3>

                <p>SPD Terdokumentasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $tercetak ?></h3>

                <p>Surat Tugas Tercetak</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $dikumpulkan; ?></h3>

                <p>SPD Belum Dikumpul</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $dibayar ?></h3>

                <p>Pembayaran Selesai</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
        <br><br>
<!--         <div class="row">
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
                </div> -->
          <div class="row">
          <div class="container-fluid" id="grafik_bulanan">
          </div>
        </div>
        <br><br>
          <div class="row">
          <div class="container-fluid">
                <h4 class="text-center">Realisasi Anggaran</h4>
                  <table id="table_progress" class="table table-striped">
                    <thead>
                      <th>id</th>
                      <th>Kegiatan</th>
                      <th>Pagu</th>
                      <th>Realisasi</th>
                    </thead>
                </table>
                </div>
              </div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

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

  function load_table(n,y){
   $('#table_progress').dataTable().fnDestroy();
    oTable = $('#table_progress').DataTable({
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          url: '<?= base_url('/main/get_table_progress')?>',
          type: 'POST',
          data: {bulan:n,tahun:y} 
        },
        "columns": [
            {data: 'id', name: 'akun_bayar',"width": "5%"},
            {data: 'deskripsi', name: 'deskripsi',"width": "55%"},
            {data: 'pagu', name: 'pagu',"width": "20%"},
            {data: 'total', name: 'total',"width": "20%"},
        ]
    });
  }

  function report_bulanan(data){
    Highcharts.chart('grafik_bulanan', {
    chart: {
        type: 'column',
    },
    title: {
        text: 'Jumlah Surat Tugas Bulanan'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Ags',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: data
});
  }

  $(document).ready(function() {
    alert('Semua user sipede sudah diupdate. Silahkan gunakan akun asli anda.');
    load_table(n,y);

     $.ajax({
        url: '<?= base_url('/main/grafik_bulanan')?>',
        type: 'GET',
        async: true,
        dataType: "json",
        success: function (data) {
            report_bulanan(data);
        }
      });

  });
</script>
</body>
</html>
