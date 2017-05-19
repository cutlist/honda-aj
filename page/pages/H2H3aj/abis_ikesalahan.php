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
	
		$dAs1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scanmasuk WHERE id%2=0 AND tanggal=CURDATE()"));
		$asmasukbengkel = round($dAs1[total]/2);
		$dAs2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE()"));
		$asmulaiservis = $dAs2[total];
		$dAs3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scankeluar WHERE id%2=0 AND tanggal=CURDATE()"));
		$askeluarbengkel = round($dAs3[total]/2);
		$dAs4 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE() AND status!='0'"));
		$asselesaiservis = $dAs4[total];
		
		$selisih1 = abs($asmasukbengkel - $asmulaiservis);
		$selisih2 = abs($askeluarbengkel - $asselesaiservis);
		
		$dCs  = mysql_fetch_array(mysql_query("SELECT aksi FROM x23_scanhistory WHERE id%2=0 AND tanggal=CURDATE() ORDER BY id DESC LIMIT 0,1"));
		$dCs2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_tutupharian WHERE id%2=0 AND tanggal=(CURDATE() - INTERVAL 1 DAY)"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
									<?
									if($_REQUEST[note]=="tp")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Saat Ini Sistem Sudah Terbuka Dan Sudah Dapat Berjalan Kembali.</p>
	                                    </div>
									<?
										}
									?>
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
                                    </form>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{         
			                    ?>
				                        <table id="example3" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th width="10%">TANGGAL</th>
													<th>KASUS</th>
													<th>STATUS</th>
												</tr>
											</thead>
				                            <tbody>
				                            <?
												$qDS = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE id%2=0 AND totalstok<'0' GROUP BY idbarang,nonota,idgudang,rak");
					                            while($dDS = mysql_fetch_array($qDS))
					                            	{
				                            		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Stok $dDS[totalstok] PCS</span>";
											?>
													<tr style='cursor:pointer'>
				                                    	<td align="center"><?echo date("d-m-Y")?></td>
														<td>INDIKASI KESALAHAN : BARANG <?echo "$dDS[kodebarang] | $dDS[namabarang] | $dDS[varian]"?> LOKASI <?echo "$dDS[gudang] | $dDS[rak]"?> NO. NOTA BELI <?echo "$dDS[nonota]"?></td>
														<td align='center'><?echo $status?></td>
													</tr>
											<?
													}
													
				                            	if($selisih1 > 2)
				                            		{
				                            		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Selisih $selisih1</span>";
											?>
													<tr style='cursor:pointer'>
				                                    	<td align="center"><?echo date("d-m-Y")?></td>
														<td>INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH SCAN MASUK DAN JUMLAH MULAI SERVIS</td>
														<td align='center'><?echo $status?></td>
													</tr>
											<?
													}
													
				                            	if($selisih2 > 2)
				                            		{
				                            		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Selisih $selisih2</span>";
											?>
													<tr style='cursor:pointer'>
				                                    	<td align="center"><?echo date("d-m-Y")?></td>
														<td>INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH SCAN KELUAR DAN JUMLAH SELESAI SERVIS</td>
														<td align='center'><?echo $status?></td>
													</tr>
											<?
													}
													
				                            	if($dCs[aksi]=='stop' || empty($dCs[aksi]))
				                            		{
				                            		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Infra Red Non Aktif</span>";
											?>
													<tr style='cursor:pointer'>
				                                    	<td align="center"><?echo date("d-m-Y")?></td>
														<td>INDIKASI KESALAHAN : SENSOR INFRA RED SAAT INI DALAM KEADAAN TIDAK AKTIF</td>
														<td align='center'><?echo $status?></td>
													</tr>
											<?
													}
													
				                            	if(empty($dCs2[id]))
				                            		{
				                            		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Belum Tutup Periode</span>";
											?>
													<tr style='cursor:pointer' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=tp"?>'">
				                                    	<td align="center"><?echo date("d-m-Y")?></td>
														<td>INDIKASI KESALAHAN : SISTEM H2H3 CABANG <?echo $_SESSION['namacabang']?> TIDAK DAPAT BERJALAN DIKARENAKAN BELUM TUTUP HARIAN PADA PERIODE KEMARIN</td>
														<td align='center'><?echo $status?></td>
													</tr>
											<?
													}
													
												$q1	 = mysql_query("SELECT * FROM x23_abis_ikesalahan WHERE id%2=0 AND bulan='$periode_bulan'  AND tahun='$periode_tahun' ORDER BY id DESC");
												while($d1  = mysql_fetch_array($q1))
													{
					                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Sudah Direspon</span>";}
					                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Belum Direspon</span>";}
											?>
													<tr style='cursor:pointer' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
				                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
														<td><?echo $d1[kasus]?></td>
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
		
	else if($submenu == 'tp')
		{
		if($_REQUEST[buka]=="1")
			{
			$tahun = date("Y");
			$bulan = date("m");
				
			mysql_query("INSERT INTO x23_tutupharian (tahun,bulan,tanggal) VALUES ('$tahun','$bulan',(CURDATE() - INTERVAL 1 DAY))");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=tp'/>";
			exit();
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly="">SISTEM TERKUNCI DAN TIDAK DAPAT BERJALAN DIKARENAKAN BELUM TUTUP HARIAN PADA PERIODE KEMARIN</textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y")?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
				           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix"> 
				                        	<button type="button" class="btn btn-primary pull-left" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&buka=1"?>'"><i class="fa fa-key"></i> &nbsp;Buka Sistem</button>
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
		
	else if($submenu == 'view')
		{
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM x23_abis_ikesalahan WHERE id%2=0 AND id='$_REQUEST[id]'"));
		
		if(!empty($dX[idtutupservis1]))
			{
			if(!empty($_REQUEST[ubah]))
				{
				$asmasukbengkel = preg_replace( "/[^0-9]/", "",$_REQUEST[asmasukbengkel]);
				$askeluarbengkel = preg_replace( "/[^0-9]/", "",$_REQUEST[askeluarbengkel]);
				$asnginep = round($asmasukbengkel/2)-round($askeluarbengkel/2);
				
				mysql_query("UPDATE x23_tutupservis SET asmasukbengkel='$asmasukbengkel', askeluarbengkel='$askeluarbengkel', asnginap='$asnginep' WHERE id%2=0 AND id='$dX[idtutupservis1]'");
				mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
				
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_tutupservis WHERE id%2=0 AND id='$dX[idtutupservis1]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$d1[iduser]'"));
			
			if($d1[askeluarbengkel] <= $d1[asmasukbengkel]){
				$ket = "<span style='font-size:10px;color:red'><i>(Telah Dimodifikasi)</i></span>";
				}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PIC TUTUP SERVIS</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
					           			<div class="col-xs-12">
					                        <table id="example4" class="table table-bordered table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th width="" style="padding:7px">KETERANGAN</th>
					                                    <th width="25%" style="padding:7px"><center>TOTAL</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                                <tr>
														<td>Jumlah Motor Keluar Bengkel</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[askeluarbengkel]." ".$ket?></span></td>
					                                </tr>
					                                <tr>
														<td>Jumlah Motor Masuk Bengkel</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[asmasukbengkel]?></span></td>
					                                </tr>
					                            </tbody>
					                        </table>
							                
						           			<div class="col-xs-12">
						           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
						           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
						                        <div class="modal-footer clearfix"> 
								                <?
								                if($dX[status]=='0')
								                	{
												?>
						                        	<button type="button" data-toggle="modal" data-target="#compose-modal-ubah" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> &nbsp;Ubah</button>
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
					
<!-- ################## MODAL UBAH ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL TUTUP SERVIS <?echo date("d-m-Y", strtotime($d1[tanggal]))?></h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:220px;">
				                    	<table>
				                    		<tr>
				                    			<td width="50%">JUMLAH SCAN MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <input type="text" name="asmasukbengkel" value="<?echo number_format($d1[asmasukbengkel],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Unit</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>JUMLAH SCAN KELUAR</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <input type="text" name="askeluarbengkel" value="<?echo number_format($d1[askeluarbengkel],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Unit</span>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
			
		if(!empty($dX[idtutupservis2]))
			{
			if(!empty($_REQUEST[ubah]))
				{
				$asmasukbengkel = preg_replace( "/[^0-9]/", "",$_REQUEST[asmasukbengkel]);
				
				mysql_query("UPDATE x23_tutupservis SET asmasukbengkel='$asmasukbengkel' WHERE id%2=0 AND id='$dX[idtutupservis2]'");
				mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
				
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_tutupservis WHERE id%2=0 AND id='$dX[idtutupservis2]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$d1[iduser]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PIC TUTUP SERVIS</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
					           			<div class="col-xs-12">
										<?
										if($d1[asmulaiservis] != $d1[asmasukbengkel])
											{
										?>
					                        <table id="example4" class="table table-bordered table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th width="" style="padding:7px">KETERANGAN</th>
					                                    <th width="25%" style="padding:7px"><center>TOTAL</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                                <tr>
														<td>Jumlah Motor Mulai Servis</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[asmulaiservis]?></span></td>
					                                </tr>
					                                <tr>
														<td>Jumlah Motor Masuk Bengkel</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[asmasukbengkel]?></span></td>
					                                </tr>
					                            </tbody>
					                        </table>
										<?
											}
										else
											{
										?>
													<h4><b>Jumlah Motor Mulai Servis Sudah Sama Dengan Jumlah Motor Masuk Bengkel</b></h4>
										<?
											}
										?>
							                
						           			<div class="col-xs-12">
						           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
						           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
						                        <div class="modal-footer clearfix"> 
								                <?
								                if($dX[status]=='0')
								                	{
												?>
						                        	<button type="button" data-toggle="modal" data-target="#compose-modal-ubah" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> &nbsp;Ubah</button>
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
					
<!-- ################## MODAL UBAH ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL TUTUP SERVIS <?echo date("d-m-Y", strtotime($d1[tanggal]))?></h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:220px;">
				                    	<table>
				                    		<tr>
				                    			<td width="50%">JUMLAH SCAN MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <input type="text" name="asmasukbengkel" value="<?echo number_format($d1[asmasukbengkel],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Unit</span>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
		
		if(!empty($dX[idtutupservis3]))
			{
			if(!empty($_REQUEST[ubah]))
				{
				$askeluarbengkel = preg_replace( "/[^0-9]/", "",$_REQUEST[askeluarbengkel]);
				
				mysql_query("UPDATE x23_tutupservis SET askeluarbengkel='$askeluarbengkel' WHERE id%2=0 AND id='$dX[idtutupservis3]'");
				mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
				
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_tutupservis WHERE id%2=0 AND id='$dX[idtutupservis3]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$d1[iduser]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PIC TUTUP SERVIS</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
					           			<div class="col-xs-12">
										<?
										if($d1[asselesaiservis] != $d1[askeluarbengkel])
											{
										?>
					                        <table id="example4" class="table table-bordered table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th width="" style="padding:7px">KETERANGAN</th>
					                                    <th width="25%" style="padding:7px"><center>TOTAL</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                                <tr>
														<td>Jumlah Motor Selesai Servis</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[asselesaiservis]?></span></td>
					                                </tr>
					                                <tr>
														<td>Jumlah Motor Keluar Bengkel</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[askeluarbengkel]?></span></td>
					                                </tr>
					                            </tbody>
					                        </table>
										<?
											}
										else
											{
										?>
													<h4><b>Jumlah Motor Selesai Servis Sudah Sama Dengan Jumlah Motor Keluar Bengkel</b></h4>
										<?
											}
										?>
							                
						           			<div class="col-xs-12">
						           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
						           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
						                        <div class="modal-footer clearfix"> 
								                <?
								                if($dX[status]=='0')
								                	{
												?>
						                        	<button type="button" data-toggle="modal" data-target="#compose-modal-ubah" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> &nbsp;Ubah</button>
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
					
<!-- ################## MODAL UBAH ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL TUTUP SERVIS <?echo date("d-m-Y", strtotime($d1[tanggal]))?></h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:220px;">
				                    	<table>
				                    		<tr>
				                    			<td width="50%">JUMLAH SCAN KELUAR</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <input type="text" name="askeluarbengkel" value="<?echo number_format($d1[askeluarbengkel],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Unit</span>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
		
		if(!empty($dX[idtutupservis4]))
			{
			mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_tutupservis WHERE id%2=0 AND id='$dX[idtutupservis4]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$d1[iduser]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PIC TUTUP SERVIS</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                <?
									if($dX[status]=='0')
										{
									?>
										<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:150px;margin-top:-40px;">
											<div class="col-xs-12" style="border-bottom:1px #aaa dashed;">
												<table id="example4" class="table table-bordered table-striped table-hover">
													<thead style="color:#666;font-size:13px">
														<tr>
															<th width="" style="padding:7px">KETERANGAN</th>
															<th width="25%" style="padding:7px"><center>TOTAL</center></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Jumlah Motor Selesai Servis</td>
															<td align="right"><span style="margin-right:30%"><?echo $d1[asselesaiservis]?></span></td>
														</tr>
														<tr>
															<td>Jumlah Kwitansi Servis</td>
															<td align="right"><span style="margin-right:30%"><?echo $d1[askwitansiservis]?></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										<div></div>
										</div>
									<?
										$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM x23_kwitansi_vw WHERE id%2=0 AND jnskwitansi='servis' AND status='0' AND tanggal='$d1[tanggal]'"));
										if(!empty($dB[tot]))
											{
											$qA = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND jnskwitansi='servis' AND status='0' AND tanggal='$d1[tanggal]'");
									?>
											<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:150px;margin-top:-40px;">
												<div class="col-xs-12" style="border-bottom:1px #aaa dashed;">
													<h4><b>Daftar Kwitansi Servis Yang Belum Dicetak</b></h4>
													<table id="example3" class="table table-striped table-hover">
														<thead style="color:#666;font-size:13px">
															<tr>
																<th style="padding:7px" width="15%">NO. KWITANSI</th>
																<th style="padding:7px" width="15%">NO. NOTA SERVIS</th>
																<th style="padding:7px" width="10%">TANGGAL</th>
																<th style="padding:7px" width="1%">WAKTU</br>SELESAI</th>
																<th style="padding:7px" width="12%">NO. ANTRIAN</th>
																<th style="padding:7px" width="10%">NO. POLISI</th>
																<th style="padding:7px">NAMA PELANGGAN</th>
																<th style="padding:7px" width="15%">JUMLAH SERVIS (RP)</th>
															</tr>
														</thead>
														<tbody>
														<?
														while($dA = mysql_fetch_array($qA))
															{
														?>
															<tr style="cursor:pointer;" onclick="location.href='<?echo "?opt=".md5(ksr)."&menu=".md5(kwitansi)."&submenu=A&mod=detail&id=$dA[id]"?>'">
																<td><?echo $dA[nokwitansi]?></td>
																<td><?echo $dA[nomor]?></td>
																<td><?echo date("d-m-Y",strtotime($dA[tanggal]))?></td>
																<td align="center"><?echo $dA[waktuselesai]?></td>
																<td align="center"><?echo $dA[noantrian]?></td>
																<td><?echo $dA[nopol]?></td>
																<td><?echo $dA[nama]?></td>
																<td align="right"><span style="padding-right:30%"><?echo number_format($dA[jumlah],"0","",".")?></span></td>
															</tr>
														<?
															}
														?>
														</tbody>
													</table>
												</div>
											<div></div>
											</div>
									<?
											}
										}
									else
										{
									?>
										<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:150px;margin-top:-40px;">
											<div class="col-xs-12" style="border-bottom:1px #aaa dashed;">
												<h4><b>Semua Kwitansi Servis Sudah Dicetak</b></h4>
											</div>
										</div>
									<?
										}
									?>
			                    </div>
			                </div>

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
		
		if(!empty($dX[idtutupservis5]))
			{
			if(!empty($_REQUEST[ubah]))
				{
				$asmasukbengkel = preg_replace( "/[^0-9]/", "",$_REQUEST[asmasukbengkel]);
				
				mysql_query("UPDATE x23_tutupservis SET asmasukbengkel='$asmasukbengkel' WHERE id%2=0 AND id='$dX[idtutupservis5]'");
				mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
				
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_tutupservis WHERE id%2=0 AND id='$dX[idtutupservis5]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$d1[iduser]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PIC TUTUP SERVIS</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
									
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
					           			<div class="col-xs-12">
										<?
										if($d1[nginap] != $d1[asmasukbengkel])
											{
										?>
					                        <table id="example4" class="table table-bordered table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th width="" style="padding:7px">KETERANGAN</th>
					                                    <th width="25%" style="padding:7px"><center>TOTAL</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                                <tr>
														<td>Jumlah Motor Menginap</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[nginap]?></span></td>
					                                </tr>
					                                <tr>
														<td>Jumlah Motor Masuk Bengkel</td>
														<td align="right"><span style="margin-right:30%"><?echo $d1[asmasukbengkel]?></span></td>
					                                </tr>
					                            </tbody>
					                        </table>
										<?
											}
										else
											{
										?>
													<h4><b>Jumlah Motor Menginap Sudah Sama Dengan Jumlah Motor Masuk Bengkel</b></h4>
										<?
											}
										?>
							                
						           			<div class="col-xs-12">
						           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
						           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
						                        <div class="modal-footer clearfix"> 
								                <?
								                if($dX[status]=='0')
								                	{
												?>
						                        	<button type="button" data-toggle="modal" data-target="#compose-modal-ubah" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> &nbsp;Ubah</button>
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

					
<!-- ################## MODAL UBAH ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL TUTUP SERVIS <?echo date("d-m-Y", strtotime($d1[tanggal]))?></h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:220px;">
				                    	<table>
				                    		<tr>
				                    			<td width="50%">JUMLAH SCAN MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <input type="text" name="asmasukbengkel" value="<?echo number_format($d1[asmasukbengkel],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Unit</span>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
		
		if(!empty($dX[idnotajualdet]))
			{
			if(!empty($_REQUEST[ubah]))
				{
				$jumlahbayarkpb = preg_replace( "/[^0-9]/", "",$_REQUEST[jumlahbayarkpb]);
				mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
				mysql_query("UPDATE x23_notajual_det SET jumlahbayarkpb='$jumlahbayarkpb',statusbayar='1' WHERE id%2=0 AND id='$dX[idnotajualdet]'");
				
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det WHERE id%2=0 AND id='$dX[idnotajualdet]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$dA[idbayar]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:auto;height:300px;margin-top:-20px">
					           			<div class="col-xs-12">
				                        	<table id="example3" class="table table-bordered table-striped" style="min-width:160%">
												<thead>
													<tr>
														<th width="100px">TANGGAL KPB</th>
														<th>KODE BARANG</th>
														<th>NAMA BARANG</th>
														<th>NAMA PELANGGAN</th>
														<th>NAMA MEKANIK</th>
														<th width="150px"><center>STATUS TAGIHAN KE MPM</center></th>
														<th width="150px"><center>JUMLAH TAGIHAN (RP)</center></th>
														<th width="150px"><center>STATUS PEMBAYARAN KPB</center></th>
														<th width="150px"><center>JUMLAH YANG DIBAYAR (RP)</center></th>
													</tr>
												</thead>
					                            <tbody>
					                            <?
												$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND id='$dX[idnotajualdet]'");
												while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama,idmekanik FROM x23_notaservice_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
					                            	$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id%2=0 AND id='$d3[idmekanik]'"));
					                            	
					                            	$tgltagihan  = date("d-m-Y",strtotime($d1[tgltagihan]));
													$tglbayarkpb = date("d-m-Y",strtotime($d1[tglbayarkpb]));
												?>
					                                <tr style="cursor:pointer">
					                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
					                                	<td align="left"><?echo $d1[kodebarang]?></td>
					                                	<td align="left"><?echo "$d1[namabarang] | $d1[varian]"?></td>
					                                	<td align="left"><?echo $d3[nama]?></td>
					                                	<td align="left"><?echo $d4[nama]?></td>
					                                	<td align="center"><?echo $tgltagihan?></td>
				                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
					                                	<td align="center"><?echo $tglbayarkpb?></td>
				                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahbayarkpb],"0","",".")?></span></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                            <tfoot>
					                                <tr>
					                                    <td colspan="10">&nbsp;</td>
					                                </tr>
					                            </tfoot>
					                        </table>
							                
						           			<div class="col-xs-12">
						                        <div class="modal-footer clearfix"> 
								                <?
								                if($dX[status]=='0')
								                	{
												?>
						                        	<button type="button" data-toggle="modal" data-target="#compose-modal-ubah" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> &nbsp;Ubah</button>
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
					
<!-- ################## MODAL UBAH ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL PEMBAYARAN DARI MPM</h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:220px;">
				                    	<table>
									        <tr>
				                    			<td width="50%">JUMLAH BAYAR</td>
				                    			<td width="2%">:</td>
				                    			<td><div class="input-group">
				                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
				                                        <input type="text" name="jumlahbayarkpb" value="<?echo number_format($dA[jumlahbayarkpb],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>                                        		
									            </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
		
		if(!empty($dX[idpenagihankpb]))
			{
			mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
			if(!empty($_REQUEST[ubah]))
				{
				$jumlahbayarkpb = preg_replace( "/[^0-9]/", "",$_REQUEST[jumlahbayarkpb]);
				mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
				//mysql_query("UPDATE x23_notaservice_det SET jumlahbayarkpb='$jumlahbayarkpb',statusbayar='1' WHERE id%2=0 AND id='$dX[idpenagihankpb]'");
				
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_penagihankpb WHERE id%2=0 AND id='$dX[idpenagihankpb]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id%2=0 AND id='$dA[idbayar]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INDIKASI KESALAHAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:auto;height:300px;margin-top:-20px">
					           			<div class="col-xs-12">
				                        	<table id="example2" class="table table-bordered table-striped" style="min-width:220%">
												<thead>
													<tr>
														<th width="100px">TANGGAL KPB</th>
														<th>NO NOTA SERVIS</th>
														<th>JENIS KPB</th>
														<th>NAMA PELANGGAN</th>
														<th>NAMA MEKANIK</th>
														<th >STATUS PENAGIHAN KE MPM</th>
														<th >TGL PENAGIHAN KE MPM</th>
														<th >JUMLAH TAGIHAN (RP)</th>
														<th >JUMLAH TAGIHAN (-2%) (RP)</th>
														<th >STATUS PEMBAYARAN KPB</th>
														<th >TGL PEMBAYARAN KPB</th>
														<th >JUMLAH YANG DIBAYAR (RP)</th>
														<th width="">KETERANGAN TOLAK</th>
													</tr>
												</thead>
					                            <tbody>
					                            <?
					                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
					                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
					                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
					                            
												$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE id%2=0 AND id='$dX[idpenagihankpb]'");
												while($d1 = mysql_fetch_array($q1))
					                            	{
				                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
				                            	$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id%2=0 AND id='$d1[idmekanik]'"));
				                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE id%2=0 AND kode='$d1[kodepaket]'"));
				                            	
				                            	
				                            	if($d1[statuspenagihan]=='0'){
							                        $statustagihan = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Tertagih</span>";
							                        $tglpembayaran = "";
							                        $tglpenagihan = "";
													$statuspembayaran = "";
													}
												if($d1[statuspenagihan]=='1')
													{
							                        $statustagihan = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Sudah Tertagih</span>";
							                        $tglpenagihan = date("d-m-Y",strtotime($d1[tglpenagihan]));
													if(empty($d1[statuspembayaran]))
														{
														$statuspembayaran = "<a data-toggle='modal' data-target='#compose-modal-tglbayarkpb1$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														$tglpembayaran = "";
														}
													if($d1[statuspembayaran]=="DITOLAK")
														{
														if($d1[tagihkembali]=="TIDAK")
															{
															$statuspembayaran = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Ditolak</span>";
															$tglpembayaran = "";
															}
														if($d1[tagihkembali]=="YA")
															{
															$statuspembayaran = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Tagih Kembali</span>";
															$tglpembayaran = "";
															}
														}
													if($d1[statuspembayaran]=="TERBAYAR")
														{
														$statuspembayaran = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Sudah Terbayar</span>";
								                        $tglpembayaran = date("d-m-Y",strtotime($d1[tglpembayaran]));
														}
													}
													
												$pot = round($d1[hargampm] * 0.02 , 0);
												$hargapot = $d1[hargampm]-$pot;
														
					                            ?>
					                                <tr style="cursor:pointer">
					                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglkpb]))?></td>
					                                	<td align="left"><?echo $d1[nonotaservis]?></td>
					                                	<td align="left"><?echo $d5[nama]?></td>
					                                	<td align="left"><?echo $d3[nama]?></td>
					                                	<td align="left"><?echo $d4[nama]?></td>
					                                	<td align="center"><?echo $statustagihan?></td>
					                                	<td align="center"><?echo $tglpenagihan?></td>
				                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahtagih],"0","",".")?></span></td>
				                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahtagih2],"0","",".")?></span></td>
					                                	<td align="center"><?echo $statuspembayaran?></td>
					                                	<td align="center"><?echo $tglpembayaran?></td>
				                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahbayar],"0","",".")?></span></td>
					                                	<td align="left"><?echo $d1[kettolak]?></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                            <tfoot>
					                                <tr>
					                                    <td colspan="8">&nbsp;</td>
					                                </tr>
					                            </tfoot>
					                        </table>
							                
						           			<div class="col-xs-12">
						                        <div class="modal-footer clearfix"> 
								                <?
								                if($dX[status]=='0')
								                	{
								                	/*
												?>
						                        	<button type="button" data-toggle="modal" data-target="#compose-modal-ubah" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> &nbsp;Ubah</button>
						                        <?
						                        */
						                        	}
						                        ?>	
						                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
												</div>
						                    </div>
				                    	</div>
				                    </div>
			                    </div>
			                </div>
					
<!-- ################## MODAL UBAH ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL PEMBAYARAN DARI MPM</h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:220px;">
				                    	<table>
									        <tr>
				                    			<td width="50%">JUMLAH BAYAR</td>
				                    			<td width="2%">:</td>
				                    			<td><div class="input-group">
				                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
				                                        <input type="text" name="jumlahbayarkpb" value="<?echo number_format($dA[jumlahbayarkpb],"0","",".")?>" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>                                        		
									            </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			            </div>
			        </div>
				</section>
			</aside>
<?
			}
		
		if(!empty($dX[idnotaindent]))
			{
			mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_abis_ikesalahan WHERE id%2=0 AND idnotaindent='$dX[idnotaindent]'"));
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE id%2=0 AND nonota='$dA[notajual]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>RIWAYAT PENJUALAN</small></h4>
			                	
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NOMOR NOTA JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $d1[nonota]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" style="width: 20%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="30%">NAMA PELANGGAN</td>
			                    			<td width="2%">:</td>
			                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
			                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
			                    		</tr>
	                            	</table>
	                            	
			                    	<div id="spoiler" style="display:none">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR OHC</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
		                            	</table>
			                    	</div>
				                    
	                            	<div style="overflow-x:auto;overflow-y:auto;margin-top:20px">
				                        <table id="example2" class="table table-striped table-hover" style="width:120%">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
				                                    <th width="7%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
								                    <?
								                    if($d1[status]=='0'){
								                    ?>
				                                    	<th width="7%" style="padding:7px"><center>STOK TERKINI</center></th>
				                                    <?}?>
				                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
				                                    <th width="" style="padding:7px"><center>JUMLAH JUAL (RP)</center></th>
				                                    <th width="" style="padding:7px">GUDANG</th>
				                                    <th width="" style="padding:7px">RAK</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, 
																											SUM(totdiskon) AS ttotdiskon,
																											SUM(tothargabelibersih) AS ttothargabelibersih
																											FROM x23_notajual_det_vw WHERE id%2=0 AND nonota='$d1[nonota]'"));
											
											$qE = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
											$qC = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
											$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
				                            while($dA = mysql_fetch_array($qA))
				                            	{
								                if($d1[status]=='0'){
					                            	$dCs = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE id%2=0 AND nonota='$dA[notabeli]' AND idgudang='$dA[idgudang]' AND idbarang='$dA[idbarang]' AND rak='$dA[rak]'"));
					                            	if($dCs[stok]<$dA[qty]){
														$red = "color:#ff0227";
														}
													else{$red="";}
													}
				                            ?>
							                    <tr style="cursor:pointer;<?echo $red?>">
				                                    <td><?echo $dA[kodebarang]?></td>
				                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    
									                    <?
									                    if($d1[status]=='0'){
									                    ?>
					                                   	 	<td align="right"><span style="margin-right:20%"><?echo number_format($dCs[stok],"0","",".")?> PCS</span></td>
					                                   	<?}?>
				                                   	
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
				                                    <td><?echo $dA[gudang]?></td>
				                                    <td><?echo $dA[rak]?></td>
				                                </tr>
				                                
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                            	<tr>
				                            		<th colspan="2"></th>
								                    <?
								                    if($d1[status]=='0'){
								                    ?>
				                            			<td colspan="3" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
				                            		<?}else{?>
				                            			<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
													<?}?>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
				                            		<th colspan="3"></th>
				                            	</tr>
				                            </tfoot>
				                        </table>
				                    </div>
			                        
				                    <?
				                    if($d1[status]=='0'){
				                    ?>
				                        <table width="100%">
				                        	<tr>
				                        		<td colspan="3"><b>Keterangan</b></td>
				                        	</tr>
				                        	<tr>
				                        		<td style="color:#ff0227">Merah</td>
				                        		<td width="15px" align="center">:</td>
				                        		<td>Qty Stok Terkini Tidak Mencukupi</td>
				                        	</tr>
				                        	<tr>
				                        		<td>Hitam</td>
				                        		<td align="center">:</td>
				                        		<td>Qty Stok Terkini Mencukupi</td>
				                        	</tr>
				                        </table>
				                    <?}?>
				                    
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
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
		
		if(!empty($dX[idpenagihanoli]))
			{
			mysql_query("UPDATE x23_abis_ikesalahan SET status='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_abis_ikesalahan WHERE id%2=0 AND idpenagihanoli='$dX[idpenagihanoli]'"));
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND id='$dX[idpenagihanoli]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'"));			                           
			$d3 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS hargaoli FROM x23_claimoli_det WHERE id%2=0 AND nonota='$d1[nonota]'"));	
			
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENAGIHAN <small>OLI KE MPM</h4>
				           			<div class="col-xs-6">
				                        <table width="100%">
				                    		<tr>
				                    			<td width="35%">NAMA SUPPLIER</td>
				                    			<td width="3%">:</td>
				                    			<td><input type="text" value="MPM" class="form-control" maxlength="20" style="width:50%" disabled></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NO. PO CLAIM MPM</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" disabled></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NO. NOTA CLAIM OLI</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
				                        	</tr>
				                        </table>
				                    </div>
				           			<div class="col-xs-6">
				                        <table width="100%">
				                        	<tr>
				                        		<td>NO. KWITANSI CLAIM OLI</td>
				                        		<td>:</td>
				                        		<td><input type="text" name="nokwitansi" value="<?echo $d1[nokwitansi]?>" class="form-control" maxlength="20" style="width:50%" disabled></td>
				                        	</tr>
				                        	<tr>
				                        		<td width="40%">TGL PO CLAIM MPM</td>
				                        		<td width="3%">:</td>
				                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TGL NOTA CLAIM OLI</td>
				                        		<td>:</td>
				                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
				                        	</tr>
				                        </table>
				                    </div>
				                    
			                    	<div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
				                        <table id="example2" class="table table-striped table-hover" style="width:150%">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">NO. NOTA</br>SERVIS</th>
				                                    <th style="padding:7px">TGL NOTA</br>SERVIS</th>
				                                    <th style="padding:7px">KODE PAKET</th>
				                                    <th style="padding:7px">KPB KE</th>
				                                    <th style="padding:7px">NAMA KPB</th>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">BARANG</th>
				                                    <th style="padding:7px">HARGA OLI</br>PENGGANTIAN (RP)</th>
				                                    <th style="padding:7px">STATUS</th>
				                                    <th style="padding:7px">TAGIH KEMBALI</th>
				                                    <th style="padding:7px">KETERANGAN</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	$dD1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_claimoli_det WHERE id%2=0 AND id='$d1[id_claimoli_det]'"));
												if($dD1[statusclaim]=='DITOLAK'){
				                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><label><?echo "$dD1[nonotaservis]"?></label></td>
					                                    <td><?echo date("d-m-Y",strtotime($dD1[tglservis]))?></td>
					                                    <td><?echo $dD1[kodepaket]?></td>
					                                    <td><?echo $dD1[kpbke]?></td>
					                                    <td><?echo $dD1[namakpb]?></td>
					                                    <td><?echo $dD1[kodebarang]?></td>
					                                    <td><?echo "$dD1[namabarang] | $dD1[varian]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dD1[hargaoli],"0","",".")?></span></td>
				                                    	<td><?echo $dD1[statusclaim]?></td>
					                                    <td><?echo $dD1[tagihkembali]?></td>
				                                    	<td><?echo $dD1[kettolak]?></td>
					                                </tr>
				                            <?
													}
				                            	}
				                             ?>
				                            </tbody>
				                            <tfoot>
				                            	<tr>
				                            		<th colspan="6"></th>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d3[hargaoli])?></b></span></td>
				                            	</tr>
				                            	<tr>
				                            		<th colspan="6"></th>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b>TOTAL QTY CLAIM</b></span></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?> PCS</b></span></td>
				                            	</tr>
				                            </tfoot>
				                        </table>
				                    </div>
			                        
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
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
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
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