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
                <h4 class="card-title"> Matriks Kegiatan </h4>
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
                    <button type="button" onClick="get_excel()"class="btn btn-success" id="btn-excel">Download Excel</button>
                  </div>
                </div>
                <div class="container-fluid">
                  <div id="table-body" style="overflow-x: scroll;">
                    
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <?php if($this->session->userdata('wilayah')->kode == '6300'){?>
<!--           <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title"> Matriks Wilayah Tujuan </h4>
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
                    <button type="button" onClick="get_excel()"class="btn btn-success" id="btn-excel">Download Excel</button>
                  </div>
                </div>
                <div class="container-fluid">
                  <div id="table_wilayah" style="overflow-x: scroll;">
                     
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div> -->
      <?php } ?>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include_once(VIEWPATH.'template/sidebar_collapse.php'); ?> 
<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>

<script type="text/javascript">
    var d = new Date(),
        n = d.getMonth()+1;
        y = d.getFullYear();

  function form_submit(){
    n = $('#bulan').val(); 
    y=$('#tahun').val();
    load_table(n,y);  
  }

  function get_excel(){
    n = $('#bulan').val(); 
    y=$('#tahun').val();
    window.open("<?php echo base_url('/matriks_kegiatan/to_excel')?>"+"?bulan="+n+"&tahun="+y, "_blank");
  }

$('#modal-konfirmasi').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
     
    // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
    var id = div.data('id')

     
    var modal = $(this)
     
    // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
    modal.find('#hapus-true-data').attr("href","<?= base_url('pegawai/delete?nip=')?>"+nip);
    modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus "+nama+" ?");
    });

  $('#bulan').change(function(){
    if($('#bulan').val() != n){
      $('#btn-excel').hide();
    }else{
      $('#btn-excel').show();
    }
  });

  $('#tahun').change(function(){
    if($('#tahun').val() != n){
      $('#btn-excel').hide();
    }else{
      $('#btn-excel').show();
    }
  });

  $(document).ready(function(){
        $('#btn-excel').hide();
        n='0'+n;   
        load_table(n,y);  
        load_table_wilayah(n,y)
  });

  function load_table(n,y){
   $.ajaxSetup({
    type:"POST",
    url: "<?php echo base_url('matriks_kegiatan/show_matriks') ?>",
    cache: false,
  });
   $.ajax({
    data:{bulan:n,tahun:y},
    success: function(respond){
      $('#table-body').html(respond);
      $('#btn-excel').show();
      $('#table_data').DataTable().destroy();
      $('#table_data').DataTable( {
       'scrollX':        true,
       'fixedColumns':   {
        leftColumns: 1
      }
    } );
    }
  });
  }

    function load_table_wilayah(n,y){
     $.ajaxSetup({
      type:"POST",
      url: "<?php echo base_url('matriks_kegiatan/show_matriks_wilayah') ?>",
      cache: false,
    });
     $.ajax({
      data:{bulan:n,tahun:y},
      success: function(respond){
        $('#table_wilayah').html(respond);
        //$('#btn-excel').show();
        $('#table_wilayah').DataTable().destroy();
        $('#table_wilayah').DataTable( {
         'scrollX':        true,
         'fixedColumns':   {
          leftColumns: 1
        }
      } );
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

</script>

</body>
</html>
