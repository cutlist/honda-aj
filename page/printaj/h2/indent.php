<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "INDENT_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR INDENT H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA INDENT / NAMA PELANGGAN : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA INDENT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA INDENT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY INDENT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL UANG MUKA (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_indent_vw WHERE id%2=0 AND (nama LIKE '%$_REQUEST[cari]%' OR noindent LIKE '%$_REQUEST[cari]%' OR tglindent LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_indent_vw WHERE id%2=0 AND status='0' ORDER BY id DESC LIMIT 0,20");
											}
											
										while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[status]=='0'){
				                            	$d2 = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE id%2=0 AND idbarang IN (SELECT idbarang FROM x23_indent_det WHERE id%2=0 AND noindent='$d1[noindent]') GROUP BY idbarang"));
				                            	if($d2[stok]<$d1[totalqty]){
													$status = "<span class='label label-warning'>MENUNGGU</span>";
													}
												else{
													$status = "<span class='label label-success'>ADA</span>";
													}
												}
											if($d1[status]=='1'){
												$status = "<span class='label label-info'>SELESAI</span>";
												}
												
											$d3 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS jumlah FROM x23_kwitansi WHERE id%2=0 AND jnskwitansi='indent' AND nomor='$d1[noindent]' AND status='1'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT status FROM x23_kwitansi WHERE id%2=0 AND jnskwitansi='penjualan' AND nomor='$d1[notajual]'"));
											if(!empty($d1[notajual]))
												{
												if($d4[status]=="1")
													{
				                        ?>
					                                <tr style="cursor:pointer">
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[noindent]?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglindent]))?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo "'".$d1[notelepon]?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty])?> PCS</span></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:30%"><?echo number_format($d3[jumlah])?></span></td>
					                                    <!--
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d2[stok])?> PCS</span></td>
					                                    -->
					                                    <td align="center"><?echo $status?></td>
					                                    <td align="center">
															<?
															if($d1[status]=='0'){
															?>
						                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[noindent]"?>">
							                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
							                                    		<i class="fa fa-trash-o"></i>
							                                    	</button>
						                                    	</a>
															<?}?>
					                                     </td>
					                                </tr>
			                            <?
													}
												}
											else{
				                        ?>
				                                <tr style="cursor:pointer">
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[noindent]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglindent]))?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo "'".$d1[notelepon]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty])?> PCS</span></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:30%"><?echo number_format($d3[jumlah])?></span></td>
				                                    <!--
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d2[stok])?> PCS</span></td>
				                                    -->
				                                    <td align="center"><?echo $status?></td>
				                                    <td align="center">
														<?
														if($d1[status]=='0'){
														?>
					                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[noindent]"?>">
						                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
						                                    		<i class="fa fa-trash-o"></i>
						                                    	</button>
					                                    	</a>
														<?}?>
				                                     </td>
				                                </tr>
			                            <?
												}
			                            	}
			                            ?>
			                            </tbody>
		<tfoot>
            <tr>
                <th>&nbsp;</th>
            </tr>
		</tfoot>
	</table>