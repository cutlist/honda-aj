<?
	if($submenu == 'A')
		{
			$periode_tahun = date("Y");
			$periode_bulan = date("m");		
			
			unset($_SESSION[periode]);
			unset($_SESSION[periode_awal]);
			unset($_SESSION[periode_akhir]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-4">		                
			                <div class="small-box bg-blue" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff">
			                	<h4><b>PENCARIAN NOTA BELI</b></h4>
			                	<h5>BERDASARKAN</h5><h5><b>PERIODE</b></h5></br></br></br></br>
			                	
	                                <div class="inner">
					                   	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar" style="font-size:20px"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:50px;font-size:14px;cursor:pointer;" placeholder="Pilih Periode Tgl. Nota Beli" class="form-control" id="reservation" readonly=""/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit"style="height:50px;" class="btn btn-danger pull-left"><i class="fa fa-arrow-right"></i></button>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
			               		 	</div>
			                </div>
			            </div>
			            <div class="col-xs-4">		                
			                <div class="small-box bg-green" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff">
			                	<h4>NOTA <b>SUDAH</b> BAYAR</h4>
			                	<h5 style="margin-top:-10px">BULAN INI</h5>
			                	<?
								$pA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli WHERE id%2=0 AND tahun='$periode_tahun' AND bulan='$periode_bulan' AND id%2=0 AND bayar NOT IN ('0','')"));
			                	?>
	                                <div class="inner">
	                                	<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="color:#fff">
	                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
		                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo $pA[total]?></h3>
		                                    </div>
	                                    </div>
	                                    </a>
	                                </div></br>
	                                
	                                <div class="col-xs-12" style="margin:10px 10px 10px 10px;cursor: pointer;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96%">5 NOTA TERBARU (SUDAH BAYAR)</h4>
				                        <table class="table" style="width:96%">
				                            <thead style="font-size:12px">
				                                <tr>
			                                    <th style="padding:7px" width="">NO. NOTA BELI</th>
			                                    <th style="padding:7px" width="">TGL NOTA BELI</th>
			                                    <th style="padding:7px" width="">TOTAL BAYAR (RP)</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
				                            $dc1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar NOT IN ('0','') AND id%2=0 ORDER BY tglbayar DESC"));
				                            if(empty($dc1[id]))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td colspan="4"><i>DATA TIDAK DITEMUKAN</i></td>
				                                </tr>
				                            <?
												}
				                            
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar NOT IN ('0','') AND id%2=0 ORDER BY tglbayar DESC LIMIT 0,5");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="left"><?echo $d1[nonota]?></td>
				                                    <td align="left"><span style="padding-left:10px"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></span></td>
				                                    <td><?echo number_format($d1[bayar],"0","",".")?></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
		                           	</div>
			                    
	                                <a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" class="small-box-footer">
	                                    Lihat Detail <i class="fa fa-search"></i>
	                                </a>
			                </div>
			            </div>
			            <div class="col-xs-4">			                
			                <div class="small-box bg-orange" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff">
			                	<h4>NOTA <b>BELUM</b> BAYAR</h4>
			                	<h5 style="margin-top:-10px">BULAN INI</h5>
			                	<?
								$pB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli WHERE id%2=0 AND tahun='$periode_tahun' AND bulan='$periode_bulan' AND bayar IN ('0','') AND id%2=0 AND gtbayar!='' AND scan='1'"));
			                	?>
	                                <div class="inner" style="cursor:pointer">
	                                	<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="color:#fff">
		                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
			                                	<div class="bg-orange" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo $pB[total]?></h3>
			                                    </div>
		                                    </div>
		                                </a>
	                                </div></br>
	                                
	                                <div class="col-xs-12" style="margin:10px 10px 10px 10px;cursor: pointer;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96%">5 NOTA TERBARU (BELUM BAYAR)</h4>
				                        <table class="table" style="width:96%">
				                            <thead style="font-size:12px">
				                                <tr>
			                                    <th style="padding:7px" >NO. NOTA BELI</th>
			                                    <th style="padding:7px" >TGL NOTA BELI</th>
			                                    <th style="padding:7px" >GRAND TOTAL TIBA (RP)</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
				                            $dc1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar IN ('0','') AND gtbayar!=' AND scan='1'' AND id%2=0 ORDER BY tglbayar DESC LIMIT 0,5"));
				                            if(empty($dc1[id]))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td colspan="4"><i>DATA TIDAK DITEMUKAN</i></td>
				                                </tr>
				                            <?	
												}
				                            
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar IN ('0','') AND gtbayar!='' AND scan='1' AND id%2=0 ORDER BY tglbayar DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="left"><?echo $d1[nonota]?></td>
				                                    <td align="left"><span style="padding-left:10px"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></span></td>
				                                    <td><?echo number_format($d1[gtbayar],"0","",".")?></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
		                           	</div>
	                                <a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" class="small-box-footer">
	                                    Lihat Detail <i class="fa fa-search"></i>
	                                </a>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
						/*
						if(!empty($_REQUEST[bayarnota]))
							{
							$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
							if($tglbayar < )
							$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							if($_REQUEST[gtbayar] <= $bayar){
								$status = '1';
								}
							$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayar',scan='1',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[bayarnota]'");
							$q2 = mysql_query("DELETE FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]' AND status='0'");
								  mysql_query("INSERT INTO tbl_bayarsup_history VALUES (
								  								'',
								  								'$_REQUEST[nonota]',
								  								'$bayar',
								  								CURDATE(),
								  								'$_SESSION[id]')
								  				");
							
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'tbl_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
												");
							if($q1)
								{
								}
							else
								{
								//echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
							}
							*/
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>PEMBELIAN <small>NOTA BELI BELUM BAYAR</small></h4>
			                        <table id="example1" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. FAKTUR</th>
			                                    <th style="padding:7px">TGL DO</th>
			                                    <th style="padding:7px">NO. SURAT PESANAN</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th width="" style="padding:7px">QTY TIBA (UNIT)</th>
			                                    <th style="padding:7px">GRAND TOTAL TIBA (RP)</th>
			                                    <th style="padding:7px">GRAND TOTAL TIBA + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar IN ('0','') AND gtbayar!='' AND nodo!='' AND scan='1'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d1A = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nodo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1A[qty],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[gtbayar],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[gtbayar]+$d1[gtbayarppn],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar IN ('0','')");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
