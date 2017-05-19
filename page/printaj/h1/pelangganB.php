<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PELANGGAN$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR PELANGGAN OHC PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NAMA PELANGGAN / OHC / TELEPON : <?echo $_REQUEST[cari]?></h4>
    <table width="100%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">OHC</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL KADALUARSA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND ohc!='' AND (nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%') LIMIT 0,5");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND ohc!='' ORDER BY id DESC LIMIT 0,20");
											}
										while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[kadaluarsaohc]=="0000-00-00"){
												$kadaluarsaohc = "-";
													$red = "style='cursor:pointer'";
												}
											else{
												$kadaluarsaohcX = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
												$expired_date   = $d1[kadaluarsaohc];
												list($year, $month, $day) = explode('-', $expired_date);
												$new_expired_date = sprintf('%04d%02d%02d', $year, $month, $day);
												$date_now = date("Ymd");
												if($new_expired_date > $date_now)
													{
													$kadaluarsaohc 	= $kadaluarsaohcX;
													$red = "style='cursor:pointer'";
													}
												else{
													$kadaluarsaohc 	= "$kadaluarsaohcX";
													$red = "style='color:red;cursor:pointer'";
													}
												}
			                            ?>
			                                <tr <?echo $red?>>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[ohc]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="center"><?echo $kadaluarsaohc?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo "'".$d1[notelepon]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo "$d1[alamat] KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                </tr>
			                                
			                            <?
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