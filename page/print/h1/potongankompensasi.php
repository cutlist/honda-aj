<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "POTONGAN_KOMPENSASI$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR POTONGAN KOMPENSASI PERIODE TANGGAL POTONGAN KOMPENSASI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL POT. KOMPENSASI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH POTONGAN (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">METODE POTONGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS KONFIRMASI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS CETAK KWITANSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?		
			                            if(empty($_REQUEST[periode])){
											if(!empty($_REQUEST[cari])){
												$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE (nama LIKE '%$_REQUEST[cari]%' OR metodebayar LIKE '%$_REQUEST[cari]%' OR tgl LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else{
												$q1 = mysql_query("SELECT * FROM tbl_potkompensasi ORDER BY id DESC LIMIT 0,20");
												}
											}
			                            if(!empty($_REQUEST[periode])){
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											if(!empty($_REQUEST[cari])){
												$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (nama LIKE '%$_REQUEST[cari]%' OR metodebayar LIKE '%$_REQUEST[cari]%' OR tgl LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else{
												$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' ORDER BY id DESC LIMIT 0,20");
												}
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE idpotkom='$d1[id]' AND jnskwitansi='tunai'"));
			                            	if($d1[status]=="0"){
												if($dB[status]=="0" OR empty($dB[status])){
													$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
													$status2 = "";
													}
												if($dB[status]=="1"){
													$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
													$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
													}
												}
			                            	if($d1[status]=="1"){
												$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
												if(empty($dB[status])){
													$status2 = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>TIDAK PERLU CETAK</span>";
													}
												if($dB[status]=="0"){
													$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
													}
												if($dB[status]=="1"){
													$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
													}
												}
			                            	if($d1[status]=="2"){
												$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";
												$status2 = "";
												}
												/*
									    	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
									    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
									    	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
											*/
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tgl]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:15%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td><?echo $d1[metodebayar]?></td>
			                                    <td><?echo $d1[ket]?></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td align="center"><?echo $status2?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>