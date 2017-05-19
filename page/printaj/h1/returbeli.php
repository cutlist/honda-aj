<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RETURBELI$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR RETUR BELI PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA RETUR BELI / NO. FAKTUR : <?echo $_REQUEST[cari]?></h4>
	
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. FAKTUR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_returbeli WHERE id%2=0 AND noretur LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_returbeli ORDER BY id DESC LIMIT 0,20");
											}
											
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$qty = $d1[helm]+$d1[spion]+$d1[alaskaki]+$d1[toolkit]+$d1[accu];
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[noretur]?></td>
			                                    <td align="center"><?echo $d1[nodo]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($qty,"0","",".")?> PCS</span></td>
			                                    <td><?echo $d1[keterangan]?></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>