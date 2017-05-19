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
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE nokwitansi='$_REQUEST[nokwitansi]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d2[idpelanggan]'"));
$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE nonota='$d2[nomor]'"));

$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d2[user]'"));
$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_user_vw WHERE id='$d2[user]'"));

$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelisp FROM x23_notajual_det_vw WHERE nonota='$d2[nomor]'"));

    	if($d2[jnskwitansi]=='penjualan'){
			$jenis = "PENJUALAN BARANG";
			}

$dC = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS jumlah FROM x23_kwitansi WHERE jnskwitansi='indent' AND nomor='$d2[nomor]' AND status='1' AND nokwitansi!='$_REQUEST[nokwitansi]'"));
		
?>

<div style="width:1150px">
	<div style="text-align: left;padding-left: 20px"><?echo $d1[perusahaan]?></div>
	<div style="text-align: left;padding-left: 20px"><?echo $d1[alamatperusahaan]?></div>
	<div style="text-align: left;padding-left: 20px"><?echo $d1[kotaperusahaan]?></div>
	
	<div style="text-align: center;padding-left: 100px">KWITANSI UANG MUKA INDENT</div>
	<div style="text-align: center;padding-left: 100px"><?echo $d2[nokwitansi]?></div>
	
	<div style="float: left;margin-top:10px;padding-left: 20px">
		<table style=";" width="1150px" border="0">
			<tr>
				<td width="21%"><b>Nomor Nota Indent</b></td>
				<td width="2%">:</td>
				<td width="27%"><?echo $d2[nomor]?></td>
				<td width="21%"><b>Nama Pelanggan</b></td>
				<td width="2%">:</td>
				<td width=""><?echo $d3[nama]?></td>
			</tr>
			<tr>
				<td ><b>Tanggal Kwitansi</b></td>
				<td >:</td>
				<td ><?echo tgl_indo($d2[tanggal])?></td>
				<td ><b>Alamat Pelanggan</b></td>
				<td >:</td>
				<td ><?echo substr($d3[alamat],0,24)?></td>
			</tr>
		</table>
		
		<table style="font-weight: bold;margin-top:10px;border-top:1px solid #000;border-bottom:1px solid #000" width="1150px" border="0">
            <tr>
                <td align="center" width="20%">Kode Barang</td>
                <td align="center" width="">Barang</td>
                <td align="center" width="5%">Qty</td>
            </tr>
		</table>
            
		<table style="" width="1150px" border="0">
            <?
			$qA  = mysql_query("SELECT * FROM x23_indent_det_vw WHERE noindent='$d2[nomor]'");
            while($dA = mysql_fetch_array($qA))
            	{
            ?>
                <tr>
                    <td width="20%"><?echo $dA[kodebarang]?></td>
                    <td width="" align=""><?echo "$dA[namabarang] | $dA[varian]"?></td>
                    <td width="5%" align="right"><span style="margin-right:5%"><?echo number_format($dA[qty],"0","",".")?> Pcs</span></td>
                </tr>
                
            <?
            	}
            ?>
        </table>
        
		<table style="margin-top:30px;border-top:1px solid #000;border-bottom:1px solid #000;" width="1150px" border="0">
		<?
		if($d2[tambahdp]=="0")
			{
		?>
        	<tr>
        		<td align="left"><b>Jumlah Uang Muka</b></td>
        		<td align="center" width="5%"><b>: Rp.</b></td>
        		<td width="" align="right"><span style="margin-right:20%"><b> <?echo number_format($d2[jumlah])?></b></span></td>
                <td width=""></td>
        	</tr>
        	<tr>
        		<td align="left"><b>Biaya HO</b></td>
        		<td align="center" width="5%"><b>: Rp.</b></td>
        		<td width="" align="right"><span style="margin-right:20%"><b> <?echo number_format($d2[jumlahho])?></b></span></td>
                <td width=""></td>
        	</tr>
        	<tr>
        		<td align="left"><b>Total </b></td>
        		<td align="center" width="5%"><b>: Rp.</b></td>
        		<td width="" align="right"><span style="margin-right:20%"><b> <?echo number_format($d2[jumlahho]+$d2[jumlah])?></b></span></td>
                <td width="65%"></td>
        	</tr>
        	<tr><td><br/></td></tr>
			<tr>
				<td colspan="4">
					Kasir : <b><?echo $d4[nama]?></b>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					Terbilang :</br>
					<?
					if($d2[jumlah]!="0"){echo Terbilang($d2[jumlahho]+$d2[jumlah])." RUPIAH";}
					else{echo "NOL RUPIAH";}
					?>
				</td>
			</tr>
		<?
			}
		if($d2[tambahdp]=="1")
			{
		?>
		<!--
        	<tr>
        		<td align="left"><b>Jumlah Uang Muka Sebelumnya</b></td>
        		<td align="center" width="5%"><b>: Rp.</b></td>
        		<td width="" align="right"><span style="margin-right:20%"><b> <?echo number_format($dC[jumlah])?></b></span></td>
                <td width=""></td>
        	</tr>
        	<tr>
        		<td align="left"><b>Tambah Uang Muka</b></td>
        		<td align="center" width="5%"><b>: Rp.</b></td>
        		<td width="" align="right"><span style="margin-right:20%"><b> <?echo number_format($d2[jumlah])?></b></span></td>
                <td width="65%"></td>
        	</tr>
		-->
        	<tr>
        		<td align="left"><b>Jumlah Uang Muka</b></td>
        		<td align="center" width="5%"><b>: Rp.</b></td>
        		<td width="" align="right"><span style="margin-right:20%"><b> <?echo number_format($d2[jumlah])?></b></span></td>
                <td width="65%"></td>
        	</tr>
        	<tr><td><br/></td></tr>
			<tr>
				<td colspan="4">
					Kasir : <b><?echo $d4[nama]?></b>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					Terbilang :</br>
					<?
					if($d2[jumlah]!="0"){echo Terbilang($d2[jumlah])." RUPIAH";}
					else{echo "NOL RUPIAH";}
					?>
				</td>
			</tr>
		<?
			}
		?>
			<tr>
				<td colspan="4">
					Keterangan :</br>
					<?echo $d2[keterangan]?>
				</td>
			</tr>
		</table>
		<table border="0" width="1150px">
        	<tr>
        		<td colspan="5" align="left" style="font-size:11px"><i>BARANG YANG SUDAH DIBELI TIDAK DAPAT DIKEMBALIKAN. TERIMA KASIH.</i></td>
        		<td width="40%" colspan="" align="right"><?echo tgl_indo(date("Y-m-d"))." ".date("H:i:s")?></td>
        	</tr>
		</table>
		
		<table style="margin-top:10px;" width="1150px" border="0">
			<tr>
				<td width="70%"><b>PELANGGAN,</b></td>
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