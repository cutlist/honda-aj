<style>
@media print {
html, body {
    width: 8.27in; /* was 9.5in */
    height: 9.5in; /* was 8.27in */
    display: block;
    letter-spacing: 4px;
    font-size: 16px;
    /*font-size: auto; NOT A VALID PROPERTY */
}

@page {
    size: 8.27in 9.5in /* . Random dot? */;
}
}
</style>
<body style="font-family:Calibri">
<?
error_reporting(0);
include "../include/application_top.php";
include "../include/function.php";

//echo $_REQUEST['nv'];

$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE nokwitansi='$_REQUEST[nokwitansi]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d2[idpelanggan]'"));

$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_user_vw WHERE id='$d2[user]'"));
		
		if($d2[cetak]=="0"){
			if($d2[idpotkom]=="1"){
				$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$d2[nomor]'"));
				$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='piutang' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
				$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='pembayaran' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
				
				$totpiutang    = $dPiu[total];
				$totpembayaran = $dPby[total];
				$sisapiutang   = $dPiu[total]-$dPby[total];
				
					//echo "<script>alert ('$d2[nomor].$totpiutang.$totpembayaran.$sisapiutang.$d2[jumlah]')</script>";
					//exit();
				
				if($sisapiutang < $d2[jumlah]){
			?>
				<script>
				setTimeout("window.close();", 1);
				</script>
			<?
					exit();
					}
				}
			}


mysql_query("UPDATE x23_kwitansi SET cetak='1' WHERE nokwitansi='$_REQUEST[nokwitansi]'");

mysql_query("UPDATE x23_kwitansi SET status='1' WHERE nokwitansi='$_REQUEST[nokwitansi]'");
if($d2[idpotkom]=="0"){
	mysql_query("UPDATE x23_piutang SET status='1',updatex='$updatex' WHERE id='$d2[nomor]'");
	}
if($d2[idpotkom]!="0"){
	mysql_query("UPDATE x23_potkompensasi SET status='1',updatex='$updatex' WHERE id='$d2[nomor]'");
	}

if($d2[jnskwitansi]=="tunai"){
	$jenis = "PEMBAYARAN POTONGAN KOMPENSASI DAN PEMBAYARAN PIUTANG TUNAI";
	$ket1 = "TELAH DITERIMA DARI";
	$ket2 = "PEMBERI";
	}
	
if($d2[jnskwitansi]=="piutang"){
	$jenis = "PIUTANG KARYAWAN";
	$ket1 = "TELAH DIBERIKAN KEPADA";
	$ket2 = "PENERIMA";
	}
//mysql_query("UPDATE x23_kwitansi SET status='1' WHERE nokwitansi='$_REQUEST[nokwitansi]'");


?>

<div style="width:1150px;">
	<div style="text-align: left;;padding-left: 20px;"><?echo $d1[perusahaan]?></div>
	<div style="text-align: left;;padding-left: 20px"><?echo $d1[alamatperusahaan]?></div>
	<div style="text-align: left;;padding-left: 20px"><?echo $d1[kotaperusahaan]?></div>
	
	<div style="text-align: center;;padding-left: 100px">KWITANSI <?echo $jenis?></div>
	<div style="text-align: center;;padding-left: 100px"><?echo $d2[nokwitansi]?></div>
	
	<div style="float: left;margin-top:10px;padding-left: 20px">
		<table style=";font-size: 14px;" width="1150px" border="0">
			<tr>
				<td width="22%"></td>
				<td width="2%"></td>
				<td width="40%"></td>
				<td width="17%">TANGGAL KWITANSI</td>
				<td width="2%">:</td>
				<td width=""><?echo tgl_indo($d2[tanggal])?></td>
			</tr>
		</table>
		<!-- ############################################################################################################ -->
		<table style=";font-size: 14px;font-weight: bold;margin-top:10px;border-top:1px solid #000;border-bottom:1px solid #000" width="1150px" border="0">
			<tr>
				<td width=""><?echo $ket1?></td>
			</tr>
		</table>
		<table style=";font-size: 14px;" width="1150px" border="0">
			<tr>
				<td width="22%">NAMA KARYAWAN</td>
				<td width="2%">:</td>
				<td width=""><?echo $d3[nama]?></td>
			</tr>
			<tr>
				<td width="">NO. KTP/IDENTITAS</td>
				<td width="">:</td>
				<td width=""><?echo $d3[noktp]?></td>
			</tr>
		</table>
		<!-- ############################################################################################################ -->
		<table style=";font-size: 14px;font-weight: bold;margin-top:10px;border-top:1px solid #000;border-bottom:1px solid #000" width="1150px" border="0">
			<tr>
				<td width=""></td>
			</tr>
		</table>
		<table style=";font-size: 14px;border-bottom:1px solid #000" width="1150px" border="0">
			<tr>
				<td width="22%">SEJUMLAH UANG</td>
				<td width="2%">:</td>
				<td width=""><?echo Terbilang($d2[jumlah])?> RUPIAH</td>
			</tr>
			<tr>
				<td width="">UNTUK</td>
				<td width="">:</td>
				<td width=""><?echo $jenis?></td>
			</tr>
			<tr>
				<td width="">KETERANGAN</td>
				<td width="">:</td>
				<td width=""><?echo $d2[keterangan]?></td>
			</tr>
			<tr><td width=""></td></tr>
		</table>
		<!-- ############################################################################################################ -->
		<div style="float:left;margin-right:20px">
			<table style=";font-size: 20px;font-weight: bold;margin-top:5px;border-top:1px solid #000;border-bottom:1px solid #000;padding-left:10px" width="300px" border="0">
				<tr>
					<td width="" >RP. <?echo number_format($d2[jumlah])?></td>
				</tr>
			</table>
		</div>
		<div style="float:right">
			<table style=";font-size: 14px;font-weight: normal;margin-top:5px;" width="420px" border="0">
				<tr>
					<td width=""><?echo $d1[kotaperusahaan]?>, <?echo tgl_indo(date("Y-m-d"))?></td>
				</tr>
			</table>
		</div>
		
		<table style="margin-top:10px;" width="1150px" border="0">
			<tr>
				<td width="70%"><b><?echo $ket2?>,</b></td>
				<td width=""><b><?echo $d5[posisi]?>,</b></td>
			</tr>
			<tr>
        		<td colspan="2" style="height:60px"></td>
			</tr>
			<tr>
        		<td align="left" valign="top"><b><?echo $d3[nama]?></br><?echo $d3[notelepon]?></b></td>
        		<td align="left" valign="top"><b><?echo $d5[nama]?></b></td>
			</tr>
		</table>
	</div>
</div>
</body>
<script>
setTimeout("window.close();", 1);
window.print();
</script>