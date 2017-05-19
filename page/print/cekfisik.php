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
<body style="font-size:12px">
<?
error_reporting(0);
include "../include/application_top.php";
//include "../include/function.php";

		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nonota='$_REQUEST[nonota]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduserpdi]'"));

?>

	<div class="col-xs-12" style="text-align:center">
		<h4><b>CEK FISIK</b></h4>
	</div>
	</br>
	<div class="col-xs-12">
		<b>DATA PELANGGAN</b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
    		<tr>
    			<td width="45%">NO. NOTA PENJUALAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dB[nonota]?></td>
    		</tr>
    		<tr>
    			<td width="45%">NOMOR PDI</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dB[nopdi]?></td>
    		</tr>
    		<tr>
    			<td>TGL CEK FISIK</td>
    			<td>:</td>
    			<td><?echo date("d-m-Y",strtotime($d5[tanggal]))?></td>
    		</tr>
    		<tr>
    			<td width="45%">NAMA CHECKER</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d6[nama]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    	</table>
    </div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
    		<tr>
    			<td width="45%">NAMA PELANGGAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[nama]?></td>
    		</tr>
    		<tr>
    			<td>NO. KTP/NO. IDENTITAS</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d1[noktp]?></td>
    		</tr>
    		<tr>
    			<td width="45%" valign="top">ALAMAT</td>
    			<td width="2%" valign="top">:</td>
    			<td colspan="2" valign="top"><?echo $d1[alamat]?>, RT/RW <?echo $d1[rt]?>/<?echo $d1[rw]?></td>
			</tr>
    		<tr>
    			<td></td>
    			<td></td>
    			<td colspan="2"><?echo $d1[namakel]?>, <?echo $d1[namakec]?>, <?echo $d1[namakab]?></td>
    		</tr>
    	</table>
    </div>
    <!-- ################################################################################################################# -->
    
	<?
	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE nonota='$dB[nonota]' GROUP BY nonota"));
	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'");
	?>	
	<div class="col-xs-12">
		<b>TRANSAKSI <?echo "$dA[jnstransaksi]"?></b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
			<tr>
    			<td width="45%">KUANTITAS</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dQ[total]?> UNIT</td>
    		</tr>
    		<tr>
    			<td>TNKB</td>
    			<td>:</td>
    			<td colspan="2"><input type="text" name="tnkb" value="<?echo $dB[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
    		</tr>
		<?
		if($dA[jnstransaksi]=='KREDIT')
			{
		?>
			<tr>
    			<td width="45%">LEASING</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d3[namaleasing]?></td>
			</tr>
			<tr>
    			<td width="45%">MASA ANGSURAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dA[termin]?> KALI</td>
			</tr>
		<?
			}
		?>
    		<tr><td></br></td></tr>
    	</table>
    </div>
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-12">
		<b>DETAIL UNIT</b>
	</div>
	<div class="col-xs-12">
        <table width="100%" class="table table-striped">
    	<?
    	while($dTemp = mysql_fetch_array($qTemp))
    		{
			$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dTemp[norangka]'"));
			$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dTemp[idbarang]'"));
    	?>
        	
        	<tr><td>
        	<div class="col-xs-6" style="font-size:12px">
            	<table width="80%">
            		<tr>
            			<td width="50%">NOMOR RANGKA</td>
            			<td width="2%">:</td>
            			<td colspan="2"><?echo $dTemp[norangka]?></td>
            		</tr>
            		<tr>
            			<td>NOMOR MESIN</td>
            			<td>:</td>
            			<td colspan="2"><?echo $dU[nomesin]?></td>
            		</tr>
            		<tr>
            			<td>KODE BARANG</td>
            			<td>:</td>
            			<td colspan="2"><?echo $dC[kodebarang]?></td>
            		</tr>
            		<tr>
            			<td>NAMA</td>
            			<td>:</td>
            			<td colspan="2"><?echo $dC[namabarang]?></td>
            		</tr>
            		<tr>
            			<td width="">VARIAN</td>
            			<td width="">:</td>
            			<td colspan="2"><?echo $dC[varian]?></td>
            		</tr>
            		<tr>
            			<td>WARNA</td>
            			<td>:</td>
            			<td colspan="2"><?echo $dC[warna]?></td>
            		</tr>
            		<tr>
            			<td>TAHUN</td>
            			<td>:</td>
            			<td colspan="2"><?echo $dC[thnproduksi]?></td>
            		</tr>
            		<!--
            		-->
            	</table>
        	</div>
        	<div class="col-xs-6" style="font-size:12px">
            	<table width="80%">
            		<tr>
            			<td width="50%">ANAK KUNCI 2 PCS </td>
            			<td width="5%">:</td>
            			<td colspan="2"><?if($dTemp[anakkunci]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>SPION</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[spion]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>ACCU</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[accu]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>TOOLKIT</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[toolkit]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>HELM</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[helm]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>ALAS KAKI</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[alaskaki]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>JAKET</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[jaket]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>BUKU SERVIS</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[bukuservis]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>CEK FISIK 2 LBR</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[cekfisik]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
            		</tr>
            		<tr>
            			<td>KONDISI MOTOR</td>
            			<td>:</td>
            			<td colspan="2"><?if($dTemp[kondisimotor]=='1'){?>BAIK<?}else{?>TIDAK BAIK<?}?></td>
            		</tr>
            	</table>
        	</div>
        	<div class="col-xs-12">
        		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
        	</div>
        	</td></tr>
    	<?
    		}
    	?>
        </table>
        <div class="clearfix"></div>
    </div>
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-8" style="font-size:12px">
    	<table width="100%">
			<tr>
    			<td><b></b></td>
    		</tr>
			<tr>
    			<td>CHECKER</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td><?echo $d6[nama]?></td>
    		</tr>
    	</table>
    </div>

</body>