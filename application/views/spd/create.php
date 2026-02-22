<?php include_once(VIEWPATH.'template/head.php'); ?> 
<style>
    .ui-datepicker{ z-index:1151 !important; }
    table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
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
                <h4 class="card-title"> Input Rincian SPD (<?= $matriks_kegiatan->nama.' kegiatan '.$matriks_kegiatan->kegiatan?>)</h4>
                <div class="card-tools">
                   
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                <form action="<?= base_url('spd/add') ?>" method="POST">
                  <input type="hidden" name="id_matriks" value="<?= $matriks_kegiatan->id ?>">
                  <input type="hidden" name="id_kegiatan" value="<?= $matriks_kegiatan->keg_id ?>">
                  <input type="hidden" name="nip" value="<?= $matriks_kegiatan->nip ?>">
                  <input type="hidden" name="id_st" value="<?= $id_st?>">
                  <input type="hidden" name="id_sby" value="<?= $id_sby ?>">
                  <input type="hidden" name="id_spd" value="<?= $id_spd ?>">
                  <input type="hidden" name="mtx_tipe" value="<?= $matriks_kegiatan->tipe ?>">
                  <input type="hidden" name="akun_bayar" class="form-control" id="akun_bayar" value="<?= $matriks_kegiatan->kode_kegiatan ?>" readonly>
                 <div class="row">
                  <div class="col-md-8 col-lg-8">
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="pegawai.nama" class="form-control" id="pegawai.nama" value="<?= $matriks_kegiatan->nama ?>" readonly>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                            <label>Berangkat</label>
                            <input type="text" id="date_berangkat" class="form-control date" value="<?= @format_tanggal($matriks_kegiatan->tanggal_awal) ?>" readonly>
                          </div>

