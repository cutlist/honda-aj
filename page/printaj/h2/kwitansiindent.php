<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KWITANSI_INDENT_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KWITANSI INDENT H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NAMA PELANGGAN / NO. NOTA INDENT / NO. KWITANSI : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. KWITANSI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA INDENT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA INDENT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY INDENT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH UANG MUKA INDENT (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH HO (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND jnskwitansi='indent' AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%' OR nomor LIKE '%$_REQUEST[cari]%') ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND jnskwitansi='indent' ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d3 = mysql_fetch_array(mysql_query("SELECT totalqty FROM x23_indent WHERE id%2=0 AND noindent='$d1[nomor]'"));

											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											if(!empty($d3[notajual]))
												{
												$d4 = mysql_fetch_array(mysql_query("SELECT status FROM x23_kwitansi WHERE id%2=0 AND jnskwitansi='penjualan' AND nomor='$d3[notajual]'"));
												if($d4[status]=="1")
													{
			                            ?>
				                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
				                                    <td><?echo $d1[nokwitansi]?></td>
				                                    <td><?echo $d1[nomor]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
				                                    <td><?echo $d1[nama]?></td>
				                                    <td align="right"><span style="padding-right:10%"><?echo number_format($d3[totalqty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlahho],"0","",".")?></span></td>
				                                </tr>
			                            <?
													}
												}
											else
												{
			                            ?>
				                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
				                                    <td><?echo $d1[nokwitansi]?></td>
				                                    <td><?echo $d1[nomor]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
				                                    <td><?echo $d1[nama]?></td>
				                                    <td align="right"><span style="padding-right:10%"><?echo number_format($d3[totalqty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlahho],"0","",".")?></span></td>
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