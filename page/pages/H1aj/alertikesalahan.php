<?
	if($submenu == 'B')
		{
			$periode_tahun = date("Y");
			$periode_bulan = date('m');
?>
			<meta http-equiv="refresh" content="10"></meta>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;">
			                	<h4>ALERT <small>INDIKASI KESALAHAN</small></h4>
	                                <div class="inner col-xs-12">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd;cursor:pointer" onclick="location.href='<?echo "?opt=".md5(abis)."&submenu=A&menu=".md5(abis_ikesalahan)?>'">    
		                                	<div class="btn-danger" style="width:100%;height:358px;border-radius:5px;padding:5px;">
	                                			<?
												$dA  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND bensinawal > literawal AND lihat='0'"));
												$dB  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahan='1'"));
												$dC  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND status='0' AND ikesalahan='1'"));
												$dD  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_opname_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun'"));
													if(empty($dD[id])){$tot1='1';}else{$tot1='0';}
												$dE  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND tglsampai > tanggal AND ikesalahan='0' AND tglsampai2!='0000-00-00'"));
					                            $dIb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT'"));
												$dOb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT'"));
												$dTb = $dIb[total]-$dOb[total];
													if($dTb < 0){$tot2='1';}else{$tot1='0';}
												
												$totX = $dA[tot]+$dB[tot]+$dC[tot]+$dE[tot]+$tot1+$tot2;
	                                			?>
	                                			<h2>ANDA MEMILIKI</h2>
		                                    	<span style="font-size:145px;letter-spacing:5px;"><b><?echo $totX?></b></span>
		                                    	
		                                    	<div class="clearfix"><h4>Indikasi Kesalahan Yang Membutuhkan Respon Anda <?//echo "$dA[tot]+$dB[tot]+$dC[tot]+$dE[tot]+$tot1+$tot2"?></h4></div>
		                                    </div>
	                                    </div>
	                                </div>
	                                <!--
	                                <div class="inner col-xs-5">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
		                                	<div class="" style="width:100%;overflow-x:hidden;overflow-y:auto;height:358px;border-radius:5px;padding:5px;">
		                                			<h3>KASUS</h3>
		                                			</br>
							                        <table id="example2" class="table table-hover" style="width:100%;padding-right:20px">
							                            <tbody>
							                                <tr style="cursor:pointer;">
							                                    <td colspan=""></td>
							                                </tr>
								                        <?
															if(!empty($dA[tot]))
																{
														?>
								                                <tr style="cursor:pointer;">
								                                    <td colspan="" style="background-color:#40995b;color:#fff"><b style="padding:20px">MELEBIHKAN BENSIN AWAL</b></td>
								                                </tr>
														<?
																$q1	 = mysql_query("SELECT * FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND bensinawal > literawal ORDER BY tanggal");
																while($d1  = mysql_fetch_array($q1))
																	{
									                    ?>
																	<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=".md5(abis)."&menu=".md5(abis_ikesalahan)."&submenu=B&id=$d1[id]"?>'">
								                                    	<td>NO. RANGKA <?echo $d1[norangka]?> CHECKER <?echo $d1[nama]?></td>
																	</tr>
														<?
																	}
																}
																
															if(!empty($dB[tot]))
																{
														?>
								                                <tr style="cursor:pointer;">
							                                    	<td colspan="" style="background-color:#40995b;color:#fff"><b style="padding:20px">KELENGKAPAN KURANG / KONDISI UNIT TIDAK BAIK</b></td>
								                                </tr>
														<?
																$q1	 = mysql_query("SELECT * FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahan!='0' ORDER BY tanggal");
																while($d1  = mysql_fetch_array($q1))
																	{
										               ?>
																		<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=".md5(abis)."&menu=".md5(abis_ikesalahan)."&submenu=C&id=$d1[id]"?>'">
									                                    	<td>NO. RANGKA <?echo $d1[norangka]?> CHECKER <?echo $d1[nama]?></td>
																		</tr>
														<?
																	}
																}
																
															if(!empty($dC[tot]))
																{
														?>
								                                <tr style="cursor:pointer;">
							                                    	<td colspan="" style="background-color:#40995b;color:#fff"><b style="padding:20px">JUMLAH UNIT MASUK TIDAK SAMA DENGAN JUMLAH UNIT PADA NOTA BELI</b></td>
								                                </tr>
														<?
																$q1	 = mysql_query("SELECT *,COUNT(norangka) AS total FROM tbl_notabeli_det_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND (status='0' OR ikesalahan='1') GROUP BY nonota ORDER BY tglnota");
																while($d1  = mysql_fetch_array($q1))
																	{
																		$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_stokunit_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
								                        ?>
																		<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=".md5(abis)."&menu=".md5(abis_ikesalahan)."&submenu=D&id=$d1[nonota]"?>'">
									                                    	<td>NO. NOTA BELI <?echo "$d1[nonota] SEBANYAK $d1[total] UNIT PIC $d2[nama]"?> </td>
																		</tr>
														<?	
																	}
																}
																
															if($tot1=='1')
																{
														?>
								                                <tr style="cursor:pointer;">
								                                    <td colspan="" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOCK OPNAME BULANAN</b></td>
								                                </tr>
														<?		
																$d1  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_opname_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun'"));
																if(empty($d1[id]))
																	{
										                            $status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Dilakukan</span>";
										                            $red="color:red";
									                       			}
									                       		else{
										                            $status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Dilakukan</span>";
																	}
														?>
																		<tr style='cursor:pointer;<?echo $red?>'>
																			<td>STOCK OPNAME H1 <?echo "BULAN $periode_bulan TAHUN $periode_tahun PIC $d1[nama]"?></td>
																		</tr>
														<?
																}
																
															if(!empty($dE[tot]))
																{
														?>
								                                <tr style="cursor:pointer;">
								                                    <td colspan="" style="background-color:#40995b;color:#fff"><b style="padding:20px">KETERLAMBATAN PENGIRIMAN BARANG</b></td>
								                                </tr>
								                        <?
																$q1	 = mysql_query("SELECT * FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND tglsampai > tanggal AND ikesalahan='1' AND tglsampai2!='0000-00-00' ORDER BY tanggal");
																while($d1  = mysql_fetch_array($q1))
																	{
									                     ?>
																	<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=".md5(abis)."&menu=".md5(abis_ikesalahan)."&submenu=E&id=$d1[norangka]"?>'">
								                                    	<td>NO. NOTA JUAL <?echo $d1[nonota]?> NO. RANGKA <?echo $d1[norangka]?> DRIVER <?echo $d1[nama]?></td>
																	</tr>
														<?
																	}
																}
																
																
															if($tot2=='1')
																{
									                            $dIb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT'"));
																$dOb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT'"));
																$dTb = $dIb[total]-$dOb[total];
																if($dTb < 0)
																	{
														?>
									                                <tr style="cursor:pointer;">
									                                    <td colspan="" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK BENSIN KURANG DARI 0 (NOL)</b></td>
									                                </tr>
								                        <?
										                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
										                            	$red    = "color:red";
								                        ?>
																		<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=".md5(gpdi)."&submenu=A&menu=".md5(bensin)?>'" target="_blank">
									                                    	<td>STOK BENSIN SAAT INI KURANG DARI 0 (NOL)</td>
																		</tr>
														<?
																	}
																}
														?>
							                            </tbody>
							                            <tfoot>
							                                <tr>
							                                    <th colspan="">&nbsp;</th>
							                                </tr>
							                            </tfoot>
							                        </table>
		                                	</div>
	                                    </div>
	                                </div>
	                                -->
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
?>