<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PELANGGAN_PROSPEK.xls";
header("Content-Disposition: attachment; filename=$judul");
 
    		$periode_tahun = $_REQUEST[tahun];
    		$periode_bulan = $_REQUEST[bulan];


?>
	<h4>DAFTAR PELANGGAN PROSPEK TERPILIH PERIODE BULAN <?echo $periode_bulan?> TAHUN <?echo $periode_tahun?></h4>

    <table width="150%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SALES COUNTER/SALES</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_prospek WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dNP  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$dNS  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d1[idsales]'"));
			                            	$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notajual_det_vw WHERE idpelanggan='$d1[idpelanggan]' AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND tglsampai!='0000-00-00'"));
			                            	if(empty($dCek[id])){
			                            ?>
			                                <tr <?echo $red?>>
			                                    <td><?echo $dNP[nama]?></td>
			                                    <td><?echo $dNP[notelepon]?></td>
			                                    <td><?echo "$dNP[alamat]. KEL. $dNP[namakel], KEC. $dNP[namakec], KAB. $dNP[namakab]"?></td>
			                                    <td><?echo $dNS[nama]?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            	}
			                            ?>
			                            </tbody>
		<tfoot>
            <tr>
                <th>&nbsp;</th>
            </tr>
            <!--
        	<tr>
        		<td><b>Keterangan</b></td>
        	</tr>
        	<tr>
        		<td style="color:#ff0227">Merah</td>
        		<td >: Sudah Melakukan Pembelian Periode Ini</td>
        	</tr>
        	<tr>
        		<td>Hitam</td>
        		<td >: Belum Melakukan Pembelian Periode Ini</td>
        	</tr>
        	-->
		</tfoot>
	</table>