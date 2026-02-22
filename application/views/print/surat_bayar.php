
<?php
$riil= 0;
?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= $surat_bayar->nama ?></title>
    <style type="text/css">
    .font {font-family:times;}
    .isi {font-family:times; font-size:11pt;text-align: justify;}
    .center {text-align: center;}
    .no-border-right {border-right: none;}
    .border-right {border-right: 1px solid; margin-right: 5px; }
    .no-border-bottom{border-bottom: none;}
    .no-border-top{border-top: none;}
    .bold{font-weight: bold;}
    .footer {position: fixed;bottom: 30;text-align:center;font-size:10}
    .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
    hr.garis{margin: 0;border: solid black;border-width: 1px 0 0;}
    hr.garis-double{margin: 0;border: double black;border-width: 1px 0 0;}
    hr.garis-putus{margin: 0;border: dotted black;border-width: 1px 0 0; width: 60%}
    .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
    .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
    .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
    .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
    .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
    @page { margin: 1.3cm 1.6cm 0.5px 2cm; }
</style>
<head>
    <body >
        <div class="isi">
            <table width="100%">
                <tr>
                    <td>
                        <center>
                            <!-- <img src='https://banuareload.com/assets/img/image002.png' width='80px'> -->
                          <?= "<img src='".base_url('assets').'/img/image002.jpg'."' width='80px'>" ?>
                        </center>
                    </td>
                </tr>
            </table>
            <br/>
            <table width="100%" class="isi" style="outline: 1px solid">
                <tr>
                    <td colspan="5" >
                        <center> 
                            LEMBAGA PEMERINTAH NON DEPARTEMEN
                        </center>
                        <center>
                            BADAN PUSAT STATISTIK <?= strtoupper($spd_setting['bps_satker_name'.'_'.$surat_bayar->template]) ?>
                            (<?= $spd_setting['bps_satker_kode'.'_'.$surat_bayar->template] ?>)
                        </center>
                        <br/>
                        <center class="bold">
                            <u>SURAT PERINTAH BAYAR</u>
                        </center>
                        <center>
                            Tanggal : <?= $tanggal_bayar ?> &nbsp;&nbsp;No. <?= $no_surat_bayar ?>
                        </center>
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                <tr>
                   <td colspan="5" style="padding-left: 20px;padding-right: 10px">
                    Saya yang bertanda tangan di bawah ini selaku Pejabat Pembuat Komitmen memerintahkan Bendahara Pengeluaran agar melakukan pembayaran sejumlah : <br/>
                    <?= @format_uang($surat_bayar->uang_total) ?>
                </td> 
            </tr>
            <tr>
                <td colspan="8"><hr class="garis"></hr></td>
            </tr>
            <tr>
                <td colspan="5">
                    <center><?= terbilang($surat_bayar->uang_total).' rupiah' ?> </center>
                </td>
            </tr>
            <tr>
                <td colspan="8"><hr class="garis-double"></hr></td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr>
                <td class="no-border-bottom no-border-right" style="padding-left: 20px" colspan="2">Kepada </td>
                <td>: </td>
                <td colspan="2" class="bold"> <?= $surat_bayar->nama ?> </td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr valign="top">
                <td style="padding-left: 20px"  colspan="2">Untuk pembayaran </td>
                <td>: </td>
                <td colspan="2" class="bold" style="padding-right: 10px"> Biaya <?= $surat_bayar->tugas_spd ?> </td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr><td colspan="5" style="padding-left: 20px">Atas dasar:</td></tr>
            <tr>
                <td width="3%" style="padding-left: 20px">1. </td>
                <td width="25%">Kuitansi/bukti pembelian</td>
                <td>: </td>
                <td colspan="2" class="bold"> Terlampir</td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr valign="top">
                <td style="padding-left: 20px">2. </td>
                <td style="padding-right: 10px">Nota/bukti penerimaan barang/jasa <br>(Bukti lainnya)</td>
                <td>: </td>
                <td colspan="2" class="bold"> Terlampir</td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr><td colspan="5" style="padding-left: 20px">Dibebankan pada :</td></tr>
            <tr>
                <td></td>
                <td>Kegiatan, output, MAK</td>
                <td>: </td>
                <td colspan="2" class="bold">
                    <?php 
                     $akun = $surat_bayar->akun_bayar;
                     if(strpos($akun,'524113') !== false){
                        echo "Perjalanan Dinas Dalam Kota Lebih dari 8 Jam";
                     }else{
                     if(strpos($akun,'524111') !== false){
                        echo "Perjalanan Dinas Biasa</td>";
                     }elseif(strpos($akun,'524119') !== false){
                         echo "Perjalanan Dinas Paket Meeting Luar Kota";
                     }elseif(strpos($akun,'524114') !== false){
                        echo "Perjalanan Dinas Paket Meeting Dalam Kota";
                     }else{
                        echo "Perjalanan Dinas Dalam Kota Lebih dari 8 Jam";
                     }
                 }
                     ?>
                </td>
            </tr>
