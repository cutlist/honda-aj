<?
include "include/fungsi_indotgl1.php";
?>
	<script src="js/jquery.min.js"></script>
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
                                <li class="active"><a href="#tab_1-1" data-toggle="tab">Bulanan</a></li>
                            -->
                                <li class="pull-left header"><h4>KINERJA SALES <small>INDIVIDU</small></h4></li>
                            </ul>
                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
                                <div class="tab-pane active">
                                    <div style="float:right;width:65%">
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
										<?
											if($_SESSION[posisi]=='DIREKSI')
												{
		                                    	if(!empty($_REQUEST[idsales]))
													{
													$qB = mysql_query("SELECT * FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]'");
													$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]'"));
													$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
													$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
		                                    		}	
												else
													{
													$qB = mysql_query("SELECT * FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
													$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'"));
													$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
													$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
													}
										?>
                                    			<td width="65%"><select name="idsales" class="form-control" id="select1" style="font-size:12px;padding:3px">
																		<option value='' selected>SEMUA COUNTER SALES, SALES, PIC, & DIREKSI</option>
																		<?
																			$q1 = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id%2=0 AND id_posisi IN ('2','7','6','9') ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($_REQUEST[idsales]==$dA[id]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
										<?
												}
											else if($_SESSION[posisi]=='PIC')
												{
		                                    	if(!empty($_REQUEST[idsales]))
													{
													$qB = mysql_query("SELECT * FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]'");
													$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]'"));
													$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
													$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
		                                    		}	
												else
													{
													$qB = mysql_query("SELECT * FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
													$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'"));
													$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
													$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
													}
										?>
                                    			<td width="65%"><select name="idsales" class="form-control" id="select1" style="font-size:12px;padding:3px">
																		<option value='' selected>SEMUA COUNTER SALES, SALES, & PIC</option>
																		<?
																			$q1 = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id%2=0 AND id_posisi IN ('2','7','9') ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($_REQUEST[idsales]==$dA[id]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
										<?
												}
											else
												{
												$qB = mysql_query("SELECT * FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_SESSION[id]'");
												$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_SESSION[id]'"));
												$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_SESSION[id]' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
												$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE id%2=0 AND id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$_SESSION[id]' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
		                                    	
												}
										?>
                                    			<td width="22%"><select name="bulan" class="form-control" style="height:35px">
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
                                    			<td width="15%"><select name="tahun" class="form-control" style="height:35px">
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
							                <div class="small-box bg-green" style="text-align:left;height:75px;border-radius:10px 10px 0 0;margin-top:0px;padding:10px 0 0 0;border-bottom: 5px solid #fff">
							                	<h4 style="padding-left:20px"><b>TOTAL</b> PENJUALAN</h4>
					                                <div class="inner" style="margin-top:-45px">
					                                	<a href="#" style="color:#fff">
					                                	<div style="text-align:center;width:80px;height:80px;border-radius:80px;background:#fff;float:right;padding:10px;">
						                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:9px;">
							                                    	<h4><b><?echo number_format($p1[total],"0","",".")?></b></h4>
						                                    </div>
					                                    </div>
					                                    </a>
					                                </div>
							                </div>
							            </div>	
							            <div class="col-xs-4">		                
							                <div class="small-box bg-orange" style="text-align:left;height:75px;border-radius:10px 10px 0 0;margin-top:0px;padding:10px 0 0 0;border-bottom: 5px solid #fff">
							                	<h4 style="padding-left:20px">PENJUALAN <b>CASH</b></h4>
					                                <div class="inner" style="margin-top:-45px">
					                                	<a href="#" style="color:#fff">
					                                	<div style="text-align:center;width:80px;height:80px;border-radius:80px;background:#fff;float:right;padding:10px;">
						                                	<div class="bg-orange" style="width:60px;height:60px;border-radius:60px;padding:9px;">
							                                    	<h4><b><?echo number_format($p2[total],"0","",".")?></b></h4>
						                                    </div>
					                                    </div>
					                                    </a>
					                                </div>
							                </div>
							            </div>	
							            <div class="col-xs-4">		                
							                <div class="small-box bg-blue" style="text-align:left;height:75px;border-radius:10px 10px 0 0;margin-top:0px;padding:10px 0 0 0;border-bottom: 5px solid #fff">
							                	<h4 style="padding-left:20px">PENJUALAN <b>KREDIT</b></h4>
					                                <div class="inner" style="margin-top:-45px">
					                                	<a href="#" style="color:#fff">
					                                	<div style="text-align:center;width:80px;height:80px;border-radius:80px;background:#fff;float:right;padding:10px;">
						                                	<div class="bg-blue" style="width:60px;height:60px;border-radius:60px;padding:9px;">
							                                    	<h4><b><?echo number_format($p3[total],"0","",".")?></b></h4>
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
												<th width="10%">TANGGAL PENJUALAN <?//echo $_REQUEST[idsales]?></th>
												<th>NAMA SALES</th>
												<th>NAMA PELANGGAN</th>
												<th width="30%">BARANG</th>
												<th>JENIS TRANSAKSI</th>
												<th width="20%">LEASING</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											while($dX = mysql_fetch_array($qB))
												{
												$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dX[idpelanggan]'"));
												$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dX[idleasing]'"));
												$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dX[idsales]'"));
												if($dX[jnstransaksi]=="KREDIT"){
													$leasing = $d3[namaleasing];
													$jnstransaksi = $dX[jnstransaksi];
													}
												else if($dX[jnstransaksi]=="CASH"){
													$jnstransaksi = $dX[jnstransaksi];
													$leasing = "";
													}
												else{
													$jnstransaksi = "$dX[jnstransaksi] $dX[jnscashtempo]";
													}
											?>
													<tr>
														<td align="center"><?echo tgl_indo1($dX[tglnota])?></td>
														<td align="left"><span style="margin-left:0%"><?echo $d6[nama]?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo $d1[nama]?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo "$dX[namabarang] | $dX[kodebarang]</br>$dX[varian] | $dX[warna]"?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo $jnstransaksi?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo $leasing?></span></td>
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
                    	
		            else if($mod=='bulanan')
		            	{
		            ?>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                                <li class="active"><a href="#tab_2-2" data-toggle="tab">Tahunan</a></li>
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=harian"?>">Bulanan</a></li>
                                <li class="pull-left header"><h4>KINERJA SALES <small>INDIVIDU</small></h4></li>
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
										if(!empty($_REQUEST[idsales]))
											{
											$qB = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota IN (SELECT nonota FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]')");
											$p1 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun' AND idsales='$_REQUEST[idsales]'"));
											$p2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun' AND jnstransaksi!='KREDIT' AND idsales='$_REQUEST[idsales]'"));
											$p3 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun' AND jnstransaksi='KREDIT' AND idsales='$_REQUEST[idsales]'"));
                                    		}
										else
											{
											$qB = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota IN (SELECT nonota FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun')");
											$p1 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun'"));
											$p2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun' AND jnstransaksi!='KREDIT'"));
											$p3 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE id%2=0 AND tahun='$periode_tahun' AND jnstransaksi='KREDIT'"));
											}
                                    	?>
                                    		<tr>
                                    			<td><select name="idsales" class="form-control" id="select1" style="font-size:12px;padding:3px">
																		<option value='' selected>SEMUA COUNTER SALES & SALES</option>
																		<?
																			$q1 = mysql_query("SELECT id,nama FROM tbl_karyawan WHERE id%2=0 AND posisi IN ('2','7') ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($_REQUEST[idsales]==$dA[id]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
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
									
									<div class="col-xs-12" style="width:200%;margin:0 auto;margin-top:10px">
				                        <table id="example3" class="table table-striped table-bordered">
				                            <thead style="cursor:pointer">
												<th class="btn-info" style="text-align:center">TANGGAL PENJUALAN</th>
												<th class="btn-info" style="text-align:center">NAMA SALES</th>
												<th class="btn-info" style="text-align:center">NAMA PELANGGAN</th>
												<th class="btn-info" style="text-align:center">BARANG</th>
												<th class="btn-info" style="text-align:center">TRANSAKSI</th>
												<th class="btn-info" style="text-align:center">LEASING</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											while($dX = mysql_fetch_array($qB))
												{
												$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$dX[nonota]'"));
												$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dB[idpelanggan]'"));
												$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[idsales]'"));
												$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dB[idleasing]'"));
												$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dX[idbarang]'"));
				                            	if(!empty($d3[namaleasing])){
													$leasing = $d3[namaleasing];
													}
												else{
													$leasing = "CASH";
													}
												
											    $tanggal = $dB[tglnota];
											?>
													<tr>
														<td align="CENTER"><?echo tgl_indo1("$tanggal")?></td>
														<td align="left"><span style="margin-left:0%"><?echo $d2[nama]?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo $d1[nama]?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo "$d4[namabarang] | $d4[kodebarang]] | $d4[varian] | $d4[warna]"?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo $dB[jnstransaksi]?></span></td>
														<td align="left"><span style="margin-left:0%"><?echo $leasing?></span></td>
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
		
        <script src="js/jquery.min.js"></script>
        
        <script>
        //SELECT2
			$(function(){
			  var select = $('#select1').select2();
			}); 
			$(document).ready(function() {});
		</script>

        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>