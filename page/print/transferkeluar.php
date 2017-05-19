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
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_REQUEST[notransfer]'"));
$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_REQUEST[notransfer]' GROUP BY notransfer"));
$ppn = ROUND($dB[total] * 0.1,0);

$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idtujuan]'"));

						$dA1 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_accu WHERE nonota='$d1[notransfer]'"));
						$dA2 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_alaskaki WHERE nonota='$d1[notransfer]'"));
						$dA3 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_anakkunci WHERE nonota='$d1[notransfer]'"));
						$dA4 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_helm WHERE nonota='$d1[notransfer]'"));
						$dA5 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_spion WHERE nonota='$d1[notransfer]'"));
						$dA6 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_toolkit WHERE nonota='$d1[notransfer]'"));
						$dA7 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_jaket WHERE nonota='$d1[notransfer]'"));
						$dA8 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_bukuservis WHERE nonota='$d1[notransfer]'"));
							

?>

	<div class="col-xs-12" style="text-align:center">
		<h5><b>NOTA MUTASI KELUAR</br>CV ANUGRAH JAYA</b></h5>
	</div>
	</br>
	<div class="col-xs-5">
        <table width="100%">
        	<tr>
        		<td width="40%">NO. MUTASI</td>
        		<td width="3%">:</td>
        		<td><?echo $d1[notransfer]?></td>
        	</tr>
        	<tr>
        		<td>ASAL MUTASI</td>
        		<td>:</td>
        		<td><?echo $dx[namacabang]?></td>
        	</tr>
        	<tr><td></br></td></tr>
        </table>
    </div>
	<div class="col-xs-4">
        <table width="100%">
        	<tr>
        		<td width="50%">TGL MUTASI</td>
        		<td width="3%">:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tgltransfer]))?></td>
        	</tr>
        	<tr>
        		<td>TUJUAN MUTASI</td>
        		<td>:</td>
        		<td><?echo $d2[nama]?></td>
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
        <table id="example2" class="table table-striped table-bordered">
            <thead style="color:#666;font-size:11px">
                <tr>
                    <th style="padding:7px">KODE BARANG</th>
                    <th style="padding:7px">NAMA BARANG</th>
                    <th style="padding:7px">VARIAN</th>
                    <th style="padding:7px">WARNA</th>
                    <th style="padding:7px">NO. RANGKA</th>
                    <th style="padding:7px">NO. MESIN</th>
                    <th width="" style="padding:7px"><center>HARGA MUTASI KELUAR (RP)</center></th>
                    <th width="" style="padding:7px"><center>PPN (RP)</center></th>
                </tr>
            </thead>
            <tbody>
            <?
			$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_REQUEST[notransfer]'");
            while($d1 = mysql_fetch_array($q1))
            	{
				$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
            ?>
                <tr style="cursor:pointer">
                    <td><?echo $d2[kodebarang]?></td>
                    <td><?echo $d2[namabarang]?></td>
                    <td><?echo $d2[varian]?></td>
                    <td><?echo $d2[warna]?></td>
                    <td><?echo $d1[norangka]?></td>
                    <td><?echo $d1[nomesin]?></td>
                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
                </tr>
            <?
            	}
            ?>
            </tbody>
            <tfoot>
            	<tr>
            		<th colspan="5"></th>
            		<th colspan="" align="right">GRAND TOTAL (RP)</th>
            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
            		<th colspan="2"></th>
            	</tr>
            	<tr>
            		<th colspan="5"></th>
            		<th colspan="" align="right">GRAND TOTAL + PPN (RP)</th>
            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
            		<th colspan="2"></th>
            	</tr>
            	<tr>
            		<th colspan="5"></th>
            		<th colspan="" align="right">QTY MUTASI KELUAR</th>
            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
                    <!--
            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
            		-->
            		<th colspan="2"></th>
            	</tr>
            </tfoot>
        </table>
					                <div class="col-xs-12" style="margin:5px"></div>
    
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="30%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><?echo $dA4[jual]?> PCS</td>
					                        	</tr>
					                        	<tr>
					                        		<td>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><?echo $dA8[jual]?> PCS</td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><?echo $dA5[jual]?> PCS</td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="30%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><?echo $dA1[jual]?> PCS</td>
					                        	</tr>
					                        	<tr>
					                        		<td>JAKET</td>
					                        		<td>:</td>
					                        		<td><?echo $dA7[jual]?> PCS</td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><?echo $dA6[jual]?> PCS</td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="35%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><?echo $dA3[jual]?> PCS</td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><?echo $dA2[jual]?> PCS</td>
					                        	</tr>
					                        </table>
					                    </div>
					                <div class="col-xs-12" style="margin:15px"></div>
					                
					                
		<div style="float:right">
			<table style=";font-size: 14px;font-weight: normal;margin-top:5px;" width="420px" border="0">
				<tr>
					<td width=""><?echo $dx[kotaperusahaan]?>, <?echo tgl_indo(date("Y-m-d"))?></td>
				</tr>
				<tr>
					<td width=""><?echo $_SESSION[posisi]?>,</td>
				</tr>
			</table>
			<table style=";font-size: 14px;border-bottom:0px solid #000;margin-top:50px" width="350px" border="0">
				<tr><td width=""><?echo $_SESSION[nama]?></td></tr>
			</table>
		</div>
	</div>
</body>