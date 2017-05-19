<?
	if($submenu == 'A')
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
			                	<h4>ALERT</h4>
	                                <div class="inner col-xs-6">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd;cursor:pointer" onclick="location.href='<?echo "?opt=".md5(abis)."&submenu=A&menu=".md5(abis_dkonfirmasi)?>'">    
		                                	<div class="btn-danger" style="width:100%;height:358px;border-radius:5px;padding:5px;">
                                			<?
											$d1  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_abis_dkonfirmasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND status='0'"));
                                			?>
	                                			<h2>ANDA MEMILIKI</h2>
		                                    	<span style="font-size:135px;letter-spacing:5px;"><b><?echo $d1[total]?></b></span>
		                                    	
	                                			<h2>Daftar Konfirmasi</h2>
		                                    	<div class="clearfix" style="margin-top: -15px"><h4>Yang Membutuhkan Respon Anda <?//echo "$dA[tot]+$dB[tot]+$dC[tot]+$dE[tot]+$tot1+$tot2"?></h4></div>
		                                    </div>
	                                    </div>
	                                </div>
	                                
	                                <div class="inner col-xs-6">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd;cursor:pointer" onclick="location.href='<?echo "?opt=".md5(abis)."&submenu=A&menu=".md5(abis_ikesalahan)?>'">    
		                                	<div class="btn-danger" style="width:100%;height:358px;border-radius:5px;padding:5px;">
	                                			<?
	                                			$tglsampai = date("Y-m-d");
	                                			
												$dA  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_cekfisik_vw WHERE ikesalahan='0' AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND bensinawal > literawal AND lihat='0'"));
												$dB  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_cekfisik_vw WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahan='1'"));
												$dC  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_notabeli_det_vw WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND status='0' AND ikesalahan='1'"));
												$dD  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_opname_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
													if(empty($dD[id])){$tot1='1';}else{$tot1='0';}
												$dE  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_pengeluaranunit_vw WHERE ikesalahan='0' AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND '$tglsampai' > tanggal AND tglsampai2='0000-00-00'"));
												$dF  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_notabeli WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahanacc IN ('1','2')"));
												$dG  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM tbl_notabeli_det3_vw WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND (status='0' OR ikesalahan='1')"));
												$dIb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE jenis='INPUT'"));
												$dOb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE jenis='OUTPUT'"));
												$dTb = $dIb[total]-$dOb[total];
													if($dTb < 0){$tot2='1';}else{$tot1='0';}
													
					                            $dS1  = mysql_fetch_array(mysql_query("SELECT SUM(accu) AS accu,SUM(jual) AS jual FROM stok_accu"));
												$dS1X = $dS1[accu]-$dS1[jual];
													if($dS1X < 0){$tota1 ='1';}else{$tota2='0';}
													
					                            $dS2  = mysql_fetch_array(mysql_query("SELECT SUM(alaskaki) AS alaskaki,SUM(jual) AS jual FROM stok_alaskaki"));
												$dS2X = $dS2[alaskaki]-$dS2[jual];
													if($dS2X < 0){$totb1 ='1';}else{$totb2='0';}
													
					                            $dS3  = mysql_fetch_array(mysql_query("SELECT SUM(anakkunci) AS anakkunci,SUM(jual) AS jual FROM stok_anakkunci"));
												$dS3X = $dS3[anakkunci]-$dS3[jual];
													if($dS3X < 0){$totc1 ='1';}else{$totc2='0';}
													
					                            $dS4  = mysql_fetch_array(mysql_query("SELECT SUM(bukuservis) AS bukuservis,SUM(jual) AS jual FROM stok_bukuservis"));
												$dS4X = $dS4[bukuservis]-$dS4[jual];
													if($dS4X < 0){$totd1 ='1';}else{$totd2='0';}
													
					                            $dS5  = mysql_fetch_array(mysql_query("SELECT SUM(helm) AS helm,SUM(jual) AS jual FROM stok_helm"));
												$dS5X = $dS5[helm]-$dS5[jual];
													if($dS5X < 0){$tote1 ='1';}else{$tote2='0';}
													
					                            $dS6  = mysql_fetch_array(mysql_query("SELECT SUM(jaket) AS jaket,SUM(jual) AS jual FROM stok_jaket"));
												$dS6X = $dS6[jaket]-$dS6[jual];
													if($dS6X < 0){$totf1 ='1';}else{$totf2='0';}
													
					                            $dS7  = mysql_fetch_array(mysql_query("SELECT SUM(spion) AS spion,SUM(jual) AS jual FROM stok_spion"));
												$dS7X = $dS7[spion]-$dS7[jual];
													if($dS7X < 0){$totg1 ='1';}else{$totg2='0';}
													
					                            $dS8  = mysql_fetch_array(mysql_query("SELECT SUM(toolkit) AS toolkit,SUM(jual) AS jual FROM stok_toolkit"));
												$dS8X = $dS8[toolkit]-$dS8[jual];
													if($dS8X < 0){$toth1 ='1';}else{$toth2='0';}
												
												$totX = $dA[tot]+$dB[tot]+$dC[tot]+$dE[tot]+$dF[tot]+$dG[tot]+$dH[tot]+$tot1+$tot2
														+$tota1+$tota2
														+$totb1+$totb2
														+$totc1+$totc2
														+$totd1+$totd2
														+$tote1+$tote2
														+$totf1+$totf2
														+$totg1+$totg2
														+$toth1+$toth2
														;
	                                			?>
	                                			<h2>ANDA MEMILIKI</h2>
		                                    	<span style="font-size:135px;letter-spacing:5px;"><b><?echo $totX?></b></span>
		                                    	
	                                			<h2>Indikasi Kesalahan</h2>
		                                    	<div class="clearfix" style="margin-top: -15px"><h4>Yang Membutuhkan Respon Anda <?//echo "$dA[tot]+$dB[tot]+$dC[tot]+$dE[tot]+$tot1+$tot2"?></h4></div>
		                                    </div>
	                                    </div>
	                                </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
?>