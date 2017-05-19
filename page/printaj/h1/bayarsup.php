<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PEMBAYARAN_KE_SUPPLIER$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR PEMBAYARAN KE SUPPLIER PERIODE TANGGAL NOTA BELI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. FAKTUR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL DO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. SURAT PESANAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY TIBA (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL TIBA (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL TIBA + PPN (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH BAYAR (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">BUNGA (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?			                            
										$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND nodo!=''");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'> Bayar</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
			                           		if($d1[bayar] < $d1[gtbayar] || empty($d1[bayar])){
												$bunga = "-";
												}
											else if($d1[bayar] >= $d1[gtbayar]){
												$bungaX = $d1[bayar]-$d1[gtbayar]-$d1[gtbayarppn];
												$bunga  = number_format($bungaX,"0","",".");
												}
											$d1A = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
											if($d1A[qty]=="0"){
												$qtytiba = "-";
												$gtbayar = "-";
												$gtbayarppn = "-";
												$bayar = "-";
												}
											else{
												$qtytiba = number_format($d1A[qty],"0","",".");
												$gtbayar = number_format($d1[gtbayar],"0","",".");
												$gtbayarppn = number_format($d1[gtbayar]+$d1[gtbayarppn],"0","",".");
												$bayar = number_format($d1[bayar],"0","",".");
												if(empty($bayar)){
													$bayar = "-";
													}
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nodo]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $qtytiba?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $gtbayar?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $gtbayarppn?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $bayar?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $bunga?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>