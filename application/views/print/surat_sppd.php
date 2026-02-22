            <?php 
                $template='';
                $prov = array('6300','6351','6352','6353','6354','6355','6356');
                if (in_array($this->session->userdata('wilayah')->kode, $prov)){
                    $template = 'prov';
                }else{
                    $template = 'kab';
                } 
                $rom = 0;

                $base_image = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QB6RXhpZgAATU0AKgAAAAgABgEyAAIAAAAUAAAAVgMBAAUAAAABAAAAagMDAAEAAAABAAAAAFEQAAEAAAABAQAAAFERAAQAAAABAAAOxFESAAQAAAABAAAOxAAAAAAyMDA5OjA3OjIyIDA3OjM4OjA2AAABhqAAALGP/9sAQwACAQECAQECAgICAgICAgMFAwMDAwMGBAQDBQcGBwcHBgcHCAkLCQgICggHBwoNCgoLDAwMDAcJDg8NDA4LDAwM/9sAQwECAgIDAwMGAwMGDAgHCAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwM/8AAEQgAPwBQAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A/fyvlv8A4LF/Ec/D/wDYY163inkt7vxJfWek27o21smUTyDPvFBKPoTX1JX50/8ABf34gtDoPw38JxyKVurm81e4jzypiSOGE/j504/4Ca+v4BwP1viDC0nspc3/AIAnL9D4XxMzL6jwvja6dm4OK9ZtQ/8Abv1Pzh/4SHUB/wAv97/3/b/Gv2K/4I1+BJfCf7EGk6lcSTyXXizUrzVZPOYsygSfZk5PYpbqw7fPnvX40OdqEhWY44AGSa/fD4L/ALOkfgn4J+EfC+tX19eQ+H9HtNPeygnNtZs8UKxvuWPa0wcglllZ0YknaAcV+veNmPlQyyjhKMVzVJ33srRWt93a8lsmfgv0dct+s5vicdXk+WlBLq9Zvpqle0Xu1oze8Y/tB+D/AAPrEmmXWsJd61EAX0rTIJdS1FQehNtbq8oB9SuPevi//gqB+0VeePdN8K+HY/D/AIm8N2qzS6q39rRR20l7hfKjZY1kaRVG+XPmqhJIwDg4+9PDXhXS/BmkR6fo+m2Gk2EP+rtrO3SCFPoigAfgK/Mr/gpz43PjH9r3WLcMGi8O2VrpUZU8H5PtDfiHuGU/7uO1fwp4tY3GYbIZKpUS9pKMOWK/7eacm23pF6pRv17H+h3hXg8Jic8i6dNt04ylzSfpFNRSSWsurlbp3PALjUHhheSSaXailmJc9BzX2j8Hf2V/jt+zNaRap4Y8I/CvWNWmj8w3Vw0s+pIGXmLfM8SxcHayxFQcclsZr5d/Z68D/wDCy/jz4N0Fo/Oh1LWbZLhP70CyB5v/ACEr1+ylfnnhLwjSzONfH1pzg6bjGEoNJp2bk9U1e3L977n33ipxZVyx0cFRhGampOcZptNXSjomtL834dj4ruv+ClHxH+CGuw2XxW+FrafHPJ5a3Fiz2yvjlvKMhkinYDssw+tfTfwG/aN8J/tIeF5NU8Laj9p+zFUu7SZfKurF2BIWWM9M4OGGVba21jg11Pizwlpfjvw7daRrWn2mqaXfJ5dxa3MQkilGQeVPHBAIPUEAjkV+enxN+HV5/wAE4f2x/DWt6Dc3I8Ia5N+7WSQuxszIi3dnIc5fywyOjN38oksyMT+n5hjc64ZqwxGKrfWcG5KMnJJVKfM7KV4pKSvu2r7JW3PzbAYPJuJKc8PhaP1bGKLlFRbdOpZXatJtxdtrPzd9j9G6/Ov/AIKTfsd+NP20v22LHTvCWpeGJv7G8OwQ3cU11cL/AGLH5k8qy3bLCyRtMz7Y41LSOIy+wIrOPrD9sL9pC9+CuhaJ4d8K2sOrfEr4gXZ0rwxYS5MKSYHm3k+MkW9uh3vgEngcAsy9f8AvgnZ/AX4eRaNBdXGrajczPf6xq9yP9K1u/kwZrqU8/MxAAGSERUQfKigf0BkOYYjI0s2p255qUYJq91tKb8k9F3lf+Vn89cTZTheI08krX9nBxlUadrPeME+7Wr/ljbrKLPza8Lf8EO/jF4W8TabqkeufC25k0y7iu0huL2+khmMbhwrqLUEqSMEAgkE8jrWWn/Bdn4yQOVbRPhtNtJGf7MvPm/8AJuv1W+IPi6H4f+Atc165Krb6Jp89/KWOFCRRtIc/gpr+dO2TyraNf7qgc/Sv17gfFPi1VqufUoVPZcqh7trc3M5dfKJ+B+JGDXAqw9HhmtOj7bnc1zXvy8qi9V5yP1Z/4Jx/8FOviB+1/wDHq88MeJNF8HWOk2OiXGqzXOnQ3EEkRjlhjGTJNIpUmXkYB754weL+J/7CviL4n/E3xH4i/wCFhfCf/ifapc36IddkJjSWVnROIf4VKr+FfO/7H2qD4UfsV/tNePmWSO4Xw5beFLCZThlk1GR4HKkc7kLQPx6Z7V8NC1jA/wBXH/3zX84+PXDeSYnO/wCzPY2p0lF2jJxXNKN79b6Ox994f+P2fcIZRQxDSr1sSpScpvVQU3GK+Hq4tn61eE/2XfG/7HU1x8VrTXPhj4gXwbA8phj1C5uMGZGgGFWJPmYSMq5cDJqy/wDwV8+JB+7oPggfW1uj/wC168F/ZE0Bfhx/wSc8Tam1usNx8SfHsNikgGDNa2cSSr+CzQzjv1rjq/k3irMsRw1io5dkNWdKm4qcle/vybV7tfyqJ/fvhbiYcdcPUuI+IcNB1al1Fa6QWqXS+rk9j9T/ANgn9pjxL+1J8Otb1rxFp+j2J0/VDYW7aekiJKBDHI25XdzkeYOQcHPQYyeU/wCCo/glfHvgL4daZCgbUdU8a2emW5/iAnhnVv8AgOQhPYbcnpXWf8E3fBP/AAhf7H/hcyR+Xcaz5+qSn++JpWMR/wC/Ii/Kus8ReD/+FmftDaDfTKW0n4e281yvOUn1O5QRoMesFv5jEHvdxEcqa/caOCxOY8K0MJjZOdSvGHM3v7zUm35xjf7rbn5tUxmGy/iivisHFQp0JTslt7qcUl/ilZfO+x8y/sV+K1/a0/4KUfF74jXUkd1p/wAPrWPwz4ejOGSCF5pk8+M4yC4t53yecXbL0AA+4icV+Uv/AASG+M0P7Nn7X/jH4c+Kpo7CbxVP/ZAlnYLjVLOeVI4STwDJ5k6juX8tRksK/Vl0WRGVlDKwwQRwRX9AeI2AlhM1jRiv3Sp01TfRxUUtP+3uZvzd+p/OnhTmkcfkssRN/vnVququqm5t2fpHlS8lZbHwX/wVH/4KZ+B4PgdrHgDwF4j0zxRr3iyBrG+u9MuVuLPTbN+JgZlykkki7owiElQzMxXCq/5ZeemPvr+dfo9/wWu/bf8AFv7LfxO8E+E/h3faZoNxdaTPqmrFtGsrzz45JhFbjE8ThdpguPu4zu56Cvha7/4Ki/HAM1w3i/SY5IwW81PCGiI647hhZ5H1Brq4d8YMq4dw8sDQwU5O95S543bsv7qsktEraebu3+FeKVGjmOezhmWLlzUkopQorlirXsm6129dW1vpskes/tCWVx8Dv+CRngTQ7gXFlqfxa8ZzeJHglTy2l0+2g8pOCMlGYWsynoRICOor4rJwK/Yrx/8A8EfvGP7XvhHwlqXxZ+OHirVNasNPWX7HJotqselzzxxNcxps2ZG9FGSM4QVzFr/wbgeEjcR/avih4nkttw81YdMt45GTuFYlgrY6EqwB7HpX5FxNXxuc5nWzOVPl9o7pXWi6Lfpse1m/hnnuKnSjhKNqVOnCEeaUFK0Yq7aUna8nJ2Tdrnn3xW0uL4S/sJfs3eC/OEck+g3Hii7ic7WV750uEyDzkGedfbbivHUl+3SLBass91OwjhiRgWkduFUe5JA/Gv2sv9K8O+C/C6SXsOk6fpGi2ixCa72JDZwRjABd+FVQO5xXN+HviDpfjmaOXwZoMesWuQyay0AtdMI4IaKcruuFKnKvbrJGSMGRetfl/EHgzic6zCpmP1rlg+VW5LqKjFRtzOaV3a+272P724L8VMHwxkeFyGOG5nRjZe/Zy1evKoN2W3otzqfh/wCEYfh94D0TQbX/AI9tDsINPi4x8kUaxr+iitO1tIrKHy4Y44Yx0VFCgfhTNOhuILVRdTrcTnlmSPy0z/srkkD6kn3qev2OnRhTiqcNoqy9EfmU606knUnvJ3fqz4l/4KN/8Enl/aW8R3PjnwHdWWl+MLiMf2jYXbFLTWCi4WQOAfKn2gLkgo+FzsO528X8Aft8ftJfsQWo0X4peANa8VaLp4Ma3mqRyRzqABhV1KNZIZgOpLCRjn74GK/UKivvcBxxNYOOXZrQjiaMfhUrqUV2jNapfK9rK9lY/Nsy8O6bx881ybEzwleesnC0oTfeVOWjd/NK93a7ufz0f8FE/wBq1f2y/wBqLUvGVvZ3Om6eLG006ytJ5Fkkt44o8uu5eCDM8zDGOGBwDkV5t8EbCx1T4zeE4dU0/UNV0k6xavqFlYQeddXVqsqtPHEmRudolcAEgZ6kDNWvifqmsfGv4peJvGDWb+Z4s1a71llMiAr9omebHXjG/GO2K+tv+CEXwLutZ/bk/t7UrXyYfB+g3d9bt5iN/pExS1UYBzzFNOc+w9a/FfaUcTmPtFC1OU78t9ouV+XmtfRaXt52P5twOBxmdZ/GM5OUqtTWbjo9buXLta2vLe3S5+gunft7eOviKQvgf9nT4o6gWAYSeJWt/DkDKedwklZwwxz8uc9q6PTtB/aI+JxY6vr3gD4W6dIVdIdFspNe1ZB3RprjZbK2O4hkFe8UV+m1M3oR/wB0w0IebvN/+Ttw/wDJEf1tTyTES/3zF1J+UeWmvvglP/ydnmPhP9kvwro2sW+ra7JrPj7XrWTzoNS8VXh1J7WTOQ9vAQLa2YetvDGcV6dRRXlYjF1q75q0nK21+nklsl5LQ9jC4Ohho8tCCjfe278292/N3YUUUVznUf/Z'
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
                /*table#t01 th, td {
                  border: 1px solid black;
                }*/

        </style>
    </head>
        <body>
        <div class="Section1 isi-tahoma">
            <div class="font">
                <center>
                  <!-- <img src='https://banuareload.com/assets/img/image002.jpg' width='80px'> <br> -->
                    <?= "<img src='".$base_image.'/img/image002.jpg'."' width='80px'>" ?><br><br> 
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
                     <td style="text-align: justify"> bahwa untuk kelancaran dan efektivitas kegiatan Badan Pusat Statistik Provinsi Kalimantan Selatan Tahun Anggaran <?= date('Y',$surat->tanggal_surat) ?> maka diperlukan pelaksanaan perjalanan dinas.</td>
                 </tr>
                 <tr>
                     <td valign="top"> Mengingat</td>
                     <td valign="top"> : </td>
                     <td valign="top" style="text-align: justify"> <ol type="a" style="padding-left: 15px; margin-top: 0px; margin-left: 0px;">
                        <li>Undang-Undang Nomor 16 Tahun 1997 tentang Statistik (Lembaran Negara Republik Indonesia Nomor 39 Tahun 1997, Tambahan Lembaran Negara Republik Indonesia Nomor 3683);</li>
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
                           <!-- NIP. <?= $spd_setting['bps_head_nip'.'_'.$template] ?>-->
                        </center>
                    </td>
                </tr>
            </table>

            <?php if($surat->is_pengawasan){?>
                <div style="clear: both;position: fixed;bottom: 60; left: 30">
                <table style="border: 1px solid black" width="100%">
                  <tr >
                    <td style="font-family:Tahomax;font-size: 9pt;">Dalam penugasan ini, pelaksana perjalanan dinas tidak boleh menerima gratifikasi sesuai Surat Sestama 
                    No: B-234/BPS/2000/08/2018 Tanggal 23 Agustus 2018 tentang Penolakan Gratifikasi dalam Pelaksanaan Penugasan Pengawasan
                    </td>
                  </tr>
                </table>
            </div>
        <?php } ?>
            <div class="footer">
                <center>
                        <?= $spd_setting['bps_address'.'_'.$template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$template] ?> <br/>
                         Website : <?= $spd_setting['bps_website'.'_'.$template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$template] ?>
                </center>
            </div>
           </div>
        </div>
                <div class="Section1 isi" style=" page-break-before: always;"> 

            <div class="isi">
                <table>
                    <tr>
                        <td rowspan="3">
                            <?= "<img src='".$base_image.'/img/image002.jpg'."' width='80px'>" ?>
                           <!--  <?= "<img src='https://banuareload.com/assets/img/image002.jpg' width='80px'>" ?> -->
                        </td>
                        <td rowspan="3" colspan="2" width="100px"><span class="font" style="font-weight: bold; font-style: italic;font-size: 13px;">BADAN PUSAT STATISIK </span>
                        <br/>
                            <span class="font" style="font-weight: bold; font-style: italic; font-size: 12px;"><?= strtoupper($spd_setting['bps_satker_name'.'_'.$surat->template]) ?> </span>
                        </td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lembar Ke </td>
                        <td> :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode No. </td>
                        <td> :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor </td>
                        <td> :</td>
                        <td class="bold" style="font-size: 12px;"><?= $surat->no_sppd ?></td>
                    </tr>
                </table>
                <br/>
                <br/>
                <center class="bold">SURAT PERJALANAN DINAS (SPD)</center>
                <table  border="1px solid" width="100%">
                    <tr valign="top">
                        <td class="center no-border-right">1.</td>
                        <?php if( isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                            <td><?= $spd_setting['ttd'] ?></td>
                            <td colspan="2"><?= $spd_setting['bps_head'.'_'.$surat->template] ?></td>
                        <?php }else{?>
                            <td>Pejabat Pembuat Komitmen</td>
                            <td colspan="2"><?= $spd_setting['bps_ppk'.'_'.$surat->template] ?></td>
                        <?php } ?>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right ">2.</td>
                        <td>Nama/NIP pegawai yang melaksanakan perjalanan dinas</td>
                        <td colspan="2"><?= $surat->nama ?> / <?= $surat->nip ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">3.</td>
                        <td>a. Pangkat dan Golongan</td>
                        <td colspan="2">a. <?= $surat->pangkat ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>b. Jabatan/Instansi</td>
                        <td colspan="2">b. <?= $surat->jabatan ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>c. Tingkat Biaya Perjalanan Dinas</td>
                        <td colspan="2">c. C</td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">4.</td>
                        <td>Maksud Perjalanan Dinas</td>
                        <td colspan="2"><div style="font-size: 10pt"><?= $surat->perihal ?></div></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">5.</td>
                        <td>Alat angkutan yang dipergunakan</td>
                        <td colspan="2"><?= $surat->kendaraan ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">6.</td>
                        <td>a. Tempat berangkat</td>
                        <td colspan="2">a. <?= $surat->berangkat ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>b. Tempat tujuan</td>
                        <td colspan="2">b. <?= $surat->tujuan ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">7.</td>
                        <td>a. Lamanya Perjalanan Dinas</td>
                        <td colspan="2">a. <?=$jangka_waktu_hari ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>b. Tanggal berangkat</td>
                        <td colspan="2">b. <?= $surat->array_tanggal?jangka_waktu($surat,FALSE):@format_tanggal($surat->tanggal_awal,true) ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>c. Tanggal harus kembali di tempat baru *)</td>
                        <td colspan="2">c. <?= $surat->array_tanggal?jangka_waktu($surat,FALSE):@format_tanggal($surat->tanggal_akhir,true) ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">8.</td>
                        <td>Pengikut  :         Nama</td>
                        <td>Tanggal Lahir </td>
                        <td>Keterangan </td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <?php if(sizeof($pengikut) > 0){ 
                            if(sizeof($pengikut)>1){
                                $br = '<br>';
                            }else{
                                $br = '';
                            }
                            $nama= '';
                            $ttl='';
                            $ket='';
                            foreach ($pengikut as $value) {
                                $nama .= $value['pengikut_nama'].$br;
                                $ttl .= date('d-m-Y',strtotime($value['pengikut_ttl'])).$br;
                                $ket .= $value['pengikut_ket'].$br;                             
                            } 
                        ?>
                            <td> <?= $nama ?> </td>
                            <td> <?= $ttl ?> </td>
                            <td> <?= $ket ?> </td>
                        <?php }else{ ?>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                        <?php } ?>
                        
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">9.</td>
                        <td>Pembebanan Anggaran</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>a. Instansi</td>
                        <td colspan="2">a. BPS <?= $spd_setting['bps_satker_name'.'_'.$surat->template] ?>  </td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right"></td>
                        <td>b. Akun</td>
                        <td colspan="2">b. <?= $surat->akun_bayar ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="center no-border-right">10.</td>
                        <td>Keterangan lain-lain </td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                *) Coret yang tidak perlu
                <br/>
                <table style="float: right;" style="width: 100%">
                    <tr>
                        <td>Dikeluarkan di</td>
                        <td> : </td>
                        <td> <?= $spd_setting['bps_city'.'_'.$surat->template] ?></td>
                    </tr>
                    <tr>
                        <td>Pada tanggal</td>
                        <td> : </td>
                        <td> <?= @format_tanggal($surat->tanggal_sppd,true) ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <center>
                                <?php if(isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                                    <?= $spd_setting['ttd'] ?>, <br/>
                                    BPS <?= $spd_setting['bps_satker_name'.'_'.$surat->template] ?>
                                <?php }else{ ?>
                                    Pejabat Pembuat Komitmen, <br/>
                                    BPS <?= $spd_setting['bps_satker_name'.'_'.$surat->template] ?>
                                <?php } ?>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td><br/><br/><br/></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <center>
                                <?php if(isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                                    <?= $spd_setting['bps_head'.'_'.$surat->template] ?><br/>
                                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat->template] ?>
                                <?php }else{?>
                                    <?= $spd_setting['bps_ppk'.'_'.$surat->template] ?> <br/>
                                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat->template] ?>
                                <?php } ?>

                            </center>
                        </td>
                    </tr>
                </table>

            <div class="footer">
                <center>
                        <?= $spd_setting['bps_address'.'_'.$surat->template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$surat->template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$surat->template] ?> <br/>
                         Website : <?= $spd_setting['bps_website'.'_'.$surat->template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$surat->template] ?>
                </center>
            </div>
            
            </div>
        </div>

                <div class="Section2 isi2" style=" page-break-before: always;"> 

            <table  style="border: 1px solid black" width="100%">
                <tr>
                    <td width="5%"></td>
                    <td width="12%"></td>
                    <td width="1%"></td>
                    <td width="20%" class="border-right"></td>
                    <td width="2%">I. </td>
                    <td width="10%">Berangkat dari </td>
                    <td width="25%" colspan="2">: <?= $surat->berangkat ?> </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td></td>
                    <td>(Tempat Kedudukan)</td>
                    <td></td>
                    <td></td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td></td>
                    <td>Ke </td>
                    <td colspan="2">: <?= sizeof($tujuan_spd)>0?$tujuan_spd[0]['tj_kembali']:html_escape($surat->tujuan)  ?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td></td>
                    <td>Pada tanggal</td>
                    <td colspan="2">: <?= sizeof($tujuan_spd)>0?format_tanggal(strtotime($tujuan_spd[0]['tj_tanggal_berangkat']),true):html_escape(@format_tanggal($surat->tanggal_awal,true)) ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td></td>
                    <td colspan="3"><hr class="garis"></td>
                </tr>  
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="4">
                        <?php if ($surat->visum_nama) { ?>
                            <center><?= $surat->visum_jabatan ?></center>
                        <?php }else{ ?>
                            <center>Kepala BPS <?= $spd_setting['bps_satker_name'.'_'.$template] ?></center>
                        <?php } ?>
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="4">
                        <br/> <br/> <br/>
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="4">
                        <?php if ($surat->visum_nama) { ?>
                            <center>
                                <?= $surat->visum_nama ?> <br/>
                                NIP. <?= $surat->visum_nip ?>
                            </center>
                        <?php }else{ ?>
                           <center>
                                <?= $spd_setting['bps_head'.'_'.$template] ?> <br/>
                                NIP. <?= $spd_setting['bps_head_nip'.'_'.$template] ?>
                            </center>
                        <?php } ?>
                    </td>
                </tr> 
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                <tr>
                    <td>II. </td>
                    <td>Tiba di </td>
                    <td> : </td>
                    <td class="border-right"><?= sizeof($tujuan_spd)>0?$tujuan_spd[0]['tj_kembali']:html_escape($surat->tujuan)  ?></td>
                    <td colspan="2">Berangkat dari</td>
                    <td colspan="2">: <?= sizeof($tujuan_spd)>0?$tujuan_spd[0]['tj_kembali']:html_escape($surat->tujuan) ?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td>Pada tanggal </td>
                    <td> : </td>
                    <td class="border-right"><?= sizeof($tujuan_spd)>0?format_tanggal(strtotime($tujuan_spd[0]['tj_tanggal_kembali']),true):html_escape(@format_tanggal($surat->tanggal_awal,true)) ?></td>
                    <td colspan="2">Ke</td>
                    <td colspan="2">: <?php
                        if(isset($tujuan_spd[0])){
                            echo $tujuan_spd[0]['tj_is_pp']?$tujuan_spd[0]['tj_berangkat']:isset($tujuan_spd[1])?$tujuan_spd[1]['tj_kembali']:$spd_setting['bps_city'.'_'.$template];
                        }else{
                            echo $surat->berangkat;
                        }
                     ?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="2">Pada tanggal </td>
                    <td>: <?php
                        if(isset($tujuan_spd[0])){
                            echo $tujuan_spd[0]['tj_is_pp']?format_tanggal(strtotime($tujuan_spd[0]['tj_tanggal_kembali']),true):format_tanggal(strtotime($tujuan_spd[0]['tj_tanggal_kembali']),true);
                        }else{
                            echo html_escape(@format_tanggal($surat->tanggal_akhir,true));
                        }

                     ?></td>
                </tr> 
                <tr>
                    <td colspan="4"  class="border-right">
                        <br/><br/><br/><br/><br/> 
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                    <td colspan="4">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                </tr>  
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>      
                <tr>
                    <td>III. </td>
                    <td>Tiba di </td>
                    <td>: </td>
                    <td class="border-right"><?php
                        if(isset($tujuan_spd[1])){
                            echo $tujuan_spd[1]['tj_is_pp']?$tujuan_spd[1]['tj_berangkat']:$tujuan_spd[1]['tj_kembali'];
                        }else{
                            echo '';
                        }


                    ?></td>
                    <td colspan="2">Berangkat dari</td>
                    <td colspan="2">: <?= sizeof($tujuan_spd)>1?$tujuan_spd[1]['tj_kembali']:'' ?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td>Pada tanggal </td>
                    <td>: </td>
                    <td class="border-right"><?php 
                        if(isset($tujuan_spd[1])){
                            echo $tujuan_spd[1]['tj_is_pp']?format_tanggal(strtotime($tujuan_spd[1]['tj_tanggal_kembali']),true):format_tanggal(strtotime($tujuan_spd[1]['tj_tanggal_berangkat']),true);
                        }else{
                            echo '';
                        }
                    ?></td>
                    <td colspan="2">Ke</td>
                    <td colspan="2">: <?php
                        if(isset($tujuan_spd[1])){
                            if($tujuan_spd[1]['tj_is_pp']){
                                echo $tujuan_spd[1]['tj_berangkat'];
                            }elseif(isset($tujuan_spd[2])){
                                echo $tujuan_spd[2]['tj_kembali'];
                            }else{
                                echo $surat->berangkat;
                            }
                        }else{
                            echo '';
                        }
                     ?>
                         
                     </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="2">Pada tanggal </td>
                    <td>: <?php 
                        if(isset($tujuan_spd[1])){
                            if($tujuan_spd[1]['tj_is_pp']){
                                echo format_tanggal(strtotime($tujuan_spd[1]['tj_tanggal_kembali']),true);
                            }elseif(isset($tujuan_spd[2])){
                                echo format_tanggal(strtotime($tujuan_spd[2]['tj_tanggal_berangkat']),true);
                            }else{
                                echo format_tanggal(strtotime($tujuan_spd[1]['tj_tanggal_kembali']),true);
                            }
                        }else{
                            echo '';
                        }

                        ?>

                    </td>
                </tr> 
                <tr>
                    <td colspan="4" class="border-right">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                    <td colspan="4">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                </tr>  
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                <tr>
                    <td>IV. </td>
                    <td>Tiba di </td>
                    <td>: </td>
                    <td class="border-right"><?php
                        if(isset($tujuan_spd[2])){
                            echo $tujuan_spd[2]['tj_is_pp']?$tujuan_spd[2]['tj_berangkat']:$tujuan_spd[2]['tj_kembali'];
                        }else{
                            echo '';
                        }


                    ?></td>
                    <td colspan="2">Berangkat dari</td>
                    <td colspan="2">: <?= sizeof($tujuan_spd)>2?$tujuan_spd[2]['tj_kembali']:'' ?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td>Pada tanggal </td>
                    <td>: </td>
                    <td class="border-right"><?php 
                        if(isset($tujuan_spd[2])){
                            echo $tujuan_spd[2]['tj_is_pp']?format_tanggal(strtotime($tujuan_spd[2]['tj_tanggal_kembali']),true):format_tanggal(strtotime($tujuan_spd[2]['tj_tanggal_berangkat']),true);
                        }else{
                            echo '';
                        }
                    ?></td>
                    <td colspan="2">Ke</td>
                    <td colspan="2">: <?php
                         if(isset($tujuan_spd[2])){
                                if($tujuan_spd[2]['tj_is_pp']){
                                    echo $tujuan_spd[2]['tj_berangkat'];
                                }elseif(isset($tujuan_spd[3])){
                                    echo $tujuan_spd[3]['tj_kembali'];
                                }else{
                                    echo $surat->berangkat;
                                }
                            }else{
                                echo '';
                            }
                     ?>
                         
                     </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="2">Pada tanggal </td>
                    <td>: <?php 
                         if(isset($tujuan_spd[2])){
                                if($tujuan_spd[2]['tj_is_pp']){
                                    echo format_tanggal(strtotime($tujuan_spd[2]['tj_tanggal_kembali']),true);
                                }elseif(isset($tujuan_spd[3])){
                                    echo format_tanggal(strtotime($tujuan_spd[3]['tj_tanggal_berangkat']),true);
                                }else{
                                    echo format_tanggal(strtotime($tujuan_spd[2]['tj_tanggal_kembali']),true);
                                }
                            }else{
                                echo '';
                            }


                        ?>

                    </td>
                </tr> 
                <tr>
                    <td colspan="4" class="border-right">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                    <td colspan="4">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                </tr>  
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>

                <?php if(sizeof($tujuan_spd)>3){ ?>
                    <?php for($i=3;$i>0;$i++){ $rom = $i;if(!isset($tujuan_spd[$i]))break; ?>
                        <tr>
                    <td><?= get_romawi($i+2).'.' ?> </td>
                    <td>Tiba di </td>
                    <td>: </td>
                    <td class="border-right"><?php
                        if(isset($tujuan_spd[$i])){
                            echo $tujuan_spd[$i]['tj_is_pp']?$tujuan_spd[$i]['tj_berangkat']:$tujuan_spd[$i]['tj_kembali'];
                        }else{
                            echo '';
                        }


                    ?></td>
                    <td colspan="2">Berangkat dari</td>
                    <td colspan="2">: <?= sizeof($tujuan_spd)>$i?$tujuan_spd[$i]['tj_kembali']:'' ?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td>Pada tanggal </td>
                    <td>: </td>
                    <td class="border-right"><?php 
                        if(isset($tujuan_spd[$i])){
                            echo $tujuan_spd[$i]['tj_is_pp']?format_tanggal(strtotime($tujuan_spd[$i]['tj_tanggal_kembali']),true):format_tanggal(strtotime($tujuan_spd[$i]['tj_tanggal_berangkat']),true);
                        }else{
                            echo '';
                        }
                    ?></td>
                    <td colspan="2">Ke</td>
                    <td colspan="2">: <?php
                        if(isset($tujuan_spd[$i])){
                            if($tujuan_spd[$i]['tj_is_pp']){
                                echo $tujuan_spd[$i]['tj_berangkat'];
                            }elseif(isset($tujuan_spd[$i+1])){
                                echo $tujuan_spd[$i+1]['tj_kembali'];
                            }else{
                                echo $surat->berangkat;
                            }
                        }else{
                            echo '';
                        }
                     ?>
                         
                     </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-right"></td>
                    <td colspan="2">Pada tanggal </td>
                    <td>: <?php 
                        if(isset($tujuan_spd[$i])){
                            if($tujuan_spd[$i]['tj_is_pp']){
                                echo format_tanggal(strtotime($tujuan_spd[$i]['tj_tanggal_kembali']),true);
                            }elseif(isset($tujuan_spd[$i+1])){
                                echo format_tanggal(strtotime($tujuan_spd[$i+1]['tj_tanggal_berangkat']),true);
                            }else{
                                echo format_tanggal(strtotime($tujuan_spd[$i]['tj_tanggal_kembali']),true);
                            }
                        }else{
                            echo '';
                        }

                        ?>

                    </td>
                </tr> 
                <tr>
                    <td colspan="4" class="border-right">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                    <td colspan="4">
                        <br/><br/><br/><br/><br/>
                        <hr class="garis-putus"></hr>
                        NIP.
                    </td>
                </tr>  
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td><?= $rom?get_romawi($rom+2):'V.' ?> </td>
                    <td>Tiba di </td>
                    <td class="border-right" colspan="2"><?= ': '.$surat->berangkat ?></td>
                    <td class="isi" valign="top" rowspan="3" colspan="4" style="padding-right: 7px">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td colspan="3" class="border-right"> (Tempat Kedudukan)</td>
                </tr> 
                <tr>
                    <td></td>
                    <td>Pada tanggal </td>
                    <td class="border-right" colspan="2"><?= ':'.html_escape(@format_tanggal($surat->tanggal_akhir,true)) ?> </td>
                </tr> 
                <tr>
                    <td colspan="4" class="border-right">
                        <br/>
                        <center>
                            <?php if(isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                            <?= $spd_setting['ttd'] ?>,<br/><br/><br/><br/><br/>
                        <?php }else{?>
                            Pejabat Pembuat Komitmen, <br/><br/><br/><br/><br/>
                        <?php } ?>

                        </center>
                        <center>
                             <?php if(isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                                    <?= $spd_setting['bps_head'.'_'.$template] ?> <br/>
                                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat->template] ?>
                                <?php }else{?>
                                    <?= $spd_setting['bps_ppk'.'_'.$surat->template] ?> <br/>
                                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat->template] ?>
                                <?php } ?>
                        </center>
                    </td>
                    <td colspan="4" >
                        <br/> 
                        <center>
                            <?php if(isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                            <?= $spd_setting['ttd'] ?>,<br/><br/><br/><br/><br/>
                        <?php }else{?>
                            Pejabat Pembuat Komitmen, <br/><br/><br/><br/><br/>
                        <?php } ?>
                        </center>
                        <center>
                            <?php if(isset($spd_setting['ttd']) && $surat->template == 'kab'){ ?>
                                    <?= $spd_setting['bps_head'.'_'.$template] ?> <br/>
                                    NIP. <?= $spd_setting['bps_head_nip'.'_'.$surat->template] ?>
                                <?php }else{?>
                                    <?= $spd_setting['bps_ppk'.'_'.$surat->template] ?> <br/>
                                    NIP. <?= $spd_setting['bps_ppk_nip'.'_'.$surat->template] ?>
                                <?php } ?>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                <tr>
                    <td valign="top"><?= $rom?get_romawi($rom+3):'VI.' ?></td>
                    <td colspan="7">Catatan Lain-Lain <br/> <br/> &nbsp; </td>
                </tr>
                <tr>
                    <td colspan="8"><hr class="garis"></hr></td>
                </tr>
                <tr>
                    <td valign="top"><?= $rom?get_romawi($rom+4):'VII.' ?></td>
                    <td class="isi" colspan="7"  style="padding-right: 7px">
                    PERHATIAN <br/>
                    PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasar peraturan-peraturan Keuangan Negara apabaila negara menderita akibat kesalahan, kelalaian, dan kealpaannya.
                    </td>
                </tr>
            </table>
            <div class="footer">
                <center>
                        <?= $spd_setting['bps_address'.'_'.$template] ?> Telp. <?= $spd_setting['bps_phone'.'_'.$template] ?>  Fax : <?= $spd_setting['bps_fax'.'_'.$template] ?> <br/>
                         Website : <?= $spd_setting['bps_website'.'_'.$template] ?>  E-mail : <?= $spd_setting['bps_email'.'_'.$template] ?>
                </center>
            </div>
        </div>

        <?php if($surat->opsi_lembar4 == 1) {?>
                <div class="Section1 isi" style=" page-break-before: always;"> 
    
            <table width="100%" style="outline: 1px solid;">
                <tr>
                    <td colspan="6"> <center><b>LAPORAN PERJALANAN DINAS</b></center></td>
                </tr>
                <tr>
                    <td colspan="6"><hr class="garis"></hr></td>
                </tr>
                <tr>
                    <td width="15%" style="padding-left: 20px;">Tujuan </td>
                    <td width="1%">: </td>
                    <td width="32%"> <?= $surat->tujuan ?></td>
                    <td width="15%" style="padding-left: 20px;">Nama </td>
                    <td width="1%">: </td>
                    <td width="32%"> <?= $surat->nama ?></td>
                </tr>
                <tr>
                    <td width="15%" style="padding-left: 20px;">Tanggal </td>
                    <td width="1%">: </td>
                    <td width="32%"> <?= @format_tanggal($surat->tanggal_awal,true)  ?></td>
                    <td width="15%" style="padding-left: 20px;">Tanda Tangan </td>
                    <td width="1%">: </td>
                    <td width="32%"> </td>
                </tr>
                <tr>
                    <td width="15%" style="padding-left: 20px;">Kegiatan </td>
                    <td width="1%">: </td>
                    <td width="32%"> <?= $surat->kegiatan ?></td>
                    <td width="15%"> </td>
                    <td width="1%"> </td>
                    <td width="32%"> </td>
                </tr>
                <tr>
                    <td colspan="6"><hr class="garis"></hr></td>
                </tr>
                <tr>
                    <td colspan="6"> <center><b>PELAPORAN KEGIATAN</b></center></td>
                </tr>
                <tr>
                    <td height="700px"></td>
                </tr>
            </table>
        </div>
    <?php } ?>
        </body>
</html>