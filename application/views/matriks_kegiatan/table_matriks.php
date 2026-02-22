<table id="table_data">
  <thead>
    <tr>
      <th rowspan="2"> Nama </th>
      <th colspan="<?= $number_days ?>"  style="text-align:center;"> Tanggal </th>
    </tr>
    <tr>
      <?php
      for($i=1;$i<=$number_days;$i++){
        echo "<th>".$i."</th>";
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
      for ($i=0;$i<sizeof($matriks_kegiatan);$i++) {
        echo "<tr>";
        echo "<th>".$matriks_kegiatan[$i][0]."</th>";
        for($j=1;$j<=$number_days;$j++){
          if(array_key_exists($matriks_kegiatan[$i][$j], $kegiatan)){
            echo "<th title='".$kegiatan[$matriks_kegiatan[$i][$j]]['nama']."'>".$matriks_kegiatan[$i][$j]."</th>";
          }else{
            echo "<th>".$matriks_kegiatan[$i][$j]."</th>";
          }
          
        }
        echo "</tr>";
      }      
    ?>
  </tbody>
</table>