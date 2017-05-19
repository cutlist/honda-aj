<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KWITANSI_PIUTANG_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KWITANSI PIUTANG KARYAWAN H2H3</h4>
	<h4>CARI NAMA KARYAWAN / NO. KWITANSI : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. KWITANSI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TANGGAL KWITANSI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS CETAK KWITANSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_piutang_vw WHERE id%2=0 AND jnskwitansi IN ('piutang') AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%') AND status!='2' ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_piutang_vw WHERE id%2=0 AND jnskwitansi IN ('piutang') AND status!='2' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND id='$d1[nomor]'"));
											
											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND id='$d1[nomor]'"));
											if($dCek1[status]=="0"){
												$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
												}
											if($dCek1[status]=="1"){
												$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
												}
											
											if($d1[jnskwitansi]=="tunai"){
												$jns = "PEMBAYARAN PIUTANG TUNAI DAN POTONGAN KOMPENSASI TUNAI";
												}
											if($d1[jnskwitansi]=="piutang"){
												$jns = "PIUTANG";
												}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="center"><?echo $status2?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
		<tfoot>
            <tr>
                <th>&nbsp;</th>
            </tr>
		</tfoot>
	</table>
    <table>
    	<tr>
    		<td colspan="3"><b>Keterangan</b></td>
    	</tr>
    	<tr>
    		<td style="color:#ff0227">Merah</td>
    		<td width="15px" align="center">:</td>
    		<td>Belum Dikonfirmasi Pihak Manajemen</td>
    	</tr>
    	<tr>
    		<td>Hitam</td>
    		<td align="center">:</td>
    		<td>Sudah Dikonfirmasi Pihak Manajemen</td>
    	</tr>
    </table>