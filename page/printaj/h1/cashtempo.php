<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "CASH_TEMPO$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR CASH TEMPO DEALER PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA JUAL / NAMA PELANGGAN / TGL NOTA JUAL : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SALES</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY JUAL (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">SISA PEMBAYARAN (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL JATUH TEMPO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL PELUNASAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if($_SESSION[posisi]=='DIREKSI')
											{
											if(!empty($_REQUEST[cari]))
												{
												$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER' AND (nama LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else
												{
												$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER' AND tglpelunasan='0000-00-00' ORDER BY id DESC LIMIT 0,20");
												}
											}
										else if($_SESSION[posisi]=='SALES COUNTER' OR $_SESSION[posisi]=='PIC')
											{
											if(!empty($_REQUEST[cari]))
												{
												$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER' AND (nama LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else
												{
												$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER' AND tglpelunasan='0000-00-00' ORDER BY id DESC LIMIT 0,20");
												}
											}
			                            else if($_SESSION[posisi]=='SALES')
			                            	{
											if(!empty($_REQUEST[cari]))
												{
												$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND idsales='$_SESSION[id]' AND jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER' AND (nama LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else
												{
												$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND idsales='$_SESSION[id]' AND jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER' AND tglpelunasan='0000-00-00' ORDER BY id DESC LIMIT 0,20");
												}
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id%2=0 AND id='$d1[idsales]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$d1[nopesan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$d1[idleasing]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE id%2=0 AND nopesan='$d1[nopesan]'"));
											/*
											if($d1[sisabayar] >= "0"){
												$red = "color:red";
												$tglpelunasan = "-";
												}
											else{
												$red = "";
												$dCk = mysql_fetch_array(mysql_query("SELECT * FROM tbl_history_bcashtempo WHERE id%2=0 AND nonota='$d1[nonota]' ORDER BY id DESC LIMIT 0,1 "));
												$tglpelunasan = date("d-m-Y",strtotime($dCk[tanggal]));
												}
											*/
											if($d1[tglpelunasan] == "0000-00-00"){
												$red = "color:red";
												$tglpelunasan = "-";
												}
											else{
												$red = "";
												$dCk = mysql_fetch_array(mysql_query("SELECT * FROM tbl_history_bcashtempo WHERE id%2=0 AND nonota='$d1[nonota]' ORDER BY id DESC LIMIT 0,1 "));
												$tglpelunasan = date("d-m-Y",strtotime($dCk[tanggal]));
												}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $d3[qty]?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[sisabayar],"0","",".")?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d5[tglpelunasan]))?></td>
			                                    <td align="center"><?echo $tglpelunasan?></td>
			                                </tr>
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
		<tfoot>
            <tr>
                <th>&nbsp;</th>
            </tr>
			<!--
			<tr>
				<td colspan="2"><b><span style="margin-left:10%">TOTAL</b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gtp[grandtotal])?></b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gto[grandtotal])?></b></span></td>
			</tr>
			-->
		</tfoot>
	</table>