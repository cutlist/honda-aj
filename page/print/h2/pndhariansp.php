<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
if(empty($_REQUEST[periode])){
            $periode_awal  = date("Y-m-d");
            $periode_akhir = date("Y-m-d");
}
else{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
}
$judul = "PENDAPATAN_HARIAN_PERIODE_$periode.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
<h4>PENDAPATAN HARIAN PENJUALAN BARANG PERIODE TANGGAL NOTA JUAL <?echo date("d-m-Y",strtotime($periode_awal))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($periode_akhir))?></h4>
			                        <table id="example2" class="table table-bordered table-striped" style="width:130%">
										<thead>
											<tr>
												<th style="height:45px;background:#37A58A;color:#fff;">NO.</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="height:45px;background:#37A58A;color:#fff;">BARANG</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">HARGA JUAL (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">QTY JUAL (PCS)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">DISKON/PCS (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH JUAL (RP)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
			                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            $no=1;
										if(empty($_REQUEST[periode]))
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE tglnota=CURDATE() AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')");
											$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																					SUM(diskon) AS b,
																					SUM(total) AS c
																				FROM x23_notajual_det WHERE tglnota=CURDATE() AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')"));
											}
										else
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')");
											$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																					SUM(diskon) AS b,
																					SUM(total) AS c
																				FROM x23_notajual_det WHERE tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')"));
			                            	}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{			
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[notabeli]'"));								
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right:20%"><?echo "$no."?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?echo $d1[kodebarang]?></td>
			                                    <td align=""><?echo "$d1[namabarang] | $d1[varian]"?></td>
			                                    <td align=""><?echo $d1[notabeli]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="19"></th>
			                                </tr>
			                                <tr>
			                                    <td colspan="6" style="text-align:center;font-weight:bold">TOTAL (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[a],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[b],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[c],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>