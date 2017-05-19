<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "NOTA_RETUR$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>NOTA RETUR BELI PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA  RETUR BELI / NO. NOTA BELI / NAMA SUPPLIER : <?echo $_REQUEST[cari]?></h4>
    <table>
        <thead>
			<tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA RETUR BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>POTONG BAYAR NOTA BELI (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;"><center>SISA (RP)</center></th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;" style="width: 400px">STATUS</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notaretur_vw WHERE id%2=0 AND (nonota LIKE '%$_REQUEST[cari]%' OR noretur LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notaretur_vw WHERE id%2=0 ORDER BY id DESC LIMIT 0,20");
											}
										while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[status]=="2"){$status = "SEBAGIAN NILAI RETUR BELI MEMOTONG NOTA BELI";}
			                            	if($d1[status]=="1"){$status = "SEMUA NILAI RETUR BELI SUDAH MEMOTONG NOTA BELI";}
			                            	if($d1[status]=="0"){$status = "NILAI RETUR BELI BELUM MEMOTONG NOTA BELI";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[noretur]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[potong],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[sisa],"0","",".")?></span></td>
			                                    <td><?echo $status?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>