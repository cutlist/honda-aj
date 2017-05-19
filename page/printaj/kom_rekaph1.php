<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


$periode_tahun = $_REQUEST[tahun];
$periode_bulan = $_REQUEST[bulan];

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "REKAPITULASI_KOMPENSASI_".$periode_bulan."_".$periode_tahun.".xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>REKAPITULASI KOMPENSASI <?echo "BULAN $periode_bulan TAHUN $periode_tahun"?></h4>
        <table>
			<thead>
				<tr>
					<th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
					<th style="height:45px;background:#37A58A;color:#fff;">POSISI</th>
					<th style="height:45px;background:#37A58A;color:#fff;">GAJI POKOK (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">UANG HARIAN (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">KOMISI (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">TAMBAHAN (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">POTONGAN (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
				</tr>
			</thead>
            <tbody>
<?
			$q2	 = mysql_query("SELECT * FROM tbl_kompensasi WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND idkaryawan IN (SELECT id FROM tbl_karyawan WHERE id%2=0 AND status='AKTIF')");
			while($d2  = mysql_fetch_array($q2))
				{
            	if($d2[status]=="1"){$status = "Lunas";}
            	if($d2[status]=="0"){$status = "Belum Bayar";}
				
				echo"
					<tr> 
						<td>$d2[nama]</td>
						<td>$d2[posisi]</td>
						<td align='right'>".number_format($d2[ugapok],"0","",".")."</td> 
						<td align='right'>".number_format($d2[uharian],"0","",".")."</td> 
						<td align='right'>".number_format($d2[uinsentif],"0","",".")."</td> 
						<td align='right'>".number_format($d2[utambahan],"0","",".")."</td> 
						<td align='right'>".number_format($d2[upotongan],"0","",".")."</td> 
						<td align='center'>$status</td>
					</tr>";
				}
			?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10">&nbsp;</th>
                </tr>
            </tfoot>
        </table>