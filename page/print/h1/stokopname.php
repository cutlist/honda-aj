<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_opname WHERE id='$_REQUEST[id]'"));
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd",strtotime($d1[tanggal]));
$judul = "STOK_OPNAME.xls";
header("Content-Disposition: attachment; filename=$judul");
 
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_opname WHERE id='$_REQUEST[id]'"));
$dGudang = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$d1[idgudang]'"));

if(empty($dGudang[gudang])){
	$gudang = "SEMUA LOKASI";
}else{
	
	$gudang = $dGudang[gudang];
}
?>
	
	<h4>STOK OPNAME</h4>
	<h4>TANGGAL STOK OPNAME <?echo $d1[tanggal]?></h4>
	<h4>LOKASI : <?echo $gudang?></h4>
					                            <?
												if(empty($d1[idgudang]))
													{
												?>
					                        <table class="table table-striped" id="example2">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR RANGKA</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR MESIN</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">GUDANG</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
												<?
													$qA = mysql_query("SELECT * FROM tbl_opname_det WHERE idopname='$d1[id]'");
						                            while($dA = mysql_fetch_array($qA))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$dA[norangka]'"));
						                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $d2[norangka]?></td>
						                                    <td><?echo $d2[nomesin]?></td>
						                                    <td><?echo $d2[kodebarang]?></td>
						                                    <td><?echo $d2[namabarang]?></td>
						                                    <td><?echo $d2[varian]?></td>
						                                    <td><?echo $d2[warna]?></td>
						                                    <td><?echo $d2[gudang]?></td>
						                                    <td><?echo $dA[keterangan]?></td>
						                                    
						                                </tr>
						                            <?
						                            	}
													$qB = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE status='STOK'");
						                            while($dB = mysql_fetch_array($qB))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$dB[norangka]'"));
						                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dB[norangka]?></td>
						                                    <td><?echo $dB[nomesin]?></td>
						                                    <td><?echo $dB[kodebarang]?></td>
						                                    <td><?echo $dB[namabarang]?></td>
						                                    <td><?echo $dB[varian]?></td>
						                                    <td><?echo $dB[warna]?></td>
						                                    <td><?echo $d2[gudang]?></td>
						                                    <td>ADA</td>
						                                    
						                                </tr>
						                            <?
						                            	}
						                            ?>
					                            </tbody>
					                        </table>
												<?
													}
												else
													{
												?>
					                        <table class="table table-striped" id="example2">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR RANGKA</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR MESIN</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">BARANG</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
					                                    <th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
												<?
													$qA = mysql_query("SELECT * FROM tbl_opname_det WHERE idopname='$d1[id]'");
						                            while($dA = mysql_fetch_array($qA))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$dA[norangka]'"));
						                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $d2[norangka]?></td>
						                                    <td><?echo $d2[nomesin]?></td>
						                                    <td><?echo $d2[kodebarang]?></td>
						                                    <td><?echo $d2[namabarang]?></td>
						                                    <td><?echo $d2[varian]?></td>
						                                    <td><?echo $d2[warna]?></td>
						                                    <td><?echo $dA[keterangan]?></td>
						                                    
						                                </tr>
						                            <?
						                            	}
													$qB = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE status='STOK' AND idgudang='$d1[idgudang]'");
						                            while($dB = mysql_fetch_array($qB))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$dB[norangka]'"));
						                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dB[norangka]?></td>
						                                    <td><?echo $dB[nomesin]?></td>
						                                    <td><?echo $dB[kodebarang]?></td>
						                                    <td><?echo $dB[namabarang]?></td>
						                                    <td><?echo $dB[varian]?></td>
						                                    <td><?echo $dB[warna]?></td>
						                                    <td>ADA</td>
						                                    
						                                </tr>
						                            <?
						                            	}
						                            ?>
					                            </tbody>
					                        </table>
												<?
													}
												?>
				                        