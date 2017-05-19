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

$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE nodo='$_REQUEST[nodo]'"));
$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE nonota='$d1[nonota]'"));		
						

?>

	<div class="col-xs-12" style="text-align:center">
		<h5><b>NOTA RETUR BELI</b</h5>
	</div>
	</br>
	<div class="col-xs-4">
        <table width="100%">
        	<tr>
        		<td width="60%">NO. DO SUPPLIER</td>
        		<td width="3%">:</td>
        		<td><?echo $d1[nodo]?></td>
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
        		<td width="60%">TGL DO SUPPLIER</td>
        		<td width="3%">:</td>
    			<td><?echo date("d-m-Y", strtotime($d1[tgldo]))?></td>
        	</tr>
        	<tr>
        		<td>TGL PO SUPPLIER</td>
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
	<div class="col-xs-4">
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
	        <thead style="color:#666;font-size:11px">
	            <tr>
	                <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE</th>
	                <th style="padding:7px">NAMA</th>
	                <th style="padding:7px">VARIAN</th>
	                <th style="padding:7px">NOMOR RANGKA</th>
	                <th style="padding:7px">NOMOR MESIN</th>
	                <th style="padding:7px">STATUS</th>
	                <th style="padding:7px">TGL TIBA</th>
	                <th style="padding:7px">GUDANG</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?
			$no=1;
			$q1 = mysql_query("SELECT * FROM tbl_notabeli_det_vw WHERE nonota='$d1[nonota]'");
	        while($dA = mysql_fetch_array($q1))
	        	{
	            if($dA[status]=='1'){
					$status = "ADA";
					}
				else if($dA[status]=='0'){
					$status = "-";
					}
				$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dA[norangka]'"));
				$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$dB[idgudang]'"));
	        ?>
	            <tr style="cursor:pointer;font-size:10px">
	                <td><label><?echo "$checkbox $dA[kodebarang]"?></label></td>
	                <td><?echo $dA[namabarang]?></td>
	                <td><?echo $dA[varian]?></td>
	                <td><?echo $dA[norangka]?></td>
	                <td><?echo $dA[nomesin]?></td>
	                <td><?echo $status?></td>
	                <td><?echo $dB[tgltiba]?></td>
	                <td><?echo $dC[gudang]?></td>
	            </tr>
	        <?
				$no++;
	        	}
	         ?>
	        </tbody>
	    </table>
	    <?
	    $dhelm  = mysql_fetch_array(mysql_query("SELECT helm FROM stok_helm WHERE nonota='$d1[nonota]'"));
	    $dspion = mysql_fetch_array(mysql_query("SELECT spion FROM stok_spion WHERE nonota='$d1[nonota]'"));
	    $daccu	= mysql_fetch_array(mysql_query("SELECT accu FROM stok_accu WHERE nonota='$d1[nonota]'"));
	    $dtoolkit	= mysql_fetch_array(mysql_query("SELECT toolkit FROM stok_toolkit WHERE nonota='$d1[nonota]'"));
	    $danakkunci	= mysql_fetch_array(mysql_query("SELECT anakkunci FROM stok_anakkunci WHERE nonota='$d1[nonota]'"));
	    $dalaskaki	= mysql_fetch_array(mysql_query("SELECT alaskaki FROM stok_alaskaki WHERE nonota='$d1[nonota]'"));
	    ?>
	<div style="padding:20px">
			<div class="col-xs-4">
	            <table width="100%">
	            	<tr>
	            		<td width="50%">HELM</td>
	            		<td width="3%">:</td>
	            		<td><?echo $dhelm[helm]?></td>
	            	</tr>
	            	<tr>
	            		<td>SPION</td>
	            		<td>:</td>
	            		<td><?echo $dspion[spion]?></td>
	            	</tr>
	            </table>
	        </div>
			<div class="col-xs-4">
	            <table width="100%">
	            	<tr>
	            		<td width="50%">ACCU</td>
	            		<td width="3%">:</td>
	            		<td><?echo $daccu[accu]?></td>
	            	</tr>
	            	<tr>
	            		<td>TOOLKIT</td>
	            		<td>:</td>
	            		<td><?echo $dtoolkit[toolkit]?></td>
	            	</tr>
	            </table>
	        </div>
			<div class="col-xs-4">
	            <table width="100%">
	            	<tr>
	            		<td width="50%">ANAK KUNCI 2 PCS</td>
	            		<td width="3%">:</td>
	            		<td><?echo $danakkunci[anakkunci]?></td>
	            	</tr>
	            	<tr>
	            		<td>ALAS KAKI</td>
	            		<td>:</td>
	            		<td><?echo $dalaskaki[alaskaki]?></td>
	            	</tr>
	            </table>
	        </div>
	    </div>
	    <div class="clearfix"></div>
	    <div style="border-bottom:1px #aaa dashed;margin: 10px 0 -10px"></div>
	    
	    <?
	    $dR = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE nodo='$_REQUEST[nodo]'"));
	    ?>
		<div style="padding:20px;">
	    	<table width="70%">
	    		<tr>
	    			<td width="30%">TANGGAL RETUR</td>
	    			<td width="2%">:</td>
	    			<td><?echo tgl_indo($dR[tanggal])?></td>
	    		</tr>
	    		<tr>
	    			<td colspan="3"><h5><b>BARANG YANG DIRETUR</b></h5></td>
	    		</tr>
	    		<?
	    		if(!empty($dR[helm]))
	    		{
	    		?>
	        	<tr>
	        		<td>HELM</td>
	        		<td >:</td>
	        		<td><?echo $dR[helm]?></td>
	        	</tr>
	    		<?
	    		}
	    		if(!empty($dR[spion]))
	    		{
	    		?>
	        	<tr>
	        		<td>SPION</td>
	        		<td>:</td>
	        		<td><?echo $dR[spion]?></td>
	        	</tr>
	    		<?
	    		}
	    		if(!empty($dR[accu]))
	    		{
	    		?>
	        	<tr>
	        		<td>ACCU</td>
	        		<td>:</td>
	        		<td><?echo $dR[accu]?></td>
	        	</tr>
	    		<?
	    		}
	    		if(!empty($dR[toolkit]))
	    		{
	    		?>
	        	<tr>
	        		<td>TOOLKIT</td>
	        		<td>:</td>
	        		<td><?echo $dR[toolkit]?></td>
	        	</tr>
	    		<?
	    		}
	    		if(!empty($dR[alaskaki]))
	    		{
	    		?>
	        	<tr>
	        		<td>ALAS KAKI</td>
	        		<td>:</td>
	        		<td><?echo $dR[alaskaki]?></td>
	        	</tr>
	        	<?
	        	}
	        	?>
	    		<tr>
	    			<td valign="top" >KETERANGAN</td>
	    			<td valign="top" >:</td>
	    			<td valign="top" colspan="2"><?echo $dR[keterangan]?></td>
	    		</tr>
	    	</table>
	    </div>
	</div>
</body>