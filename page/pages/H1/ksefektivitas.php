
		<aside class="right-side">
		    <section class="content">
		        <div class="row">
		            <div class="col-xs-12">	
		            <?
		            if(empty($mod) || $mod=='harian')
		            	{
		            ?>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                            <!--
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=bulanan"?>">Tahunan</a></li>
                            -->
                                <li class="active"><a href="#tab_1-1" data-toggle="tab">Bulanan</a></li>
                                <li class="pull-left header"><h4>KINERJA SALES <small>EFEKTIVITAS PROSPEK</small></h4></li>
                            </ul>
                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
                                <div class="tab-pane active">
                                    <div style="float:right;width:40%">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
                                    	if(!empty($_REQUEST[tahun]) && !empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = $_REQUEST[tahun];
                                    		$periode_bulan = $_REQUEST[bulan];
											}
                                    	else if(empty($_REQUEST[tahun]) && empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = date("Y");
											$periode_bulan = date('m');
                                    		}
										?>
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                           				<td width="1%"><button type="button"  onclick="window.open('print/h1/ksefektivitas.php?<? echo "periode_tahun=$periode_tahun&periode_bulan=$periode_bulan";?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
			                           				</td>
			                           			<?
			                           				}
			                           			?>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>

									<div class="col-xs-12" style="width:100%;margin:0 auto;margin-top:10px">
				                        <table id="example3" class="table table-striped table-bordered">
				                            <thead style="cursor:pointer">
												<th class="btn-info" style="text-align:center">NAMA KARYAWAN</th>
												<th class="btn-info" style="width:20%;text-align:center">JUMLAH PROSPEK</br>(ORANG)</th>
												<th class="btn-info" style="width:20%;text-align:center">JUMLAH TINDAK LANJUT</br>PADA PROSPEK (TINDAKAN)</th>
												<th class="btn-info" style="width:20%;text-align:center">JUMLAH PENJUALAN</br>PADA PROSPEK (TRANSAKSI)</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											mysql_query("TRUNCATE temp_ksefektivitas ");
											if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
												{
												$qA = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id_posisi IN ('2','7') ORDER BY nama");
												}
											else
												{
												$qA = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id_posisi IN ('2','7') ORDER BY nama");
												}
											while($dA = mysql_fetch_array($qA))
												{
												$h1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_prospek WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]'"));
												if(!empty($h1[total])){
													$jps = number_format($h1[total],"0","",".");
													}
												else{
													$jps = "-";
													}
													
												$h2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_pesanan_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]' AND idpelanggan IN (SELECT idpelanggan FROM tbl_prospek WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]')"));
												if(!empty($h2[total])){
													$jtl = number_format($h2[total],"0","",".");
													}
												else{
													$jtl = "-";
													}
													
												$h3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notajual_det_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]' AND tglsampai!='0000-00-00' AND idpelanggan IN (SELECT idpelanggan FROM tbl_prospek WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]')"));
												if(!empty($h3[total])){
													$jpl = number_format($h3[total],"0","",".");
													}
												else{
													$jpl = "-";
													}
												
												mysql_query("INSERT INTO temp_ksefektivitas VALUES ('$jps','$jtl','$jpl')");
											?>
												<tr>
													<td align="left"><span style="margin-left:5%"><?echo $dA[nama]?></span></td>
													<td align="right"><span style="margin-right:40%"><?echo $jps?></span></td>
													<td align="right"><span style="margin-right:40%"><?echo $jtl?></span></td>
													<td align="right"><span style="margin-right:40%"><?echo $jpl?></span></td>
												</tr>
											<?
												}
												
												$dTh = mysql_fetch_array(mysql_query("SELECT SUM(jps) AS tjps, SUM(jtl) AS tjtl, SUM(jpl) AS tjpl FROM temp_ksefektivitas"));
											?>
												<tr>
													<td colspan="4"></td>
												</tr>
												<tr>
													<td align="left"><span style="margin-left:5%"><b>TOTAL</b></span></td>
													<td align="right"><span style="margin-right:40%"><b><?echo $dTh[tjps]?></b></span></td>
													<td align="right"><span style="margin-right:40%"><b><?echo $dTh[tjtl]?></b></span></td>
													<td align="right"><span style="margin-right:40%"><b><?echo $dTh[tjpl]?></b></span></td>
												</tr>
											</tbody>
										</table>
									</div>
                                </div>
                            </div>
                        </div>
                    <?
                    	}
                    	
		            else if($mod=='bulanan')
		            	{
		            ?>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                                <li class="active"><a href="#tab_2-2" data-toggle="tab">Tahunan</a></li>
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=harian"?>">Bulanan</a></li>
                                <li class="pull-left header"><h4>KINERJA SALES <small>SEMUA</small></h4></li>
                            </ul>
                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
                                <div class="tab-pane active">
                                    <span style="font-size:16px;font-weight:bold;">TAHUNAN</span>
                                    <div style="float:right;width:50%">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
                                    	if(!empty($_REQUEST[tahun]))
                                    		{
                                    		$periode_tahun = $_REQUEST[tahun];
                                    		$periode_bulan = $_REQUEST[bulan];
											}
                                    	else if(empty($_REQUEST[tahun]))
                                    		{
                                    		$periode_tahun = date("Y");
											$periode_bulan = date('m');
                                    		}
										$qB = mysql_query("SELECT * FROM tbl_notajual WHERE tahun='$periode_tahun'");
										$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(qty) AS total FROM tbl_notajual_qty WHERE tahun='$periode_tahun'"));
										$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(qty) AS total FROM tbl_notajual_qty WHERE tahun='$periode_tahun' AND jnstransaksi!='KREDIT'"));
										$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(qty) AS total FROM tbl_notajual_qty WHERE tahun='$periode_tahun' AND jnstransaksi='KREDIT'"));
										?>
                                    		<tr>
                                    			<td></td>
                                    			<td width="17%"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
						            <div class="col-xs-12" style="margin-top:10px">	
							            <div class="col-xs-4">		                
							                <div class="small-box bg-green" style="text-align:center;height:115px;border-radius:10px 10px 0 0;margin-top:0px;padding:10px 0 0 0;border-bottom: 5px solid #fff">
							                	<h4><b>TOTAL</b> PENJUALAN</h4>
					                                <div class="inner">
					                                	<a href="#" style="color:#fff">
					                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
						                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:9px;">
							                                    	<h4><b><?echo $p1[total]?></b></h4>
						                                    </div>
					                                    </div>
					                                    </a>
					                                </div>
							                </div>
							            </div>	
							            <div class="col-xs-4">		                
							                <div class="small-box bg-orange" style="text-align:center;height:115px;border-radius:10px 10px 0 0;margin-top:0px;padding:10px 0 0 0;border-bottom: 5px solid #fff">
							                	<h4>PENJUALAN <b>CASH</b></h4>
					                                <div class="inner">
					                                	<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="color:#fff">
					                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
						                                	<div class="bg-orange" style="width:60px;height:60px;border-radius:60px;padding:9px;">
							                                    	<h4><b><?echo $p2[total]?></b></h4>
						                                    </div>
					                                    </div>
					                                    </a>
					                                </div>
							                </div>
							            </div>	
							            <div class="col-xs-4">		                
							                <div class="small-box bg-blue" style="text-align:center;height:115px;border-radius:10px 10px 0 0;margin-top:0px;padding:10px 0 0 0;border-bottom: 5px solid #fff">
							                	<h4>PENJUALAN <b>KREDIT</b></h4>
							                	<?
												$pA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli WHERE tahun='$periode_tahun' AND status='1'"));
							                	?>
					                                <div class="inner">
					                                	<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="color:#fff">
					                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
						                                	<div class="bg-blue" style="width:60px;height:60px;border-radius:60px;padding:9px;">
							                                    	<h4><b><?echo $p3[total]?></b></h4>
						                                    </div>
					                                    </div>
					                                    </a>
					                                </div>
							                </div>
							            </div>	
						            </div>
									
									<div class="col-xs-12" style="width:100%;margin:0 auto;margin-top:10px">
				                        <table id="example3" class="table table-striped table-bordered">
				                            <thead style="cursor:pointer">
												<th class="btn-info" style="text-align:center">NAMA KARYAWAN</th>
												<th class="btn-info" style="width:12%;text-align:center">PENJUALAN CASH</th>
												<th class="btn-info" style="width:12%;text-align:center">PENJUALAN KREDIT</th>
												<th class="btn-info" style="width:12%;text-align:center">TOTAL PENJUALAN</th>
												<th class="btn-info" style="width:12%;text-align:center">KOMISI CASH</th>
												<th class="btn-info" style="width:12%;text-align:center">KOMISI KREDIT</th>
												<th class="btn-info" style="width:12%;text-align:center">TOTAL KOMISI</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											$qA = mysql_query("SELECT id,nama FROM tbl_karyawan WHERE posisi IN ('2','7') ORDER BY nama");
											while($dA = mysql_fetch_array($qA))
												{
												$h1 = mysql_fetch_array(mysql_query("SELECT COUNT(qty) AS total FROM tbl_notajual_qty WHERE bulan='$periode_bulan' AND jnstransaksi!='KREDIT' AND idsales='$dA[id]'"));
												$h2 = mysql_fetch_array(mysql_query("SELECT COUNT(qty) AS total FROM tbl_notajual_qty WHERE bulan='$periode_bulan' AND jnstransaksi='KREDIT' AND idsales='$dA[id]'"));
												if(!empty($h1[total])){
													$pc = number_format($h1[total],"0","",".");
													}
												else{
													$pc = "-";
													}
												if(!empty($h2[total])){
													$pk = number_format($h2[total],"0","",".");
													}
												else{
													$pk = "-";
													}
												$hp = $h1[total]+$h2[total];
												if($hp!='0'){
													$tp = number_format($hp,"0","",".");
													}
												else{
													$tp = "-";
													}
												
											?>
													<tr>
														<td align="left"><span style="margin-left:5%"><?echo $dA[nama]?></span></td>
														<td align="right"><span style="margin-right:40%"><?echo $pc?></span></td>
														<td align="right"><span style="margin-right:40%"><?echo $pk?></span></td>
														<td align="right"><span style="margin-right:40%"><?echo $tp?></span></td>
														<td align="left"><span style="margin-left:20%"><?echo $dB[jnstransaksi]?></span></td>
														<td align="left"><span style="margin-left:20%"><?echo $d3[namaleasing]?></span></td>
														<td align="left"><span style="margin-left:20%"><?echo $d3[namaleasing]?></span></td>
													</tr>
											<?
												}
											?>
											</tbody>
										</table>
									</div>
                                </div>
                            </div>
                        </div>
                    <?
                    	}
                    ?>
                    </div>
		        </div>
                
			</section>
		</aside>