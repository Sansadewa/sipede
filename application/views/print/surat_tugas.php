<?php 
                $template='';
                $prov = array('6300','6351','6352','6353','6354','6355','6356');
                if (in_array($this->session->userdata('wilayah')->kode, $prov)){
                    $template = 'prov';
                }else{
                    $template = 'kab';
                } 
            ?>

<html>
    <head>
        <title><?= $surat->nama ?></title>
        <style type="text/css">
            @font-face {
                    font-family: "Tahomax";
                    font-weight: normal;
                    font-style: normal;
                    src: url("http://bpskalsel.com/sipede/assets/font/tahoma.ttf") format('truetype');
                 }
                  @font-face {
                    font-family: "Tahomabd";
                    font-weight: normal;
                    font-style: normal;
                    src: url("http://bpskalsel.com/sipede/assets/font/tahomabd.ttf") format('truetype');
                 }
                .font {font-family:times;}
                .isi {font-family:times; font-size:11pt;text-align: justify;}
                .isi-tahoma {font-family:Tahomax; font-size:11pt;text-align: justify;}
                .center {text-align: center;}
                .no-border-right {border-right: none;}
                .bold{font-weight: bold;}
                .footer {position: fixed;bottom: 10;text-align:center;font-size:10}

                .isi2 {font-family:times; font-size:11pt;text-align: justify;line-height: 13px}
                .border-right {border-right: 1px solid; margin-right: 5px; }
                .no-border-bottom{border-bottom: none;}

                hr.garis{margin: 0;border: solid black;border-width: 1px 0 0;}
                hr.garis-putus{margin: 0;border: dotted black;border-width: 1px 0 0; width: 60%}

                div.Section2 { margin: 0cm 0cm 0cm 0cm;}
                div.Section1 { margin: 0.5cm 0.5cm 0.5cm 0.5cm;  }               

        </style>
    </head>
        <body>
        <div class="Section1 isi-tahoma">
             <div class="font">
                <center>
                  <!-- <img src='https://banuareload.com/assets/img/image002.jpg' width='80px'> <br> -->
                     <img src='data:image/jpeg;base64,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' width='80px'/><br><br>
                    <span style="font-size: 12pt; font-style: italic;font-weight: bold;">BADAN PUSAT STATISTIK <?= strtoupper($spd_setting['bps_satker_name'.'_'.$template]) ?></span><br/>
                </center>  
            </div>
            <br>
            <div class="isi-tahoma">
            <center>
                <span style="font-family:Tahomabd;font-size: 12pt;"><u style="padding-bottom:10px;text-decoration:none;border-bottom:3px solid #000;">SURAT - TUGAS</u> </span> <br/>
                    <span style="font-family:Tahomax;font-size: 12pt">Nomor : <?= $surat->nomor ?>
            </center>
            <br/><br/><br/>
           <table style="margin-left: 40px">
                <tr>
                     <td valign="top"> Menimbang</td>
                     <td valign="top"> : </td>
                     <td style="text-align: justify"> bahwa untuk kelancaran dan efektivitas kegiatan Badan Pusat Statistik Provinsi Kalimantan Selatan Tahun Anggaran <?= date('Y',$surat->tanggal_surat) ?>.</td>
                 </tr>
                 <tr>
                     <td valign="top"> Mengingat</td>
                     <td valign="top"> : </td>
                     <td valign="top" style="text-align: justify"> <ol type="a" style="padding-left: 15px; margin-top: 0px; margin-left: 0px;">
                        <li>Undang-Undang Nomor 16 Tahun 1997 tentang Statistik (Lembaran Negara Republik Indonesia Nomo 39 Tahun 1997, Tambahan Lembaran Negara Republik Indonesia Nomor 3683);</li>
                        <li>Peraturan Menteri Keuangan Republik Indonesia Nomor 113/PMK.05/2012 tentang Perjalanan Dinas Dalam Negeri bagi Pejabat Negara, Pegawai Negeri dan Pegawai Tidak Tetap</li>
                        </ol>
                    </td>
                 </tr>
                 <tr>
                     <td> </td>
                     <td>  </td>
                     <td> Memberi Tugas </td>
                 </tr>
                 <tr>
                    <td> </td>
                 </tr>
                 <tr>
                    <td> </td>
                 </tr>
                 <tr>
                    <td> </td>
                 </tr>
                 <tr>
                     <td> Kepada</td>
                     <td> : </td>
                     <td> <?= $surat->nama ?></td>
                 </tr>
                 
                 <tr>
                     <td valign="top"> Untuk</td>
                     <td valign="top"> : </td>
                     <td style="text-align: justify"> 
                        <?= $surat->perihal ?> <br>
                         Pada Tanggal <?= $surat->array_tanggal?jangka_waktu($surat,FALSE):@format_tanggal($surat->tanggal_awal,true) ?> -  <?= $surat->array_tanggal?jangka_waktu($surat,FALSE):@format_tanggal($surat->tanggal_akhir,true) ?>
                     </td>
                 </tr>
                 
            </table>
            <br/>
            <br/>
            
            <table style="float: right;">
                <tr>
                    <td><center><?= $spd_setting['bps_city'.'_'.$template] ?>, <?= @format_tanggal($surat->tanggal_surat,true) ?></center></td>
                </tr>
                <tr>
                    <td>
                        <center>
                        Plt. Kepala Badan Pusat Statistik <br>
                        <?= $spd_setting['bps_satker_name'.'_'.$template] ?>,
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                      <!--   <img src="http://localhost/spd/public/assets/ttd.jpg" width="120">  -->
                       <br><br><br><br>
                    </td>
                    <br>
                </tr>
                <tr>
                    <td>
                        <center><span style="font-family: Tahomabd;"><?= isset($spd_setting['bps_head'.'_'.$template.'2'])?$spd_setting['bps_head'.'_'.$template.'2']:$spd_setting['bps_head'.'_'.$template] ?> </span> <br/>
                           <!--  NIP. <?= $spd_setting['bps_head_nip'.'_'.$template] ?> -->
                        </center>
                    </td>
                </tr>
            </table>

            <div style="clear: both;position: fixed;bottom: 40; left: 30">
                <?php //echo DNS1D::getBarcodeHTML("6302", "EAN13");
                ?>
            </div>
            <div class="footer">
                <center>
                        <?= $spd_setting['bps_address'.'_'.$template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$template] ?> <br/>
                         Website : <?= $spd_setting['bps_website'.'_'.$template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$template] ?>
                </center>
            </div>
           </div>
        </div>
        </body>
</html>