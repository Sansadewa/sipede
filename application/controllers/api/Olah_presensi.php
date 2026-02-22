<?php


class Olah_presensi extends CI_Controller{



	public function kriteria(){
		
	}

}



Absen normal / Untuk yg WFH

Absen Pagi
7.30.00 - 8.00.00 TL1
8.00.01 - 8.30.00 TL2
8.30.01 - 9.00.00 TL3
9.00.01 - tidak absen TL4

Absen pulang (senin - kamis)
tidak absen - 14.29.59 PSW4
14.30.00 - 14.59.59 PSW3
15.00.00 - 15.29.59 PSW2
15.30.00 - 15.59.59 PSW1

Absen pulang (jumat)
tidak absen - 14.59.59 PSW4
15.00.00 - 15.29.59 PSW3
15.30.00 - 15.59.59 PSW2
16.00.00 - 16.29.59 PSW1


*Absen Untuk yg WFO tipe 1*

Absen Pagi 
7.30.00 - 8.00.00 TL1
8.00.01 - 8.30.00 TL2
8.30.01 - 9.00.00 TL3
9.00.01 - tidak absen TL4

Absen Sore (14.30, senin-kamis)
tidak absen - 12.59.59 PSW4
12.00.00 - 12.29.59 PSW3
12.30.00 - 13.59.59 PSW2
14.00.00 - 14.29.59 PSW1

Absen pulang (dirumah, senin-kamis)
tidak absen - 14.29.59 PSW4
14.30.00 - 14.59.59 PSW3
15.00.00 - 15.29.59 PSW2
15.30.00 - 15.59.59 PSW1

Absen pulang (jumat)
tidak absen - 14.59.59 PSW4
15.00.00 - 15.29.59 PSW3
15.30.00 - 15.59.59 PSW2
16.00.00 - 16.29.59 PSW1

catatan : absen pulang hanya dihitung kalau absen sore aman dari PSW agar tidak terjadi 2 kali hitung PSW
jika salah satu dari absen sore atau absen pulang tidak terisi saat ybs WFO maka dianggap 1 PSW4
jika keduanya tidak terisi saat ybs WFO maka dianggap 1 PSW4

*Absen untuk yg WFO tipe 2*

Absen Pagi (07.30, dirumah)
7.30.00 - 8.00.00 TL1
8.00.01 - 8.30.00 TL2
8.30.01 - 9.00.00 TL3
9.00.01 - tidak absen TL4

Absen Datang (9.00, dikantor)
9.00.01 - 9.30.00 TL1
9.30.01 - 10.00.00 TL2
10.00.01 - 10.30.00 TL3
10.30.01 - tidak absen TL4

Absen pulang (senin - kamis)
tidak absen - 14.29.59 PSW4
14.30.00 - 14.59.59 PSW3
15.00.00 - 15.29.59 PSW2
15.30.00 - 15.59.59 PSW1

Absen pulang (jumat)
tidak absen - 14.59.59 PSW4
15.00.00 - 15.29.59 PSW3
15.30.00 - 15.59.59 PSW2
16.00.00 - 16.29.59 PSW1


catatan : absen datang hanya dihitung kalau absen pagi aman dari TL agar tidak terjadi 2 kali hitung TL
kalau absen pagi TL, maka TL dilihat dari absen pagi saja
jika salah satu dari absen pagi atau absen datang tidak terisi saat ybs WFO maka dianggap 1 TL4
jika keduanya tidak terisi saat ybs WFO maka dianggap 1 TL4


*Aturan Absen selama bulan Ramadan*

Absen Pagi
8.00.00 - 8.30.00 TL1
8.30.01 - 9.00.00 TL2
9.00.01 - 9.30.00 TL3
9.30.01 - tidak absen TL4

Absen pulang (senin - kamis)
tidak absen - 13.29.59 PSW4
13.30.00 - 13.59.59 PSW3
14.00.00 - 14.29.59 PSW2
14.30.00 - 14.59.59 PSW1

Absen pulang (jumat)
tidak absen - 13.59.59 PSW4
14.00.00 - 14.29.59 PSW3
14.30.00 - 14.59.59 PSW2
15.00.00 - 15.29.59 PSW1




catatan : 
Absen setelah jam 20.00.00 otomatis terhapus oleh sistem
Absen sebelum jam 6.00.00 otomatis terhapus oleh sistem