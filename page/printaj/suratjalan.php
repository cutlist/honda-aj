<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
@media print {
html, body {
    width: 8.27in; /* was 9.5in */
    height: 9.5in; /* was 8.27in */
    display: block;
    /*font-size: auto; NOT A VALID PROPERTY */10 11 13 14
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

$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND id='$_REQUEST[id]'"));
$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE id%2=0 AND nonota='$dA[nonota]'"));
$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$dA[nonota]'"));
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dC[idpelanggan]'"));;
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[user]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND posisi='9'"));

?>

	<div class="col-xs-12" style="text-align:center">
		<h4><b>SURAT JALAN CV ANUGRAH JAYA</b></h4>
		<h4><b><?echo $dB[nosj]?></b></h4>
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
    			<td width="45%">NO. NOTA PEMESANAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dA[nopesan]?></td>
    		</tr>
    		<tr>
    			<td width="45%">NAMA PELANGGAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[nama]?></td>
    		</tr>
    		<tr>
    			<td width="45%">NOMOR OHC</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[ohc]?></td>
    		</tr>
    		<tr>
    			<td>NOMOR TELEPON</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d1[notelepon]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    	</table>
    </div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
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
    		<tr>
    			<td>EMAIL</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d1[email]?></td>
    		</tr>
    		<tr>
    			<td>PEKERJAAN</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d1[pekerjaan]?></td>
    		</tr>
    	</table>
    </div>
	<div class="col-xs-12">
		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
	</div>
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-12">
		<b>DETAIL UNIT</b>
	</div>
	<div class="col-xs-12">
    	<?
		$dTemp = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND norangka='$dA[norangka]'"));
		$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
		$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
		$dD   = mysql_fetch_array(mysql_query("SELECT jaket,bukuservice FROM tbl_notajual_det WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
    	?>
        	
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
            			<td>NAMA BARANG</td>
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
        	
        <div class="clearfix"></div>
    </div>
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-8" style="font-size:12px">
    	<table width="100%">
			<tr>
    			<td><b>MENGETAHUI,</b></td>
    		</tr>
			<tr>
    			<td>PIC,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td><?echo $d3[nama]?></td>
    		</tr>
    	</table>
    </div>
    <div class="clearfix"></div>
    
	<div class="col-xs-4" style="font-size:12px;margin-top:20px">
    	<table width="100%">
			<tr>
    			<td>ADMINISTRASI,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td><?echo $d2[nama]?></td>
    		</tr>
    	</table>
    </div>
	<div class="col-xs-4" style="font-size:12px;margin-top:20px">
    	<table width="100%">
			<tr>
    			<td align="">DRIVER,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td align=""></td>
    		</tr>
    	</table>
    </div>
	<div class="col-xs-4" style="font-size:12px;margin-top:20px">
    	<table width="100%">
			<tr>
    			<td align="">PELANGGAN,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td align=""><?echo $d1[nama]?></td>
    		</tr>
    	</table>
    </div>

</body>