<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
@media print {
html, body {
    width: 8.27in; /* was 9.5in */
    height: 9.5in; /* was 8.27in */
    display: block;
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
<body style="font-size:12px;font-family:Calibri">
<?
error_reporting(0);
include "../include/application_top.php";
include "../include/function.php";

$dx = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE nonota='$_REQUEST[nonota]'"));
$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE nonota='$d1[nonota]'"));		
$ppn = 	ROUND(($d2[total]*10)/100);	 						

$d3 = mysql_fetch_array(mysql_query("SELECT nama,posisi FROM tbl_user_vw WHERE id='$d1[iduser]'"));

?>

	<div class="col-xs-12" style="text-align:center">
		<h5><b>NOTA BELI</br>CV ANUGRAH JAYA</b></h5>
	</div>
	</br>
	<div class="col-xs-5">
        <table width="100%">
        	<tr>
        		<td width="40%">NO. FAKTUR</td>
        		<td width="3%">:</td>
        		<td><?echo $d1[nodo]?></td>
        	</tr>
        	<tr>
        		<td>NO. SURAT PESANAN</td>
        		<td>:</td>
        		<td><?echo $d1[nopo]?></td>
        	</tr>
        	<tr>
        		<td>NO. NOTA BELI</td>
        		<td>:</td>
        		<td><?echo $d1[nonota]?></td>
        	</tr>
        	<tr><td></br></td></tr>
        </table>
    </div>
	<div class="col-xs-4">
        <table width="100%">
        	<tr>
        		<td width="60%">TGL FAKTUR</td>
        		<td width="3%">:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tgldo]))?></td>
        	</tr>
        	<tr>
        		<td>TGL SURAT PESANAN</td>
        		<td>:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tglpo]))?></td>
        	</tr>
        	<tr>
        		<td>TGL NOTA BELI</td>
        		<td>:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tglnota]))?></td>
        	</tr>
        </table>
    </div>
	<div class="col-xs-3">
        <table width="100%">
        	<tr>
        		<td width="20%" valign="top">MEMO</td>
        		<td width="3%" valign="top">:</td>
    			<td valign="top"><?echo $d1[memo]?></td>
        	</tr>
        </table>
    </div>

    <div class="col-xs-12">
	    <table width="100%" class="table table-striped table-bordered">
	        <thead style="color:#666;font-size:9px">
	            <tr>
	                <th style="padding:7px">KODE BARANG</th>
	                <th style="padding:7px">NAMA BARANG</th>
	                <th style="padding:7px">VARIAN</th>
	                <th style="padding:7px">WARNA</th>
	                <th style="padding:7px">NOMOR RANGKA</th>
	                <th style="padding:7px">NOMOR MESIN</th>
	                <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
	            </tr>
	        </thead>
	        <tbody>
	        <?
			$no=1;
			$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
	        while($dA = mysql_fetch_array($q1))
	        	{
	        ?>
	            <tr style="cursor:pointer;font-size:9px">
	                <td><?echo $dA[kodebarang]?></td>
	                <td><?echo $dA[namabarang]?></td>
	                <td><?echo $dA[varian]?></td>
	                <td><?echo $dA[warna]?></td>
	                <td><?echo $dA[norangka]?></td>
	                <td><?echo $dA[nomesin]?></td>
	                <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
	            </tr>
	            
	        <?
				$no++;
	        	}
	         ?>
	        </tbody>
	        <tfoot style="color:#666;font-size:9px">
	        	<tr>
	        		<th colspan="5"></th>
	        		<th colspan="" align="center"><center>GRAND TOTAL BELI (RP)</center></th>
	        		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
	        	</tr>
	        	<tr>
	        		<th colspan="5"></th>
	        		<th colspan="" align="center"><center>GRAND TOTAL BELI + PPN (RP)</center></th>
	        		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total]+$ppn)?></b></span></td>
	        	</tr>
	        	<tr>
	        		<th colspan="5"></th>
	        		<th colspan="" align="center"><center>QTY BELI (UNIT)</center></th>
	        		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
	        	</tr>
	        </tfoot>
	    </table>
		<div style="float:right">
			<table style=";font-size: 14px;font-weight: normal;margin-top:5px;" width="420px" border="0">
				<tr>
					<td width=""><?echo $dx[kotaperusahaan]?>, <?echo tgl_indo(date("Y-m-d"))?></td>
				</tr>
				<tr>
					<td width=""><?echo $d3[posisi]?>,</td>
				</tr>
			</table>
			<table style=";font-size: 14px;border-bottom:0px solid #000;margin-top:50px" width="350px" border="0">
				<tr><td width=""><?echo $d3[nama]?></td></tr>
			</table>
		</div>
	</div>
</body>