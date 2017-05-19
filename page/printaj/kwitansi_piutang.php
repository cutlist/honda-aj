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
<script>
setTimeout("window.close();", 1);
window.print();
</script>
<body style="font-family:Calibri">
<?
error_reporting(0);
include "../include/application_top.php";
include "../include/function.php";

//echo $_REQUEST['nv'];
mysql_query("UPDATE tbl_kwitansi SET cetak='1' WHERE id%2=0 AND nokwitansi='$_REQUEST[nokwitansi]'");

$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id%2=0 AND id='1'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nokwitansi]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND id='$d2[idpelanggan]'"));

mysql_query("UPDATE tbl_kwitansi SET status='1' WHERE id%2=0 AND nokwitansi='$_REQUEST[nokwitansi]'");
mysql_query("UPDATE tbl_potkompensasi SET status='1',updatex='$updatex' WHERE id%2=0 AND id='$d2[nomor]'");
mysql_query("UPDATE tbl_piutang SET status='1',updatex='$updatex' WHERE id%2=0 AND id='$d2[nomor]'");

$jenis = "PIUTANG KARYAWAN TUNAI";

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
				<td width="">TELAH BERIKAN KEPADA</td>
			</tr>
		</table>
		<table style=";font-size: 14px;" width="1150px" border="0">
			<tr>
				<td width="22%">NAMA</td>
				<td width="2%">:</td>
				<td width=""><?echo $d3[nama]?></td>
			</tr>
			<tr>
				<td width="">NO. KTP/IDENTITAS</td>
				<td width="">:</td>
				<td width=""><?echo strtoupper($d3[noktp])?></td>
			</tr>
		</table>
		<!-- ############################################################################################################ -->
		<table style=";font-size: 14px;font-weight: bold;margin-top:10px;border-top:1px solid #000;border-bottom:1px solid #000" width="1150px" border="0">
			<tr>
				<td width="">PEMBAYARAN</td>
			</tr>
		</table>
		<table style=";font-size: 14px;border-bottom:1px solid #000" width="1150px" border="0">
			<tr>
				<td width="22%">SEJUMLAH UANG</td>
				<td width="2%">:</td>
				<td width=""><?echo Terbilang($d2[jumlah])?> RUPIAH</td>
			</tr>
			<tr>
				<td width="">UNTUK PEMBAYARAN</td>
				<td width="">:</td>
				<td width=""><?echo $jenis?></td>
			</tr>
			<tr>
				<td width="">KETERANGAN</td>
				<td width="">:</td>
				<td width=""><?echo strtoupper($d2[keterangan])?></td>
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
				<tr>
					<td width="">PENERIMA,</td>
				</tr>
			</table>
			<table style=";font-size: 14px;border-bottom:0px solid #000;margin-top:50px" width="350px" border="0">
				<tr><td width=""><?echo $d3[nama]?></td></tr>
			</table>
		</div>
	</div>
</div>
</body>