<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "OPNAME$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
    <table>
        <thead>
            <tr>
                <th style="height:45px;background:#37A58A;color:#fff;">NO.</th>
                <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">KUANTITAS (PCS)</th>
            </tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
		<tbody style="cursor:pointer">
        <?
		$no=1;
		$q1 = mysql_query("SELECT scan,COUNT(scan) AS qty FROM _tools GROUP BY scan");
        while($d1 = mysql_fetch_array($q1))
        	{
        ?>
            <tr style="cursor:pointer">
                <td align="right"><?echo $no?>.</td>
                <td><?echo $d1[scan]?></td>
			    <td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
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
			<!--
			<tr>
				<td colspan="2"><b><span style="margin-left:10%">TOTAL</b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gtp[grandtotal])?></b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gto[grandtotal])?></b></span></td>
			</tr>
			-->
		</tfoot>
	</table>