<tr><td colspan="5"><br></td></tr>
<tr>
    <td></td>
    <td>Kode</td>
    <td>: </td>
    <td colspan="2" class="bold"> <?= $akun_bayar_lengkap /*$surat_bayar->akun_bayar*/ ?></td>
</tr>
<tr><td colspan="5"><br></td></tr>
<tr><td colspan="5"><br></td></tr>
<tr>
    <td colspan="5"></td>
</tr>
<tr>
    <td colspan="8"><hr class="garis-double"></hr></td>
</tr>
<tr>
    <td colspan="4"></td>
    <td><?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?>,  <?= format_tanggal(strtotime($surat_bayar->tanggal_dibuat),true) ?></td>
</tr>
<tr><td colspan="5"><br></td></tr>
<tr valign="top">
    <td colspan="2" style="padding-left:20px">Setuju/lunas dibayar <br> Tanggal  <?= $tanggal_bayar ?> <br> Bendahara Pengeluaran <br><br><br><br><br>
    </td>
    <td width="2%"></td>
    <td width="31%" style="padding-right: 8px">Diterima Tanggal <br> Penerima Uang/ Uang Muka Kerja  <br><br><br><br><br>
    </td>
    <td width="39%">
        <center>
            <?php if( isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                    Kuasa Pengguna Anggaran <br> <br><br><br><br> <br>
                <?php }else{?>
                    An. Kuasa Pengguna Anggaran <br> Pejabat Pembuat Komitmen  <br><br><br><br> <br>
                <?php } ?>
        </center>
    </td>
