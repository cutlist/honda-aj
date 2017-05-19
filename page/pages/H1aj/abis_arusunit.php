<?
	if(!empty($_REQUEST[update]))
		{
		$nostnk		= strtoupper($_REQUEST[nostnk]);
		$nobpkb		= strtoupper($_REQUEST[nobpkb]);
		mysql_query("UPDATE tbl_notajual_det SET
										statusleasing='$_REQUEST[statusleasing]',								
										statusbbn='$_REQUEST[statusbbn]',								
										nostnk='$nostnk',								
										nobpkb='$nobpkb'
									WHERE 	
										norangka='$_REQUEST[update]'						
						");
		}
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
			                	<h4>AKTIVITAS BISNIS <small>ARUS UNIT</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:75%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" placeholder="Pilih Periode Tgl Beli (Barang Masuk) / Tgl Jual (Barang Keluar) / Tgl Mutasi (Mutasi Antar Dealer)" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?><td width="1%">
													<button type="button"  onclick="window.open('printaj/h1/abis_arusunit.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                       			
                                    			</td>
				                       			<?
				                       				}
				                       			?>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
										
	                            <?
		                            if(!empty($_REQUEST[periode]))
		                            	{
			                    ?>
				                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan='2'><center>TANGGAL BELI</center></th>
													<th colspan="7" style="background-color:#"><center>BARANG MASUK</center></th>
												</tr>
												<tr>
													<!-- BARANG MASUK -->
													<th style="background-color:#">KODE BARANG</th>
													<th style="background-color:#">NAMA BARANG</th>
													<th style="background-color:#">VARIAN</th>
													<th style="background-color:#">WARNA</th>
													<th style="background-color:#">LOKASI GUDANG</th>
													<th style="background-color:#">QTY MASUK (UNIT)</th>
													<th style="background-color:#">TOTAL (UNIT)</th>
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND nodo!='' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND nodo!='' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND nodo!='' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND nodo!='' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND nodo!='' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND nodo!='' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_notabeli_det_vw WHERE id%2=0 AND tglnota='$awal' AND tglnota='$awal' AND nodo!=''");
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
													<th rowspan='2'><center>TANGGAL JUAL</center></th>
													<th colspan="7" style="background-color:#"><center>BARANG KELUAR</center></th>
												</tr>
												<tr>
													<!-- BARANG KELUAR -->
													<th style="background-color:#">KODE BARANG</th>
													<th style="background-color:#">NAMA BARANG</th>
													<th style="background-color:#">VARIAN</th>
													<th style="background-color:#">WARNA</th>
													<th style="background-color:#">LOKASI GUDANG</th>
													<th style="background-color:#">QTY KELUAR (UNIT)</th>
													<th style="background-color:#">TOTAL (UNIT)</th>
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal' GROUP BY namabarang,varian,gudang");
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
					                                	$qB = mysql_query("SELECT *,COUNT(nonota) AS tot FROM tbl_abis_arusunit1 WHERE SUBSTR(nonota,-3,3)%2=0 AND tglnota='$awal'");
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
													<th rowspan='2'><center>TANGGAL MUTASI</center></th>
													<th colspan="8" style="background-color:#"><center>MUTASI ANTAR GUDANG</center></th>
												</tr>
												<tr>
													<!-- PINDAH LOKASI -->
													<th style="background-color:#">KODE BARANG</th>
													<th style="background-color:#">NAMA BARANG</th>
													<th style="background-color:#">VARIAN</th>
													<th style="background-color:#">WARNA</th>
													<th style="background-color:#">GUDANG ASAL</th>
													<th style="background-color:#">GUDANG TUJUAN</th>
													<th style="background-color:#">QTY MUTASI (UNIT)</th>
													<th style="background-color:#">TOTAL (UNIT)</th>
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
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT idgudang1 FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT idgudang2 FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal' GROUP BY namabarang,varian");
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
					                                	$qB = mysql_query("SELECT *,COUNT(idpindah) AS tot FROM tbl_abis_arusunit2 WHERE id%2=0 AND tanggal='$awal'");
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
			                    		
				                        <table id="example6" class="table table-bordered table-striped table-hover" style="width:120%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan='2'><center>TANGGAL MUTASI</center></th>
													<th colspan="10" style="background-color:#"><center>MUTASI ANTAR DEALER</center></th>
												</tr>
												<tr>
													<!-- PINDAH LOKASI -->
													<th style="background-color:#">KODE BARANG</th>
													<th style="background-color:#">NAMA BARANG</th>
													<th style="background-color:#">VARIAN</th>
													<th style="background-color:#">WARNA</th>
													<th style="background-color:#">DEALER ASAL</th>
													<th style="background-color:#">GUDANG ASAL</th>
													<th style="background-color:#">DEALER TUJUAN</th>
													<th style="background-color:#">GUDANG TUJUAN</th>
													<th style="background-color:#">QTY MUTASI (UNIT)</th>
													<th style="background-color:#">TOTAL (UNIT)</th>
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal' GROUP BY notransfer");
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
					                                	$qB = mysql_query("SELECT *,COUNT(id) AS tot FROM tbl_transfer WHERE id%2=0 AND tgltransfer='$awal'");
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
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
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
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example5').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example6').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
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