<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RINGKASAN_PEMBELIAN.xls";
header("Content-Disposition: attachment; filename=$judul");
 
	                            	mysql_query("TRUNCATE temp_x23_abispenjualan");


?>
	<h4>LAPORAN RINGKASAN PEMBELIAN PERIODE TANGGAL NOTA BELI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="19" style="background:#37A58A;color:#fff;"><b><center>RINGKASAN PEMBELIAN SPARE PARTS</center></b></td>
												<td colspan="4" style="background:#37A58A;color:#fff;"><b><center>RINGKASAN RETUR BELI</center></b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">TGL NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">TGL PO</th>
												<th style="background:#37A58A;color:#fff;">NO. PO</th>
												<th style="background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="background:#37A58A;color:#fff;">VARIAN</th>
												<th style="background:#37A58A;color:#fff;">QTY BELI (PCS)</th>
												<th style="background:#37A58A;color:#fff;">HARGA BELI (RP)</th> 
												<th style="background:#37A58A;color:#fff;">JUMLAH BELI (RP)</th>
												<th style="background:#37A58A;color:#fff;">TOTAL PEMBELIAN (RP)</th>
												<th style="background:#37A58A;color:#fff;">TOTAL PEMBELIAN + PPN (RP)</th>
												<th style="background:#37A58A;color:#fff;">STATUS PEMBAYARAN KE SUPPLIER</th>
												<th style="background:#37A58A;color:#fff;">TOTAL PEMBAYARAN KE SUPPLIER (RP)</th>
												<th style="background:#37A58A;color:#fff;">TOTAL BUNGA (RP)</th>
												<th style="background:#37A58A;color:#fff;">LOKASI GUDANG AWAL</th>
												<th style="background:#37A58A;color:#fff;">TANGGAL MASUK GUDANG</th>
												<th style="background:#37A58A;color:#fff;">LOKASI RAK AWAL</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA RETUR BELI</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA RETUR BELI</th>
												<th style="background:#37A58A;color:#fff;">QTY RETUR BELI (PCS)</th>
												<th style="background:#37A58A;color:#fff;">JUMLAH RETUR BELI (RP)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$no = 1;
										$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND substr(nonota,1,2)='NB'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Lunas</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
			                            		
											$bungaX = $d1[bayar]-$d1[gtbayar];
											if($bungaX <= 0){
												$bunga = '0';
												}
											else{
												$bunga = $bungaX;
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align=""><?echo $d1[nopo]?></td>
			                                    <td align=""><?echo $d1[nama]?></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <span style="padding-right:30%"><?echo number_format($dA[qty],"0","",".")?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <span style="padding-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <span style="padding-right:20%"><?echo number_format($dA[total],"0","",".")?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotalppn],"0","",".")?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($d1[bayar])){echo "-";}else{echo $d1[bayar];}?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($bunga)){echo "-";}else{echo number_format($bunga,"0","",".");}?></span></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="center">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
				                            		if($dA[tgltiba]!="0000-00-00")
				                            			{
				                            	?>
				                            			<?echo date("d-m-Y",strtotime($dA[tgltiba]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
				                            	<?
														}
													else{
														echo "-";
														}
													}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[rak]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="center">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                            	if(!empty($dB[noretur]))
					                           			{
					                            ?>
						                               <?echo date("d-m-Y",strtotime($dB[tanggal]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                           		if(!empty($dB[noretur]))
					                           			{
					                            ?>
						                               <?echo $dB[noretur]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                           		if(!empty($dB[noretur]))
					                           			{
					                            ?>
			                                    		<span style="margin-right:30%"><?echo number_format($dB[qty],"0","",".")?></span>
					                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                           		if(!empty($dB[noretur]))
					                           			{
					                            ?>
			                                    		<span style="margin-right:30%"><?echo number_format($dA[total],"0","",".")?></span>
					                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>