</tr>
<tr>
    <td colspan="2"><center><u><?= $spd_setting['bps_bendahara'.'_'.$surat_bayar->template] ?></u> <br>
        NIP. <?= $spd_setting['bps_bendahara_nip'.'_'.$surat_bayar->template] ?></center></td>
        <td></td>
        <td><center><u><?= $surat_bayar->nama ?></u> <br>
            NIP. <?= $surat_bayar->nip ?></center></td>
            <td><center>
                <?php if(isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                                    <u><?= $spd_setting['bps_head'.'_'.$surat_bayar->template] ?></u><br/>
                                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat_bayar->template] ?>
                                <?php }else{?>
                                    <u><?= $spd_setting['bps_ppk'.'_'.$surat_bayar->template] ?> </u> <br/>
                                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat_bayar->template] ?>
                                <?php } ?>
            </center></td>
            </tr>
        </table>

        <div class="footer">
            <center>
                <?= $spd_setting['bps_address'.'_'.$surat_bayar->template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$surat_bayar->template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$surat_bayar->template] ?> <br/>
                Website : <?= $spd_setting['bps_website'.'_'.$surat_bayar->template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$surat_bayar->template] ?>
            </center>
        </div>
    </div>

    <div class="isi" style=" page-break-before: always;">
        <table>
            <tr>
                <td rowspan="3">
                    <?= "<img src='".base_url('assets').'/img/image002.jpg'."' width='80px'>" ?>
                </td>
                <td rowspan="3" class="bold" width="100px"><span style="font-family: Arial, sans-serif; font-style: italic;font-weight: bold; font-size: 12px;">Badan Pusat Statistik <br/>
                    <?= $spd_setting['bps_satker_name'.'_'.$surat_bayar->template] ?> </span>
                </td>
                <td rowspan="3" width="100px"></td>
                <td> Bukti Kas No. </td>
                <td> :</td>
                <td></td>
            </tr>
            <tr>
                <td> Beban MAK </td>
                <td> :</td>
                <td><?= $surat_bayar->akun_bayar ?></td>
            </tr>
            <tr>
                <td> Tahun Anggaran </td>
                <td> :</td>
                <td><?= $th_anggaran ?></td>
            </tr>
        </table>
        <br/>
        <br/>
        <center><b>KUITANSI</b></center> <br>
        <table cellspacing="0" cellpadding="0" width="100%" style="outline: 1px solid;">
            <tr>
                <td colspan="2">Sudah terima dari </td>
                <td>: </td>
                <td colspan="3">Kuasa Pengguna Anggaran BPS <?= $spd_setting['bps_satker_name'.'_'.$surat_bayar->template] ?> </td>
            </tr>
            <tr>
                <td colspan="2">Uang sebesar </td>
                <td>: </td>
                <td colspan="3"><?= terbilang($surat_bayar->uang_total).' rupiah' ?> </td>
            </tr>
            <tr valign="top">
                <td colspan="2">Untuk Pembayaran </td>
                <td>: </td>
                <td colspan="3"><?= $surat_bayar->tugas_spd ?></td>
            </tr>
            <tr>
                <td colspan="2">Berdasarkan SPD Nomor/Tanggal </td>
                <td>: </td>
                <td colspan="3"> <?= $surat_bayar->no_sppd ?> / <?= format_tanggal($surat_bayar->tanggal_sppd,true) ?> </td>
            </tr>
            <tr>
                <td colspan="2">Untuk Perjalanan Dinas </td>
                <td>: </td>
                <td colspan="3"><?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?> - <?= $surat_bayar->tujuan ?> </td>
            </tr>
            <tr>
                <td colspan="6"><hr class="garis"></hr></td>
            </tr> 
            <tr>
                <td colspan="2">Jumlah </td>
                <td>: </td>
                <td colspan="3"><?= @format_uang($surat_bayar->uang_total) ?></td>
            </tr>
            <tr>
                <td colspan="6"><hr class="garis"></hr></td>
            </tr> 
        </table>
        <table width="100%" style="outline: 1px solid">
            <tr>
                <td>
                    <center>
                        Setuju dibayar : <br>
                         <?php if( isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                            Kuasa Penguna Anggaran <br>
                            <br>
                            <br><br><br>
                        <?php }else{?>
                            An. Kuasa Penguna Anggaran <br>
                            Pejabat Pembuat Komitmen, <br>
                            <br><br><br>
                        <?php } ?>
                        <?php if(isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                                    <?= $spd_setting['bps_head'.'_'.$surat_bayar->template] ?><br/>
                                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat_bayar->template] ?>
                                <?php }else{?>
                                    <?= $spd_setting['bps_ppk'.'_'.$surat_bayar->template] ?>  <br/>
                                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat_bayar->template] ?>
                                <?php } ?>
                    </center>
                </td>
                <td>
                    <center>
                        <?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?>, <?= format_tanggal(strtotime($surat_bayar->tanggal_dibuat),true) ?> <br>
                        <br>
                        Yang Menerima, <br>
                        <br><br><br>
                        <?= $surat_bayar->nama ?> <br>
                        NIP. <?= $surat_bayar->nip ?>
                    </center>
                </td>
            </tr>
        </table>
        <table width="100%" style="outline: 1px solid">
            <tr>
                <td colspan="4">
                    <center><b>RINCIAN BIAYA PERJALANAN</b></center>
                </td>
            </tr>
            <tr>
                <td colspan="4"><hr class="garis"></hr></td>
            </tr> 
            <tr>
                <td class="border-right" width="5%" style="text-align: center;">No</td>
                <td class="border-right" width="45%" style="text-align: center;">Perincian Biaya</td>
                <td class="border-right" width="15%" style="text-align: center;">Jumlah</td>
                <td width="35%" style="text-align: center;">Keterangan</td>
            </tr>
            <tr>
                <td colspan="6"><hr class="garis"></hr></td>
            </tr> 
            <tr>
                <td class="border-right" width="5%" style="text-align: center;">
                    <center>
                        1. <br>
                        2. <br>
                        3. <br> <br><br><br><br>
                        4. <br> <br><br>
                        5. <br><br><br>
                        6. <br>
                        7. <br>
                    </center>
                </td>
                <td class="border-right" width="40%" >
                    Nama Pegawai : <?= $surat_bayar->nama ?><br>
                    Golongan     : <?= $surat_bayar->golongan ?> <br>
                    <hr class="garis"></hr>
                    Uang Harian  : <br> 
                    <?= $surat_bayar->waktu_harian.' hari' ?> x <?= @format_uang($surat_bayar->uang_harian).',-' ?>
                    <br>
                    <?= $surat_bayar->waktu_fullboard.' hari' ?> x <?= @format_uang($surat_bayar->uang_harian_fullboard).',-' ?>
                    <br><br><br>
                    Transport PP (Tiket Pesawat/Taksi) : <br>
                     <?= ($surat_bayar->opsi_cc == 1 || $surat_bayar->opsi_cc == 2)?'<br><br>':''.'<br><br>' ?>
                    Penginapan <br>
                    <?= (($surat_bayar->opsi_cc == 1 || $surat_bayar->opsi_cc == 3) &&  $surat_bayar->uang_penginapan_kwitansi == 0)?'-<br><br>':$surat_bayar->waktu_penginapan_kwitansi.' hari x '.@format_uang($surat_bayar->uang_penginapan_kwitansi).',-<br><br>' ?>
                    Biaya Pengeluaran Riil<br>
                    Biaya Representatif<br> 
                </td>
                <td class="border-right" width="20%" >
                    <br><br><br>
                    <?= @format_uang($surat_bayar->waktu_harian * $surat_bayar->uang_harian).',-' ?>
                    <br>
                    <?= @format_uang($surat_bayar->waktu_fullboard * $surat_bayar->uang_harian_fullboard).',-' ?>
                    <br>
                    <br><br>
                    <?= ($surat_bayar->opsi_cc == 1 || $surat_bayar->opsi_cc == 2)? @format_uang($surat_bayar->uang_transport).',-':@format_uang($surat_bayar->uang_transport).',-' ?> <br><br>
                      <br> <?= (($surat_bayar->opsi_cc == 1 || $surat_bayar->opsi_cc == 3) &&  $surat_bayar->uang_penginapan_kwitansi == 0)?  '-':@format_uang($surat_bayar->uang_penginapan_kwitansi*$surat_bayar->waktu_penginapan_kwitansi).',-' ?><br><br>
                      <br><?= @format_uang($surat_bayar->uang_riil).',-' ?><br><?= @format_uang($surat_bayar->uang_representatif).',-' ?>
                </td>
                <td class="border-right" valign="top" width="35%">
                    Perjalanan Dinas dilaksanakan selama<br>
                    <?= $jangka_waktu_hari ?> <br>
                    Tanggal   <?= $jangka_waktu ?><br> <br> <br><br><br>
                </td>
            </tr>
            <tr>
                <td colspan="6"><hr class="garis"></hr></td>
            </tr> 
            <tr>
                <td class="border-right"colspan="2"><center>Jumlah</center></td>
                <td class="border-right"><?= @format_uang($surat_bayar->uang_total).',-' ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6"><hr class="garis"></hr></td>
            </tr> 
            <tr>
                <td class="border-right" colspan="2"><center>Terbilang</center></td>
                <td class="border-right" colspan="2"><?= terbilang($surat_bayar->uang_total).' rupiah' ?></td>
            </tr>
        </table>
        <table width="100%" style="outline: 1px solid">
            <tr>
                <td class="border-right">
                    <br>
                    Telah dibayarkan uang sejumlah <br>
                    <?= @format_uang($surat_bayar->uang_total).',-' ?> <br> <br>
                    Bendahara Pengeluaran,
                    <br><br><br><br>
                    <?= $spd_setting['bps_bendahara'.'_'.$surat_bayar->template] ?> <br>
                    NIP. <?= $spd_setting['bps_bendahara_nip'.'_'.$surat_bayar->template] ?>
                </td>
                <td class="border-right">
                    <br>
                    <center>
                       Setuju dibayar : <br>
                         <?php if( isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                            Kuasa Penguna Anggaran <br>
                            <br>
                            <br><br><br>
                        <?php }else{?>
                            An. Kuasa Penguna Anggaran <br>
                            Pejabat Pembuat Komitmen, <br>
                            <br><br><br>
                        <?php } ?>
                        <?php if(isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                                    <?= $spd_setting['bps_head'.'_'.$surat_bayar->template] ?><br/>
                                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat_bayar->template] ?>
                                <?php }else{?>
                                    <?= $spd_setting['bps_ppk'.'_'.$surat_bayar->template] ?>  <br/>
                                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat_bayar->template] ?>
                                <?php } ?>
                    </center>
                </td>
                <td>
                 <?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?>, <?= $tanggal_bayar ?> <br><br>
                 <center>
                    Telah menerima jumlah uang sebesar: <br>
                    <?= @format_uang($surat_bayar->uang_total).',-' ?> <br>
                    Yang berpergian <br>
                    <br><br><br>
                    <?= $surat_bayar->nama ?> <br>
                    NIP. <?= $surat_bayar->nip ?>
                </center> 
            </td>
        </tr>
    </table>
    <div class="footer">
        <center>
            <?= $spd_setting['bps_address'.'_'.$surat_bayar->template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$surat_bayar->template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$surat_bayar->template] ?> <br/>
            Website : <?= $spd_setting['bps_website'.'_'.$surat_bayar->template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$surat_bayar->template] ?>
        </center>
    </div>
