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
                .font {font-family:times;}
                .isi {font-family:times; font-size:11pt;text-align: justify;}
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
        <div class="Section1 isi">
            <div class="font">
                <center>
                 <!--  <img src='https://banuareload.com/assets/img/image002.png' width='80px'> -->
                   <?= "<img src='".base_url('assets').'/img/image002.jpg'."' width='80px'>" ?><br><br/>
                    <span style="font-size: 12pt; font-style: italic;font-weight: bold;">BADAN PUSAT STATISTIK </span><br/>
                    <span style="font-size: 12pt; font-style: italic;font-weight: bold;"><?= strtoupper($spd_setting['bps_satker_name'.'_'.$template]) ?></span><br/>
                            <!-- <span style="font-size: 12pt"><?= $spd_setting['bps_address'] ?> Telp. <?= $spd_setting['bps_phone'] ?>  Fax  <?= $spd_setting['bps_fax'] ?> <?= $spd_setting['bps_city'] ?></span> -->
                </center>   
            </div>
            <br>
            <div class="isi">
            <center>
                <span style="font-size: 12pt;font-weight: bold;"><u>SURAT - TUGAS</u> </span> <br/>
                    <span style="font-size: 12pt">Nomor : <?= $surat->nomor ?>
            </center>
            <br/>
            Yang bertanda tangan di bawah ini : <br/> <br/>
            <center><span style="font-size: 12pt;font-weight: bold; "> KEPALA BADAN PUSAT STATISTIK <?= strtoupper($spd_setting['bps_satker_name'.'_'.$template]) ?> </span> <br/><br/></center>
            Memberikan tugas kepada :   <br/><br/>
            <table style="margin-left: 40px">
                 <tr>
                     <td> Nama</td>
                     <td> : </td>
                     <td> <?= $surat->nama ?></td>
                 </tr>
                 <tr>
                    <td><br></td>
                 </tr>
                 <tr>
                     <td> NIP</td>
                     <td> : </td>
                     <td> <?= $surat->nip ?></td>
                 </tr>
                 <tr>
                    <td><br></td>
                 </tr>
                 <tr>
                     <td> Pangkat/Golongan</td>
                     <td> : </td>
                     <td> <?= $surat->pangkat ?></td>
                 </tr>
                 <tr>
                    <td><br></td>
                 </tr>
                 <tr>
                     <td> Jabatan</td>
                     <td> : </td>
                     <td> <?= $surat->jabatan ?></td>
                 </tr>
                 <tr>
                    <td><br></td>
                 </tr>
                 <tr>
                     <td valign="top"> Tujuan/Tugas</td>
                     <td valign="top"> : </td>
                     <td> <?= $surat->perihal ?></td>
                 </tr>
                 <tr>
                    <td><br></td>
                 </tr>
                 <tr>
                     <td> Jangka waktu</td>
                     <td> : </td>
                     <td> <?= $jangka_waktu ?></td>
                 </tr>
                 <tr>
                    <td><br></td>
                 </tr>
                 <tr>
                    <td><br></td>
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
                        Kepala Badan Pusat Statistik <br>
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
                        <center><u style="font-weight: bold;"><?= $spd_setting['bps_head'.'_'.$template] ?> </u> <br/>
                            NIP. <?= $spd_setting['bps_head_nip'.'_'.$template] ?>
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