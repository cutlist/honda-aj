<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "DAFTAR_STOK_OPNAME$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR STOK OPNAME H1 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI BULAN / TAHUN : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TANGGAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">LOKASI GUDANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STOK (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">SCAN (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">SISA (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_opname WHERE bulan LIKE '%$_REQUEST[cari]%' OR tahun LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_opname ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dG = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$d1[idgudang]'"));
			                            	if(empty($dG[gudang])){
												$lokasi = "SEMUA GUDANG";
												}
											else{
												$lokasi = $dG[gudang];
												}
			                            	if($d1[status]=="0"){$status = "MENUNGGU";}
			                            	if($d1[status]=="1"){$status = "DISETUJUI";}
			                            	if($d1[status]=="2"){$status = "DITOLAK";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $lokasi?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[stok]?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[scan]?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[sisa]?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
			                                    -->
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>