<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "AKTIVITAS_BISNIS_ARUS_UNIT$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");

?>
	<h4>DAFTAR AKTIVITAS BISNIS ARUS UNIT PERIODE TGL BELI (BARANG MASUK) / TGL JUAL (BARANG KELUAR) / TGL MUTASI (MUTASI ANTAR DEALER) <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
										
	                            <?
		                            if(!empty($_REQUEST[periode]))
		                            	{
			                    ?>
				                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan='2' style="background:#37A58A;color:#fff;"><center>TANGGAL BELI</center></th>
													<th colspan="7"  style="background:#37A58A;color:#fff;"><center>BARANG MASUK</center></th>
												</tr>
												<tr>
													<!-- BARANG MASUK -->
													<th  style="background:#37A58A;color:#fff;">KODE BARANG</th>
													<th  style="background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th  style="background:#37A58A;color:#fff;">VARIAN</th>
													<th  style="background:#37A58A;color:#fff;">WARNA</th>
													<th  style="background:#37A58A;color:#fff;">LOKASI GUDANG</th>
													<th  style="background:#37A58A;color:#fff;">QTY MASUK (UNIT)</th>
													<th  style="background:#37A58A;color:#fff;">TOTAL (UNIT)</th>
												</tr>
											</thead>
				                            <tbody>
			                    <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
									
										$awal  = date("Y-m-d",strtotime($pecah[0]));
										$akhir = date("Y-m-d",strtotime($pecah[1]));
											
										while (strtotime($awal) <=  strtotime($akhir)) 
			                            	{
		                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notabeli_det_vw WHERE tglnota='$awal' AND SUBSTR(nonota,1,2)='NB' GROUP BY namabarang,varian,gudang"));
		                                	if(!empty($dA[id]))
		                                		{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
				                                    
			                                    <!-- BARANG MASUK -->
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[warna]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<span style="padding-right:20%"><?echo $dB[tot]?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
			                                		</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE tglnota='$awal'");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
					                                		if($dB[tot]!='0')
					                                			{
													?>
															<span style="padding-right:40%;font-weight:bold;"><?echo $dB[tot]?></span>
													<?
																	
																}
															}
					                                ?>	
			                                		</td>
				                                </tr>
				                            <?
				                            	}
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
				                            }
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="29">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                    		<div class="clearfix"></div>
			                    		
				                        <table id="example3" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan='2' style="background:#37A58A;color:#fff;"><center>TANGGAL JUAL</center></th>
													<th colspan="7"  style="background:#37A58A;color:#fff;"><center>BARANG KELUAR</center></th>
												</tr>
												<tr>
													<!-- BARANG KELUAR -->
													<th  style="background:#37A58A;color:#fff;">KODE BARANG</th>
													<th  style="background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th  style="background:#37A58A;color:#fff;">VARIAN</th>
													<th  style="background:#37A58A;color:#fff;">WARNA</th>
													<th  style="background:#37A58A;color:#fff;">LOKASI GUDANG</th>
													<th  style="background:#37A58A;color:#fff;">QTY KELUAR (UNIT)</th>
													<th  style="background:#37A58A;color:#fff;">TOTAL (UNIT)</th>
												</tr>
											</thead>
				                            <tbody>
			                    <?		}
			                    
		                            if(!empty($_REQUEST[periode]))
		                            	{
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
									
										$awal  = date("Y-m-d",strtotime($pecah[0]));
										$akhir = date("Y-m-d",strtotime($pecah[1]));
											
										while (strtotime($awal) <=  strtotime($akhir)) 
			                            	{
		                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notajual WHERE tglnota='$awal'"));
		                                	if(!empty($dA[id]))
		                                		{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
			                                    <!-- BARANG KELUAR -->
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[warna]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal' GROUP BY namabarang,varian,gudang");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<span style="padding-right:20%"><?echo $dB[tot]?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
			                                		</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE tglnota='$awal'");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
					                                		if($dB[tot]!='0')
					                                			{
													?>
															<span style="padding-right:40%;font-weight:bold;"><?echo $dB[tot]?></span>
													<?
																	
																}
															}
					                                ?>	
			                                		</td>
				                           	 	</tr>
				                            <?
				                            	}
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
				                            }
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="29">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                    		<div class="clearfix"></div>
			                    		
				                        <table id="example5" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan='2' style="background:#37A58A;color:#fff;"><center>TANGGAL MUTASI</center></th>
													<th colspan="8"  style="background:#37A58A;color:#fff;"><center>PINDAH LOKASI ANTAR GUDANG</center></th>
												</tr>
												<tr>
													<!-- PINDAH LOKASI -->
													<th  style="background:#37A58A;color:#fff;">KODE BARANG</th>
													<th  style="background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th  style="background:#37A58A;color:#fff;">VARIAN</th>
													<th  style="background:#37A58A;color:#fff;">WARNA</th>
													<th  style="background:#37A58A;color:#fff;">GUDANG ASAL</th>
													<th  style="background:#37A58A;color:#fff;">GUDANG TUJUAN</th>
													<th  style="background:#37A58A;color:#fff;">QTY MUTASI (UNIT)</th>
													<th  style="background:#37A58A;color:#fff;">TOTAL (UNIT)</th>
												</tr>
											</thead>
				                            <tbody>
			                    <?		}
			                    
		                            if(!empty($_REQUEST[periode]))
		                            	{
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
									
										$awal  = date("Y-m-d",strtotime($pecah[0]));
										$akhir = date("Y-m-d",strtotime($pecah[1]));
											
										while (strtotime($awal) <=  strtotime($akhir)) 
			                            	{
		                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM tbl_abis_arusunit2 WHERE tanggal='$awal'"));
		                                	if(!empty($dA[id]))
		                                		{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
			                                    <!-- PINDAH LOKASI -->
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<?echo $dB[warna]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT idgudang1 FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
					                                		$dC = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$dB[idgudang1]'"));
													?>
															<?echo $dC[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT idgudang2 FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
					                                		$dC = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$dB[idgudang2]'"));
													?>
															<?echo $dC[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE tanggal='$awal' GROUP BY namabarang,varian");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<span style="padding-right:20%"><?echo $dB[tot]?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
			                                		</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE tanggal='$awal'");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
					                                		if($dB[tot]!='0')
					                                			{
													?>
															<span style="padding-right:40%;font-weight:bold;"><?echo $dB[tot]?></span>
													<?
																	
																}
															}
					                                ?>	
			                                		</td>
				                                </tr>
				                            <?
				                            	}
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
				                            }
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="29">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                    		
				                        <table id="example6" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan='2' style="background:#37A58A;color:#fff;"><center>TANGGAL MUTASI</center></th>
													<th colspan="10"  style="background:#37A58A;color:#fff;"><center>PINDAH LOKASI ANTAR DEALER</center></th>
												</tr>
												<tr>
													<!-- PINDAH LOKASI -->
													<th  style="background:#37A58A;color:#fff;">KODE BARANG</th>
													<th  style="background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th  style="background:#37A58A;color:#fff;">VARIAN</th>
													<th  style="background:#37A58A;color:#fff;">WARNA</th>
													<th  style="background:#37A58A;color:#fff;">DEALER ASAL</th>>
													<th  style="background:#37A58A;color:#fff;">GUDANG ASAL</th>
													<th  style="background:#37A58A;color:#fff;">DEALER TUJUAN</th>
													<th  style="background:#37A58A;color:#fff;">GUDANG TUJUAN</th>
													<th  style="background:#37A58A;color:#fff;">QTY MUTASI (UNIT)</th>
													<th  style="background:#37A58A;color:#fff;">TOTAL (UNIT)</th>
												</tr>
											</thead>
				                            <tbody>
			                    <?		}
			                    
		                            if(!empty($_REQUEST[periode]))
		                            	{
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
									
										$awal  = date("Y-m-d",strtotime($pecah[0]));
										$akhir = date("Y-m-d",strtotime($pecah[1]));
											
										while (strtotime($awal) <=  strtotime($akhir)) 
			                            	{
		                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM tbl_transfer WHERE tgltransfer='$awal'"));
		                                	if(!empty($dA[id]))
		                                		{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
			                                    <!-- PINDAH LOKASI -->
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dB[idbarang]'")); 
													?>
															<?echo $dC[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dB[idbarang]'")); 
													?>
															<?echo $dC[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dB[idbarang]'")); 
													?>
															<?echo $dC[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                               	<?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dB[idbarang]'")); 
													?>
															<?echo $dC[warna]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															if($dB[jenis]=="KELUAR")
																{
																$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
													?>
																<?echo $dC[namacabang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															if($dB[jenis]=="MASUK")
																{
																$dC = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$dB[idasal]'"));
													?>
																<?echo $dC[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															if($dB[jenis]=="MASUK")
																{
													?>
																- <div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															if($dB[jenis]=="KELUAR")
																{
																$dC = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_stokunit_vw WHERE norangka='$dB[norangka]'"));
													?>
																<?echo $dC[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															if($dB[jenis]=="KELUAR")
																{
																$dC = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$dB[idtujuan]'"));
													?>
																<?echo $dC[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															if($dB[jenis]=="MASUK")
																{
																$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
													?>
																<?echo $dC[namacabang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															}
					                                ?>	
				                                	</td>
				                                    <td>
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
															if($dB[jenis]=="MASUK")
																{
																$dC = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$dB[idgudangtujuan]'"));
													?>
																<?echo $dC[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															if($dB[jenis]=="KELUAR")
																{
													?>
																- <div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
																}
															}
					                                ?>	
				                                	</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal' GROUP BY notransfer");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
													?>
															<span style="padding-right:20%"><?echo $dB[tot]?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
					                                ?>	
			                                		</td>
				                                    <td align="right">
					                                <?
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE tgltransfer='$awal'");
					                                	while($dB = mysql_fetch_array($qB))
					                                		{
					                                		if($dB[tot]!='0')
					                                			{
													?>
															<span style="padding-right:40%;font-weight:bold;"><?echo $dB[tot]?></span>
													<?
																	
																}
															}
					                                ?>	
			                                		</td>
				                                </tr>
				                            <?
				                            	}
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
				                            }
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="29">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                    		<div class="clearfix"></div>
								<?
										}
				                ?>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>