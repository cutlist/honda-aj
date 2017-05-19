<?php
	function tgl_indo1($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	
	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Mar";
						break;
					case 4:
						return "Apr";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Jun";
						break;
					case 7:
						return "Jul";
						break;
					case 8:
						return "Agu";
						break;
					case 9:
						return "Sep";
						break;
					case 10:
						return "Okt";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Des";
						break;
				}
			} 
			
	function selisihHari($tglAwal, $tglAkhir)
		{
		// list tanggal merah selain hari minggu
		$tglLibur = Array("");

		// memecah string tanggal awal untuk mendapatkan
		// tanggal, bulan, tahun
		$pecah1 = explode("-", $tglAwal);
		$date1 = $pecah1[2];
		$month1 = $pecah1[1];
		$year1 = $pecah1[0];

		// memecah string tanggal akhir untuk mendapatkan
		// tanggal, bulan, tahun
		$pecah2 = explode("-", $tglAkhir);
		$date2 = $pecah2[2];
		$month2 = $pecah2[1];
		$year2 =  $pecah2[0];

		// mencari total selisih hari dari tanggal awal dan akhir
		$jd1 = GregorianToJD($month1, $date1, $year1);
		$jd2 = GregorianToJD($month2, $date2, $year2);

		$selisih = $jd2 - $jd1;

		// proses menghitung tanggal merah dan hari minggu
		// di antara tanggal awal dan akhir
		for($i=1; $i<=$selisih; $i++)
			{
				// menentukan tanggal pada hari ke-i dari tanggal awal
				$tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
				$tglstr = date("Y-m-d", $tanggal);

				// menghitung jumlah tanggal pada hari ke-i
				// yang masuk dalam daftar tanggal merah selain minggu
				if (in_array($tglstr, $tglLibur))
				{
				   $libur1++;
				}

				// menghitung jumlah tanggal pada hari ke-i
				// yang merupakan hari minggu
				if ((date("N", $tanggal) == 7))
				{
				   $libur2++;
				}
			}

		// menghitung selisih hari yang bukan tanggal merah dan hari minggu
		//return $selisih-$libur1-$libur2;
		return $selisih;
		}
?>
