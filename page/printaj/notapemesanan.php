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
//include "../include/function.php";

$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'"));
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dB[norangka]'"));

?>

	<div class="col-xs-12" style="text-align:center">
		<h4><b>NOTA PEMESANAN</br>CV ANUGRAH JAYA</b></h5>
	</div>
	</br>
	<div class="col-xs-12">
		<b>DATA PELANGGAN</b>
	</div>
	<div class="col-xs-6" style="font-size:12px">
    	<table width="100%">
    		<tr>
            	<td width="1%"></td>
    			<td width="40%">NOMOR NOTA PEMESANAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dA[nopesan]?></td>
    		</tr>
    		<tr>
            	<td width="1%"></td>
    			<td width="40%">NAMA PELANGGAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[nama]?></td>
    		</tr>
    		<tr>
            	<td width="1%"></td>
    			<td width="40%">NOMOR OHC</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d1[ohc]?></td>
    		</tr>
    		<tr>
            	<td width="1%"></td>
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
            	<td width="1%"></td>
    			<td>NO. KTP/NO. IDENTITAS</td>
    			<td>:</td>
    			<td colspan="2"><?echo $d2[noktp]?></td>
    		</tr>
    		<tr>
            	<td width="1%"></td>
    			<td valign="top">ALAMAT</td>
    			<td valign="top">:</td>
    			<td colspan="2" valign="top"><?echo $d2[alamat]?>, RT/RW <?echo $d2[rt]?>/<?echo $d2[rw]?></td>
    		</tr>
    		<tr>
            	<td width="1%"></td>
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
    
	<?
		$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' GROUP BY nopesan"));
		$dS  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id%2=0 AND id='$dA[idsales]'"));
	?>	
	<div class="col-xs-12">
		<b>TRANSAKSI <?echo "$dA[jnstransaksi]"?></b>
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
            	<td width="1%"></td>
    			<td width="">KUANTITAS</td>
    			<td width="">:</td>
    			<td colspan="2"><?echo $dQ[total]?> UNIT</td>
    		</tr>
		<?
		if($dA[jnstransaksi]=='KREDIT')
			{
		?>
			<tr>
            	<td width="1%"></td>
    			<td width="40%">LEASING</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $d3[namaleasing]?></td>
			</tr>
			<tr>
            	<td width="1%"></td>
    			<td width="40%">MASA ANGSURAN</td>
    			<td width="2%">:</td>
    			<td colspan="2"><?echo $dA[termin]?> KALI</td>
			</tr>
		<?
			}
													
		if($dA[jnstransaksi]=='CASH TEMPO')
			{
		?>
				<tr>
            	<td width="1%"></td>
	    			<td width="40%">JENIS CASH TEMPO</td>
	    			<td width="2%">:</td>
	    			<td colspan="2"><?echo $dA[jnscashtempo]?></td>
				</tr>
		<?
	    		if($dA[jnscashtempo]=='LEASING')
	    			{
		?>
					<tr>
            	<td width="1%"></td>
		    			<td width="40%">LEASING</td>
		    			<td width="2%">:</td>
		    			<td colspan="2"><?echo $d3[namaleasing]?></td>
					</tr>
					<tr>
            	<td width="1%"></td>
		    			<td width="40%">MASA ANGSURAN</td>
		    			<td width="2%">:</td>
		    			<td colspan="2"><?echo $dA[termin]?></td>
					</tr>
		<?
					}
					
	    		else if($dA[jnscashtempo]=='MANDIRI')
	    			{
		?>
					<tr>
            	<td width="1%"></td>
		    			<td width="40%">TANGGAL PELUNASAN</td>
		    			<td width="2%">:</td>
		    			<td colspan="2"><?echo date("d-m-Y",strtotime($dA[tglpelunasan]))?></td>
					</tr>
		<?
					}
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
		$qTemp  = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'");
		
    	while($dTemp = mysql_fetch_array($qTemp))
    		{
			$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
			$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
    	?>
        	
        	<tr><td>
        	<div class="col-xs-6" style="font-size:12px">
            	<table width="80%">
            		<tr>
            			<td width="50%">KODE BARANG</td>
            			<td width="2%">:</td>
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
    
	<div class="col-xs-6" style="font-size:12px">
		<table width="100%">
    		<tr>
    			<td width="55%">UANG MUKA/TITIPAN</td>
    			<td width="2%">:</td>
    			<td colspan="1">RP. </td>
    			<td align="right"><span style="padding-right:55%"><?echo number_format($dA[utitipan],"0","",".")?></span></td>
    		</tr>
			<?
			$dCek = mysql_fetch_array(mysql_query("SELECT status FROM tbl_kwitansi WHERE id%2=0 AND nomor='$dA[nopesan]' AND jnskwitansi IN ('umuka','titip')"));
			if(empty($dCek[status])){
				$sum = "BELUM TERBAYAR";
				}
			if($dCek[status]=="1"){
				$sum = "TERBAYAR";
				}
			?>
			<tr><td style="heigt:30px"></td></tr>
    		<tr>
    			<td>STATUS UANG MUKA/TITIPAN</td>
    			<td>:</td>
    			<td width="25%"><?echo $sum?></td>
    			<td></td>
    		</tr>
<tr><td></br></td></tr>
    	</table>
    </div>
    <div class="clearfix"></div>
	<div class="col-xs-12"></div>
    <!-- ################################################################################################################# -->
    
	<div class="col-xs-6" style="font-size:12px">
		<table width="100%" style="">
    		<tr>
    			<td><b>PELANGGAN,</b></td>
    		</tr>
    		<tr>
    			<td height="80px"></td>
    		</tr>
    		<tr>
    			<td><?echo $d1[nama]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    	</table>
    </div>
    <?
    $dSC  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id%2=0 AND id='$dB[iduser]'"));
    ?>
	<div class="col-xs-6" style="font-size:12px">
		<table width="100%" style="">
    		<tr>
    			<td><b>SALES COUNTER,</b></td>
    		</tr>
    		<tr>
    			<td height="80px"></td>
    		</tr>
    		<tr>
    			<td><?echo $dSC[nama]?></td>
    		</tr>
    		<tr><td></br></td></tr>
    	</table>
    </div>

</body>