<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PINDAH_LOKASI_BULAN_$_REQUEST[bulan]_TAHUN_$_REQUEST[tahun].xls";
header("Content-Disposition: attachment; filename=$judul");
 

		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_pindah WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$g1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang1]'"));
		$g2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang2]'"));

?>
	<h4>PINDAH LOKASI H2H3 BULAN <?echo $_REQUEST[bulan]?> TAHUN <?echo $_REQUEST[tahun]?><br></h4>
    <table>
        <thead>
			<tr>
			                                    <th style="background:#37A58A;color:#fff;">TGL PINDAH LOKASI</th>
			                                    <th style="background:#37A58A;color:#fff;">GUDANG/RAK ASAL</th>
			                                    <th style="background:#37A58A;color:#fff;">GUDANG/RAK TUJUAN</th>
			                                    <th style="background:#37A58A;color:#fff;">STATUS</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
		<tbody>
<?
			
		$q1 = mysql_query("SELECT * FROM x23_pindah WHERE id%2=0 AND bulan='$_REQUEST[bulan]' AND tahun='$_REQUEST[tahun]'");
        while($d1 = mysql_fetch_array($q1))
        	{
        	$dG1 = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang1]'"));
        	$dG2 = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang2]'"));
        	$dT  = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM x23_pindah_det WHERE id%2=0 AND idpindah='$d1[id]'"));
        
    
		if($d1[status]=="2"){$status = "Ditolak";}
    	if($d1[status]=="1"){$status = "Disetujui";}
    	if($d1[status]=="0"){$status = "Belum Dikonfirmasi Pihak Manajemen";}
        ?>
            <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
                <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
                <td><?echo "$dG1[gudang] | $d1[rak1]"?></td>
                <td><?echo "$dG2[gudang] | $d1[rak2]"?></td>
                <td><?echo $status?></td>
            </tr>
<?
		}
?>
        </tbody>
    </table>