</div>

<!-- Kartu kredit -->
<?php if($surat_bayar->opsi_cc != 0){ ?>
        <div class="isi">
            <table width="100%">
                <tr>
                    <td>
                        <center>
                            <!-- <img src='https://banuareload.com/assets/img/image002.png' width='80px'> -->
                          <?= "<img src='".base_url('assets').'/img/image002.jpg'."' width='80px'>" ?>
                        </center>
                    </td>
                </tr>
            </table>
            <br/>
            <table width="100%" class="isi" style="outline: 1px solid">
                <tr>
                    <td colspan="5" >
                        <center> 
                            LEMBAGA PEMERINTAH NON DEPARTEMEN
                        </center>
                        <center>
                            BADAN PUSAT STATISTIK <?= strtoupper($spd_setting['bps_satker_name'.'_'.$surat_bayar->template]) ?>
                            (<?= $spd_setting['bps_satker_kode'.'_'.$surat_bayar->template] ?>)
                        </center>
                        <br/>
                        <center class="bold">
                            <u>SURAT PERINTAH BAYAR</u>
                        </center>
                        <center>
                            Tanggal : <?= $tanggal_bayar ?> &nbsp;&nbsp;No. <?= $no_surat_bayar ?>
                        </center>
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                <tr>
                   <td colspan="5" style="padding-left: 20px;padding-right: 10px">
                    Saya yang bertanda tangan di bawah ini selaku Pejabat Pembuat Komitmen memerintahkan Bendahara Pengeluaran agar melakukan pembayaran sejumlah : <br/>
                    <?= @format_uang($surat_bayar->uang_total_cc) ?>
                </td> 
            </tr>
            <tr>
                <td colspan="8"><hr class="garis"></hr></td>
            </tr>
            <tr>
                <td colspan="5">
                    <center><?= terbilang($surat_bayar->uang_total_cc).' rupiah' ?> </center>
                </td>
            </tr>
            <tr>
                <td colspan="8"><hr class="garis-double"></hr></td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr>
                <td class="no-border-bottom no-border-right" style="padding-left: 20px" colspan="2">Kepada </td>
                <td>: </td>
                <td colspan="2" class="bold"> <?= $surat_bayar->nama ?> </td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr valign="top">
                <td style="padding-left: 20px"  colspan="2">Untuk pembayaran </td>
                <td>: </td>
                <td colspan="2" class="bold" style="padding-right: 10px"> <?= $teks.' '.$surat_bayar->tugas_spd ?> </td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr><td colspan="5" style="padding-left: 20px">Atas dasar:</td></tr>
            <tr>
                <td width="3%" style="padding-left: 20px">1. </td>
                <td width="25%">Kuitansi/bukti pembelian</td>
                <td>: </td>
                <td colspan="2" class="bold"> Terlampir</td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr valign="top">
                <td style="padding-left: 20px">2. </td>
                <td style="padding-right: 10px">Nota/bukti penerimaan barang/jasa <br>(Bukti lainnya)</td>
                <td>: </td>
                <td colspan="2" class="bold"> Terlampir</td>
            </tr>
            <tr><td colspan="5"><br></td></tr>
            <tr><td colspan="5" style="padding-left: 20px">Dibebankan pada :</td></tr>
            <tr>
                <td></td>
                <td>Kegiatan, output, MAK</td>
                <td>: </td>
                <td colspan="2" class="bold">
                    <?php 
                    $akun = explode('.', $surat_bayar->akun_bayar);
                   if(count($akun) == 0){
                        echo "Perjalanan Dinas Dalam Kota Lebih dari 8 Jam";
                     }else{
                     if($akun[sizeof($akun)-1] == '524111'){
                        echo "Perjalanan Dinas Biasa";
                     }elseif($akun[sizeof($akun)-1] == '524119'){
                         echo "Perjalanan Dinas Paket Meeting Luar Kota";
                     }elseif($akun[sizeof($akun)-1] == '524114'){
                        echo "Perjalanan Dinas Paket Meeting Dalam Kota";
                     }else{
                        echo "Perjalanan Dinas Dalam Kota Lebih dari 8 Jam";
                     }
                 }
        ?>
                </td>
            </tr>
<tr><td colspan="5"><br></td></tr>
<tr>
    <td></td>
    <td>Kode</td>
    <td>: </td>
    <td colspan="2" class="bold"> <?= $akun_bayar_lengkap/*$surat_bayar->akun_bayar */ ?></td>
</tr>
<tr><td colspan="5"><br></td></tr>
<tr><td colspan="5"><br></td></tr>
<tr>
    <td colspan="5"></td>
</tr>
<tr>
    <td colspan="8"><hr class="garis-double"></hr></td>
</tr>
<tr>
    <td colspan="4"></td>
    <td><?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?>,  <?= format_tanggal(strtotime($surat_bayar->tanggal_dibuat),true) ?></td>
</tr>
<tr><td colspan="5"><br></td></tr>
<tr valign="top">
    <td colspan="2" style="padding-left:20px">Setuju/lunas dibayar <br> Tanggal  <?= $tanggal_bayar ?> <br> Bendahara Pengeluaran <br><br><br><br><br>
    </td>
    <td width="2%"></td>
    <td width="31%" style="padding-right: 8px">Diterima Tanggal <br> Penerima Uang/ Uang Muka Kerja  <br><br><br><br><br>
    </td>
    <td width="39%">
        <center>
            An. Kuasa Pengguna Anggaran <br> Pejabat Pembuat Komitmen  <br><br><br><br> <br>
        </center>
    </td>
</tr>
<tr>
    <td colspan="2"><center style="padding-right: 11pt"><u><?= $spd_setting['bps_bendahara'.'_'.$surat_bayar->template] ?></u> <br>
        NIP. <?= $spd_setting['bps_bendahara_nip'.'_'.$surat_bayar->template] ?></center></td>
        <td></td>
        <td><center style="padding-right: 11pt"><u><?= $surat_bayar->nama ?></u> <br>
            NIP. <?= $surat_bayar->nip ?></center></td>
            <td><center style="padding-right: 11pt"><u><?= $spd_setting['bps_ppk'.'_'.$surat_bayar->template] ?></u> <br>
                NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat_bayar->template] ?></center></td>
            </tr>
        </table>

        <div class="footer">
            <center>
                <?= $spd_setting['bps_address'.'_'.$surat_bayar->template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$surat_bayar->template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$surat_bayar->template] ?> <br/>
                Website : <?= $spd_setting['bps_website'.'_'.$surat_bayar->template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$surat_bayar->template] ?>
            </center>
        </div>
    </div>

