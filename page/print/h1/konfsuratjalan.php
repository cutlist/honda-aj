<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KONFIRMASI_SURAT_JALAN$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KONFIRMASI SURAT JALAN PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA JUAL / NO. SURAT JALAN / TGL NOTA JUAL : <?echo $_REQUEST[cari]?></h4>
				                    <table id="example2" class="table table-striped table-bordered table-hover" style="min-width:250%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. SURAT JALAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL SAMPAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JAM SAMPAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR RANGKA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR MESIN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SALES</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PDI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											//$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE updatex!='' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE penyerahan='KIRIM' AND status='0' AND (nonota LIKE '%$_REQUEST[cari]%' OR nosj LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%'))");
											$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE tglsampai!='0000-00-00' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE penyerahan='KIRIM' AND status='0' AND (nonota LIKE '%$_REQUEST[cari]%' OR nosj LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%'))");
											}
										else
											{
											//$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE updatex!='' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE penyerahan='KIRIM' AND status='0') ORDER BY tglsampai DESC LIMIT 0,20");
											$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE tglsampai!='0000-00-00' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE penyerahan='KIRIM' AND status='0') ORDER BY tglsampai DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nonota='$d1[nonota]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d2[idpelanggan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d2[iduser]'"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d2[iduserpdi]'"));
											$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$d1[norangka]'"));
											$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                	<td><?echo $d8[nosj]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglsampai]))?></td>
			                                    <td><?echo date("H:i:s",strtotime($d1[jamsampai]))?></td>
			                                    <td><?echo $d3[nama]?></td>
			                                    <td><?echo $d3[alamat]?></td>
			                                    <td><?echo $d3[notelepon]?></td>
			                                    <td><?echo $d7[norangka]?></td>
			                                    <td><?echo $d7[nomesin]?></td>
			                                    <td><?echo $d4[kodebarang]?></td>
			                                    <td><?echo $d4[namabarang]?></td>
			                                    <td><?echo $d4[varian]?></td>
			                                    <td><?echo $d4[warna]?></td>
			                                    <td><?echo $d5[nama]?></td>
			                                    <td><?echo $d6[nama]?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>