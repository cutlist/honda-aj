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

$dx = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id%2=0 AND id='1'"));
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));

$d2  = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total, SUM(total) AS gtotal FROM x23_notabeli_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));			                           
if($d1[idsupplier]=="1"){
	$ppn = round($d2[gtotal]*0.1,0);  
	}
else{
	$ppn = 0;
	} 

$d3 = mysql_fetch_array(mysql_query("SELECT nama,posisi FROM x23_user_vw WHERE id%2=0 AND id='$d1[iduserbeli]'"));

$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_supplier WHERE id%2=0 AND id='$d1[idsupplier]' ORDER BY nama"));

?>

	<div class="col-xs-12" style="text-align:center">
		<h5><b>NOTA BELI H2H3</br>CV ANUGRAH JAYA</b></h5>
	</div>
	</br>
	<div class="col-xs-8">
        <table width="100%">
        	<tr>
        		<td width="30%">NAMA SUPPLIER</td>
        		<td width="1%">:</td>
        		<td><?echo $d4[nama]?></td>
        	</tr>
        	<tr>
        		<td>NO. PO SUPPLIER</td>
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
        		<td width="50%">TGL PO SUPPLIER</td>
        		<td width="1%">:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tglpo]))?></td>
        	</tr>
        	<tr>
        		<td>TGL NOTA BELI</td>
        		<td>:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tglnota]))?></td>
        	</tr>
        </table>
    </div>

    <div class="col-xs-12">
	    <table width="100%" class="table table-striped table-bordered">
	        <thead style="color:#666;font-size:9px">
	            <tr>
                    <th style="padding:7px">KODE BARANG</th>
                    <th style="padding:7px">BARANG</th>
                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
                    <th width="" style="padding:7px">GUDANG</th>
                    <th width="" style="padding:7px">RAK</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?
			$no=1;
			$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'");
	        while($dA = mysql_fetch_array($q1))
	        	{
            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
            	$dC = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id%2=0 AND id='$dA[idgudang]'"));
	        ?>
	            <tr style="cursor:pointer;font-size:9px">
                    <td><?echo $dB[kodebarang]?></td>
                    <td><?echo "$dB[namabarang] | $dB[varian]"?></td>
                    <td align="right"><span style="margin-right:0%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
                    <td><?echo $dC[gudang]?></td>
                    <td><?echo $dA[rak]?></td>
	            </tr>
	            
	        <?
				$no++;
	        	}
	         ?>
	        </tbody>
	        <tfoot style="color:#666;font-size:9px">
            	<tr>
            		<th colspan=""></th>
            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
            		<td colspan="" align="right"><span style="margin-right:0%"><b><?echo number_format($d2[qty])?> PCS</b></span></td>
            		<td colspan="" align="right"></td>
            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal])?></b></span></td>
            		<th colspan="3"></th>
            	</tr>
            	<tr>
            		<th colspan=""></th>
            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL + PPN</b></span></td>
            		<td colspan="" align="right"><span style="margin-right:0%"></span></td>
            		<td colspan="" align="right"></td>
            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal]+$ppn)?></b></span></td>
            		<th colspan="3"></th>
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