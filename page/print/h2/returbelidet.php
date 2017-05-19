<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "DETAIL_RETUR_BELI.xls";
header("Content-Disposition: attachment; filename=$judul");
 

		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_vw WHERE id='$_REQUEST[id]'"));  
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_returbeli_det WHERE noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));   
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_supplier WHERE id='$d1[idsupplier]'"));
		   
		if($d1[status]=="3"){$status = "Ditolak";}
    	if($d1[status]=="2"){$status = "Disetujui";}
    	if($d1[status]=="1"){$status = "Belum Dikonfirmasi Pihak Manajemen";}
    	if($d1[status]=="0"){$status = "Belum Dikonfirmasi Gudang";}
		
?>
	<h4>RETUR BELI H2H3<br>
	NAMA SUPPLIER : <?echo $d3[nama]?><br>
	NO. PO SUPPLIER : <?echo $d1[nopo]?><br>
	NO. NOTA BELI : <?echo $d1[nonota]?><br>
	TGL RETUR BELI : <?echo date("d-m-Y",strtotime($d1[tanggal]))?><br>
	QTY RETUR BELI (PCS) : <?echo number_format($d2[total])?><br>
	STATUS : <?echo $status?></h4>
    <table>
        <thead>
			<tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>QTY BELI</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>HARGA BELI (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>JUMLAH BELI (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GUDANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">RAK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STOK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>QTY RETUR BELI</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>QTY KELUAR</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>JUMLAH KELUAR (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>KETERANGAN</center></th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE noretur='$d1[noretur]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]'"));
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]' AND nonota='$d1[nonota]'"));
				                           	if(empty($d2[totqty2])){
													$totqty2 = "-";
													}
												else{
													$totqty2 = number_format($d2[totqty2],"0","",".");
													}	
											if(empty($d1[totalkeluar])){
													$totalkeluar = "-";
													}
												else{
													$totalkeluar = number_format($d1[totalkeluar],"0","",".");
													}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo "$d1[namabarang]"?></td>
			                                    <td><?echo "$d1[varian]"?></td>
			                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td><?echo $d1[gudang]?></td>
			                                    <td><?echo $d1[rak]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($dB[stok],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totqty2?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totalkeluar?></span></td>
			                                    <td align="center"><?echo $d1[ket]?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>