<?php } ?>

<div class="isi" style=" page-break-before: always;">
    <table>
            <tr>
                <td rowspan="3">
                    <?= "<img src='".base_url('assets').'/img/image002.jpg'."' width='80px'>" ?>
                </td>
                <td rowspan="3" class="bold"><span style="font-family: Arial, sans-serif; font-style: italic;font-weight: bold; font-size: 12px">Badan Pusat Statistik <br/>
                    <?= $spd_setting['bps_satker_name'.'_'.$surat_bayar->template] ?> </span>
                </td>
                <td rowspan="3" width="100px"></td>
                <td> Bukti Kas No. </td>
                <td> :</td>
                <td></td>
            </tr>
            <tr>
                <td> Beban MAK </td>
                <td> :</td>
                <td><?= $surat_bayar->akun_bayar ?></td>
            </tr>
            <tr>
                <td> Tahun Anggaran </td>
                <td> :</td>
                <td><?= $th_anggaran ?></td>
            </tr>
        </table>
        <br/>
<br>
<p align="center"><strong>DAFTAR  PENGELUARAN RIIL</strong></p>
<p>Yang bertanda tangan di bawah ini :</p>
<p style="padding-left: 25px">Nama                   : <?= $surat_bayar->nama ?> <br />
  NIP                      : <?= $surat_bayar->nip ?> <br />
  Jabatan                 : <?= $surat_bayar->jabatan ?> </p>
  <p>Berdasarkan Surat Perjalan Dinas (SPD)  Nomor :   <?= $surat_bayar->no_sppd ?>  tanggal : <?= format_tanggal($surat_bayar->tanggal_sppd,true) ?> dengan ini kami  menyatakan dengan sesungguhnya bahwa : </p>
  <ol>
    <li>Biaya transport pegawai dan/atau biaya penginapan dibawah  ini yang tidak dapat diperoleh bukti-bukti pengeluaran meliputi :</li>
