<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PEMBAYARAN_LEMBUR.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR PEMBAYARAN UANG LEMBUR <?echo "BULAN $_REQUEST[bulan] TAHUN $_REQUEST[tahun]"?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">POSISI</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL LEMBUR</th>
													<th style="height:45px;background:#37A58A;color:#fff;">UANG LEMBUR (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?			   
										
											$q1 = mysql_query("SELECT * FROM x23_lembur_vw WHERE id%2=0 AND bulan='$_REQUEST[bulan]' AND tahun='$_REQUEST[tahun]' AND idkaryawan IN (SELECT id FROM x23_karyawan WHERE id%2=0 AND status='AKTIF')");
									
											while($d1 = mysql_fetch_array($q1))
												{
												$d2	= mysql_fetch_array(mysql_query("SELECT id FROM tbl_uanglembur WHERE id%2=0 AND idkaryawan='$d1[idkaryawan]' AND tanggal='$d1[tanggal]'"));
												if($d1[ulembur]!='0'){
													if(empty($d2[id])){
														$status = "<a data-toggle='modal' data-target='#compose-modal-sts$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Dibayar</span></a>";
														}
													else{
														$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'> Dibayar</span>";
														}
													}
												else{
													$status = "";
													}
											?>
												<tr style="cursor:pointer">
													<td align=""><?echo $d1[nama]?></td>
													<td align=""><?echo $d1[posisi]?></td>
													<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
													<td align="right"><span style="margin-right:30%"><?echo number_format($d1[ulembur],"0","",".")?></span></td>
													<td align="center"><?echo $status?></td>
		                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>