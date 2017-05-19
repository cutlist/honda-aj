<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PEMBAYARAN_LEASING$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR PEMBAYARAN LEASING & MAIN DEALER PERIODE TANGGAL NOTA JUAL <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
			                        	<table id="example2" class="table table-bordered table-striped" style="min-width:420%">
											<thead>
												<tr>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
													<th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO. RANGKA</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO. MESIN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL UNIT KELUAR</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA SALES/COUNTER</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS PENJUALAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS TAGIHAN KE LEASING</th>
													<th style="height:45px;background:#37A58A;color:#fff;">OTR (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS OTR</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA LEASING</th>
													<th style="height:45px;background:#37A58A;color:#fff;">MASA ANGSURAN (X)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">GROSS (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS GROSS</th>
													<th style="height:45px;background:#37A58A;color:#fff;">SUBSIDI SETELAH PAJAK (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS SUBSIDI</th>
													<th style="height:45px;background:#37A58A;color:#fff;">MATRIX SETELAH PAJAK (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS MATRIX</th>
													<th style="height:45px;background:#37A58A;color:#fff;">SCP AHM (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS SCP AHM</th>
													<th style="height:45px;background:#37A58A;color:#fff;">SCP MD (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS SCP MD</th>
												</tr>
											</thead>
				                            <tbody>
				                            <?
											//$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING' OR jnstransaksi='KREDIT')");
											$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND tglsampai!='0000-00-00'");
											while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
				                            	$dUK  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$d1[nonota]'"));
				                            	$dPlg  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
				                            	$dSls  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id='$d1[iduser]'"));
				                            	$dLsg  = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
				                            	
				                            	//$dTot = mysql_fetch_array(mysql_query("SELECT SUM(otr) AS totr,SUM(gross) AS tgross,SUM(subsidipajak) AS tsubsidipajak,SUM(matrixpajak) AS tmatrixpajak,SUM(scpahm) AS tscpahm,SUM(scpmd) AS tscpmd FROM tbl_notajual_det_vw WHERE jnstransaksi='KREDIT' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'"));
				                            	$dTot = mysql_fetch_array(mysql_query("SELECT SUM(otr) AS totr,SUM(gross) AS tgross,SUM(subsidipajak) AS tsubsidipajak,SUM(matrixpajak) AS tmatrixpajak,SUM(scpahm) AS tscpahm,SUM(scpmd) AS tscpmd FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND  tglsampai!='0000-00-00'"));
				                            	
				                            	if($d1[jnstransaksi]=='KREDIT')
				                            		{
					                            	if($d1[statusotr]=='0'){
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusgross]=='0'){
								                        $statusgross = "<a data-toggle='modal' data-target='#compose-modal-gross0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusgross = "<a data-toggle='modal' data-target='#compose-modal-gross1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statussubsidi]=='0'){
								                        $statussubsidi = "<a data-toggle='modal' data-target='#compose-modal-subsidi0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statussubsidi = "<a data-toggle='modal' data-target='#compose-modal-subsidi1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusmatrix]=='0'){
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusscpahm]=='0'){
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusscpmd]=='0'){
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statustagihanls]=='0'){
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terkirim</span></a>";
														}
													else{
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terkirim</span></a>";
														}
													}
				                            	else if($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='LEASING')
				                            		{
					                            	if($d1[statusotr]=='0'){
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusmatrix]=='0'){
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	$statusgross  		= "-";
													$statussubsidi 		= "-";
								                    $statusscpahm 		= "-";
													$statusscpmd 		= "-";
					                            	if($d1[statustagihanls]=='0'){
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terkirim</span></a>";
														}
													else{
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terkirim</span></a>";
														}
													}
												else{
					                            	$statusotr 		= "-";
					                            	$statusgross 	= "-";
													$statussubsidi 	= "-";
													$statusmatrix 	= "-";
													if($d1[statusscpahm]=='0'){
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusscpmd]=='0'){
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	$statustagihanls = "-";
													}
													
													if(empty($dUK[tanggal])){
														$dUKtanggal = "-";
														}
													else{
														$dUKtanggal = date("d-m-Y",strtotime($dUK[tanggal]));
														}
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
				                                	<td align="center"><?echo $d1[nonota]?></td>
				                                	<td align="left"><?echo $dBrg[kodebarang]?></td>
				                                	<td align="left"><?echo $dBrg[namabarang]?></td>
				                                	<td align="left"><?echo $dBrg[varian]?></td>
				                                	<td align="center"><?echo $d1[norangka]?></td>
				                                	<td align="center"><?echo $dBrg[nomesin]?></td>
				                                	<td align="center"><?echo $dUKtanggal?></td>
				                                	<td align="left"><?echo $dPlg[nama]?></td>
				                                	<td align="left"><?echo $dSls[nama]?></td>
				                                	<td align="left"><?echo $d1[jnstransaksi]?></td>
				                                	<td align="left"><?echo $statustagihanls?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[otr],"0","",".")?></span></td>
				                                	<td align="center"><?echo $statusotr?></td>
				                                	<td align="left"><?if(empty($dLsg[namaleasing])){echo "-";}else{echo $dLsg[namaleasing];}?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[termin])){echo "-";}else{echo $d1[termin];}?></span></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[gross])){echo "-";}else{echo number_format($d1[gross],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusgross?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[subsidipajak])){echo "-";}else{echo number_format($d1[subsidipajak],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statussubsidi?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[matrixpajak])){echo "-";}else{echo number_format($d1[matrixpajak],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusmatrix?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[scpahm])){echo "-";}else{echo number_format($d1[scpahm],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusscpahm?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[scpmd])){echo "-";}else{echo number_format($d1[scpmd],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusscpmd?></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <td colspan="11">&nbsp;</td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[totr],"0","",".")?></b></span></td>
				                                	<td colspan="2">&nbsp;</td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tgross],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tsubsidipajak],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tmatrixpajak],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tscpahm],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tscpmd],"0","",".")?></b></span></td>
				                                </tr>
				                            </tfoot>
				                        </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>