</ol>

<table width="100%" border="0.5px">
  <tr>
    <td width="10%"><p align="center">No.</p></td>
    <td width="70%" colspan="5"><p align="center">Uraian</p></td>
    <td width="20%"><p align="center">Jumlah (Rp)</p></td>
</tr>
<tr>
    <td height="12" valign="top"><p align="center">(1)</p></td>
    <td height="12" colspan="5" valign="top"><p align="center">(2)</p></td>
    <td height="12" valign="top"><p align="center">(3)</p></td>
</tr>

<?php $no=1; foreach ($rincian_tambahan as $key) { ?>
<tr>
    <td ><p align="center"><?= $no ?></p></td>
    <td colspan="5" valign="top"><p><?= $key->rincian ?></p></td>
    <td ><p align="right"><?= $key->biaya_tambahan ?> </p></td>
</tr>
<?php $no++; $riil +=$key->biaya_tambahan; } ?>

<?php if($surat_bayar->uang_penginapan) {?>
<tr>
    <td><p align="center"><?= $no ?></p></td>
    <td colspan="5" valign="top"><p align="center"></p>Penginapan 30%</td>
    <td ><p align="right"><?= $surat_bayar->waktu_penginapan * $surat_bayar->uang_penginapan*0.3 ?> </p></td>
</tr>
<?php $riil+=$surat_bayar->waktu_penginapan * $surat_bayar->uang_penginapan*0.3;} ?>

