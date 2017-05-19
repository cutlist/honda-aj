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

$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND nokwitansi='$_REQUEST[nokwitansi]'"));			                           
$d2 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS hargaoli FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]'"));	
$d3 = mysql_fetch_array(mysql_query("SELECT nama,posisi FROM x23_user_vw WHERE id%2=0 AND id='$dA[iduserbeli]'"));

?>

	<div class="col-xs-12" style="text-align:left">
		<table style="font-size: 16px;width: 100%">
			<tr>
				<td width="30%">NOMOR KWITANSI CLAIM OLI</td>
				<td width="3%"><b>:</b></td>
				<td><b><?echo $_REQUEST[nokwitansi]?></b></td>
			</tr>
			<tr>
				<td>SUDAH DITERIMA DARI</td>
				<td><b>:</b></td>
				<td><b>PT. MITRA PINASTHIKA MULIA</b></td>
			</tr>
			<tr>
				<td>BANYAKNYA UANG</td>
				<td><b>:</b></td>
				<td><b>
					<?
					if($d2[hargaoli]!="0"){echo Terbilang($d2[hargaoli])." RUPIAH";}
					else{echo "NOL RUPIAH";}
					?></b></td>
			</tr>
			<tr><td height="20px"></td></tr>
			<tr>
				<td width="30%">TANGGAL PENAGIHAN</td>
				<td width="3%"><b>:</b></td>
				<td><b><?echo tgl_indo(date("Y-m-d",strtotime($dA[tglnota])))?></b></td>
			</tr>
			<tr>
				<td>UNTUK PEMBAYARAN</td>
				<td><b>:</b></td>
				<td><b>OLI KARTU PERAWATAN BERKALA</b></td>
			</tr>
			<tr><td height="20px"></td></tr>
		</table>
	</div>
	</br>
	
    <div class="col-xs-12">
    	<table id="example2" class="table table-bordered table-striped" style="width:100%">
			<thead>
				<tr>
					<th></th>
					<th width="16.5%">KPB I</th>
					<th width="16.5%">KPB II</th>
					<th width="16.5%">KPB III</th>
					<th width="16.5%">KPB IV</th>
					<th width="16.5%">TOTAL</th>
				</tr>
			</thead>
			<?
			$dA1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='1'"));
			$dA2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='2'"));
			$dA3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='3'"));
			$dA4 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='4'"));
			
			$dB1 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS rp FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='1'"));
			$dB2 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS rp FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='2'"));
			$dB3 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS rp FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='3'"));
			$dB4 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS rp FROM x23_notabeli_claim_det WHERE id%2=0 AND nonota='$dA[nonota]' AND kpbke='4'"));
			
			if(empty($dB1[rp])){$rp1 = "0";}
			else{$rp1 = $dB1[rp];}
			if(empty($dB2[rp])){$rp2 = "0";}
			else{$rp2 = $dB2[rp];}
			if(empty($dB3[rp])){$rp3 = "0";}
			else{$rp3 = $dB3[rp];}
			if(empty($dB4[rp])){$rp4 = "0";}
			else{$rp4 = $dB4[rp];}
			?>
            <tbody>
                <tr style="cursor:pointer">
                	<td align="center"><b>JUMLAH (QTY)</b></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format("$dA1[qty]","0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format("$dA2[qty]","0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format("$dA3[qty]","0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format("$dA4[qty]","0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format(($dA1[qty]+$dA2[qty]+$dA3[qty]+$dA4[qty]),"0","",".")?></span></td>
                </tr>
                <tr style="cursor:pointer">
                	<td align="center"><b>JUMLAH (RP)</b></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format($rp1,"0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format($rp2,"0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format($rp3,"0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format($rp4,"0","",".")?></span></td>
            		<td align="right"><span style="padding-right:20%"><?echo number_format(($rp1+$rp2+$rp3+$rp4),"0","",".")?></span></td>
                </tr>
            </tbody>
        </table>
        
		<table style="font-size: 16px;width: 100%">
			<tr>
				<td width="10%">TERBILANG</td>
				<td width="3%"><b>:</b></td>
				<td width="6%"><b>RP.</b></td>
				<td><b><?echo number_format($d2[hargaoli],"0","",".")?></b></td>
			</tr>
			<tr><td height="20px"></td></tr>
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