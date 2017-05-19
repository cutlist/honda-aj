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
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>AKTIVITAS BISNIS <small>RINGKASAN ARUS BARANG</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:LEFT;width:65%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" required="" style="height:33px" placeholder="Pilih Periode Tgl Tiba (Barang Masuk) / Tgl Nota Jual (Barang Keluar) / Tgl Pindah (Pindah Lokasi)" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
	                           		<div style="float:right" class="col-xs-4">
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h2/abis_arusbarang.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{    
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:200%;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="2"><b><center>TANGGAL TIBA</center></b></td>
												<td colspan="9" style="font-size:14px"><b><center>BARANG MASUK</center></b></td>
											</tr>
											<tr>
												<!-- BARANG MASUK 
												<th>KELOMPOK</th>-->
												<th>KODE BARANG</th>
												<th>NAMA BARANG</th>
												<th>VARIAN</th>
												<th>NAMA SUPPLIER</th>
												<th>NO. NOTA BELI</th>
												<th>LOKASI GUDANG AWAL</th>
												<th>LOKASI RAK AWAL</th>
												<th width="5%">QTY MASUK (PCS)</th>
												<th width="5%">TOTAL QTY MASUK (PCS)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            if(!empty($_REQUEST[periode]))
			                            	{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											while (strtotime($awal) <=  strtotime($akhir)) 
				                            	{
			                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det2_vw WHERE id%2=0 AND jns='PEMBELIAN' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak"));
			                                	if(!empty($dA[id]))
			                                		{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
					                                  <!--  
					                                    <td>PEMBELIAN</td>
				                                     	BARANG MASUK PEMBELIAN -->
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
					                                    		<span style="margin-right:30%"><?echo number_format(round($dB[qty]/2),"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_notabeli_det2_vw WHERE jns='PEMBELIAN' AND tgltiba='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format(round($dB[tot]/2),"0","",".")?></span>
					                                	</td>
					                                </tr>
					                                
					                            <?
					                            	}
					                            	
					                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND jns='CLAIM' AND tgltiba='$awal' GROUP BY idbarang,idgudang,rak"));
			                                	if(!empty($dA[id]))
			                                		{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($awal))?></td>
					                                    <!--
					                                    <td>CLAIM</td>
				                                     	BARANG MASUK CLAIM -->
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
					                                    		<span style="margin-right:30%"><?echo number_format(round($dB[qty]/2),"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_notabeli_det2_vw WHERE jns='CLAIM' AND tgltiba='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format(round($dB[tot]/2),"0","",".")?></span>
					                                	</td>
					                                </tr>
					                            <?
					                            	}
													$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
					                        	}
					                        }
				                        ?>
			                            </tbody>
			                        </table>
		                    		<div class="clearfix"></div>
			                        <table id="example3" class="table table-bordered table-striped table-hover" style="width:230%;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="2"><b><center>TGL NOTA JUAL/</br>TGL NOTA SERVIS</center></b></td>
												<td colspan="14" style="font-size:14px"><b><center>BARANG KELUAR</center></b></td>
											</tr>
											<tr>
												<!-- BARANG KELUAR 
												<th>KELOMPOK</th>
												-->
												<th>KODE BARANG</th>
												<th>NAMA BARANG</th>
												<th>VARIAN</th>
												<th>NAMA SUPPLIER</th>
												<th>NO. NOTA BELI</th>
												<th>TGL NOTA BELI</th>
												<th>NO. NOTA JUAL/</br>NO. NOTA SERVIS</th>
												<th>NO. NOTA RETUR BELI</th>
												<th>TGL NOTA RETUR BELI</th>
												<th>LOKASI GUDANG</th>
												<th>LOKASI RAK</th>
												<th>QTY KELUAR (PCS)</th>
												<th>TOTAL QTY KELUAR (PCS)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            if(!empty($_REQUEST[periode]))
			                            	{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											
											while (strtotime($awal) <=  strtotime($akhir)) 
				                            	{
					                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND notabeli!='CLAIM' AND tglnota='$awal' GROUP BY idbarang,idgudang,rak,notabeli"));
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
					                                    		<span style="margin-right:30%"><?echo number_format(round($dB[qty]/2),"0","",".")?></span>
							                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
														<?
																}
						                                ?>	
					                                	</td>
						                                <?
						                                	$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS tot FROM x23_notajual_det_vw WHERE notabeli!='CLAIM' AND tglnota='$awal'"));
						                                ?>
				                                   		<td align="right">
					                                    		<span style="margin-right:30%"><?echo number_format(round($dB[tot]/2),"0","",".")?></span>
					                                	</td>
					                                </tr>
					                            <?
					                            	}
													$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
					                        	}
					                        }
				                        ?>
			                            </tbody>
			                        </table>
		                    		<div class="clearfix"></div>
			                        <table id="example4" class="table table-bordered table-striped table-hover" style="width:200%;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="2"><b><center>TANGGAL PINDAH</center></b></td>
												<td colspan="12" style="font-size:14px"><b><center>PINDAH LOKASI</center></b></td>
											</tr>
											<tr>
												<!-- PINDAH LOKASI -->
												<th>KODE BARANG</th>
												<th>NAMA BARANG</th>
												<th>VARIAN</th>
												<th>NAMA SUPPLIER</th>
												<th>NO. NOTA BELI</th>
												<th>TGL NOTA BELI</th>
												<th>DARI GUDANG</th>
												<th>DARI RAK</th>
												<th>KE GUDANG</th>
												<th>KE RAK</th>
												<th>QTY PINDAH (PCS)</th>
												<th>TOTAL QTY PINDAH (PCS)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            if(!empty($_REQUEST[periode]))
			                            	{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											
											while (strtotime($awal) <=  strtotime($akhir)) 
				                            	{
			                                	$dA = mysql_fetch_array(mysql_query("SELECT id FROM x23_pindah WHERE id%2=0 AND tanggal='$awal'"));
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
					                        }
				                        ?>
			                            </tbody>
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
                $('#example4').dataTable({
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