<tr>
    <td colspan="6"><p align="center">Jumlah</p></td>
    <td><p align="right"><?= $riil ?></p></td>
</tr>

</table>

<ol start="2">
    <li>Jumlah uang tersebut pada angka 1 diatas benar-benar  dikeluarkan untuk pelaksanaan  dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran,  kami bersedia menyetorkan kelebihan tersebut ke Kas Negara</li>
</ol>

<p>Demikian Pernyataan ini  kami buat dengan sebenarnya, dipergunakan sebagaimana mestinya.</p>
<table width="100%">
  <tr>
    <td valign="top"><p>&nbsp;</p>
      <p align="center">Mengetahui/menyetujui<br />
        <?php if( isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
            Kuasa Penguna Anggaran <p>
        <?php }else{?>
            Pejabat Pembuat Komitmen, <p>
        <?php } ?>
      <p align="center">&nbsp;</p>
      <p align="center">&nbsp;</p>
      <p align="center">
         <?php if(isset($spd_setting['ttd']) && $surat_bayar->template == 'kab'){ ?>
                    <?= $spd_setting['bps_head'.'_'.$surat_bayar->template] ?><br/>
                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat_bayar->template] ?></p></td>
        <?php }else{?>
                    <?= $spd_setting['bps_ppk'.'_'.$surat_bayar->template] ?>  <br/>
                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat_bayar->template] ?></p></td>
        <?php } ?>

        <td  valign="top"><p>&nbsp;</p>
          <p align="center"><?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?>, <?= $tanggal_bayar ?> <br>
          Pelaksana SPD</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center"><?= $surat_bayar->nama ?> <br />
            NIP. <?= $surat_bayar->nip ?> </p></td>
        </tr>
    </table>
