<?php 

include "../../connect.php";

if(isSet($_POST['bpkbpengambil']))
{
$bpkbpengambil = strtoupper($_POST['bpkbpengambil']);
$nonota= $_POST['nonota'];

									$dCek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$nonota' AND (namaambilbpkb='$bpkbpengambil' OR namaambilbpkb2='$bpkbpengambil')"));
									$dCek2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$nonota'"));
									if(!empty($dCek2[namaambilbpkb2])){
										$npbpkb = "$dCek2[namaambilbpkb] Atau $dCek2[namaambilbpkb2]";
										}
									else{
										$npbpkb = "$dCek2[namaambilbpkb]";
										}
			
									if(empty($dCek[id])){
										echo "Mohon Ulangi Nama Pengambil BPKB ($bpkbpengambil) Yang Diinput, Karena Berbeda Dengan Rencana Nama Pengambil BPKB Di Menu Pengeluaran Unit ($npbpkb).')";
										}
									else{
										echo 'OK';
										}
										

}

?>