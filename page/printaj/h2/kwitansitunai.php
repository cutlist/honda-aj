<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KWITANSI_PEMBAYARAN_PIUTANG_TUNAI_DAN_POTONGAN_KOMPENSASI_TUNAI_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KWITANSI PEMBAYARAN PIUTANG TUNAI & POTONGAN KOMPENSASI TUNAI H2H3</h4>
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
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_tunai_vw WHERE id%2=0 AND jnskwitansi IN ('tunai') AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%') AND status!='2' ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_tunai_vw WHERE id%2=0 AND jnskwitansi IN ('tunai') AND status!='2' ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{

											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_potkompensasi WHERE id%2=0 AND id='$d1[idpotkom]'"));
											if($d1[cetak]=="0"){
												$status2 = "BELUM CETAK";
												}
											if($d1[cetak]=="1"){
												$status2 = "SUDAH CETAK";
												}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="center"><?echo $status2?></td>
			                                </tr>
			                            <?
											$no++;
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