</div>

<?php if($surat_bayar->is_pernyataan_tdk_menginap) { ?>
<div class="isi" style=" page-break-before: always;">
    <table>
            <tr>
                <td rowspan="3">
                    <?= "<img src='".base_url('assets').'/img/image002.jpg'."' width='80px'>" ?>
                </td>
                <td rowspan="3" class="bold"><span style="font-family: Arial, sans-serif; font-style: italic;font-weight: bold;">Badan Pusat Statistik <br/>
                    <?= $spd_setting['bps_satker_name'.'_'.$surat_bayar->template] ?> </span>
                </td>
                <td rowspan="3" width="100px"></td>
                <td> </td>
                <td> </td>
                <td></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td></td>
            </tr>
        </table>
        <br/>
<br>
<p align="center"><strong>SURAT PERNYATAAN</strong></p>
<p>Yang bertanda tangan di bawah ini menyatakan bahwa:</p>
<p style="padding-left: 25px">Nama                   : <?= $surat_bayar->nama ?> <br />
  NIP                      : <?= $surat_bayar->nip ?> <br />
  Jabatan                 : <?= $surat_bayar->jabatan ?> <br />
  Unit Kerja            : <?= 'BPS '.$spd_setting['bps_satker_name'.'_'.$surat_bayar->template] ?> </p>
  <p>Telah melaksanakan <?= $surat_bayar->tugas_spd ?> dengan tidak menggunakan fasilitas penginapan. </p>

<p>Demikian surat pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
<table width="100%">
  <tr>
    <td valign="top"><p>&nbsp;</p>
      <p align="center">Mengetahui<br />
        Kepala BPS <?= $spd_setting['bps_satker_name'.'_'.$surat_bayar->template] ?>,
      <p align="center">&nbsp;</p>
      <p align="center">&nbsp;</p>
      <p align="center">
          <?= $spd_setting['bps_head'.'_'.$surat_bayar->template] ?><br/>
            NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat_bayar->template] ?></p></td>

        <td  valign="top"><p>&nbsp;</p>
          <p align="center"><?= $spd_setting['bps_city'.'_'.$surat_bayar->template] ?>, <?= $tanggal_bayar ?> <br>
          Yang Membuat Pernyataan </p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center"><?= $surat_bayar->nama ?> <br />
            NIP. <?= $surat_bayar->nip ?> </p></td>
        </tr>
    </table>
</div>

<?php }?> 

</body>
</html>


