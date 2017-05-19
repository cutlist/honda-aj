<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "NOTA_BELI$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR NOTA BELI PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA BELI / NO. PO / TGL NOTA / NAMA SUPPLIER : <?echo $_REQUEST[cari]?></h4>
    <table>
        <thead>
			<tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL PO</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH + PPN (RP)</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE jns='PEMBELIAN' AND (nonota LIKE '%$_REQUEST[cari]%' OR nopo LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE jns='PEMBELIAN' ORDER BY id DESC LIMIT 0,20");
											}
											
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE nonota='$d1[nonota]'"));
			                            	$db = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nopo]?></td>
			                                    <td><?echo $d1[tglpo]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotalppn],"0","",".")?></span></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>