<?
	if($submenu == 'A')
		{	
?>
		<aside class="right-side">
		    <section class="content">
		        <div class="row">
		            <div class="col-xs-12">	
		            <?
		            if(empty($mod) || $mod=='harian')
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
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print1(){
								window.open('printaj/aruskash2.php?tahun=<?echo $periode_tahun?>&bulan=<?echo $periode_bulan?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                            	<!--
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=bulanan"?>">Tahunan</a></li>
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=tgl"?>">Harian</a></li>
                                <li class="active"><a href="#tab_1-1" data-toggle="tab">Bulanan</a></li>
                                -->
                                <li><a href="#" onClick="popup_print1()"><button type="button" class="btn btn-danger pull-left" style="margin-top:-10px"><i class="fa fa-print"></i> Export Ke Excel</button></a></li>
                                <li class="pull-left header"><h4>KASIR <small>ARUS KAS</small></h4></li>
                            </ul>
                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
                                <div class="tab-pane active">
                                    <div style="float:left;width:30%;margin-left:15px">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
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
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									<?
									$dA1   = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_bayarsup_history WHERE id%2=0 AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'"));
					                $dA2   = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='OUTPUT' AND status='1'"));
					                $dA2B  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='INPUT' AND status='1'"));
		                            $dA3   = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='piutang' AND status='1'"));
		                            $dA4S  = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='servis' AND status='1'"));
		                            $dA4J1 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah>=0 AND status='1'"));
		                            $dA4J2 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah<0 AND status='1'"));
		                            
		                            $dA4I  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='indent' AND status='1'"));
		                            $dA4I2 = mysql_fetch_array(mysql_query("SELECT SUM(jumlahho) AS total FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='indent' AND status='1'"));
		                            $dA5A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA5B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='GAJI' AND status='1' AND potkompensasi='1'"));
		                            //$dA6A  = mysql_fetch_array(mysql_query("SELECT SUM(jumlahbayarkpb) AS total FROM x23_notajual_det WHERE id%2=0 AND substr(tglbayarkpb,6,2)='$periode_bulan' AND substr(tglbayarkpb,1,4)='$periode_tahun' AND statusbayar='1'"));
		                            $dA6B  = mysql_fetch_array(mysql_query("SELECT SUM(jumlahbayar) AS total,SUM(jumlahtagih) AS total2 FROM x23_penagihankpb WHERE id%2=0 AND substr(tglpembayaran,6,2)='$periode_bulan' AND substr(tglpembayaran,1,4)='$periode_tahun' AND statuspembayaran='TERBAYAR'"));
		                            $dA8   = mysql_fetch_array(mysql_query("SELECT SUM(totuharian) AS total FROM x23_uangharian WHERE id%2=0 AND substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1'"));
		                            $dA9   = mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS total FROM x23_uanglembur WHERE id%2=0 AND substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun'"));
		                            $dA10A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'"));
		                            $dA10B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA11  = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_kompensasi WHERE id%2=0 AND substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1'"));
		                            $dA12A = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM x23_opname WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND totjumselisih>=0 AND status='1'"));
		                            $dA12B = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM x23_opname WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND totjumselisih<0 AND status='1'"));
		                            //$dA12 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('CASHTEMPO')"));
		                            
		                            $dA13 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_returjual WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'"));
		                            $dA14 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_notaretur_use WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'"));
									
									$POTdPKBdrMPM = round($dA6B[total2]*0.02,0);
		                        	
		                            $out = $dA1[total]+$dA2[total]+$dA3[total]+$dA8[total]+$dA9[total]+$dA11[total]+$dA4J2[total]+$dA12A[total]+$dA13[total];//$dA4J2[total]+$dA12A[total]+$dA13[total]
		                            $in  = $dA5A[total]+$dA5B[total]+$dA10A[total]+$dA10B[total]+$dA4S[total]+$dA4J1[total]+$dA4I[total]+$dA4I2[total]+$dA2B[total]-$dA12B[total]+$dA6A[total]+$dA14[total]+$dA6B[total]-$POTdPKBdrMPM;
		                            $re  = $in-$out;
		                            if($re < 0){
		                            	$ketre = "RUGI KOTOR";
		                            	$totre = -1*$re;
										}
		                            else if($re > 0){
		                            	$ketre = "LABA KOTOR";
		                            	$totre = $re;
										}
		                            else {
		                            	$ketre = "RESULT";
		                            	$totre = 0;
										}
									?>
                                    <div style="float:right;width:65%;margin-right:15px">
				                        <table width="100%">
				                        	<tr>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-red" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>TOTAL PENGELUARAN</b></h5>
				                        					<span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($out,"0","",".")?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-aqua" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>TOTAL PEMASUKAN</b></h5>
				                        					<span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($in,"0","",".")?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-orange" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5 style=""><b><?echo $ketre?></b></h5>
				                        					<span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($totre,"0","",".")?></span>
				                        					</div>
				                        		</td>
				                        	</tr>
				                        </table>
				                    </div>
				                    
			                        <table id="example2" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th width="10%">TANGGAL</th>
												<th>KETERANGAN</th>
												<th width="15%">UANG MASUK (RP)</th>
												<th width="15%">UANG KELUAR (RP)</th>
											</tr>
										</thead>
			                            <tbody style="font-size:12px;">
											<?
											if($dA1['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN PEMBELIAN ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN PEMBELIAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT tanggal,jumlah,nonota FROM x23_bayarsup_history WHERE id%2=0 AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notabeli_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PEMBAYARAN KE SUPPLIER NOTA BELI <?echo $d1['nonota']?> SUPLLIER <?echo $d2[nama]?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA13['total']!=0)
												{
											?>
			                            <!-- ############################ RETUR JUAL ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">RETUR JUAL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_returjual_vw WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notajual_vw WHERE id%2=0 AND nonota='$d1[nonotajual]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PEMBAYARAN RETUR JUAL NOTA RETUR <?echo $d1['noreturjual']?> UNTUK NOTA JUAL <?echo $d1['nonotajual']?> DARI <?echo $d2[nama]?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA4J2['total']!=0)
												{
											?>
			                            <!-- ############################ PENGEMBALIAN KELEBIHAN BAYAR ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGEMBALIAN KELEBIHAN BAYAR</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah<0 AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PENGEMBALIAN KELEBIHAN BAYAR NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(($d1['pembulatan']),0,",",".")?></span></td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA6B['total']!=0)
												{
											?>
			                            <!-- ############################ POTONGAN PEMBAYARAN SERVIS KPB DARI MPM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">POTONGAN PEMBAYARAN SERVIS KPB DARI MPM SEBESAR 2%</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE id%2=0 AND substr(tglpembayaran,6,2)='$periode_bulan' AND substr(tglpembayaran,1,4)='$periode_tahun' AND statuspembayaran='TERBAYAR'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE id%2=0 AND kode='$d1[kodepaket]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE id%2=0 AND nonota='$d1[nonotaservis]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglpembayaran']))?></td>
					                                    <td>POTONGAN NO. NOTA SERVIS <?echo "$d1[nonotaservis]"?> <?echo "$d2[nama]"?> A.N. <?echo "$d3[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(round(($d1['jumlahtagih']*0.02),0),0,",",".")?></span></td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA2['total']!=0)
												{
											?>
			                            <!-- ############################ PENGELUARAN KAS KECIL ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGELUARAN KAS KECIL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kaskecil WHERE id%2=0 AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='OUTPUT'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo $d1['keterangan']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA3['total']!=0)
												{
											?>
			                            <!-- ############################ PIUTANG KARYAWAN ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PIUTANG KARYAWAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='piutang' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo $d1['nama']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA8['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN UANG HARIAN ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN UANG HARIAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_uangharian WHERE id%2=0 AND substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1' AND totuharian!=0 ORDER BY updatex");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
						                    ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
					                                    <td><?echo "$d1[nama] ".date("d-m-Y",strtotime($d1['dari']))." s/d ".date("d-m-Y",strtotime($d1['sampai']))?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totuharian'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA9['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN UANG LEMBUR ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN UANG LEMBUR</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_uanglembur WHERE id%2=0 AND substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' ORDER BY updatex");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
					                                    <td><?echo "$d1[nama] TANGGAL ".date("d-m-Y",strtotime($d1['tanggal']))?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['ulembur'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA11['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN KOMPENSASI / GAJI ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN KOMPENSASI / GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kompensasi WHERE id%2=0 AND substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1' ORDER BY updatex");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
					                                    <td><?echo "$d1[nama] PERIODE $d1[bulan] $d1[tahun]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA12A['total']!=0)
												{
											?>
			                            <!-- ############################ SELISIH STOCK OPNAME ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">KERUGIAN SELISIH DARI STOCK OPNAME</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_opname_vw WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND totjumselisih > 0 ORDER BY inputx");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo "TERJADI SELISIH PADA STOCK OPNAME $d1[gudang]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totjumselisih'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA4S['total']!=0)
												{
											?>
			                            <!-- ############################ SERVIS ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">SERVIS</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='servis' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
													if($d1[pembulatan] > $d1[jumlah]){
														$ket = "(PEMBULATAN)";
														}
													else{$ket = "";}
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>SERVIS NOTA SERVIS <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama] $ket"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['pembulatan'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
					                            }
												
											if($dA4J1['total']!=0)
												{
											?>
			                            <!-- ############################ PENJUALAN BARANG ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PENJUALAN BARANG</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah>=0 AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
													if($d1[pembulatan] > $d1[jumlah]){
														$ket = "(PEMBULATAN)";
														}
													else{$ket = "";}
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PENJUALAN BARANG NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama] $ket"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['pembulatan'],0,",",".");?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA14['total']!=0)
												{
											?>
			                            <!-- ############################ RETUR BELI ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">RETUR BELI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_notaretur_use WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id%2=0 AND id='$d1[idsupplier]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>RETUR BELI NO. NOTA RETUR <?echo "$d1[noretur]"?> SUPPLIER <?echo "$d2[nama]"?> BAYAR NOTA BELI <?echo $d1[nonota2]?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA6A['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN BARANG KPB DARI MPM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN BARANG KPB DARI MPM</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND substr(tglbayarkpb,6,2)='$periode_bulan' AND substr(tglbayarkpb,1,4)='$periode_tahun' AND statusbayar='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
													$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notaservice_det1_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayarkpb']))?></td>
					                                    <td>NO. NOTA SERVIS <?echo "$d1[nonota]"?> NO. KPB <?echo "$d2[nama]"?> BARANG : <?echo "$d1[kodebarang] - $d1[namabarang] - $d1[varian]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlahbayarkpb'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA6B['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN SERVIS KPB DARI MPM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN SERVIS KPB DARI MPM</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE id%2=0 AND substr(tglpembayaran,6,2)='$periode_bulan' AND substr(tglpembayaran,1,4)='$periode_tahun' AND statuspembayaran='TERBAYAR'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE id%2=0 AND kode='$d1[kodepaket]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE id%2=0 AND nonota='$d1[nonotaservis]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglpembayaran']))?></td>
					                                    <td>NO. NOTA SERVIS <?echo "$d1[nonotaservis]"?> <?echo "$d2[nama]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlahbayar'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA4I['total']!=0)
												{
											?>
			                            <!-- ############################ UANG MUKA BARANG INDENT ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">UANG MUKA BARANG INDENT</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='indent' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
						                        	if($d1[tambahdp]=="0")
						                        		{
											?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>UANG MUKA BARANG INDENT NOTA INDENT <?echo "$d1[nomor]. $d1[keterangan]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>BIAYA HO BARANG INDENT NOTA INDENT <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlahho'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
					                        <?
					                        			}
						                        	if($d1[tambahdp]=="1")
						                        		{
											?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>TAMBAH UANG MUKA BARANG INDENT NOTA INDENT <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]. $d1[keterangan]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
					                        <?
					                        			}
					                            	}
					                            }
												
											if($dA2B['total']!=0)
												{
											?>
			                            <!-- ############################ PEMASUKAN KAS KECIL ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMASUKAN KAS KECIL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kaskecil WHERE id%2=0 AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='INPUT'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo $d1['keterangan']?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA5A['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN PIUTANG KARYAWAN (TUNAI) ########################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN (TUNAI)</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA5B['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI########################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND potkompensasi='1' AND jenis='pembayaran' AND metodebayar='GAJI' AND potkompensasi='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
											<?
													}
												}
		                            
											if($dA10B['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN POTONGAN KOMPENSASI (TUNAI) ########################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI (TUNAI)</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND metodebayar='TUNAI' AND status='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
											<?
													}
												}
		                            
											if($dA10A['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI ########################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
											<?
													}
												}
												
											if($dA12B['total']!=0)
												{
											?>
			                            <!-- ############################ KELEBIHAN SELISIH DARI STOCK OPNAME ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">KELEBIHAN SELISIH DARI STOCK OPNAME</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_opname_vw WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND totjumselisih < 0 ORDER BY inputx");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo "LEBIH ".-1*$d1[totselisih]." PCS PADA STOCK OPNAME $d1[gudang]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(-1*$d1['totjumselisih'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($totre!=0)
												{
											?>
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#aaa;color:#fff"><b style="padding:20px">TOTAL</b></td>
				                                </tr>
				                                <tr style="cursor:pointer">
				                                    <td colspan="2"></td>
				                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($in,0,",",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($out,0,",",".")?></span></td>
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
                                </div>
                            </div>
                        </div>
                    <?
                    	}
                    	
		            if($mod=='tgl')
		            	{
                        $pecah = explode(" s.d. ", $_REQUEST[periode]);
                        $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
                        $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
                        
		            ?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print2(){
								window.open('printaj/aruskash1tgl.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                            	<!--
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=bulanan"?>">Tahunan</a></li>
                                -->
                                <li class="active"><a href="#tab_1-1" data-toggle="tab">Harian</a></li>
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>">Bulan</a></li>
                                <li><a href="#" onClick="popup_print2()"><button type="button" class="btn btn-danger pull-left" style="margin-top:-10px"><i class="fa fa-print"></i> Export Ke Excel</button></a></li>
                                <li class="pull-left header"><h4>KASIR <small>ARUS KAS</small></h4></li>
                            </ul>
	                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
	                                <div class="tab-pane active">
	                                    <div style="float:right;width:30%;margin-left:15px">
				                   			<form method="post" action="" enctype="multipart/form-data">
	                                    	<table>
	                                    		<tr>
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation" readonly=""/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    	</form>
										</div>
                        	<?
                        	if(!empty($_REQUEST[periode]))
                        		{
					                $dA1  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_bayarsup_history WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir'"));
					                $dA2  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='OUTPUT'"));
					                $dA2B  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='INPUT'"));
		                            $dA3  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='piutang' AND status='1'"));
		                            $dA4S = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='servis' AND status='1'"));
		                            $dA4J1= mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='penjualan' AND jumlah>=0 AND status='1'"));
		                            $dA4J2= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='penjualan' AND jumlah<0 AND status='1'"));
		                            $dA4I = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='indent' AND status='1'"));
		                            
		                            $dA5A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA5B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='pembayaran' AND metodebayar='GAJI' AND status='1' AND potkompensasi='1'"));
		                            $dA8  = mysql_fetch_array(mysql_query("SELECT SUM(totuharian) AS total FROM x23_uangharian WHERE id%2=0 AND tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1'"));
		                            $dA9  = mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS total FROM x23_uanglembur WHERE id%2=0 AND tglbayar BETWEEN '$periode_awal' AND '$periode_akhir'"));
		                            $dA10A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'"));
		                            $dA10B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA11 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_kompensasi WHERE id%2=0 AND tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1'"));
		                            $dA12A = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM x23_opname WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND totjumselisih>=0 AND status='1'"));
		                            $dA12B = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM x23_opname WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND totjumselisih<0 AND status='1'"));
		                           
		                            $out = $dA1[total]+$dA2[total]+$dA3[total]+$dA8[total]+$dA9[total]+$dA11[total]-$dA4J2[total]+$dA12A[total];
		                            $in  = $dA5A[total]+$dA5B[total]+$dA10A[total]+$dA10B[total]+$dA4S[total]+$dA4J1[total]+$dA4I[total]+$dA2B[total]-$dA12B[total];
		                            $re  = $in-$out;
		                            if($re < 0){
		                            	$ketre = "RUGI KOTOR";
		                            	$totre = -1*$re;
										}
		                            else if($re > 0){
		                            	$ketre = "LABA KOTOR";
		                            	$totre = $re;
										}
		                            else {
		                            	$ketre = "RESULT";
		                            	$totre = 0;
										}
							?>
	                                    <div style="float:left;width:65%;margin-right:15px">
					                        <table width="100%">
					                        	<tr>
					                        		<td rowspan="3" width="13%" valign="top">
					                        					<div class="small-box bg-red" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
					                        					<h5><b>TOTAL PENGELUARAN</b></h5>
					                        					<span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($out,"0","",".")?></span>
					                        					</div>
					                        		</td>
					                        		<td rowspan="3" width="13%" valign="top">
					                        					<div class="small-box bg-aqua" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
					                        					<h5><b>TOTAL PEMASUKAN</b></h5>
					                        					<span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($in,"0","",".")?></span>
					                        					</div>
					                        		</td>
					                        		<td rowspan="3" width="13%" valign="top">
					                        					<div class="small-box bg-orange" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
					                        					<h5 style=""><b><?echo $ketre?></b></h5>
					                        					<span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($totre,"0","",".")?></span>
					                        					</div>
					                        		</td>
					                        	</tr>
					                        </table>
					                    </div>
					                    
				                        <table id="example2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th width="10%">TANGGAL</th>
													<th>KETERANGAN</th>
													<th width="15%">UANG MASUK (RP)</th>
													<th width="15%">UANG KELUAR (RP)</th>
												</tr>
											</thead>
				                            <tbody style="font-size:12px;">
												<?
												if($dA1['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN PEMBELIAN ######################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN PEMBELIAN</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT tanggal,jumlah,nonota FROM x23_bayarsup_history WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>PEMBAYARAN KE SUPPLIER NOTA BELI <?echo $d1['nonota']?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
												
												if($dA4J2['total']!=0)
													{
												?>
				                            <!-- ############################ PENGEMBALIAN KELEBIHAN UANG MUKA ####################################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGEMBALIAN KELEBIHAN UANG MUKA</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='penjualan' AND status='1'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
						                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>PENGEMBALIAN KELEBIHAN UANG MUKA NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format(($d1['jumlah']*(-1)),0,",",".")?></span></td>
						                                </tr>
						                        <?	
						                            	}
						                            }
													
												if($dA2['total']!=0)
													{
												?>
				                            <!-- ############################ PENGELUARAN KAS KECIL ######################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGELUARAN KAS KECIL</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kaskecil WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='OUTPUT'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td><?echo $d1['keterangan']?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($dA3['total']!=0)
													{
												?>
				                            <!-- ############################ PIUTANG KARYAWAN ################################################################################ -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PIUTANG KARYAWAN</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='piutang' AND status='1'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
						                                    <td><?echo $d1['nama']?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($dA8['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN UANG HARIAN ################################################################################ -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN UANG HARIAN</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_uangharian WHERE id%2=0 AND tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND totuharian!=0 ORDER BY updatex");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
							                    ?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
						                                    <td><?echo "$d1[nama] ".date("d-m-Y",strtotime($d1['dari']))." s/d ".date("d-m-Y",strtotime($d1['sampai']))?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totuharian'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($dA9['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN UANG LEMBUR ################################################################################ -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN UANG LEMBUR</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_uanglembur WHERE id%2=0 AND tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY updatex");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
						                                    <td><?echo "$d1[nama] TANGGAL ".date("d-m-Y",strtotime($d1['tanggal']))?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['ulembur'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($dA11['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN KOMPENSASI / GAJI ################################################################################ -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN KOMPENSASI / GAJI</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kompensasi WHERE id%2=0 AND tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' ORDER BY updatex");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
						                                    <td><?echo "$d1[nama] PERIODE $d1[bulan] $d1[tahun]"?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
												
												if($dA12A['total']!=0)
													{
												?>
				                            <!-- ############################ SELISIH STOCK OPNAME ################################################################################ -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">KERUGIAN SELISIH DARI STOCK OPNAME</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_opname_vw WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' ORDER BY inputx");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td><?echo "SELISIH $d1[totselisih] PCS PADA STOCK OPNAME $d1[gudang]"?></td>
				                                    		<td align="center">-</td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totjumselisih'],0,",",".")?></span></td>
						                                </tr>
						                        <?
						                            	}
													}
												
												if($dA4S['total']!=0)
													{
												?>
				                            <!-- ############################ SERVIS ####################################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">SERVIS</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='servis' AND status='1'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
						                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>SERVIS NOTA SERVIS <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['pembulatan'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                        <?
						                            	}
						                            }
												
												if($dA4J1['total']!=0)
													{
												?>
				                            <!-- ############################ PENJUALAN BARANG ####################################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PENJUALAN BARANG</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='penjualan' AND status='1'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
						                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>PENJUALAN BARANG NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['pembulatan'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                        <?	
						                            	}
						                            }
												
												if($dA4I['total']!=0)
													{
												?>
				                            <!-- ############################ UANG MUKA BARANG INDENT ####################################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">UANG MUKA BARANG INDENT</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='indent' AND status='1'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
						                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>UANG MUKA BARANG INDENT NOTA INDENT <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                        <?
						                            	}
						                            }
													
												if($dA2B['total']!=0)
													{
												?>
				                            <!-- ############################ PEMASUKAN KAS KECIL ######################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PENGELUARAN KAS KECIL</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_kaskecil WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='INPUT'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td><?echo $d1['keterangan']?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($dA5A['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN PIUTANG KARYAWAN (TUNAI) ########################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN (TUNAI)</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
						                                    <td><?echo "$d1[nama] $d1[ket]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($dA5B['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI########################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_piutang WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND potkompensasi='1' AND jenis='pembayaran' AND metodebayar='GAJI' AND potkompensasi='1'");
													while($d1 = mysql_fetch_array($q1))
														{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
						                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
												<?
														}
													}
			                            
												if($dA10B['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN POTONGAN KOMPENSASI (TUNAI) ########################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI (TUNAI)</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND metodebayar='TUNAI' AND status='1'");
													while($d1 = mysql_fetch_array($q1))
														{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
						                                    <td><?echo "$d1[nama] $d1[ket]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
												<?
														}
													}
			                            
												if($dA10A['total']!=0)
													{
												?>
				                            <!-- ############################ PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI ########################################################################### -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE id%2=0 AND tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'");
													while($d1 = mysql_fetch_array($q1))
														{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
						                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
												<?
														}
													}
												
												if($dA12B['total']!=0)
													{
												?>
				                            <!-- ############################ KELEBIHAN SELISIH DARI STOCK OPNAME ################################################################################ -->
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">KELEBIHAN SELISIH DARI STOCK OPNAME</b></td>
					                                </tr>
					                            <?
													$q1 = mysql_query("SELECT * FROM x23_opname_vw WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND totjumselisih < 0 ORDER BY inputx");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
												?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td><?echo "LEBIH ".-1*$d1[totselisih]." PCS PADA STOCK OPNAME $d1[gudang]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format(-1*$d1['totjumselisih'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                        <?
						                            	}
													}
													
												if($totre!=0)
													{
												?>
					                                <tr style="cursor:pointer;">
					                                    <td colspan="4" style="background-color:#aaa;color:#fff"><b style="padding:20px">TOTAL</b></td>
					                                </tr>
					                                <tr style="cursor:pointer">
					                                    <td colspan="2"></td>
					                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($in,0,",",".")?></span></td>
					                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($out,0,",",".")?></span></td>
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
	                                </div>
	                            </div>
	                        </div>
                    <?
                    		}
                    	}
                    ?>
                    </div>
		        </div>
                
			</section>
		</aside>
		
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
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
<?
		}
?>
	