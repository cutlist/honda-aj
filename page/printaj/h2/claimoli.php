<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PENAGIHAN_OLI_KE_MPM.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>PENAGIHAN OLI KE MPM PERIODE TANGGAL NOTA CLAIM OLI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
	<table>
        <thead>
			<tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. KWITANSI CLAIM OLI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA CLAIM OLI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA CLAIM OLI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. PO CLAIM MPM</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL PO CLAIM MPM</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY CLAIM</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nopo]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
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