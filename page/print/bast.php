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
$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE nopesan='$dB[nopesan]'"));
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dA[nopesan]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$_REQUEST[nonota]'"));
$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduserpdi]'"));
$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE nopesan='$dB[nopesan]'"));
$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduser]'"));

?>

	<div class="col-xs-12" style="text-align:center">
		<h4><b>BERITA ACARA SERAH TERIMA UNIT CV ANUGRAH JAYA</b></h4>
	</div>
	</br>
	<div class="col-xs-12">
		<b>DATA PELANGGAN</b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
    		<tr>
            	<td width="3%"></td>
    			<td width="40%">NO. NOTA PENJUALAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dB[nonota]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td width="40%">NO. NOTA PEMESANAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dA[nopesan]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td width="40%">NAMA PELANGGAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[nama]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td width="40%">NOMOR OHC</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[ohc]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
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
    			<td width="40%" valign="top">ALAMAT</td>
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
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-12">
		<b>DATA BPKB</b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
    		<tr>
            	<td width="3%"></td>
    			<td width="40%">NAMA BPKB</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d2[nama]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td>NO. KTP/NO. IDENTITAS</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d2[noktp]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td valign="top">ALAMAT</td>
    			<td valign="top">:</td>
    			<td colspan="2" valign="top"><?echo $d2[alamat]?>, RT/RW <?echo $d2[rt]?>/<?echo $d2[rw]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td></td>
    			<td></td>
    			<td colspan="2"><?echo $d1[namakel]?>, <?echo $d1[namakec]?>, <?echo $d1[namakab]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    	</table>
    </div>
	<div class="col-xs-6" style="font-size:12px">        	
		<table width="100%">
			<tr>
				<td width="40%" valign="top">PESAN NO. POLISI</td>
				<td width="2%" valign="top">:</td>
				<td colspan="2"><?echo $d2[pnopol]?></td>
			</tr>
		</table>
    </div>
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-12">
		<b>METODE PENYERAHAN : DI <?echo "$d5[penyerahan]"?></b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
    		<tr>
            	<td width="3%"></td>
    			<td width="50%">NAMA PENGAMBIL STNK 1</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d5[namaambilstkn1]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td>NO. TLP PENGAMBIL STNK 1</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d5[tlpambilstkn1]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    		<tr>
            	<td width="3%"></td>
    			<td width="50%">NAMA PENGAMBIL STNK 2</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d5[namaambilstkn2]?></td>
    		</tr>
    		<tr>
            	<td width="3%"></td>
    			<td>NO. TLP PENGAMBIL STNK 2</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d5[tlpambilstkn2]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    	</table>
    </div>
	<div class="col-xs-6" style="font-size:12px">        	
		<table width="100%">
    		<tr>
    			<td width="50%">NAMA PENGAMBIL BPKB 1</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d5[namaambilbpkb]?></td>
    		</tr>
    		<tr>
    			<td>NO. TLP PENGAMBIL BPKB 1</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d5[tlpambilbpkb]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    		<tr>
    			<td width="40%">NAMA PENGAMBIL BPKB 2</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d5[namaambilbpkb2]?></td>
    		</tr>
    		<tr>
    			<td>NO. TLP PENGAMBIL BPKB 2</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d5[tlpambilbpkb2]?></td>
    		</tr>
		</table>
    </div>
    <!-- ################################################################################################################# -->
    
	<?
		$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE nonota='$dB[nonota]' GROUP BY nonota"));
		$dS  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id='$dB[idsales]'"));
	?>	
	<div class="col-xs-12">
		<b>TRANSAKSI <?echo "$dA[jnstransaksi] $dA[jnscashtempo]"?></b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
			<tr>
            	<td width="3%"></td>
    			<td width="40%">NAMA SALES</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dS[nama]?></td>
    		</tr>
			<tr>
            	<td width="3%"></td>
    			<td width="">KUANTITAS</td>
    			<td width="">:</td>
    			<td colspan="2"><?echo $dQ[total]?> UNIT</td>
    		</tr>
			<tr>
            	<td width="3%"></td>
    			<td width="">TNKB</td>
    			<td width="">:</td>
    			<td colspan="2"><?echo $dB[tnkb]?></td>
    		</tr>
		<?
		if($dA[jnstransaksi]=='KREDIT')
			{
		?>
			<tr>
            	<td width="3%"></td>
    			<td width="40%">LEASING</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d3[namaleasing]?></td>
			</tr>
			<tr>
            	<td width="3%"></td>
    			<td width="40%">MASA ANGSURAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dB[termin]?> KALI</td>
			</tr>
			<tr>
            	<td width="3%"></td>
    			<td width="40%">ANGSURAN</td>
    			<td width="2%">:</td>
    			<td colspan="2">RP. <?echo number_format($dB[angsuran],"0","",".")?></td>
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
		$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'");
    	while($dTemp = mysql_fetch_array($qTemp))
    		{
			$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dTemp[norangka]'"));
			$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dTemp[idbarang]'"));
			$dD   = mysql_fetch_array(mysql_query("SELECT jaket,bukuservice FROM tbl_notajual_det WHERE norangka='$dTemp[norangka]'"));
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
    			<td><b>MENGETAHUI,</b></td>
    		</tr>
			<tr>
    			<td>SALES COUNTER,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td><?echo $d8[nama]?></td>
    		</tr>
    	</table>
    </div>
	<div class="col-xs-4" style="font-size:12px">
    	<table width="100%">
			<tr>
    			<td><b></b></td>
    		</tr>
			<tr>
    			<td>CHECKER PDI,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td><?echo $d6[nama]?></td>
    		</tr>
    	</table>
    </div>
    <div class="clearfix"></div>
    
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
	<div class="col-xs-4" style="font-size:12px;margin-top:20px">
    	<table width="100%">
			<tr>
    			<td align="">PENGAMBIL STNK 1,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td align=""><?echo $d5[namaambilstkn1]?></td>
    		</tr>
    	</table>
    </div>
	<div class="col-xs-4" style="font-size:12px;margin-top:20px">
    	<table width="100%">
			<tr>
    			<td align="">PENGAMBIL STNK 2,</td>
    		</tr>
    		<tr><td></br></br></br></br></td></tr>
			<tr>
    			<td align=""><?echo $d5[namaambilstkn2]?></td>
    		</tr>
    	</table>
    </div>

</body>