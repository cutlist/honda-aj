<?php
function Terbilang($satuan)
	{
	$huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
	if ($satuan < 12)
		return " " . $huruf[$satuan];
	elseif ($satuan < 20)
		return Terbilang($satuan - 10) . " BELAS";
	elseif ($satuan < 100)
		return Terbilang($satuan / 10) . " PULUH" . Terbilang($satuan % 10);
	elseif ($satuan < 200)
		return " SERATUS" . Terbilang($satuan - 100);
	elseif ($satuan < 1000)
		return Terbilang($satuan / 100) . " RATUS" . Terbilang($satuan % 100);
	elseif ($satuan < 2000)
		return " SERIBU" . Terbilang($satuan - 1000);
	elseif ($satuan < 1000000)
		return Terbilang($satuan / 1000) . " RIBU" . Terbilang($satuan % 1000);
	elseif ($satuan < 1000000000)
		return Terbilang($satuan / 1000000) . " JUTA" . Terbilang($satuan % 1000000);
	elseif ($satuan <= 1000000000)
		echo "Maaf Tidak Dapat di Prose Karena Jumlah Uang Terlalu Besar ";
	}

	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "JANUARI";
						break;
					case 2:
						return "FEBRUARI";
						break;
					case 3:
						return "MARET";
						break;
					case 4:
						return "APRIL";
						break;
					case 5:
						return "MEI";
						break;
					case 6:
						return "JUNI";
						break;
					case 7:
						return "JULI";
						break;
					case 8:
						return "AGUSTUS";
						break;
					case 9:
						return "SEPTEMBER";
						break;
					case 10:
						return "OKTOBER";
						break;
					case 11:
						return "NOVEMBER";
						break;
					case 12:
						return "DESEMBER";
						break;
				}
			} 
?>