<?
	if($submenu == 'A')
		{
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
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:35%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px" required="">
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
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px" required="">
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
									</div>
                                    </br>
                                    </form>
                                    </br>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{         
			                    ?>
				                        <table id="example5" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th width="10%">TANGGAL</th>
													<th>KASUS</th>
													<th>STATUS</th>
												</tr>
											</thead>
				                            <tbody>
				                                <tr style="cursor:pointer;">
				                                    <td colspan="3"></td>
				                                </tr>
					                        <?
					                       	/*
												$dA  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND bensinawal > literawal"));
												if(!empty($dA[id]))
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">MELEBIHKAN BENSIN AWAL</b></td>
					                                </tr>
											<?
													$q1	 = mysql_query("SELECT * FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND bensinawal > literawal ORDER BY tanggal");
													while($d1  = mysql_fetch_array($q1))
														{
						                            	if($d1[lihat]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Direspon</span>";$red="";}
						                            	if($d1[lihat]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Membutuhkan Respon</span>";$red="color:red";}
					                        ?>
														<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
					                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
															<td>NO. RANGKA <?echo $d1[norangka]?> CHECKER <?echo $d1[nama]?></td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
														}
													}
											*/
												$dA  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notabeli WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahanacc IN ('1','2')"));
												if(!empty($dA[id]))
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">JUMLAH AKSESORIS MASUK TIDAK SAMA DENGAN JUMLAH AKSESORIS PADA NOTA BELI</b></td>
					                                </tr>
											<?
													$q1	 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahanacc IN ('1','2')");
													while($d1  = mysql_fetch_array($q1))
														{
							                            	if($d1[ikesalahanacc]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Direspon</span>";$red="";}
							                            	if($d1[ikesalahanacc]=="1"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Membutuhkan Respon</span>";$red="color:red";}
							                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_stokunit_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
					                        ?>
															<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=F&id=$d1[nonota]"?>'"> 
						                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
																<td>NO. NOTA BELI <?echo "$d1[nonota] PENANGGUNG JAWAB $d2[nama]"?> </td>
																<td align='center'><?echo $status?></td>
															</tr>
											<?	
														}
													}
													
												$dA  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahan!='0' ORDER BY tanggal"));
												if(!empty($dA[id]))
													{
											?>
					                                <tr style="cursor:pointer;">
				                                    	<td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">KELENGKAPAN KURANG / KONDISI UNIT TIDAK BAIK</b></td>
					                                </tr>
											<?
													$q1	 = mysql_query("SELECT * FROM tbl_cekfisik_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND ikesalahan!='0' ORDER BY tanggal");
													while($d1  = mysql_fetch_array($q1))
														{
														$dCek = mysql_fetch_array(mysql_query("SELECT status FROM tbl_notajual WHERE id%2=0 AND nonota='$d1[nonota]'"));
														if($dCek[status]=="1")
															{
							                            	if($d1[ikesalahan]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Direspon</span>";$red="";}
							                            	if($d1[ikesalahan]=="1"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Membutuhkan Respon</span>";$red="color:red";}
					                        ?>
															<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&id=$d1[id]"?>'">
						                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
																<td>NO. RANGKA <?echo $d1[norangka]?> CHECKER <?echo $d1[nama]?></td>
																<td align='center'><?echo $status?></td>
															</tr>
											<?
															}
														}
													}
													
												$dA  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notabeli_det3_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND (status='0' OR ikesalahan='1') ORDER BY tglnota"));
												if(!empty($dA[id]))
													{
											?>
					                                <tr style="cursor:pointer;">
				                                    	<td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">JUMLAH UNIT MASUK TIDAK SAMA DENGAN JUMLAH UNIT PADA NOTA BELI</b></td>
					                                </tr>
											<?
													$q1	 = mysql_query("SELECT *,COUNT(norangka) AS total FROM tbl_notabeli_det3_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND (status='0' OR ikesalahan='1') GROUP BY nonota ORDER BY tglnota");
													while($d1  = mysql_fetch_array($q1))
														{
							                            	if($d1[ikesalahan]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Direspon</span>";$red="";}
							                            	if($d1[ikesalahan]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Membutuhkan Respon</span>";$red="color:red";}
							                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_stokunit_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
					                        ?>
															<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&id=$d1[nonota]"?>'"> 
						                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
																<td>NO. NOTA BELI <?echo "$d1[nonota] PENANGGUNG JAWAB $d2[nama]"?> </td>
																<td align='center'><?echo $status?></td>
															</tr>
											<?	
														}
													}
													
											?>
				                                <tr style="cursor:pointer;">
				                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOCK OPNAME BULANAN H1</b></td>
				                                </tr>
											<?		
												$d1  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_opname_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun'"));
												if(empty($d1[id]))
													{
						                            $status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Dilakukan</span>";
						                            $red = "color:red";
						                            $pic = "";
					                       			}
					                       		else{
						                            $status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Dilakukan</span>";
						                            $red = "";
						                            $pic = "PENANGGUNG JAWAB $d1[nama]";
													}
											?>
														<tr style='cursor:pointer;<?echo $red?>'>
					                                    	<td align="center"><?echo "$periode_bulan-$periode_tahun"?></td>
															<td>STOCK OPNAME H1 <?echo "BULAN $periode_bulan TAHUN $periode_tahun $pic"?></td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
												$tglsampai = date("Y-m-d");
												//$dA  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND '$tglsampai' > tanggal AND tglsampai2=='0000-00-00' ORDER BY tanggal"));
												$dA  = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND '$tglsampai' > tanggal AND tglsampai2='0000-00-00'"));
												if(!empty($dA[id]))
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">KETERLAMBATAN PENGIRIMAN BARANG</b></td>
					                                </tr>
					                        <?
													//$q1	 = mysql_query("SELECT * FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND '$tglsampai' > tanggal AND tglsampai2!='0000-00-00' ORDER BY tanggal");
													$q1	 = mysql_query("SELECT * FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' AND '$tglsampai' > tanggal AND tglsampai2='0000-00-00'");
													while($d1  = mysql_fetch_array($q1))
														{
						                            	if($d1[ikesalahan]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'> Direspon</span>";$red="";}
						                            	if($d1[ikesalahan]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Membutuhkan Respon</span>";$red="color:red";}
					                        ?>
														<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=E&id=$d1[norangka]"?>'">
					                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
															<td>NO. NOTA JUAL <?echo $d1[nonota]?> NO. RANGKA <?echo $d1[norangka]?> DRIVER <?echo $d1[nama]?></td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
														}
													}
													
					                            $dIb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT'"));
												$dOb = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT'"));
												$dTb = $dIb[total]-$dOb[total];
												if($dTb < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK BENSIN KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style='cursor:pointer;<?echo $red?>' onclick="location.href='<?echo "?opt=".md5(gpdi)."&submenu=A&menu=".md5(bensin)?>'" target="_blank">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK BENSIN SAAT INI KURANG DARI 0 (NOL)</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(accu) AS accu,SUM(jual) AS jual FROM stok_accu"));
												$dSa1X = $dSa1[accu]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK ACCU KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK ACCU SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(alaskaki) AS alaskaki,SUM(jual) AS jual FROM stok_alaskaki"));
												$dSa1X = $dSa1[alaskaki]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK ALAS KAKI KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK ALAS KAKI SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(anakkunci) AS anakkunci,SUM(jual) AS jual FROM stok_anakkunci"));
												$dSa1X = $dSa1[anakkunci]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK ANAK KUNCI KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK ANAK KUNCI SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(bukuservis) AS bukuservis,SUM(jual) AS jual FROM stok_bukuservis"));
												$dSa1X = $dSa1[bukuservis]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK BUKU SERVIS KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK BUKU SERVIS SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(helm) AS helm,SUM(jual) AS jual FROM stok_helm"));
												$dSa1X = $dSa1[helm]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK HELM KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK HELM SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(jaket) AS jaket,SUM(jual) AS jual FROM stok_jaket"));
												$dSa1X = $dSa1[jaket]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK JAKET KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK JAKET SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(spion) AS spion,SUM(jual) AS jual FROM stok_spion"));
												$dSa1X = $dSa1[spion]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK SPION KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK SPION SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
													
					                            $dSa1  = mysql_fetch_array(mysql_query("SELECT SUM(toolkit) AS toolkit,SUM(jual) AS jual FROM stok_toolkit"));
												$dSa1X = $dSa1[toolkit]-$dSa1[jual];
												if($dSa1X < 0)
													{
											?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="3" style="background-color:#40995b;color:#fff"><b style="padding:20px">STOK TOOLKIT KURANG DARI 0 (NOL)</b></td>
					                                </tr>
					                        <?
						                            	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Stok Minus</span>";
						                            	$red    = "color:red";
					                        ?>
														<tr style="<?echo $red?>">
					                                    	<td align="center"><?echo date("d-m-Y")?></td>
															<td>STOK TOOLKIT SAAT INI <?echo $dSa1X?> PCS</td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?
													}
											?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="10">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                    		<div class="clearfix"></div>
								<?
				                	}
				                ?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		mysql_query("UPDATE tbl_cekfisik SET lihat='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
		
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$d5[nonota]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dB[norangka]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[iduserpdi]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>GUDANG & PDI <small>CEK FISIK</small></h4>

					            	<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. PDI</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nopdi]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL CEK FISIK</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($d5[tanggal]))?>" style="width: 40%" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" style="width: 100%" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
														<option value=''>Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>EMAIL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            
			                    	<?
	                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]' GROUP BY nonota"));
	                            	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND nonota='$dB[nonota]'");
	                            	?>	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    	</table>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            <table width="100%" class="table table-striped">
			                    	<?
	                            	while($dTemp = mysql_fetch_array($qTemp))
			                    		{
										$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
										$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
			                    	?>
		                            	
		                            	<tr><td>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="40%">NO. RANGKA</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><?echo $dTemp[norangka]?></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. MESIN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $dU[nomesin]?></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KODE BARANG</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $dA[kodebarang]?></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA BARANG</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $dA[namabarang]?></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="40%">VARIAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><?echo $dA[varian]?></td>
					                    		</tr>
					                    		<tr>
					                    			<td>WARNA</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $dA[warna]?></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TAHUN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $dA[thnproduksi]?></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                    	<div class="clearfix" style="border-bottom:1px #eee dashed;margin:0 10px; margin-bottom:5px"></div>
				                    	
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="40%">NO. RANGKA</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $dTemp[norangka]?>" class="form-control" maxlength="40" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. MESIN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $dU[nomesin]?>" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BENSIN AWAL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
															<option value='1' <?if($dTemp[bensinawal]=='1'){?>selected=""<?}?>>1 LITER</option>
															<option value='2' <?if($dTemp[bensinawal]=='2'){?>selected=""<?}?>>2 LITER</option>
														</select></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="40%">ANAK KUNCI 2 PCS </td>
					                    			<td width="5%">:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>SPION</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>ACCU</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TOOLKIT</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>HELM</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>ALAS KAKI</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>CEK FISIK 2 LBR</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KONDISI MOTOR</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='1'){?>checked=""<?}?>> BAIK</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='0'){?>checked=""<?}?>> TIDAK BAIK</label></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                    	<input type="hidden" name="idbarang<?echo $dTemp[id]?>" value="<?echo $d4[idbarang]?>">
				                    	<div class="clearfix"></div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	</td></tr>
			                    	<?
			                    		}
			                    	?>
		                            </table>
		                            
				                    </div>
		                            	
			                        <div class="modal-footer clearfix">
			                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'C')
		{
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$d5[nonota]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$d5[norangka]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[iduserpdi]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>GUDANG & PDI <small>CEK FISIK <?//echo $d4[nonota].$d5[norangka]?></small></h4>

					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C2"?>" enctype="multipart/form-data">
					            	<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. PDI</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nopdi]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL CEK FISIK</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($d5[tanggal]))?>" style="width: 40%" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" style="width: 100%" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
														<option value=''>Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>EMAIL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            
			                    	<?
	                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]' GROUP BY nonota"));
	                            	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND nonota='$dB[nonota]'");
	                            	?>	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    	</table>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
			                            <table width="100%" class="table table-striped">
				                    	<?
		                            	while($dTemp = mysql_fetch_array($qTemp))
				                    		{
											$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
											$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
				                    	?>
			                            	
			                            	<tr>
				                            	<td>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">NO. RANGKA</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><?echo $dTemp[norangka]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NO. MESIN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dU[nomesin]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>KODE BARANG</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[kodebarang]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NAMA BARANG</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[namabarang]?></td>
							                    		</tr>
					                            	</table>
						                    	</div>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">VARIAN</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><?echo $dA[varian]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>WARNA</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[warna]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>TAHUN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[thnproduksi]?></td>
							                    		</tr>
					                            	</table>
						                    	</div>
						                    	<div class="clearfix" style="border-bottom:1px #eee dashed;margin:0 10px; margin-bottom:5px"></div>
						                    	
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">NO. RANGKA</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><input type="text" value="<?echo $dTemp[norangka]?>" class="form-control" maxlength="40" readonly=""></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NO. MESIN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><input type="text" value="<?echo $dU[nomesin]?>" class="form-control" maxlength="20" readonly=""></td>
							                    		</tr>
							                    		<tr>
							                    			<td>BENSIN AWAL</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
																	<option value='1' <?if($dTemp[bensinawal]=='1'){?>selected=""<?}?>>1 LITER</option>
																	<option value='2' <?if($dTemp[bensinawal]=='2'){?>selected=""<?}?>>2 LITER</option>
																</select></td>
							                    		</tr>
					                            	</table>
						                    	</div>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">ANAK KUNCI 2 PCS </td>
							                    			<td width="5%">:</td>
							                    			<td colspan="2"><select name="anakkunci<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[anakkunci]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[anakkunci]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[anakkunci]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>SPION</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="spion<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[spion]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[spion]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[spion]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>ACCU</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="accu<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[accu]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[accu]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[accu]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>TOOLKIT</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="toolkit<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[toolkit]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[toolkit]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[toolkit]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>HELM</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="helm<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[helm]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[helm]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[helm]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>ALAS KAKI</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="alaskaki<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[alaskaki]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[alaskaki]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[alaskaki]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>JAKET</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="jaket<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[jaket]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[jaket]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[jaket]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>BUKU SERVIS</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="bukuservis<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[bukuservis]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[bukuservis]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[bukuservis]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>CEK FISIK 2 LBR</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="cekfisik<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[cekfisik]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[cekfisik]=='1'){?>selected=""<?}?>>ADA</option>
																	<option value='0' <?if($dTemp[cekfisik]=='0'){?>selected=""<?}?>>TIDAK ADA</option>
																</select></td>
							                    		</tr>
							                    		<tr>
							                    			<td>KONDISI MOTOR</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select name="kondisimotor<?echo $dTemp[id]?>" class="form-control" style="width: 60%" <?if($dTemp[kondisimotor]=='1'){?>disabled=""<?}else{?>required=""<?}?>>
																	<option value='1' <?if($dTemp[kondisimotor]=='1'){?>selected=""<?}?>>BAIK</option>
																	<option value='0' <?if($dTemp[kondisimotor]=='0'){?>selected=""<?}?>>TIDAK BAIK</option>
																</select></td>
							                    		</tr>
					                            	</table>
					                    		</div>
					                    		<div class="clearfix"></div>
			                            		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            		</td>
			                            	</tr>
				                    	<?
				                    		}
				                    	?>
		                           		</table>
		                            
				                    </div>
		                            	
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
				                    	<input type="hidden" name="notabeli" value="<?echo $d4[nonota]?>">
			                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan  Perubahan</button>
			                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				               	</form>
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'C2')
		{
		//echo "<script>alert ('$_REQUEST[nonota].')</script>";
		//exit();
        $qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
    	while($dTemp = mysql_fetch_array($qTemp))
    		{
    		$id 			= $dTemp[id];
    		$norangka		= $dTemp[norangka];
			$accuX 			= $_REQUEST[accu.$id];
			$alaskakiX 		= $_REQUEST[alaskaki.$id];
			$anakkunciX 	= $_REQUEST[anakkunci.$id];
			$helmX 			= $_REQUEST[helm.$id];
			$spionX 		= $_REQUEST[spion.$id];
			$toolkitX 		= $_REQUEST[toolkit.$id];
			$jaketX 		= $_REQUEST[jaket.$id];
			$bukuservisX 	= $_REQUEST[bukuservis.$id];
			$cekfisikX 		= $_REQUEST[cekfisik.$id];
			$kondisimotorX 	= $_REQUEST[kondisimotor.$id];
			/////////////////////////////////////////////////	
    		if($accuX == ''){
				$accu = '1';
				}
    		else if($accuX == "0" || $accuX == "1"){
				$accu = $accuX;
				}
			/////////////////////////////////////////////////	
    		if($alaskakiX == ''){
				$alaskaki = '1';
				}
    		else if($_REQUEST[alaskaki.$id] == "0" || $_REQUEST[alaskaki.$id] == "1"){
				$alaskaki = $alaskakiX;
				}
			/////////////////////////////////////////////////
    		if($anakkunciX == ''){
				$anakkunci = '1';
				}
    		else if($_REQUEST[anakkunci.$id] == "0" || $_REQUEST[anakkunci.$id] == "1"){
				$anakkunci = $anakkunciX;
				}
			/////////////////////////////////////////////////	
    		if($helmX == ''){
				$helm = '1';
				}
    		else if($_REQUEST[helm.$id] == "0" || $_REQUEST[helm.$id] == "1"){
				$helm = $helmX;
				}
			/////////////////////////////////////////////////	
    		if($spionX == ''){
				$spion = '1';
				}
    		else if($_REQUEST[spion.$id] == "0" || $_REQUEST[spion.$id] == "1"){
				$spion = $spionX;
				}
			/////////////////////////////////////////////////	
    		if($toolkitX == ''){
				$toolkit = '1';
				}
    		else if($_REQUEST[toolkit.$id] == "0" || $_REQUEST[toolkit.$id] == "1"){
				$toolkit = $toolkitX;
				}
			/////////////////////////////////////////////////	
    		if($jaketX == ''){
				$jaket = '1';
				}
    		else if($_REQUEST[jaket.$id] == "0" || $_REQUEST[jaket.$id] == "1"){
				$jaket = $jaketX;
				}
			/////////////////////////////////////////////////	
    		if($bukuservisX == ''){
				$bukuservis = '1';
				}
    		else if($_REQUEST[bukuservis.$id] == "0" || $_REQUEST[bukuservis.$id] == "1"){
				$bukuservis = $bukuservisX;
				}
			/////////////////////////////////////////////////	
    		if($cekfisikX == ''){
				$cekfisik = '1';
				}
    		else if($_REQUEST[cekfisik.$id] == "0" || $_REQUEST[cekfisik.$id] == "1"){
				$cekfisik = $cekfisikX;
				}
			/////////////////////////////////////////////////	
    		if($kondisimotorX == ''){
				$kondisimotor = '1';
				}
    		else if($_REQUEST[kondisimotor.$id] == "0" || $_REQUEST[kondisimotor.$id] == "1"){
				$kondisimotor = $kondisimotorX;
				}
				
			//echo "<script>alert ('$helm.$dA[helm].$_REQUEST[nonota]')</script>";
			//exit();
			
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND norangka='$norangka'"));
			if($dA[helm]=='0' AND $helm=='1'){
				mysql_query("UPDATE stok_helm SET jual=jual+1 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			if($dA[spion]=='0' AND $spion=='1'){
				mysql_query("UPDATE stok_spion SET jual=jual+2 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			if($dA[accu]=='0' AND $accu=='1'){
				mysql_query("UPDATE stok_accu SET jual=jual+1 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			if($dA[toolkit]=='0' AND $toolkit=='1'){
				mysql_query("UPDATE stok_toolkit SET jual=jual+1 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			if($dA[alaskaki]=='0' AND $alaskaki=='1'){
				mysql_query("UPDATE stok_alaskaki SET jual=jual+1 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			if($dA[jaket]=='0' AND $jaket=='1'){
				mysql_query("UPDATE stok_jaket SET jual=jual+1 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			if($dA[bukuservis]=='0' AND $alaskaki=='1'){
				mysql_query("UPDATE stok_bukuservis SET jual=jual+1 WHERE id%2=0 AND nonota='$_REQUEST[notabeli]'");
				}
			
			mysql_query("UPDATE tbl_cekfisik SET
										accu='$accu', 
										alaskaki='$alaskaki', 
										anakkunci='$anakkunci', 
										helm='$helm', 
										spion='$spion', 
										toolkit='$toolkit', 
										cekfisik='$cekfisik', 
										kondisimotor='$kondisimotor', 
										ikesalahan='2', 
										updatex='$updatex'
									WHERE id%2=0 AND norangka='$norangka'
						");
			}
			
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		}
		
	else if($submenu == 'D')
		{
		mysql_query("UPDATE tbl_notabeli_det SET ikesalahan='1' WHERE id%2=0 AND status='0' AND nonota='$_REQUEST[id]'");
		//mysql_query("UPDATE tbl_notabeli SET scan='1' WHERE id%2=0 AND nonota='$_REQUEST[id]'");
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND nonota='$_REQUEST[id]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_stokunit_vw WHERE id%2=0 AND nonota='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK</small></h4>
			                	
				                	<div style="padding:20px;">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $d1[nodo]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL DO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($d1[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL PO SUPPLIER</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;" readonly=""><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        	<tr>
					                        		<td valign="top">PENANGGUNG JAWAB</td>
					                        		<td valign="top">:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d2[nama]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u2"?>">
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
				                            if($dA[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
												}
											else if($dA[status]=='0'){
												$status = "-";
												$checkbox = "<input type='checkbox' class='flat-red' name='scan[]' disabled=''/>";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$checkbox $dA[kodebarang]"?></label></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td><?echo $status?></td>
			                                </tr>
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                        </form>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'E')
		{
		mysql_query("UPDATE tbl_notajual_det SET ikesalahan='1' WHERE id%2=0 AND norangka='$_REQUEST[id]'");
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit_vw WHERE id%2=0 AND norangka='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>KETERLAMBATAN PENGIRIMAN BARANG</h4>
			                	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%">INDIKASI KESALAHAN</td>
				                        		<td width="1%">:</td>
				                        		<td><input type="text" style="width:70%" value="KETERLAMBATAN PENGIRIMAN BARANG" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NO. NOTA JUAL</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d1[nonota]?>" style="width: 25%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>NAMA DRIVER</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d1[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>TGL PENGELUARAN UNIT</td>
				                        		<td>:</td>
						                    	<td><input type="text" value="<?echo date("d-m-Y", strtotime($d1[tanggal]))?>" class="form-control" readonly="" style="width:25%"></td>
				                    		</tr>
				                    		<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
				                	<?
										$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$d1[nonota]'"));
										$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND nopesan='$dB[nopesan]'"));
										$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
										$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
										$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
										$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dB[norangka]'"));
										$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND norangka='$dB[norangka]'"));
										$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[iduserpdi]'"));
										$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[iduser]'"));
										$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE id%2=0 AND nonota='$dB[nonota]'"));
										$d9 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$dB[iduseradm]'"));
			                    	?>
				                    	<table width="70%">
										<!--
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
										-->
				                    		<tr>
				                    			<td width="30%">TANGGAL NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo date("d-m-Y",strtotime($dB[tglnota]))?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA SALES / COUNTER</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d7[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER PDI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA PELANGGAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
														<option value=''>Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>EMAIL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
			                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%"><b>DATA BPKB</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea  maxlength="100" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
														<option value=''>Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            
				                    	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]' GROUP BY nonota"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND nonota='$dB[nonota]'");
		                            	?>	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">DATA TRANSAKSI BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
			                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<div id="spoiler2" style="display:none">
				                            <table width="100%" class="table table-striped">
					                    	<?
			                            	while($dTemp = mysql_fetch_array($qTemp))
					                    		{
												$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
												$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
					                    	?>
				                            	
				                            	<tr><td>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">NO. RANGKA</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><?echo $dTemp[norangka]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NO. MESIN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dU[nomesin]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>KODE BARANG</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[kodebarang]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NAMA BARANG</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[namabarang]?></td>
							                    		</tr>
					                            	</table>
						                    	</div>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">VARIAN</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><?echo $dA[varian]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>WARNA</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[warna]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>TAHUN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[thnproduksi]?></td>
							                    		</tr>
					                            	</table>
						                    	</div>
						                    	<div class="clearfix" style="border-bottom:1px #eee dashed;margin:0 10px; margin-bottom:5px"></div>
						                    	
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">NO. RANGKA</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><input type="text" value="<?echo $dTemp[norangka]?>" class="form-control" maxlength="40" readonly=""></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NO. MESIN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><input type="text" value="<?echo $dU[nomesin]?>" class="form-control" maxlength="20" readonly=""></td>
							                    		</tr>
							                    		<tr>
							                    			<td>BENSIN AWAL</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select class="form-control" style="width: 60%"  readonly="">
																	<option value='1' <?if($dTemp[bensinawal]=='1'){?>selected=""<?}?>>1 LITER</option>
																	<option value='2' <?if($dTemp[bensinawal]=='2'){?>selected=""<?}?>>2 LITER</option>
																</select></td>
							                    		</tr>
					                            	</table>
						                    	</div>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">ANAK KUNCI 2 PCS </td>
							                    			<td width="5%">:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>SPION</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>ACCU</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>TOOLKIT</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>HELM</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>ALAS KAKI</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>CEK FISIK 2 LBR</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>KONDISI MOTOR</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='1'){?>checked=""<?}?>> BAIK</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='0'){?>checked=""<?}?>> TIDAK BAIK</label></td>
							                    		</tr>
					                            	</table>
						                    	</div>
						                    	<input type="hidden" name="idbarang<?echo $dTemp[id]?>" value="<?echo $d4[idbarang]?>">
						                    	<div class="clearfix"></div>
				                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
				                            	</td></tr>
					                    	<?
					                    		}
					                    	?>
				                            </table>
		                            	</div>
		                            	
					                    	<table width="70%">
												<!--
					                    		<tr>
					                    			<td width="30%">TANGGAL KELUAR</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo date('d-m-Y',strtotime($d8[tanggal]))?>" style="width: 25%" class="form-control" readonly></td>
					                    		</tr>
												-->
					                    		<tr>
					                    			<td width="30%">NAMA ADMIN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d9[nama]?>" style="width: 50%" class="form-control" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PENYERAHAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" readonly style="width: 50%">
																	<option value='KIRIM' <?if($d8[penyerahan]=='KIRIM'){?>selected=""<?}?>>KIRIM</option>
																	<option value='BAWA SENDIRI' <?if($d8[penyerahan]=='BAWA SENDIRI'){?>selected=""<?}?>>BAWA SENDIRI</option>
														</select></td>
					                    		</tr>
					                    		<?
					                    		if($dB[jnstransaksi]=='KREDIT')
					                    			{
												?>
						                    		<tr>
						                    			<td>ANGSURAN</td>
						                    			<td>:</td>
						                    			<td colspan="2">
						                                    <div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="angsuran" value="<?echo number_format($dB[angsuran],'0','','.')?>" class="form-control uang" value="0" style="width:34%;text-align:right" readonly="">
						                                    </div>
								                        </td>
						                    		</tr>
						                    		<tr>
						                    			<td>MASA ANGSURAN</td>
						                    			<td>:</td>
						                    			<td colspan="2">
						                                        <input type="text" name="termin" value="<?echo $dB[termin]?> Kali" class="form-control uang" value="0" style="width:15%;text-align:right" readonly="">
						                                </td>
						                    		</tr>
												<?
													}
					                    		?>
					                    	</table>
					           			<div class="col-xs-12">
					           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
					                        <div class="modal-footer clearfix">
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
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
		
	else if($submenu == 'F')
		{
		mysql_query("UPDATE tbl_notabeli SET ikesalahanacc='2' WHERE id%2=0 AND nonota='$_REQUEST[id]'");
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND nonota='$_REQUEST[id]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_stokunit_vw WHERE id%2=0 AND nonota='$_REQUEST[id]'"));
		
		$dHitung = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
		$h1 = $dHitung[total];
		$h2 = $dHitung[total]*2;
		
		$dS1 = mysql_fetch_array(mysql_query("SELECT helm FROM stok_helm WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS2 = mysql_fetch_array(mysql_query("SELECT bukuservis FROM stok_bukuservis WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS3 = mysql_fetch_array(mysql_query("SELECT spion FROM stok_spion WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS4 = mysql_fetch_array(mysql_query("SELECT accu FROM stok_accu WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS5 = mysql_fetch_array(mysql_query("SELECT jaket FROM stok_jaket WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS6 = mysql_fetch_array(mysql_query("SELECT toolkit FROM stok_toolkit WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS7 = mysql_fetch_array(mysql_query("SELECT anakkunci FROM stok_anakkunci WHERE id%2=0 AND nonota='$d1[nonota]'"));
		$dS8 = mysql_fetch_array(mysql_query("SELECT alaskaki FROM stok_alaskaki WHERE id%2=0 AND nonota='$d1[nonota]'"));
		
		if($dS1[helm] != $h1){
			$red1 = "style='color:red'";
			}
		if($dS2[bukuservis] != $h1){
			$red2 = "style='color:red'";
			}
		if($dS3[spion] != $h2){
			$rd3 = "style='color:red'";
			}
		if($dS4[accu] != $h1){
			$red4 = "style='color:red'";
			}
		if($dS6[toolkit] != $h1){
			$red6 = "style='color:red'";
			}
		if($dS7[anakkunci] != $h1){
			$red7 = "style='color:red'";
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:420px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK</small></h4>
			                	
		                        	<?
									$dHitung = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
									$h1 = $dHitung[total];
									$h2 = $dHitung[total]*2;
		                        	?>
				                	<div style="padding:20px 0px;">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $d1[nodo]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>KONFIRMASI NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d2[nama]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL DO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($d1[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL PO SUPPLIER</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>QTY TIBA</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $h1?> UNIT" class="form-control" maxlength="20" style="width:70%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;" readonly=""><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
				                	<div style="padding:20px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%" <?echo $red1?>>HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" value="<?echo $dS1[helm]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red2?>>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="bukuservis" value="<?echo $dS2[bukuservis]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red3?>>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $dS3[spion]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%" <?echo $red4?>>ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" value="<?echo $dS4[accu]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red5?>>JAKET</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="jaket" value="<?echo $dS5[jaket]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red6?>>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $dS6[toolkit]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%" <?echo $red7?>>ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="anakkunci" value="<?echo $dS7[anakkunci]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="<?echo $dS8[alaskaki]?> PCS" class="form-control" maxlength="4" style="width:80%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div> 
					                
			                    </div>
		                        <div class="modal-footer clearfix">
			                    	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
?>
			
        <script src="js/jquery.min.js"></script>
        <!-- buat angka -->
        <script type="text/javascript">
			function buat_angka(e,teks)
			{
				var goodInput = teks;
				var evt = (e)?e:window.event;
				var key_code = (document.all)?evt.keyCode:evt.which;
				
				if (key_code == 0 || key_code == 8 || key_code == 11 || key_code == 9 || key_code == 13) 
					return true;
				if (goodInput.indexOf(String.fromCharCode(key_code)) == -1)	
					return false;
				else
					return true;
			}
        </script>
        <!-- uang -->
        <script type="text/javascript">
		// memformat angka ribuan
		function formatAngka(angka) {
			 if (typeof(angka) != 'string') angka = angka.toString();
			 var reg = new RegExp('([0-9]+)([0-9]{3})');
			 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			 return angka;
			}
		
		$('.uang').on('keypress', function(e) {
			 var c = e.keyCode || e.charCode;
			 switch (c) {
			  case 8: case 9: case 27: case 13: return;
			  case 65:
			   if (e.ctrlKey === true) return;
			 }
			 if (c < 48 || c > 57) e.preventDefault();
			})
			.on('keyup', function() {
			 var inp = $(this).val().replace(/\./g, '');
		  
			 $(this).val(formatAngka(inp));
			});
		</script>
        
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example5').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>
        <script>
        //SELECT2
			$(function(){
			           
			  /* dropdown and filter select */
			  var select = $('#select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
		</script>
        <!-- datemask -->
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

            });
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();

        </script>