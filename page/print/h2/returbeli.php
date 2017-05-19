<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RETUR_BELI$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>RETUR BELI PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA RETUR BELI / NO. PO / NAMA SUPPLIER : <?echo $_REQUEST[cari]?></h4>
    <table>
        <thead>
			<tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH RETUR BELI (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY KELUAR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH KELUAR (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STOK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_returbeli_vw WHERE (nopo LIKE '%$_REQUEST[cari]%' OR noretur LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_returbeli_vw ORDER BY id DESC LIMIT 0,20");
											}
											
										while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS totqty,SUM(total) AS totjum,SUM(qtykeluar) AS totqty2,SUM(totalkeluar) AS totjum2 FROM x23_returbeli_det
											                                     WHERE noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));
																				 
											if($d1[status]=="3"){$status = "Ditolak";}
			                            	if($d1[status]=="2"){$status = "Disetujui";}
			                            	if($d1[status]=="1"){$status = "Belum Dikonfirmasi Pimpinan";}
			                            	if($d1[status]=="0"){$status = "Belum Dikonfirmasi Gudang";}
											if(empty($d2[totqty2])){
												$totqty2 = "-";
												}
											else{
												$totqty2 = number_format($d2[totqty2],"0","",".");
												}
											if(empty($d2[totjum2])){
												$totjum2 = "-";
												}
											else{
												$totjum2 = number_format($d2[totjum2],"0","",".");
												}
											$dB = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS tstok FROM x23_stokpart WHERE nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[noretur]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="center"><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center"><?echo $d1[nopo]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align=""><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totqty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totjum],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totqty2?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totjum2?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dB[tstok],"0","",".")?> PCS</span></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>