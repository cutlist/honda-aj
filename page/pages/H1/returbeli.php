<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="km")
											{
											$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</p>";
											}
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
	                                    </div>
									<?
										}
									?>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA RETUR BELI / NO. FAKTUR ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A2"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Retur Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('print/h1/returbeli.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example4" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="15%">NO. NOTA RETUR BELI</th>
			                                    <th style="padding:7px" width="15%">NO. FAKTUR</th>
			                                    <th style="padding:7px" width="15%">TGL NOTA RETUR BELI</th>
			                                    <th style="padding:7px" width="12%">QTY RETUR BELI</th>
			                                    <th style="padding:7px">KETERANGAN</th>
			                                    <th style="padding:7px" width="1%">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_returbeli WHERE noretur LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_returbeli ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$qty = $d1[helm]+$d1[spion]+$d1[alaskaki]+$d1[toolkit]+$d1[accu];
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[noretur]?></td>
			                                    <td align="center"><?echo $d1[nodo]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($qty,"0","",".")?> PCS</span></td>
			                                    <td><?echo $d1[keterangan]?></td>
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
			            
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'A2')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> PILIH NOMOR NOTA BELI</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA BELI / NO. FAKTUR / NO. SURAT PESANAN  ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i> &nbsp; Lihat Retur</button>
										</a>
	                           		</div>
			                        <table id="example3" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. FAKTUR</th>
			                                    <th style="padding:7px">TGL FAKTUR</th>
			                                    <th style="padding:7px">NO. SURAT PESANAN</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th width="" style="padding:7px">QTY BELI (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE substr(nonota,1,2)='NB' AND nodo LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%' OR nopo LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE scan='1' AND substr(nonota,1,2)='NB' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nodo]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td><?echo $d1[nopo]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
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
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
			                	
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
					                        		<td width="50%">TGL FAKTUR</td>
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
					                
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th style="padding:7px">TGL TIBA</th>
			                                    <th style="padding:7px">GUDANG</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det_vw WHERE nonota='$d1[nonota]'");
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
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dA[norangka]'"));
											$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$dB[idgudang]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$checkbox $dA[kodebarang]"?></label></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[warna]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td><?echo $status?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dB[tgltiba]))?></td>
			                                    <td><?echo $dC[gudang]?></td>
			                                </tr>
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
			                        <?
			                        $dhelm  = mysql_fetch_array(mysql_query("SELECT helm FROM stok_helm WHERE nonota='$d1[nonota]'"));
			                        $dspion = mysql_fetch_array(mysql_query("SELECT spion FROM stok_spion WHERE nonota='$d1[nonota]'"));
			                        $daccu	= mysql_fetch_array(mysql_query("SELECT accu FROM stok_accu WHERE nonota='$d1[nonota]'"));
			                        $dtoolkit	= mysql_fetch_array(mysql_query("SELECT toolkit FROM stok_toolkit WHERE nonota='$d1[nonota]'"));
			                        $danakkunci	= mysql_fetch_array(mysql_query("SELECT anakkunci FROM stok_anakkunci WHERE nonota='$d1[nonota]'"));
			                        $dalaskaki	= mysql_fetch_array(mysql_query("SELECT alaskaki FROM stok_alaskaki WHERE nonota='$d1[nonota]'"));
			                        ?>
				                	<div style="padding:20px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $dhelm[helm]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dspion[spion]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $daccu[accu]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dtoolkit[toolkit]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $danakkunci[anakkunci]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dalaskaki[alaskaki]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
			                        <div style="border-bottom:1px #aaa dashed;margin: 10px 0 -10px"></div>
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>">
				                	<div style="padding:20px">
				                		<h5><b>BARANG YANG DIRETUR</b></h5>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" placeholder="0" class="form-control" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:40%;text-align:right;"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" placeholder="0" class="form-control" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:40%;text-align:right;"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" placeholder="0" class="form-control" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:40%;text-align:right;"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" placeholder="0" class="form-control" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:40%;text-align:right;"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ALAS KAKI</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="alaskaki" placeholder="0" class="form-control" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:40%;text-align:right;"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
	else if($submenu == 'C')
		{
		if($_REQUEST[helm]=='0' || $_REQUEST[spion]=='0' || $_REQUEST[accu]=='0' || $_REQUEST[toolkit]=='0' || $_REQUEST[alaskaki]=='0')
			{
			echo "<script>alert ('Jumlah Tidak Boleh 0 (Nol).')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A2'/>";
			exit();
			}
		if(empty($_REQUEST[helm]) && empty($_REQUEST[spion]) && empty($_REQUEST[accu]) && empty($_REQUEST[toolkit]) && empty($_REQUEST[alaskaki]))
			{
			echo "<script>alert ('Jumlah Tidak Boleh Kosong Semua.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A2'/>";
			exit();
			}
			
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNR = mysql_fetch_array(mysql_query("SELECT noretur FROM tbl_returbeli WHERE tanggal=CURDATE() ORDER BY SUBSTR(noretur,-3,3) DESC LIMIT 1"));
            
		if(empty($dNR[noretur]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNR[noretur]",-3,3);
			$dig3 = substr($x,-1,1)+1;
			$dig2 = substr($x,-2,1);
			$dig1 = substr($x,-3,1);
			
			if ($dig3>9)
				{
				$dig3=0;
				$dig2=$dig2+1;
				}
			else
				{
				$dig3=$dig3;
				}
			
			if ($dig2>9)
				{
				$dig2=0;
				$dig1=$dig1+1;
				}
			else
				{
				$dig2=$dig2;
				}
			
			if ($dig1>9)
				{
				echo "kode habis";
				exit();
				}
			else
				{
				$dig1=$dig1;
				}
			}
			
			$noretur = "NR1$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		$d1 = mysql_fetch_array(mysql_query("SELECT nodo,nonota FROM tbl_notabeli WHERE id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>">
									<div style="padding:20px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA RETUR BELI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="noretur" class="form-control" style="width: 30%" value="<?echo $noretur?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NOMOR FAKTUR</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 30%" value="<?echo $d1[nodo]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL RETUR BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td><h5><b>BARANG YANG DIRETUR</b></h5></td>
				                    		</tr>
				                    		<?
				                    		if(!empty($_REQUEST[helm])){
				                    			if($_REQUEST[helm]!='0'){
										        $dhelm  = mysql_fetch_array(mysql_query("SELECT helm FROM stok_helm WHERE nonota='$d1[nonota]'"));
										        if($dhelm[helm] < $_REQUEST[helm])
										        	{
													echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Retur Melebihi Jumlah Stok.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
				                    		?>
				                        		<tr>
					                        		<td>HELM</td>
					                        		<td >:</td>
					                        		<td width="20%">
					                                    <div class="input-group">
					                                    	<input type="text" name="helm" value="<?echo $_REQUEST[helm]?>" class="form-control" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" maxlength="4" style="width:100%;text-align:right;" readonly="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">PCS</span>
					                                    </div>
				                                    </td>
				                                    <td></td>
					                        	</tr>
				                    		<?
				                    			}
				                    		}
				                    		if(!empty($_REQUEST[spion])){
				                    			if($_REQUEST[spion]!='0'){
										        $dspion = mysql_fetch_array(mysql_query("SELECT spion FROM stok_spion WHERE nonota='$d1[nonota]'"));
										        if($dspion[spion] < $_REQUEST[spion])
										        	{
													echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Retur Melebihi Jumlah Stok.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
				                    		?>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td width="20%">
					                                    <div class="input-group">
					                                    	<input type="text" name="spion" value="<?echo $_REQUEST[spion]?>" class="form-control" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" maxlength="4" style="width:100%;text-align:right;" readonly="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">PCS</span>
					                                    </div>
				                                    </td>
				                                    <td></td>
					                        		
					                        	</tr>
				                    		<?
				                    			}
				                    		}
				                    		if(!empty($_REQUEST[accu])){
				                    			if($_REQUEST[accu]!='0'){
										        $daccu	= mysql_fetch_array(mysql_query("SELECT accu FROM stok_accu WHERE nonota='$d1[nonota]'"));
										        if($daccu[accu] < $_REQUEST[accu])
										        	{
													echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Retur Melebihi Jumlah Stok.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
				                    		?>
					                        	<tr>
					                        		<td>ACCU</td>
					                        		<td>:</td>
					                        		<td width="20%">
					                                    <div class="input-group">
					                                    	<input type="text" name="accu" value="<?echo $_REQUEST[accu]?>" class="form-control" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" maxlength="4" style="width:100%;text-align:right;" readonly="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">PCS</span>
					                                    </div>
				                                    </td>
				                                    <td></td>
					                        	</tr>
				                    		<?
				                    			}
				                    		}
				                    		if(!empty($_REQUEST[toolkit])){
				                    			if($_REQUEST[toolkit]!='0'){
										        $dtoolkit	= mysql_fetch_array(mysql_query("SELECT toolkit FROM stok_toolkit WHERE nonota='$d1[nonota]'"));
										        if($dtoolkit[toolkit] < $_REQUEST[toolkit])
										        	{
													echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Retur Melebihi Jumlah Stok.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
				                    		?>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td width="20%">
					                                    <div class="input-group">
					                                    	<input type="text" name="toolkit" value="<?echo $_REQUEST[toolkit]?>" class="form-control" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" maxlength="4" style="width:100%;text-align:right;" readonly="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">PCS</span>
					                                    </div>
				                                    </td>
				                                    <td></td>
					                        	</tr>
				                    		<?
				                    			}
				                    		}
				                    		if(!empty($_REQUEST[alaskaki])){
				                    			if($_REQUEST[alaskaki]!='0'){
										        $dalaskaki	= mysql_fetch_array(mysql_query("SELECT alaskaki FROM stok_alaskaki WHERE nonota='$d1[nonota]'"));
										        if($dalaskaki[alaskaki] < $_REQUEST[alaskaki])
										        	{
													echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Retur Melebihi Jumlah Stok.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
				                    		?>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td width="20%">
					                                    <div class="input-group">
					                                    	<input type="text" name="alaskaki" value="<?echo $_REQUEST[alaskaki]?>" class="form-control" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" maxlength="4" style="width:100%;text-align:right;" readonly="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">PCS</span>
					                                    </div>
				                                    </td>
				                                    <td></td>
					                        	</tr>
				                        	<?
				                        		}
				                        	}
				                        	?>
				                    		<tr>
				                    			<td valign="top" >KETERANGAN *</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="keterangan" maxlength="200" class="form-control" required=""></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td><span style="font-weight:bold;color:red"><i>* Harus Diisi</i></span></td>
				                    		</tr>
		                            	</table>
		                            </div>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="nodo" value="<?echo $d1[nodo]?>"/>
				           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'save')
		{
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
        
		if($_REQUEST[helm]=='0' || $_REQUEST[spion]=='0' || $_REQUEST[accu]=='0' || $_REQUEST[toolkit]=='0' || $_REQUEST[alaskaki]=='0')
			{
			echo "<script>alert ('Jumlah Tidak Boleh 0 (Nol).')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A2'/>";
			exit();
			}
			
		$q1 = mysql_query("INSERT INTO tbl_returbeli (
													noretur, 
													nodo, 
													tahun, 
													bulan, 
													tanggal, 
													iduser, 
													user, 
													helm, 
													spion, 
													accu, 
													toolkit, 
													alaskaki, 
													keterangan, 
													inputx, 
													updatex) 
												VALUES (
													'$_REQUEST[noretur]', 
													'$_REQUEST[nodo]', 
													'$tahun', 
													'$bulan', 
													'$tanggal', 
													'$_SESSION[id]', 
													'$_SESSION[user]', 
													'$_REQUEST[helm]', 
													'$_REQUEST[spion]', 
													'$_REQUEST[accu]', 
													'$_REQUEST[toolkit]', 
													'$_REQUEST[alaskaki]', 
													'$keterangan', 
													NOW(), 
													'$updatex')
							");
							
		$idreturbeli = mysql_insert_id();
		
		$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
											idreturbeli, 
											tahun, 
											bulan, 
											tanggal, 
											kasus, 
											tbl, 
											inputx) 
										VALUES (
											'$idreturbeli', 
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'RETUR BELI $_REQUEST[noretur] KETERANGAN : $keterangan', 
											'tbl_returbeli', 
											NOW())
							");
							
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_returbeli',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH RETUR BELI $_REQUEST[nodo]')
							");
		/*		
		echo "			
		<script type='text/javascript'>
			window.open('print/returbeli.php?nodo=$_REQUEST[nodo]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
		*/
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=km'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	else if($submenu == 'D')
		{
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE nodo='$dX[nodo]'"));
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('print/returbeli.php?nodo=<?echo $d1[nodo]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
			                	
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
					                        		<td width="50%">TGL FAKTUR</td>
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
					                
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th style="padding:7px">TGL TIBA</th>
			                                    <th style="padding:7px">GUDANG</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det_vw WHERE nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
				                            if($dA[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
												}
											else if($dA[status]=='0'){
												$status = "-";
												$checkbox = "<input type='checkbox' class='flat-red' name='scan[]' value='$dA[norangka]'/>";
												}
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dA[norangka]'"));
											$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$dB[idgudang]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$checkbox $dA[kodebarang]"?></label></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[warna]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td><?echo $status?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dB[tgltiba]))?></td>
			                                    <td><?echo $dC[gudang]?></td>
			                                </tr>
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
			                        <?
			                        $dhelm  = mysql_fetch_array(mysql_query("SELECT helm FROM stok_helm WHERE nonota='$d1[nonota]'"));
			                        $dspion = mysql_fetch_array(mysql_query("SELECT spion FROM stok_spion WHERE nonota='$d1[nonota]'"));
			                        $daccu	= mysql_fetch_array(mysql_query("SELECT accu FROM stok_accu WHERE nonota='$d1[nonota]'"));
			                        $dtoolkit	= mysql_fetch_array(mysql_query("SELECT toolkit FROM stok_toolkit WHERE nonota='$d1[nonota]'"));
			                        $danakkunci	= mysql_fetch_array(mysql_query("SELECT anakkunci FROM stok_anakkunci WHERE nonota='$d1[nonota]'"));
			                        $dalaskaki	= mysql_fetch_array(mysql_query("SELECT alaskaki FROM stok_alaskaki WHERE nonota='$d1[nonota]'"));
			                        ?>
				                	<div style="padding:20px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $dhelm[helm]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dspion[spion]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $daccu[accu]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dtoolkit[toolkit]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $danakkunci[anakkunci]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dalaskaki[alaskaki]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
			                        <div style="border-bottom:1px #aaa dashed;margin: 10px 0 -10px"></div>
					                
					                <?
					                $dR = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE id='$_REQUEST[id]'"));
					                ?>
									<div style="padding:20px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">TGL RETUR BELI</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($dR[tanggal]))?>" style="width: 25%" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td><h5><b>BARANG YANG DIRETUR</b></h5></td>
				                    		</tr>
				                    		<?
				                    		if(!empty($dR[helm]))
				                    		{
				                    		?>
				                        	<tr>
				                        		<td>HELM</td>
				                        		<td >:</td>
				                        		<td><input type="text" name="helm" value="<?echo $dR[helm]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
				                        	</tr>
				                    		<?
				                    		}
				                    		if(!empty($dR[spion]))
				                    		{
				                    		?>
				                        	<tr>
				                        		<td>SPION</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="spion" value="<?echo $dR[spion]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
				                        	</tr>
				                    		<?
				                    		}
				                    		if(!empty($dR[accu]))
				                    		{
				                    		?>
				                        	<tr>
				                        		<td>ACCU</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="accu" value="<?echo $dR[accu]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
				                        	</tr>
				                    		<?
				                    		}
				                    		if(!empty($dR[toolkit]))
				                    		{
				                    		?>
				                        	<tr>
				                        		<td>TOOLKIT</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="toolkit" value="<?echo $dR[toolkit]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
				                        	</tr>
				                    		<?
				                    		}
				                    		if(!empty($dR[alaskaki]))
				                    		{
				                    		?>
				                        	<tr>
				                        		<td>ALAS KAKI</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="alaskaki" value="<?echo $dR[alaskaki]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
				                        	</tr>
				                        	<?
				                        	}
				                        	?>
				                    		<tr>
				                    			<td valign="top" >KETERANGAN</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="keterangan" maxlength="200" class="form-control" readonly><?echo $dR[keterangan]?></textarea></td>
				                    		</tr>
		                            	</table>
		                            </div>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
				                        <?
				                        if($dX[status]=="1")
				                        	{
				                        ?>
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Retur Beli</button>
										<?	
											}
				                        ?>
				                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
		$('#uang').on('keypress', function(e) {
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
		$('#uang2').on('keypress', function(e) {
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
		$('#uang3').on('keypress', function(e) {
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
		$('#uang4').on('keypress', function(e) {
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
        </script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>