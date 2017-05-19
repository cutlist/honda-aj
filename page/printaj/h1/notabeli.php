<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "NOTABELI$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR NOTA BELI PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA BELI / NO. FAKTUR / NO. SURAT PESANAN : <?echo $_REQUEST[cari]?></h4>
			                        <table id="example3" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. FAKTUR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL FAKTUR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. SURAT PESANAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL SURAT PESANAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY BELI (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL BELI (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL BELI + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND nodo!='' AND nonota LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' OR nopo LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND nodo!='' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS qty, SUM(hargabelibersih) AS tot FROM tbl_notabeli_det WHERE nonota='$d1[nonota]'"));
											$ppn = ROUND($d2[tot] * 0.1,0);
											
											if(empty($d1[gtbayar])){
												$red = "color:#ff0227";
												}
											else{$red="";}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><?echo $d1[nodo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d2[qty],"0","",".")?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d2[tot],"0","",".")?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($ppn+$d2[tot],"0","",".")?></span></td>
			                                    
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>