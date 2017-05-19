<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "JASA_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR JASA H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI KODE JASA / NAMA JASA : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE JASA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA JASA</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_masterjasa WHERE id%2=0 AND kodejasa LIKE '%$_REQUEST[cari]%' OR namajasa LIKE '%$_REQUEST[cari]%' LIMIT 0,100");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_masterjasa ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodejasa]?></td>
			                                    <td><?echo $d1[namajasa]?></td>
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
		</tfoot>
	</table>