<!--                         <div class="col-md-6">
                          <div class="form-group">
                        <label>Berangkat</label>
                        <input type="text" name="tanggal_awal" class="form-control" maxlength="18" id="tanggal_awal" value="<?= @format_tanggal($matriks_kegiatan->tanggal_awal) ?>" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kembali</label>
                        <input type="text" name="tanggal_akhir" class="form-control" maxlength="18" id="tanggal_akhir" value="<?= @format_tanggal($matriks_kegiatan->tanggal_akhir) ?>" readonly>
                      </div>
                        </div> -->
                      </div>
                      <?php if($matriks_kegiatan->tipe ==1){?>
                      <div class="form-group">
                        <input type="checkbox" style="opacity:0; position:absolute; left:9999px;" name="is_sppd" id="is_sppd" <?=
                        $matriks_kegiatan->tipe ==1?'checked':'' ?> disabled>
                      </div>
                      <div class="form-group" id="is_transport" >
                        <label>Ada biaya transport?</label>
                        <input type="checkbox" name="is_transport" id="is_transport_st"  <?=
                        $matriks_kegiatan->is_transport_st == 0?'':'checked' ?>>
                      </div>

                      <?php if(!is_array($akun_bayar)){ ?>
                      <div class="form-group">
                        <label>Akun Pembayaran</label>
                        <input type="text" name="akun_bayar2" class="form-control" id="akun_bayar2" value="<?= $akun_bayar ?>" readonly>
                      </div>
                    <?php }else{ ?>
                      <div class="form-group" id='akun_bayar'>
                        <label>Akun Pembayaran</label>
                        <?php 
                          echo "<select class='form-control select2' name='akun_bayar' id='select_akun' required>";
                          echo "<option value=''>--Pilih Akun Bayar--</option>";
                          foreach ($akun_bayar as $key) {
                            if($akun_bayar_selected == $key->no_akun){
                              echo "<option selected value='".$key->no_akun."'>".'['.$key->no_akun.']'.$key->deskripsi."</option>";
                            }else{
                              echo "<option value='".$key->no_akun."'>".'['.$key->no_akun.']'.$key->deskripsi."</option>";
                            }
                          }
                          echo "</select>";
                        ?>
                      </div>
                      <?php } ?>
                      <div class="form-group" id="is_ppk">
                            <label>NO PPK</label>
                            <input type="text" name="no_ppk" class="form-control"  id="no_ppk" value="<?= $no_ppk ?>" width="10">
                          </div>
                    <?php } ?>
                      
                      
                      <?php if($matriks_kegiatan->tipe ==1){?>
                      <div class="form-group" id='no_sppd'>
                        <label>No SPPD <i class="fa fa-question-circle" title="Kosongkan jika hanya ingin mencetak surat tugas tanpa SPPD"></i></label>
                        <?php 
                         $tahun = date("Y", $matriks_kegiatan->tanggal_awal);
                          echo "<select class='form-control select2' name='no_sppd' id='select_no_sppd' required>";
                          echo "<option value=''>--Pilih No Surat--</option>";
                          foreach ($no_sppd as $key) {
                            $tahunx = date("Y", $key->tanggal);
                            if($tahun != $tahunx) continue;
                            if($no_sppd_selected == $key->id){
                              echo "<option selected value='".$key->id."'>".'['.$key->nomor.']'.$key->perihal."</option>";
                            }else{
                              echo "<option value='".$key->id."'>".'['.$key->nomor.']'.$key->perihal."</option>";
                            }
                          }
                          echo "</select>";
                        ?>
                      </div>
                       <?php } ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label>No Surat</label>
                        <?php 
                          $tahun = date("Y", $matriks_kegiatan->tanggal_awal);
                          echo "<select class='form-control select2' name='no_surat' id='no_surat' required>";
                          echo "<option value=''>--Pilih No Surat--</option>";
                          foreach ($no_surat as $key) {
                            $tahunx = date("Y", $key->tanggal);
                            if($tahun != $tahunx) continue;
                            if($no_surat_selected == $key->id){
                              echo "<option selected value='".$key->id."'>".'['.$key->nomor.']'.$key->perihal."</option>";
                            }else{
                              echo "<option value='".$key->id."'>".'['.$key->nomor.']'.$key->perihal."</option>";
                            }
                          }
                          echo "</select>";
                        ?>
                      </div>
                       <?php if($matriks_kegiatan->tipe ==1){?>
                     <div class="form-group">
                        <label>Kendaraan</label>
                        <select class="form-control" name="kendaraan" id="kendaraan" required>
                          <option value="Angkutan Umum" <?= ($kendaraan == 'Angkutan Umum')?'selected':'' ?>> Angkutan Umum</option>
                          <option value="Kendaraan Dinas" <?= ($kendaraan == 'Kendaraan Dinas')?'selected':'' ?>> Kendaraan Dinas</option>
                        </select>
                        <!-- <input type="text" name="kendaraan" class="form-control"  id="kendaraan" value="" required> -->
                      </div>
                      <div class="form-group">
                        <label>Berangkat Dari</label>
                        <input type="text" name="berangkat" class="form-control" id="berangkat" value="<?= $berangkat ?>" required >
                      </div>
                      <div class="form-group">
                        <label>Tujuan</label>
                       <!--  <select name="tujuan" class="form-control select2" required id="tujuan_load">
                            <option value="">-Pilih Tujuan-</option>
                          </select> -->
                        <input type="text" name="tujuan" class="form-control" id="tujuan" value="<?= $tujuan ?>" required >
                      </div>
                      <div class="form-group">
                        <label>Perkiraan Biaya</label>
                        <input type="text" name="perkiraan_biaya" class="form-control"  onchange="cek_pagu()" id="perkiraan_biaya" value="<?= $perkiraan_biaya ?>" required>
                      </div>
                    <?php }else{ ?>
                      <div class="row">
                      <div class="col-sm-6">
                         <label>Template</label>
                            <select name="template" class="form-control" required>
                            <option value="">-Pilih template-</option>
                            <option value="kab" <?= ($template == 'kab')?'selected':'' ?>>Kabupaten/Kota</option>
                            <option value="prov" <?= ($template == 'prov')?'selected':'' ?>>Provinsi</option>
                            <option value="ind" <?= ($template == 'ind')?'selected':'' ?>>Pusat</option>
                          </select>
                           
                          </div>

                          <div class="form-group">
                            <label>Melakukan pengawasan?</label>
                            <input type="checkbox" name="is_pengawasan" id="is_pengawasan" <?=
                            $is_pengawasan == 0?'':'checked' ?>>
                          </div>
                          </div>
                      <!-- <div class="form-group" id="is_transport" >
                        <label>Ada biaya transport?</label>
                        <input type="checkbox" name="is_transport" id="is_transport_st"  <?=
                        $matriks_kegiatan->is_transport_st == 0?'':'checked' ?>>
                      </div>

                      <div class="form-group" id='akun_bayar'>
                        <label>Akun Pembayaran</label>
                        <?php 
                          echo "<select class='form-control select2' name='akun_bayar' id='select_akun' required>";
                          echo "<option value=''>--Pilih Akun Bayar--</option>";
                          foreach ($akun_bayar as $key) {
                            if($akun_bayar_selected == $key->no_akun){
                              echo "<option selected value='".$key->no_akun."'>".'['.$key->no_akun.']'.$key->deskripsi."</option>";
                            }else{
                              echo "<option value='".$key->no_akun."'>".'['.$key->no_akun.']'.$key->deskripsi."</option>";
                            }
                          }
                          echo "</select>";
                        ?>
                      </div>
                      <div class="form-group" id="is_ppk">
                            <label>NO PPK</label>
                            <input type="text" name="no_ppk" class="form-control"  id="no_ppk" value="<?= $no_ppk ?>" width="10">
                          </div> -->
                    <?php } ?>
                    </div>
                    </div>
                    
                    
                  </div>
                  
                  <div class="col-lg-4 col-md-4">
                    <!-- <div class="row">
                      <div class="col-lg-6 col-sm-6">
                      <div class="form-group">
                        <label>Tujuan 1</label>
                        <input type="text" name="tujuan1" class="form-control" maxlength="18" id="tujuan1">
                      </div>
                      <div class="form-group">
                        <label>Tujuan 2</label>
                        <input type="text" name="tujuan2" class="form-control" maxlength="18" id="tujuan2">
                      </div>
                      <div class="form-group">
                        <label>Tujuan 3</label>
                        <input type="text" name="tujuan3" class="form-control" maxlength="18" id="tujuan3">
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <div class="form-group">
                        <label>Lama di tujuan 1</label>
                        <input type="number" name="lama1" class="form-control" maxlength="18" id="lama1">
                      </div>
                      <div class="form-group">
                        <label>Lama di tujuan 2</label>
                        <input type="number" name="lama2" class="form-control" maxlength="18" id="lama2">
                      </div>
                      <div class="form-group">
                        <label>Lama di tujuan 3</label>
                        <input type="number" name="lama3" class="form-control tanggal" maxlength="18" id="lama3">
                      </div>
                      
                    </div>
                    </div> -->
                    <div class="row">
                      <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                          <label>Perihal</label>
                          <textarea name="perihal" class="form-control"  id="perihal" required><?= $perihal ?></textarea>
                        </div>
                        
                      </div>
                          
                          <?php if($matriks_kegiatan->tipe ==1){?>
                            <div class="col-sm-4">
                            <select name="template" class="form-control" required>
                            <option value="">-Pilih template-</option>
                            <option value="kab" <?= ($template == 'kab')?'selected':'' ?>>Kabupaten/Kota</option>
                            <option value="prov" <?= ($template == 'prov')?'selected':'' ?>>Provinsi</option>
                            <option value="ind" <?= ($template == 'ind')?'selected':'' ?>>Pusat</option>
                          </select>
                           
                          </div>
                          <div class="form-group">
                            <label>Melakukan pengawasan?</label>
                            <input type="checkbox" name="is_pengawasan" id="is_pengawasan" <?=
                            $is_pengawasan == 0?'':'checked' ?>>
                          </div>

                          <div class="col-lg-12 col-md-12">
                            <div class="card card-warning">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" style="font-size:15px">
                                    Tanda tangan Visum
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <div class="form-group">
                                      <i>*Kosongkan jika TTD Visum adalah Kepala Kantor</i>
                                    </div>
                                    <div class="form-group">
                                      <label>Nama</label>
                                      <input type="text"  class="form-control" name="visum_nama"  id="visum_nama" value="<?= $visum_nama ?>" >
                                    </div>
                                    <div class="form-group">
                                      <label>NIP</label>
                                      <input type="text"  class="form-control" name="visum_nip" id="visum_nip" value="<?= $visum_nip ?>" >
                                    </div>
                                    <div class="form-group">
                                      <label>Jabatan</label>
                                      <input type="text"  class="form-control" name="visum_jabatan" id="visum_jabatan" value="<?= $visum_jabatan ?>" >
                                    </div>
                               </div>
                             </div>
                           </div>
                          </div>

                          <div class="col-lg-12 col-md-12">
                            <div class="card card-success">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" style="font-size:15px">
                                    Informasi Pagu
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                 Catatan untuk kegiatan ini: <br>
                                 1. Pagu total kegiatan sebesar <?= $pagu?format_uang($pagu->pagu):'-' ?><br>
                                 2. Realisasi sebesar <?= $pagu_realisasi?format_uang($pagu_realisasi->perkiraan):'-' ?><br>
                                 3. Terbayar sebesar <?= $pagu_realisasi?format_uang($pagu_realisasi->terbayar):'-' ?><br>
                                 4. Lakukan pengisian perkiraan biaya<br>
                                 5. Jika perkiraan biaya lebih dari sisa pagu maka SPD tidak dapat dicetak<br>
                                 6. Jika ada kesalahan pagu ataupun realisasi silahkan melapor ke Fungsi Keuangan<br>
                               </div>
                             </div>
                           </div>
                          </div>

                          <div class="col-lg-12 col-md-12">
                            <div class="card card-primary">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" style="font-size:15px">
                                    Opsi Cetak
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseThree" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <div class="form-group">
                                      <label>Cetak Lembar ke 4</label>
                                      <select class="form-control" name="opsi_lembar4" id="opsi_lembar4">
                                        <option value="1" <?= ($opsi_lembar4 == 1)?'selected':'' ?>>1. Ya</option>
                                        <option value="0" <?= ($opsi_lembar4 == 0)?'selected':'' ?>>2. Tidak</option>
                                      </select>
                                    </div>
                               </div>
                             </div>
                           </div>
                          </div>

                          <?php }?>
                          <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                <div class="float-lg-right">
                                  <label></label>
                                  <?php if($status != 4){ ?>
                                  <button type="submit" class="btn btn-primary" id="btn-simpan"> Simpan</button>
                                  <?php if($status != 0){ ?>
                                    <a href="<?= base_url('spd/print_spd').'?id='.$matriks_kegiatan->id.'&only_st='.$only_st.'&attachment=0' ?>" class="btn btn-warning" target="_blank"> <i class="fa fa-print"> Cetak </i></a>
                                  <?php } ?>
                                  <?php }else{ ?>
                                    <p><i>*SPD sudah terbayarkan</i></p>
                                  <?php } ?>
                                </div>
                              </div>
                          </div>
                    </div>
                  </div>
                 </div>
                 <br><br>
                  <?php if($matriks_kegiatan->tipe ==1){?>
                 <div class="row">
                  <div class="col-md-6 table-responsive">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Pengikut</h4>
                        <p><i>Jika diperlukan</i></p>
                      </div>
                      <div class="col-md-6">
                         <button type="button" data-toggle="modal" data-target="#modal_add_pengikut" class="btn btn-success float-sm-right"><i class="fa fa-plus">Pengikut</i></button>
                      </div>
                    </div>
                  <table id="table_pengikut" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                      <thead>
                          <th>Id</th>
                          <th>Nama</th>
                          <th>Tanggal Lahir</th>
                          <th>Keterangan</th>
                          <th>Hapus</th>
                      </thead>
                      <tbody>
                            
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6 table-responsive">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Detail Tujuan</h4>
                        <p><i>Jika diperlukan</i></p>
                      </div>
                      <div class="col-md-6">
                         <button type="button" data-toggle="modal" data-target="#modal_add" class="btn btn-success float-sm-right"><i class="fa fa-plus">Detail</i></button>
                      </div>
                    </div>
                    
                  <table id="table_rincian" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                      <thead>
                          <th>Urut</th>
                          <th>Berangkat</th>
                          <th>Tujuan</th>
                          <th>Tanggal</th>
                          <th>Hapus</th>
                      </thead>
                      <tbody>
                            
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
               </form>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

            <div class="modal fade" id="modal_add" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Tujuan (Masukkan tujuan dari pertama kali)</h5>
              </div>
              <div class="modal-body">
                <form class="form" id="form_rincian">
                  <input type="hidden" name="id_st" id="id_st" value="<?= $id_st ?>">
                  <div class="form-group">
                 <div class="row">
                   <div class="col-md-6">
                     <label>Urut Tujuan</label>
                      <input class="form-control"  type="number" name="urut" id="urut">
                   </div>
                   <div class="col-md-6">
                     <label>Set PP</label>
                      <input class="form-control" style="width: auto;box-shadow: none;"  type="checkbox" name="is_pp" id="is_pp" value="1">
                   </div>
                 </div>
                </div>
                  <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                     <label>Berangkat</label>
                      <input class="form-control"  type="text" name="berangkat" id="berangkat2">
                  </div>
                  <div class="col-md-6">
                    <label>Tujuan</label>
                    <input class="form-control" type="text" name="kembali" id="kembali">
                  </div>
                  </div>
                </div>
                <div class="form-group">
                 <label>Tanggal</label>
                 <input class="form-control" type="text" name="tanggal_tujuan" id="tanggal_tujuan">
                </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_tambahan()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <!-- pengikut -->

        <div class="modal fade" id="modal_add_pengikut" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Pengikut</h5>
              </div>
              <div class="modal-body">
                <form class="form" id="form_rincian_pengikut">
                  <input type="hidden" name="id_st_pengikut" id="id_st_pengikut" value="<?= $id_st ?>">
                  <div class="form-group">
                     <label>Nama</label>
                      <input class="form-control"  type="text" name="pengikut_nama" id="pengikut_nama" required="required">
                  </div>
                  <div class="form-group">
                   <label>Tanggal Lahir</label>
                   <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir">
                  </div>
                  <div class="form-group">
                     <label>Keterangan</label>
                      <textarea class="form-control"  type="text" name="pengikut_ket" id="pengikut_ket" required="required"> </textarea> 
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_pengikut()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    </div>
  </div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="<?php echo base_url('assets/js/typeahead.js') ?>"></script>
<script type="text/javascript">

var realisasi = <?= $pagu_realisasi->perkiraan?$pagu_realisasi->perkiraan:0 ?>;
pagu = <?= isset($pagu->pagu)?$pagu->pagu:0 ?>

  function form_print() {
    alert(div.data('id'));
  }   


function form_submit_tambahan(){
  var post_data ={};
     post_data['form'] = $('#form_rincian').serializeObject();
      $.ajax({
          type: "POST",
          url: "<?= base_url('spd/add_tujuan') ?>",
          data: post_data,
          beforeSend: function(){
                swal.fire({
                    html: '<h5>Loading...</h5>',
                    showConfirmButton: false,
                    onRender: function() {
                         // there will only ever be one sweet alert open.
                         $('.swal2-content').prepend(sweet_loader);
                    }
                });
            },
          success: function (response) {
           Swal.fire(
                'Berhasil',
                'Data berhasil disimpan',
                'success'
              )
            $('#modal_add').modal('hide');
            load_table($('#id_st').val());
            $('#urut').val('')
            $('#berangkat2').val('')
            $('#kembali').val('')
            $('#tanggal_tujuan').val('')

          },
          error: function() {
            alert("Terjadi kesalahan!");
          }
        });
}

function form_submit_pengikut(){
  var post_data ={};
     post_data['form'] = $('#form_rincian_pengikut').serializeObject();
      $.ajax({
          type: "POST",
          url: "<?= base_url('spd/add_pengikut') ?>",
          data: post_data,
          beforeSend: function(){
                swal.fire({
                    html: '<h5>Loading...</h5>',
                    showConfirmButton: false,
                    onRender: function() {
                         // there will only ever be one sweet alert open.
                         $('.swal2-content').prepend(sweet_loader);
                    }
                });
            },
          success: function (response) {
           Swal.fire(
                'Berhasil',
                'Data berhasil disimpan',
                'success'
              )
            $('#modal_add_pengikut').modal('hide');
            load_table_pengikut($('#id_st').val());
          },
          error: function() {
            alert("Terjadi kesalahan!");
          }
        });
}

  function delete_tujuan(id){

   Swal.fire({
    title: 'Apakah anda ingin menghapus data?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Tidak'
  }).then((result) => {
    if (result.isConfirmed) {
      var post_data ={};
      post_data['id'] =id;
      $.ajax({
        url: "<?= base_url('spd/delete_tujuan') ?>",
        type: "POST",
        data: post_data,
        dataType: "JSON",
        beforeSend: function(){
          swal.fire({
            html: '<h5>Loading...</h5>',
            showConfirmButton: false,
            onRender: function() {
                           // there will only ever be one sweet alert open.
                           $('.swal2-content').prepend(sweet_loader);
                         }
                       });
        },
        success: function(response)
        {
          Swal.fire(
            'Berhasil',
            'Data berhasil dihapus',
            'success'
            )
          load_table($('#id_st').val());
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error adding data');
        }
      });
    }
  })

  }

  function delete_pengikut(id){


    Swal.fire({
      title: 'Apakah anda ingin menghapus data?',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.isConfirmed) {
        var post_data ={};
        post_data['id'] =id;
        $.ajax({
          url: "<?= base_url('spd/delete_pengikut') ?>",
          type: "POST",
          data: post_data,
          dataType: "JSON",
          beforeSend: function(){
            swal.fire({
              html: '<h5>Loading...</h5>',
              showConfirmButton: false,
              onRender: function() {
                           // there will only ever be one sweet alert open.
                           $('.swal2-content').prepend(sweet_loader);
                         }
                       });
          },
          success: function(response)
          {
            Swal.fire(
              'Berhasil',
              'Data berhasil dihapus',
              'success'
              )
            load_table_pengikut($('#id_st').val());
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error adding data');
          }
        });
      }
    })
    
  }

  function load_tujuan(){
      console.log('ok')
    $.ajax({
          type: "GET",
          url: "<?= base_url('spd/get_tujuan') ?>",
          data: post_data,
          success: function (data) {
            $('#tujuan').html(data);
            //$('#sub_keg_iki').show();
          },
          error: function() {
            alert("Terjadi kesalahan!");
          }
        });
  }

  function load_table_pengikut(id){
   var post_data ={};
   post_data['id'] =id;
    $.ajax({
            url: "<?= base_url('spd/get_table_pengikut') ?>",
            type: "POST",
            data: post_data,
            dataType: "JSON",
            success: function(response)
            {
                table_data = response.data;
                reload_table_pengikut(response.data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
   }

 function load_table(id){
   var post_data ={};
   post_data['id'] =id;
    $.ajax({
            url: "<?= base_url('spd/get_table_tujuan') ?>",
            type: "POST",
            data: post_data,
            dataType: "JSON",
            success: function(response)
            {
                table_data = response.data;
                reload_table(response.data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
   }

   function cek_pagu(){
      let cek = realisasi + parseInt($('#perkiraan_biaya').val()) 
      if(pagu < cek){
        console.log(cek);
        Swal.fire(
          'Perhatian',
          'Perkiraan biaya melebihi pagu',
          'danger'
        )
        $('#perkiraan_biaya').val("")
      }
   }


   function reload_table_pengikut(data){

      $('#table_pengikut').DataTable( {
        "bFilter": false,
        "responsive": true,
        "paging":   false,
        "destroy": true,
        "data":data,
        "columns": [
            { "data": "pengikut_id"},
            { "data": "pengikut_nama"},
            { "data": "pengikut_ttl"},
            { "data": "pengikut_ket"},
            { "data": "aksi" },
        ]
    } );
    }

   function reload_table(data){

      $('#table_rincian').DataTable( {
        "bFilter": false,
        "responsive": true,
        "paging":   false,
        "destroy": true,
        "data":data,
        "columns": [
            { "data": "tj_urutan"},
            { "data": "tj_berangkat"},
            { "data": "tj_kembali"},
            { "data": "tj_tanggal"},
            { "data": "aksi" },
        ]
    } );
    }

    /*$('#tujuan').typeahead({
    source: function (query, result) {
      $.ajax({
        url: "<?= base_url('spd/get_tujuan') ?>",
        data: {query:query},            
        dataType: "json",
        type: "GET",
        success: function (data) {
          result($.map(data, function (item) {
            return item;
          }));
        }
      });
    }
  });*/

  function load_tujuan(){
    $.ajax({
          type: "GET",
          url: "<?= base_url('spd/get_tujuan') ?>",
          data: {},
          beforeSend: function(){
                swal.fire({
                    html: '<h5>Menyiapkan...</h5>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    onRender: function() {
                         // there will only ever be one sweet alert open.
                         $('.swal2-content').prepend(sweet_loader);
                    }
                });
            },
          success: function (data) {
             swal.close()
            $('#tujuan_load').html(data);
          },
          error: function() {
            alert("Terjadi kesalahan!");
          }
        });
  }


$(document).ready(function(){
  $('select').select2({
    width: '100%'
  });

<?php if($this->session->flashdata('success')) { ?>
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Data Berhasil Disimpan',
        text: "Apakah akan langsung mencetak?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Ya, langsung cetak',
        cancelButtonText: 'Tidak, nanti saja',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
           window.location.href = "<?= base_url('spd/print_spd?id='.$matriks_kegiatan->id."&only_st=".$matriks_kegiatan->only_st) ?>";
        } 
      })
  <?php }else{ ?>
load_tujuan()
  <?php } ?>


    $('#tanggal_tujuan').daterangepicker({
    "drops": "up",
    autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });

    $('#tanggal_tujuan').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      daterange = this;
      var id = daterange.getAttribute('id').match(/\d+/); // 123456
      validasi_tanggal(id)

  });

    load_table($('#id_st').val());
load_table_pengikut($('#id_st').val());

  if ($('#is_sppd').is(':checked')) {
          $('#is_transport').hide();
          $('#select_no_sppd').prop("checked",false);
            $('#akun_bayar').show();  
            $('#no_sppd').show();
            $('#is_ppk').show();
            $('#select_no_sppd').prop("required",true);
            $('#select_akun').prop("required",true);
            $("#kendaraan").prop("readonly", false);
            $("#tujuan").prop("readonly", false);
            $("#berangkat").prop("readonly", false);
            $("#tujuan1").prop("readonly", false);
            $("#tujuan2").prop("readonly", false); 
            $("#tujuan3").prop("readonly", false); 
            $("#lama1").prop("readonly", false);
            $("#lama2").prop("readonly", false);
            $("#lama3").prop("readonly", false);             
        } else {
            $('#is_transport').show();
            $('#akun_bayar').hide();  
            $('#no_sppd').hide();
            $('#is_ppk').hide();
            $('#select_no_sppd').prop("required",false);
            $('#select_akun').prop("required",false);
            $("#kendaraan").prop("readonly", true);
            $("#tujuan").prop("readonly", true);
            $("#berangkat").prop("readonly", true);
            $("#tujuan1").prop("readonly", true); 
            $("#tujuan2").prop("readonly", true); 
            $("#tujuan3").prop("readonly", true); 
            $("#lama1").prop("readonly", true);
            $("#lama2").prop("readonly", true);
            $("#lama3").prop("readonly", true); 
        }

  if ($('#is_transport_st').is(':checked')) {
     alert('ok')
  }

  $('#is_transport_st').click(function() {
    if ($(this).is(':checked')) {
      $('#akun_bayar').show();  
      $('#is_ppk').show();
    }else{
      $('#akun_bayar').hide();  
      $('#is_ppk').hide();
    }
  });

  $('#is_sppd').click(function() {
        if ($(this).is(':checked')) {
          $('#is_transport').hide();
           $('#select_no_sppd').prop("checked",false);
          $('#akun_bayar').show();  
            $('#no_sppd').show();
            $('#is_ppk').show();
            $('#select_no_sppd').prop("required",true);
            $('#select_akun').prop("required",true);
            $("#kendaraan").prop("readonly", false);
            $("#tujuan").prop("readonly", false);
            $("#berangkat").prop("readonly", false);
            $("#tujuan1").prop("readonly", false);
            $("#tujuan2").prop("readonly", false); 
            $("#tujuan3").prop("readonly", false); 
            $("#lama1").prop("readonly", false);
            $("#lama2").prop("readonly", false);
            $("#lama3").prop("readonly", false);             
        } else {
          $('#is_transport').show();
          $('#akun_bayar').hide();  
            $('#no_sppd').hide();
            $('#is_ppk').hide();
            $('#select_no_sppd').prop("required",false);
            $('#select_akun').prop("required",false);
            $("#kendaraan").prop("readonly", true);
            $("#tujuan").prop("readonly", true);
            $("#berangkat").prop("readonly", true);
            $("#tujuan1").prop("readonly", true); 
            $("#tujuan2").prop("readonly", true); 
            $("#tujuan3").prop("readonly", true); 
            $("#lama1").prop("readonly", true);
            $("#lama2").prop("readonly", true);
            $("#lama3").prop("readonly", true); 
        }
    });

});

$.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
 
</script>
</body>
</html>
