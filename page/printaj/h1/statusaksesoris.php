<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "STATUS_AKSESORIS$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR STATUS AKSESORIS PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA BELI / NO. NOTA MUTASI MASUK : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH BELI MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ACCU</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAS KAKI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">2 ANAK KUNCI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">HELM</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">SPION</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOOLKIT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JAKET</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">BUKU SERVIS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$qA = mysql_query("SELECT * FROM tbl_notabeli WHERE scan='1' AND nonota LIKE '%$_REQUEST[cari]%' ORDER BY id DESC");
											}
										else
											{
											$qA = mysql_query("SELECT * FROM tbl_notabeli WHERE scan='1' ORDER BY id DESC");
											}
		                            	
		                            	while($dA = mysql_fetch_array($qA))
		                            		{
		                            		//$d0 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS qty FROM tbl_stokunit WHERE nonota='$dA[nonota]'"));
		                            		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM stok_accu WHERE nonota='$dA[nonota]'"));
		                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM stok_alaskaki WHERE nonota='$dA[nonota]'"));
		                            		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM stok_anakkunci WHERE nonota='$dA[nonota]'"));
		                            		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM stok_helm WHERE nonota='$dA[nonota]'"));
		                            		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM stok_spion WHERE nonota='$dA[nonota]'"));
		                            		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM stok_toolkit WHERE nonota='$dA[nonota]'"));
		                            		$d7 = mysql_fetch_array(mysql_query("SELECT * FROM stok_jaket WHERE nonota='$dA[nonota]'"));
		                            		$d8 = mysql_fetch_array(mysql_query("SELECT * FROM stok_bukuservis WHERE nonota='$dA[nonota]'"));
		                            		
											$dHitung = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_stokunit WHERE nonota='$dA[nonota]'"));
											$h1 = $dHitung[total];
											$h2 = $dHitung[total]*2;
		
											if($d1[accu] != $h1){
												$red1a = "1";
												if($d1[accu] < $h1){
													$x = $h1-$d1[accu];
													$red1 = "color:red";
													$accu="Kurang $x PCS";}
												if($d1[accu] > $h1){
													$x = $d1[accu]-$h1;
													$red1 = "color:green";
													$accu="Lebih $x PCS";}
												}
												else{$red1a="0";$red1="";$accu="Cukup";}
											if($d3[anakkunci] != $h1){
												$red3a = "1";
												if($d3[anakkunci] < $h1){
													$x = $h1-$d3[anakkunci];
													$red3 = "color:red";
													$anakkunci="Kurang $x PCS";}
												if($d3[anakkunci] > $h1){
													$x = $d3[anakkunci]-$h1;
													$red3 = "color:green";
													$anakkunci="Lebih $x PCS";}
												}
												else{$red3a="0";$red3="";$anakkunci="Cukup";}
											if($d4[helm] != $h1){
												$red4a = "1";
												if($d4[helm] < $h1){
													$x = $h1-$d4[helm];
													$red4 = "color:red";
													$helm="Kurang $x PCS";}
												if($d4[helm] > $h1){
													$x = $d4[helm]-$h1;
													$red4 = "color:green";
													$helm="Lebih $x PCS";}
												}
												else{$red4a="0";$red4="";$helm="Cukup";}
											if($d5[spion] != $h2){
												$red5a = "1";
												if($d5[spion] < $h1){
													$x = $h1-$d5[spion];
													$red5 = "color:red";
													$spion="Kurang $x PCS";}
												if($d5[spion] > $h1){
													$x = $d5[spion]-$h1;
													$red5 = "color:green";
													$spion="Lebih $x PCS";}
												}
												else{$red5a="0";$red5="";$spion="Cukup";}
											if($d6[toolkit] != $h1){
												$red6a = "1";
												if($d6[toolkit] < $h1){
													$x = $h1-$d6[toolkit];
													$red6 = "color:red";
													$toolkit="Kurang $x PCS";}
												if($d6[toolkit] > $h1){
													$x = $d6[toolkit]-$h1;
													$red6 = "color:green";
													$toolkit="Lebih $x PCS";}
												}
												else{$red6a="0";$red6="";$toolkit="Cukup";}
											if($d8[bukuservis] != $h1){
												$red8a = "1";
												if($d8[bukuservis] < $h1){
													$x = $h1-$d8[bukuservis];
													$red8 = "color:red";
													$bukuservis="Kurang $x PCS";}
												if($d8[bukuservis] > $h1){
													$x = $d8[bukuservis]-$h1;
													$red8 = "color:green";
													$bukuservis="Lebih $x PCS";}
												}
												else{$red8a="0";$red8="";$bukuservis="Cukup";}
											
											if($red1a == "1" || $red3a == "1" || $red4a == "1" || $red5a == "1" || $red6a == "1" || $red8a == "1"){
												$status = "<span class='btn btn-warning' style='padding:0px 5px;font-size:12px;'>TIDAK SEIMBANG</span>";
												
											if(empty($d2[alaskaki])){
												$alaskasi = "0";
												}
											else{
												$alaskasi = $d2[alaskaki];
												}
											if(empty($d7[jaket])){
												$jaket = "0";
												}
											else{
												$jaket = $d7[jaket];
												}
										?>
												<tr style="cursor:pointer">
													<td align="center"><?echo $dA[nonota]?></td>
													<td align="right"><span style="padding-right: 15%;"><?echo $dHitung[total]?> UNIT</span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red1?>"><?echo $accu?></span></td>
													<td align="right"><span style="padding-right: 15%;"><?echo $alaskasi?> PCS</span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red3?>"><?echo $anakkunci?></span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red4?>"><?echo $helm?></span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red5?>"><?echo $spion?></span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red6?>"><?echo $toolkit?></span></td>
													<td align="right"><span style="padding-right: 15%;<?echo $red7?>"><?echo $jaket?> PCS</span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red8?>"><?echo $bukuservis?></span></td>
													<!--
													<td align="center"><?echo $status?></td>
													-->
												</tr>
										<?
												}
											else{
												$status = "<span class='btn btn-primary' style='padding:0px 5px;font-size:12px;'>TELAH SEIMBANG</span>";
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
				<td colspan="2"><b><span style="margin-left:10%">TOTAL</b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gtp[grandtotal])?></b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gto[grandtotal])?></b></span></td>
			</tr>
			-->
		</tfoot>
	</table>