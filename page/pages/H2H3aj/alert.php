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
											$d1  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_abis_dkonfirmasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND status='0'"));
                                			?>
	                                			<h2>ANDA MEMILIKI</h2>
		                                    	<span style="font-size:135px;letter-spacing:5px;"><b><?echo $d1[total]?></b></span>
		                                    	
	                                			<h2>Daftar Konfirmasi</h2>
		                                    	<div class="clearfix" style="margin-top: -15px"><h4>Yang Membutuhkan Respon Anda</h4></div>
		                                    </div>
	                                    </div>
	                                </div>
	                                
	                                <div class="inner col-xs-6">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd;cursor:pointer" onclick="location.href='<?echo "?opt=".md5(abis)."&submenu=A&menu=".md5(abis_ikesalahan)?>'">    
		                                	<div class="btn-danger" style="width:100%;height:358px;border-radius:5px;padding:5px;">
	                                			<?
												$dAs1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scanmasuk WHERE tanggal=CURDATE()"));
												$asmasukbengkel = round($dAs1[total]/2);
												$dAs2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE tglnota=CURDATE()"));
												$asmulaiservis = $dAs2[total];
												$dAs3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scankeluar WHERE tanggal=CURDATE()"));
												$askeluarbengkel = round($dAs3[total]/2);
												$dAs4 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE tglnota=CURDATE() AND status!='0'"));
												$asselesaiservis = $dAs4[total];
												
												$selisih1 = abs($asmasukbengkel - $asmulaiservis);
												$selisih2 = abs($askeluarbengkel - $asselesaiservis);
												
												$dCs  = mysql_fetch_array(mysql_query("SELECT aksi FROM x23_scanhistory WHERE tanggal=CURDATE() ORDER BY id DESC LIMIT 0,1"));
												$dCs2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_tutupharian WHERE tanggal=(CURDATE() - INTERVAL 1 DAY)"));
		
		
												$dA  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM x23_stokpart_group_vw2 WHERE totalstok<'0' GROUP BY idbarang,nonota,idgudang,rak"));
												$dB  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM x23_abis_ikesalahan WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun'"));
												if($selisih1 > 2){$tot1="1";}else{$tot1="0";}
												if($selisih2 > 2){$tot2="1";}else{$tot2="0";}
				                            	if($dCs[aksi]=='stop' || empty($dCs[aksi])){$tot3="1";}else{$tot3="0";}
												if(empty($dCs2[id])){$tot4="1";}else{$tot4="0";}
													
												$totX = $dA[tot]+$dB[tot]
														+$tot1+$tot2+$tot3+$tot4
														;
	                                			?>
	                                			<h2>ANDA MEMILIKI</h2>
		                                    	<span style="font-size:135px;letter-spacing:5px;"><b><?echo $totX?></b></span>
		                                    	
	                                			<h2>Indikasi Kesalahan</h2>
		                                    	<div class="clearfix" style="margin-top: -15px"><h4>Yang Membutuhkan Respon Anda <?//echo "$dA[tot]+$dB[tot]+$tot1+$tot2+$tot3"?></h4></div>
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