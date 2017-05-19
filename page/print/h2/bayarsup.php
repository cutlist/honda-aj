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
	<h4>DAFTAR PEMBAYARAN NOTA BELI KE SUPPLIER TANGGAL NOTA BELI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH + PPN (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL BAYAR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH BAYAR (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">BUNGA (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?			                            
										$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND gtbayar!='' AND dk='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "Lunas";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "Sebagian";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "Belum Bayar";
													}
			                            		}
			                           		if($d1[bayar] < $d1[gtbayar] || empty($d1[bayar])){
												$bunga = "-";
												}
											else if($d1[bayar] >= $d1[gtbayar]){
			                           			$bungaX = $d1[bayar]-$d1[gtbayar];
												$bunga  = number_format($bungaX,"0","",".");
												}
											if($d1[tglbayar]=="0000-00-00"){
												$tglbayar = "-";
												}
											else{
												$tglbayar =	date("d-m-Y",strtotime($d1[tglbayar]));
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d1[gtbayar],"0","",".")?></span></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $tglbayar?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d1[bayar],"0","",".")?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $bunga?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>