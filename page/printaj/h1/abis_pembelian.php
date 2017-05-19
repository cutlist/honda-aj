<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "AKTIVITAS_BISNIS_PEMBELIAN$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");

?>
	<h4>DAFTAR AKTIVITAS BISNIS PEMBELIAN UNIT PERIODE TANGGAL NOTA BELI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
				                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:300%;padding-right:20px">
											<thead>
												<tr>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL FAKTUR</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO. FAKTUR</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL SURAT PESANAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO. SURAT PESANAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NOSIN</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">NOKA</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">HARGA BELI (RP)</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL TIBA (RP)</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL TIBA + PPN (RP)</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">TOTAL PEMBAYARAN (RP)</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">TOTAL BUNGA (RP)</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">LOKASI GUDANG</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL MASUK GUDANG</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN KE SUPPLIER</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA RETUR BELI</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">NO NOTA RETUR BELI</th> 
												</tr>
											</thead>
				                            <tbody>
				                            <?
											$q1 = mysql_query("SELECT * FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND nodo!=''");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{			             
				                            	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));    
				                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
				                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE nonota='$d1[nonota]'"));
				                            	$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE nodo='$d1[nodo]'"));
				                            	if($dC[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'> Bayar</span>";}
				                            	else if($dC[status]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";}
				                            	if(empty($dD[nodo])){
				                            		$tglreturbeli = "-";
				                            		$noretur = "-";}
				                            	else{$tglreturbeli = date("d-m-Y",strtotime($dD[tanggal]));$noretur = $dD[noretur];}
												
				                            	$bungax = $dC[bayar]-$dC[gtbayar]-$dC[gtbayarppn];
				                            	if($bungax > 0){
													$bunga = $bungax;
													}
												else{
													$bunga = '0';
													}
				                            	
				                            ?>
				                                <tr style="cursor:pointer">
													<!--
				                                    <td align="right"><span style="padding-right:20%"><?echo $no."."?></span></td>
													-->
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
				                                    <td align="center"><?echo $d1[nonota]?></td>
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
				                                    <td align="center"><?echo $d1[nodo]?></td>
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
				                                    <td align="center"><?echo $d1[nopo]?></td>
				                                    <td><?echo $dA[kodebarang]?></td>
				                                    <td><?echo $dA[namabarang]?></td>
				                                    <td><?echo $dA[varian]?></td>
				                                    <td><?echo $dA[warna]?></td>
				                                    <td><?echo $dB[nomesin]?></td>
				                                    <td><?echo $d1[norangka]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dC[gtbayar],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dC[gtbayar]+$dC[gtbayarppn],"0","",".")?></span></td>
			                                    	<td align="right"><span style="padding-right:20%"><?if(empty($dC[bayar])){echo "-";}else{echo number_format($dC[bayar],"0","",".");}?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($bunga,"0","",".")?></span></td>
				                                    <td><?echo $dB[gudang]?></td>
				                                    <td align="center"><?echo date("d-m-Y",strtotime($dB[tgltiba]))?></td>
				                                    <td align="center"><?echo $status?></td>
				                                    <td align="center"><?echo $tglreturbeli?></td>
				                                    <td align="center"><?echo $noretur?></td>
				                                </tr>
				                                
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="29">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>