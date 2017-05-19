<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "TUTUP_HARIAN_H2H3.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>TUTUP HARIAN H2H3 PERIODE TANGGAL TUTUP HARIAN <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
    <table>
        <thead>
			<tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL TUTUP HARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENERIMAAN JASA + PPN (TIDAK TERMASUK KPB) (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL KPB (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENERIMAAN JASA + PPN (TERMASUK KPB) (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENGELUARAN H2H3 (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL NOTA KECIL (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENJUALAN S. PART (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENJUALAN S. PART MPM (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PEMBULATAN (SERVIS DAN PENJUALAN) (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL BIAYA HO (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL UANG MUKA INDENT (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PELUNASAN (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENGEMBALIAN KELEBIHAN BAYAR (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH + PPN (RP)</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                            <?
											$q1 = mysql_query("SELECT * FROM x23_tutupharian WHERE id%2=0 AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="right"><?echo number_format($d1[penerimaan]-$d1[kpb],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[kpb],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[penerimaan],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[pengeluaran],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[notakecil],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[pjs],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[pjmpm],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[pembulatan],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[ho],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[um],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[pelunasan],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[pengembalian],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[jumlah],"0","",".")?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>