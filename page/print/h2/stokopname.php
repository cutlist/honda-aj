<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "STOK_OPNAME_H2H3.xls";
header("Content-Disposition: attachment; filename=$judul");
 


$dx = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_opname WHERE id='$_REQUEST[id]'"));
$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id='$d1[idgudang]'"));

$d3 = mysql_fetch_array(mysql_query("SELECT nama,posisi FROM x23_user_vw WHERE id='$d1[user]'"));

?>
<h4>STOK OPNAME H2H3</h4>

<table width="100%">
<tr>
	<td colspan="6">CABANG : <?echo $dx[namacabang]?></td>
</tr>
<tr>
	<td colspan="6">TGL STOCK OPNAME : <?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
</tr>
<tr>
	<td colspan="6">LOKASI GUDANG : <?echo $d2[gudang]?></td>
</tr>
</table>

<table width="100%" class="table table-striped table-bordered">
    <thead style="color:#666;font-size:11px">
        <tr>
            <th style="height:45px;background:#37A58A;color:#fff;">RAK</th>
            <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
            <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
            <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
            <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
            <th style="height:45px;background:#37A58A;color:#fff;">OPNAME</th>
            <th style="height:45px;background:#37A58A;color:#fff;">STOK</th>
            <th style="height:45px;background:#37A58A;color:#fff;">SELISIH</th>
            <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH SELISIH (RP)</th>
        </tr>
    </thead>
    <tbody>
    <?	
	$qIm = mysql_query("SELECT * FROM x23_opname_det_vw WHERE idopname='$_REQUEST[id]'");
	
    while($d1 = mysql_fetch_array($qIm))
    	{
	if(!empty($d1[opname]) OR $d1[opname]=="0"){
			$red = "";
			$opname = number_format($d1[opname],"0","",".");
			if($d1[selisih] < 0){
				$selisihX = (-1)*($d1[selisih]);
				$selisihY = number_format($selisihX,"0","",".");
				$selisih = "LEBIH $selisihY PCS";
				}
			else if($d1[selisih] > 0){
				$selisihY = number_format($d1[selisih],"0","",".");
				$selisih = "KURANG $selisihY PCS";
				}
			else if($d1[selisih] == 0){
				$selisih = "0 PCS";
				}
				
			if($d1[totalselisih] < 0){
				$totselisihX = (-1)*($d1[totalselisih]);
				$totselisihY = number_format($totselisihX,"0","",".");
				$totselisih = "LEBIH $totselisihY";
				}
			else if($d1[totalselisih] > 0){
				$totselisihY = number_format($d1[totalselisih],"0","",".");
				$totselisih = "KURANG $totselisihY";
				}
			else if($d1[totalselisih] == 0){
				$totselisih = "0";
				}
			}
		else{
			$red = "color:#ff0227";
			$opname ="-";
			$selisih ="-";
			$totselisih ="-";
			}
    ?>
        <tr style="cursor:pointer;<?echo $red?>" style="cursor:pointer">
            <td><?echo $d1[rak]?></td>
            <td align="center"><?echo $d1[nonota]?></td>
            <td><?echo $d1[kodebarang]?> </td>
            <td><?echo $d1[namabarang]?></td>
            <td><?echo $d1[varian]?></td>
            <td align="right"><?echo $opname?> PCS</td>
            <td align="right"><?echo number_format($d1[stok],"0","",".")?> PCS</td>
            <td align="right"><?echo $selisih?></td>
            <td align="right"><span style="margin-right:20%"><?echo $totselisih?></span></td>
        </tr>
    <?
    	}
    ?>
    </tbody>
</table>