<!-- ################################################################################################################################# -->
<?
							}
						}
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
						if(!empty($_REQUEST[bayarnota]))
							{
							$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
							if($tglbayar < $d1[tglnota])
								{
								echo "<script>alert ('Tanggal Bayar Tidak Bisa Lebih Kecil Dari Tanggal Nota Beli.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=view&id=$_REQUEST[id]'/>";
								exit();
								}
							
							$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							if($_REQUEST[gtbayar] <= $bayar){
								$status = '1';
								}
							$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',scan='1',bayar='$bayar',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[bayarnota]'");
							$q2 = mysql_query("DELETE FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]' AND status='0'");
								  mysql_query("INSERT INTO tbl_bayarsup_history VALUES (
								  								'',
								  								'$_REQUEST[nonota]',
								  								'$bayar',
								  								'$tglbayar',
								  								'$_SESSION[id]')
								  				");
							
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'tbl_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
												");
							if($q1)
								{
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
							else
								{
								//echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
							}
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
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
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <a data-toggle="modal" data-target="#compose-modal-bayar<?echo $_REQUEST[id]?>" style="cursor:pointer"><button type="submit" class="btn btn-info"><i class="fa fa-dollar"></i> &nbsp;Bayar</button></a>
					                    	
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
				                            if($dA[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
												}
											else if($dA[status]=='0'){
												$status = "-";
												$checkbox = "<input type='checkbox' class='flat-red' name='scan[]' value='$dA[norangka]' disabled=''/>";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$checkbox $dA[kodebarang]"?></label></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td><?echo $status?></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL TIBA (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL TIBA + PPN (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total]*1.1)?></b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
						                    	<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
<!-- ################################################################################################################################# -->
<?
							}
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'C')
		{
		if(!empty($_REQUEST[bayarnota]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$gtbayar = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
			$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
			$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$bayar		= $bayar1+$bayar2;
			
			if($gtbayar <= $bayar){
				$status = '1';
				}
			else{
				$status = '0';
				}
			
			$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayar',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[bayarnota]'");
			$q2 = mysql_query("DELETE FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]' AND status='0'");
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_notabeli',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
								");
			if($q1)
				{
				}
			else
				{
				//echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			}
			
		if(!empty($_REQUEST[ubahbayarnota]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$gtbayar = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
			$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
			$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$bayar		= $bayar1+$bayar2;
			
			if($gtbayar <= $bayar2){
				$status = '1';
				}
			else{
				$status = '0';
				}
			
			$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayar2',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[ubahbayarnota]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_notabeli',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH BAYAR NOTA BELI $_REQUEST[nonota]')
								");
			if($q1)
				{
				}
			else
				{
				//echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>PEMBELIAN <small>NOTA BELI SUDAH BAYAR</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA BELI / NO. FAKTUR ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
			                        <table id="example3" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL BAYAR</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. FAKTUR</th>
			                                    <th style="padding:7px">TGL DO</th>
			                                    <th width="" style="padding:7px">QTY TIBA (UNIT)</th>
			                                    <th style="padding:7px">GRAND TOTAL TIBA (RP)</th>
			                                    <th style="padding:7px">GRAND TOTAL TIBA + PPN (RP)</th>
			                                    <th style="padding:7px">JUMLAH BAYAR (RP)</th>
			                                    <th style="padding:7px">BUNGA (RP)</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <!--
			                                    <th width="" style="padding:7px">AKSI</th>
			                                    -->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
							//SELECT COUNT(id) AS total FROM tbl_notabeli WHERE id%2=0 AND tahun='$periode_tahun' AND bulan='$periode_bulan' AND bayar NOT IN ('0','')

										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar NOT IN ('0','') AND nonota LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' AND nodo!='' LIMIT 0,20");
											$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar NOT IN ('0','') AND nonota LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' AND nodo!='' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar NOT IN ('0','') ORDER BY id DESC LIMIT 0,20");
											$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND bayar NOT IN ('0','') ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'> Bayar</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
											$bungaX = $d1[bayar]-$d1[gtbayar]-$d1[gtbayarppn];
											if($bungaX <= 0){
												$bunga = '0';
												}
											else{
												$bunga = $bungaX;
												}
											$d2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_stokunit WHERE id%2=0 AND nonota='$d1[nonota]'"));
											$d1A = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglbayar]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nodo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1A[qty],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[gtbayar],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[gtbayar]+$d1[gtbayarppn],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[bayar],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($bunga,"0","",".")?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <!--
			                                    <td width="1%" align="center">
                                            	<?
                                            	if($d1[status]=='0')
                                            		{
												?>
			                                    	<div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                                	<li><a data-toggle="modal" data-target="#compose-modal-bayar<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-dollar"></i> Bayar</a></li>
			                                           	</ul>
			                                        </div>
		                                        <?
													}
													
                                            	if($d1[status]=='1')
                                            		{
												?>
			                                    	<div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px">
			                                                	<li><a data-toggle="modal" data-target="#compose-modal-ubahbayar<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i> Ubah Bayar</a></li>
			                                           	</ul>
			                                        </div>
		                                        <?
													}
                                            	?>
			                                    </td>
			                                    -->
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d3[bayar]?>">
					                    		<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ################################################################################################################################# -->
<?
							}
							
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND status='1'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-ubahbayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">UBAH PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y",strtotime($d3[tglbayar]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" value="<?echo number_format($d3[bayar],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d3[bayar]?>">
					                    		<input type="hidden" name="ubahbayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ################################################################################################################################# -->
<?
							}
							
						}
						
					else if($mod == "edit")
						{
						if(!empty($_REQUEST[ubah]))
							{
							$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							$q1 = mysql_query("UPDATE tbl_bayarsup_history SET jumlah='$bayar' WHERE id%2=0 AND id='$_REQUEST[ubah]'");
							
							
							$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
							$selisih = $_REQUEST[jumlah]-$bayar;
							$bayarupdate = $d1[bayar]-$selisih;
								
							if($d1[gtbayar] <= $bayarupdate){
								$status = '1';
								}
							else{
								$status = '0';
								}
							
							$q2 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayarupdate',tglbayar=CURDATE(),updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[id]'");
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'tbl_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $d1[nonota]')
												");
							if($q1)
								{
								//echo "<script>alert ('Proses berhasil.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]'/>";
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]'/>";
								exit();
								}
							}
							
						$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bayarsup_history WHERE id%2=0 AND id='$_REQUEST[idbayar]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Pembayaran Nota <?echo $dA[nonota]?></small></h4>
				                	<div style="padding:20px">
                                    	
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="50%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y",strtotime($dA[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" value="<?echo number_format($dA[jumlah],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="jumlah" value="<?echo $dA[jumlah]?>">
					                    		<input type="hidden" name="ubah" value="<?echo $_REQUEST[idbayar]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
										
                       		 		</div>
                       		 	</div>
                        	</div>
                        </div>
<?
						}
						
					else if($mod == "view")
						{
						if(!empty($_REQUEST[bayarnota]))
							{
							$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
							
								$dcek = mysql_fetch_array(mysql_query("SELECT tanggal FROM tbl_bayarsup_history WHERE id%2=0 AND nonota='$_REQUEST[nonota]' ORDER BY tanggal DESC LIMIT 0,1"));
							
								
							if($tglbayar < $dcek[tanggal]){
								echo "<script>alert ('Tanggal Pembayaran Tidak Boleh Lebih Kecil Dari Tanggal Pembayaran Sebelumnya.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]'/>";
								exit();
								} 
								
							if($_REQUEST['bayar']=="0"){
								echo "<script>alert ('Pembayaran Tidak Bisa 0 (Nol).')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]'/>";
								exit();
								} 
								
							$gtbayar    = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
							$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
							$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							$bayar		= $bayar1+$bayar2;
							
							if($gtbayar <= $bayar){
								$status = '1';
								}
							else{
								$status = '0';
								}
							
							$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayar',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[bayarnota]'");
							      mysql_query("INSERT INTO tbl_bayarsup_history VALUES (
								  								'',
								  								'$_REQUEST[nonota]',
								  								'$bayar2',
								  								'$tglbayar',
								  								'$_SESSION[id]')
								  				");
							
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'tbl_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
												");
							if($q1)
								{
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
							}
							
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<div style="padding:20px">
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
					                        		<td width="30%" valign="top">TGL BAYAR</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><input type="text" name="tglbayar" value="<?echo date("d-m-Y", strtotime($d1[tglbayar]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:50%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td valign="top">MEMO</td>
					                        		<td valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;" readonly=""><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <a data-toggle="modal" data-target="#compose-modal-history" style="cursor:pointer"><button type="button" class="btn btn-primary pull-left"><i class="fa fa-search"></i> &nbsp;Riwayat Pembayaran</button></a>
				                        <?
                                    	if($d1[status]=='0')
                                    		{
										?>
					                        <a data-toggle="modal" data-target="#compose-modal-bayar" style="cursor:pointer"><button type="submit" class="btn btn-info"><i class="fa fa-dollar"></i> &nbsp;Bayar</button></a>
					                    <?
					                    	}
					                    ?>
					                        <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL TIBA (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL TIBA + PPN (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total]*1.1)?></b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
			            
	<!-- ################## MODAL RIWAYAT ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-history" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:50%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">RIWAYAT PEMBAYARAN <?echo $d1[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                        <table id="example2" class="table table-striped" style="width:100%">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th width="40%" style="padding:7px"><center>TANGGAL PEMBAYARAN</center></th>
					                                    <th width="" style="padding:7px"><center>JUMLAH BAYAR (RP)</center></th>
					                                    <th width="1%" style="padding:7px"><center>AKSI</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$d2 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bayarsup_history WHERE id%2=0 AND nonota='$d1[nonota]'"));
												$q1 = mysql_query("SELECT * FROM tbl_bayarsup_history WHERE id%2=0 AND nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($q1))
					                            	{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($dA[tanggal]))?></td>
					                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[jumlah],"0","",".")?></span></td>
					                                    <td width="1%" align="center">
				                                    	<?
		                                            	if($_SESSION[posisi]=='DIREKSI')
		                                            		{
														?>
					                                    	<div class="btn-group">
					                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
					                                                <span class="caret"></span>
					                                                <span class="sr-only">Actions</span>
					                                            </button>
					                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
					                                            	<li>
																		<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&idbayar=$dA[id]&id=$_REQUEST[id]"?>" style="cursor:pointer">
									                           				<i class="fa fa-edit"></i>Ubah
																		</a>
																	</li>
					                                            </ul>
					                                        </div>
					                                    <?
					                                    	}
					                                    ?>
					                                        </td>
					                                </tr>
					                                
					                            <?
													$no++;
					                            	}
					                             ?>
					                            </tbody>
					                            <tfoot>
					                            	<tr><th colspan="3">&nbsp;</th></tr>
					                            	<tr>
					                            		<th align="right"><center>GRAND TOTAL JUMLAH BAYAR (RP)</center></th>
					                            		<td align="right"><span style="margin-right:30%"><b><?echo number_format($d2[total])?></b></span></td>
					                            		<th ></th>
					                            	</tr>
					                            </tfoot>
					                        </table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ######################################################################################################################### -->
					        
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d1[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d1[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d1[bayar]?>">
					                    		<input type="hidden" name="bayarnota" value="<?echo $d1[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ################################################################################################################################# -->
					
		            <?
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td align="center">TANGGAL BAYAR</td>
					                    		</tr>
					                    		<tr>
					                    			<td align="center">&nbsp;</td>
					                    		</tr>
					                    		<tr>
					                    			<td align="center"><input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:27%"></td>
					                    		</tr>
					                    		<!--
					                    		<tr>
					                    			<td>QTY BELI (UNIT)</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="qty" value="<?echo number_format($d2[qty],"0","",".")?>" style="width:10%;text-align:right" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
					                    		</tr>
					                    		-->
						                    	<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
<!-- ################################################################################################################################# -->
<?
							}
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'D')
		{
		if(!empty($_REQUEST[bayarnota]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$gtbayar = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
			$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
			$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$bayar		= $bayar1+$bayar2;
			
			if($gtbayar <= $bayar){
				$status = '1';
				}
			
			$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayar',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[bayarnota]'");
			$q2 = mysql_query("DELETE FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]' AND status='0'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_notabeli',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
								");
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			}
			
		if(!empty($_REQUEST[ubahbayarnota]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$gtbayar = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
			$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
			$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$bayar		= $bayar1+$bayar2;
			
			if($gtbayar <= $bayar){
				$status = '1';
				}
			
			$q1 = mysql_query("UPDATE tbl_notabeli SET status='$status',bayar='$bayar2',tglbayar='$tglbayar',updatex='$updatex' WHERE id%2=0 AND id='$_REQUEST[ubahbayarnota]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_notabeli',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH BAYAR NOTA BELI $_REQUEST[nonota]')
								");
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			}
		
		if(empty($_SESSION[periode]))
			{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $_SESSION[periode]	= $_REQUEST[periode];
            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
			}
		if(!empty($_REQUEST[find]))
			{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $_SESSION[periode]	= $_REQUEST[periode];
            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>PENCARIAN NOTA BELI</h4>
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px;font-size:14px;cursor:pointer;" <?if(empty($_SESSION[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_SESSION[periode]?>"<?}?>  class="form-control pull-right" readonly="" id="reservation"/>
		                                            </div>
		                                            <input type="hidden" name="find" value="1">
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												<?
												if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
													{
												?>
													<button type="button"  onclick="window.open('printaj/h1/bayarsup.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                       			<?
				                       				}
				                       			?>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
			                        <table id="example4" class="table table-bordered table-striped table-hover" style="width:160%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. FAKTUR</th>
			                                    <th style="padding:7px">TGL DO</th>
			                                    <th style="padding:7px">NO. SURAT PESANAN</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th style="padding:7px">QTY TIBA (UNIT)</th>
			                                    <th style="padding:7px">GRAND TOTAL TIBA (RP)</th>
			                                    <th style="padding:7px">GRAND TOTAL TIBA + PPN (RP)</th>
			                                    <th style="padding:7px">JUMLAH BAYAR (RP)</th>
			                                    <th style="padding:7px">BUNGA (RP)</th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?			                            
										$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND nodo!=''");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'> Bayar</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
			                           		if($d1[bayar] < $d1[gtbayar] || empty($d1[bayar])){
												$bunga = "-";
												}
											else if($d1[bayar] >= $d1[gtbayar]){
												$bungaX = $d1[bayar]-$d1[gtbayar]-$d1[gtbayarppn];
												$bunga  = number_format($bungaX,"0","",".");
												}
											$d1A = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
											if($d1A[qty]=="0"){
												$qtytiba = "-";
												$gtbayar = "-";
												$gtbayarppn = "-";
												$bayar = "-";
												}
											else{
												$qtytiba = number_format($d1A[qty],"0","",".");
												$gtbayar = number_format($d1[gtbayar],"0","",".");
												$gtbayarppn = number_format($d1[gtbayar]+$d1[gtbayarppn],"0","",".");
												$bayar = number_format($d1[bayar],"0","",".");
												if(empty($bayar)){
													$bayar = "-";
													}
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nodo]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $qtytiba?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $gtbayar?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $gtbayarppn?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $bayar?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $bunga?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND status='0'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d3[bayar]?>">
					                    		<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ################################################################################################################################# -->
<?
							}
							
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND status='1'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-ubahbayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">UBAH PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y",strtotime($d3[tglbayar]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" value="<?echo number_format($d3[bayar],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d3[bayar]?>">
					                    		<input type="hidden" name="ubahbayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ################################################################################################################################# -->
<?
							}
						}
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<div style="padding:20px">
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
						                        <?
		                                    	if($d1[tglbayar]!='0000-00-00')
		                                    		{
												?>
						                        	<tr>
						                        		<td valign="top">TGL BAYAR</td>
						                        		<td valign="top">:</td>
						                    			<td valign="top"><input type="text" name="tglbayar" value="<?echo date("d-m-Y", strtotime($d1[tglbayar]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:50%"></td>
						                        	</tr>
					                        	<?
							                    	}
							                    ?>
					                        	<tr>
					                        		<td width="30%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;" readonly=""><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL TIBA (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
						$q3 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
						                    	<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
<!-- ################################################################################################################################# -->
<?
							}
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
?>
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script>
        //SELECT2
			$(function(){
			           
			  var select = $('#select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });
			  $("#tagPicker2").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
		</script>
        
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
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example4').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>