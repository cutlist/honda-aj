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
mysql_query("UPDATE tbl_kwitansi SET cetak='1',status='1' WHERE id%2=0 AND nokwitansi='$_REQUEST[nokwitansi]'");

$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id%2=0 AND id='1'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nokwitansi]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d2[idpelanggan]'"));
$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$d2[nomor]' OR notajual='$d2[nomor]'"));
$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$d2[user]'"));

if($d2[jumlah] < 0)
	{
	$jenis = "PENGEMBALIAN PEMBAYARAN PEMESANAN NO. POLISI";
	}
else
	{
	$jenis = "PEMBAYARAN PEMESANAN NO. POLISI";
	}
if($d4[status]=="2"){
	$nota  = "JUAL";
	}
else{
	$nota  = "PESAN";
	}
mysql_query("UPDATE tbl_bpkb SET status='1' WHERE id%2=0 AND nopesan='$d2[nomor]'");
?>

<div style="width:1150px">
	<div style="text-align: center;;padding-left: 100px"><?echo $d1[perusahaan]?></div>
	<div style="text-align: center;;padding-left: 100px">KWITANSI <?echo $jenis?></div>
	<div style="text-align: center;;padding-left: 100px"><?echo $d2[nokwitansi]?></div>
	
	<div style="float: left;margin-top:10px;padding-left: 20px">
		<table style=";font-size: 14px;" width="1150px" border="0">
			<tr>
				<td width="22%">NO. NOTA <?echo $nota?></td>
				<td width="2%">:</td>
				<td width="40%"><?echo $d2[nomor]?></td>
				<td width="17%">TANGGAL KWITANSI</td>
				<td width="2%">:</td>
				<td width=""><?echo tgl_indo($d2[tanggal])?></td>
			</tr>
		</table>
		<!-- ############################################################################################################ -->
		<table style=";font-size: 14px;font-weight: bold;margin-top:10px;border-top:1px solid #000;border-bottom:1px solid #000" width="1150px" border="0">
		<?
		if($d2[jumlah] < 0)
			{
		?>
			<tr>
				<td width="">DIKEMBALIKAN KE</td>
			</tr>
		<?
			}
		else
			{
		?>
			<tr>
				<td width="">TELAH DITERIMA DARI</td>
			</tr>
		<?
			}
		?>
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
				<td width=""><?echo $d3[noktp]?></td>
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
				<td width=""><?echo Terbilang(abs($d2[jumlah]))?> RUPIAH</td>
			</tr>
			<tr>
				<td width="">UNTUK PEMBAYARAN</td>
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
			<table style=";margin-top:5px;border-top:1px solid #000;border-bottom:1px solid #000;padding-left:10px" width="300px" border="0">
				<tr>
					<td width="" ><span style="font-size: 20px;font-weight: bold">RP. <?echo number_format(abs($d2[jumlah]))?></span></td>
				</tr>
			</table>
			<table style=";font-size: 14px;font-weight: normal;margin-top:5px;" width="420px" border="0">
				<tr><td height="10px"></td></tr>
	        	<tr>
	        		<td colspan="3" align="left">PELANGGAN,</td>
	        	</tr>
	        	<tr>
	        		<td colspan="3" style="height:60px"></td>
	        	</tr>
	        	<tr>
	        		<td colspan="3" align="left"><b><?echo $d3[nama]?></br><?echo $d3[notelepon]?></b></td>
	        	</tr>
	        </table>	
		</div>
		<div style="float:right">
			<table style=";font-size: 14px;font-weight: normal;margin-top:5px;" width="420px" border="0">
				<tr>
					<td width=""><?echo $d1[kotaperusahaan]?>, <?echo tgl_indo(date("Y-m-d"))?></td>
				</tr>
				<tr>
					<td width="">KASIR,</td>
				</tr>
			</table>
			<table style=";font-size: 14px;border-bottom:0px solid #000;margin-top:50px" width="350px" border="0">
				<tr><td width=""><?echo $d5[nama]?></td></tr>
			</table>
		</div>
	</div>
</div>
</body>