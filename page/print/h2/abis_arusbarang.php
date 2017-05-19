<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RINGKASAN_ARUS_BARANG.xls";
header("Content-Disposition: attachment; filename=$judul");
 
	                            	mysql_query("TRUNCATE temp_x23_abispenjualan");


?>
	<h4>LAPORAN RINGKASAN ARUS BARANG PERIODE TGL TIBA (BARANG MASUK) / TGL NOTA JUAL (BARANG KELUAR) / TGL PINDAH (PINDAH LOKASI) <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
	
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="2" style="background:#37A58A;color:#fff;"><b><center>TANGGAL TIBA</center></b></td>
												<td colspan="9" style="background:#37A58A;color:#fff;"><b><center>BARANG MASUK</center></b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="background:#37A58A;color:#fff;">VARIAN</th>
												<th style="background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">LOKASI GUDANG AWAL</th>
												<th style="background:#37A58A;color:#fff;">LOKASI RAK AWAL</th>
												<th style="background:#37A58A;color:#fff;">QTY MASUK (PCS)</th>
												<th style="background:#37A58A;color:#fff;">TOTAL QTY MASUK (PCS)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
											$awal  = $_SESSION[periode_awal];
											$akhir = $_SESSION[periode_akhir];
											while (strtotime($awal) <=  strtotime($akhir)) 
				                            	{
			                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak"));
			                                	if(!empty($dA[id]))
			                                		{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
					                                    
				                                    <!-- BARANG MASUK PEMBELIAN -->
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT kodebarang FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
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
						                                	$qB = mysql_query("SELECT namabarang FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
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
						                                	$qB = mysql_query("SELECT varian FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
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
						                                	$qB = mysql_query("SELECT idsupplier FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
						                                		$dC = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$dB[idsupplier]'"));
														?>
																<?echo $dC[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT nonota FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[nonota]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT gudang FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT rak FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[rak]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td align="right">
						                                <?
						                                	$qB = mysql_query("SELECT qty FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
					                                    		<span style="margin-right:30%"><?echo number_format($dB[qty],"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format($dB[tot],"0","",".")?></span>
					                                	</td>
					                                </tr>
					                                
					                            <?
					                            	}
					                            	
					                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak"));
			                                	if(!empty($dA[id]))
			                                		{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT kodebarang FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
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
						                                	$qB = mysql_query("SELECT namabarang FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
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
						                                	$qB = mysql_query("SELECT varian FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
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
						                                	$qB = mysql_query("SELECT idsupplier FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
						                                		$dC = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$dB[idsupplier]'"));
														?>
																<?echo $dC[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT nonota FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[nonota]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT gudang FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT rak FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[rak]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td align="right">
						                                <?
						                                	$qB = mysql_query("SELECT qty FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
					                                    		<span style="margin-right:30%"><?echo number_format($dB[qty],"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format($dB[tot],"0","",".")?></span>
					                                	</td>
					                                </tr>
					                            <?
					                            	}
													$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
					                        	}
				                        ?>
											<tr><td></td></tr>
			                            </tbody>
			                        </table>
									
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="2" style="background:#37A58A;color:#fff;"><b><center>TGL NOTA JUAL / TGL NOTA SERVIS</center></b></td>
												<td colspan="13" style="background:#37A58A;color:#fff;"><b><center>BARANG KELUAR</center></b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="background:#37A58A;color:#fff;">VARIAN</th>
												<th style="background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA JUAL/NO. NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA RETUR BELI</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA RETUR BELI</th>
												<th style="background:#37A58A;color:#fff;">LOKASI GUDANG</th>
												<th style="background:#37A58A;color:#fff;">LOKASI RAK</th>
												<th style="background:#37A58A;color:#fff;">QTY KELUAR (PCS)</th>
												<th style="background:#37A58A;color:#fff;">TOTAL QTY KELUAR (PCS)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
											$awal  = $_SESSION[periode_awal];
											$akhir = $_SESSION[periode_akhir];
											while (strtotime($awal) <=  strtotime($akhir)) 
				                            	{
					                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE notabeli!='CLAIM' AND tglnota='$awal' GROUP BY idbarang,idgudang,rak"));
			                                	if(!empty($dA[id]))
			                                		{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
				                                    <!-- BARANG KELUAR
					                                    <td>PENJUALAN</td> -->
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT kodebarang FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
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
						                                	$qB = mysql_query("SELECT namabarang FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
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
						                                	$qB = mysql_query("SELECT varian FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
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
						                                	$qB = mysql_query("SELECT notabeli FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
						                                		$dC = mysql_fetch_array(mysql_query("SELECT idsupplier FROM x23_notabeli WHERE nonota='$dB[notabeli]'"));
						                                		$dD = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$dC[idsupplier]'"));
														?>
																<?echo $dD[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT notabeli FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[notabeli]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT notabeli FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
																$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$dB[notabeli]'"));
														?>
																<?echo date("d-m-Y",strtotime($dNbl[tglnota]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT nonota FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[nonota]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
					                                	<td align="center">-</td>
					                                	<td align="center">-</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT gudang FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT rak FROM x23_notajual_det_vw WHERE tglnota='$awal' AND notabeli!='CLAIM' GROUP BY idbarang,varian,notabeli,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[rak]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td align="right">
						                                <?
						                                	$qB = mysql_query("SELECT SUM(qty) AS qty FROM x23_notajual_det_vw WHERE notabeli!='CLAIM' AND tglnota='$awal' GROUP BY idbarang,idgudang,notabeli,rak");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
					                                    		<span style="margin-right:30%"><?echo number_format($dB[qty],"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_notajual_det_vw WHERE notabeli!='CLAIM' AND tglnota='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format($dB[tot],"0","",".")?></span>
					                                	</td>
					                                </tr>
					                            <?
					                            	}
													$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
					                        	}
				                        ?>
											<tr><td></td></tr>
			                            </tbody>
			                        </table>
									
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="2" style="background:#37A58A;color:#fff;"><b><center>TANGGAL PINDAH</center></b></td>
												<td colspan="12" style="background:#37A58A;color:#fff;"><b><center>PINDAH LOKASI</center></b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="background:#37A58A;color:#fff;">VARIAN</th>
												<th style="background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">DARI GUDANG</th>
												<th style="background:#37A58A;color:#fff;">DARI RAK</th>
												<th style="background:#37A58A;color:#fff;">KE GUDANG</th>
												<th style="background:#37A58A;color:#fff;">KE RAK</th>
												<th style="background:#37A58A;color:#fff;">QTY PINDAH (PCS)</th>
												<th style="background:#37A58A;color:#fff;">TOTAL QTY PINDAH (PCS)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
											$awal  = $_SESSION[periode_awal];
											$akhir = $_SESSION[periode_akhir];
											while (strtotime($awal) <=  strtotime($akhir)) 
				                            	{
			                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM x23_pindah WHERE tanggal='$awal'"));
			                                	if(!empty($dA[id]))
			                                		{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
				                                    <!-- PINDAH LOKASI -->
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT kodebarang FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
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
						                                	$qB = mysql_query("SELECT namabarang FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
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
						                                	$qB = mysql_query("SELECT varian FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
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
						                                	$qB = mysql_query("SELECT nonota FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,varian,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
						                                		$dC = mysql_fetch_array(mysql_query("SELECT idsupplier FROM x23_notabeli WHERE nonota='$dB[nonota]'"));
						                                		$dD = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$dC[idsupplier]'"));
														?>
																<?echo $dD[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT nonota FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,varian,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[nonota]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT nonota FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,varian,gudang");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
																$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$dB[nonota]'"));
														?>
																<?echo date("d-m-Y",strtotime($dNbl[tglnota]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT gudang FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT rak1 FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[rak1]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT idgudang2 FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
						                                		$dC = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id='$dB[idgudang2]'"));
														?>
																<?echo $dC[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td>
						                                <?
						                                	$qB = mysql_query("SELECT rak2 FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
																<?echo $dB[rak2]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
				                                   		<td align="right">
						                                <?
						                                	$qB = mysql_query("SELECT qty FROM x23_pindah_det_vw WHERE tanggal='$awal' GROUP BY idbarang,idgudang1,rak1");
						                                	while($dB = mysql_fetch_array($qB))
						                                		{
														?>
					                                    		<span style="margin-right:30%"><?echo number_format($dB[qty],"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_pindah_det_vw WHERE tanggal='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format($dB[tot],"0","",".")?></span>
					                                	</td>
					                                </tr>
					                            <?
					                            	}
													$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
					                        	}
				                        ?>
			                            </tbody>
			                        </table>
									
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>
									