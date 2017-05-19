<?
			if(!empty($_REQUEST[del1]))
				{
				mysql_query("TRUNCATE tbl_history_bcashtempo");
				mysql_query("TRUNCATE stok_accu");
				mysql_query("TRUNCATE stok_alaskaki");
				mysql_query("TRUNCATE stok_anakkunci");
				mysql_query("TRUNCATE stok_helm");
				mysql_query("TRUNCATE stok_spion");
				mysql_query("TRUNCATE stok_toolkit");
				mysql_query("TRUNCATE stok_jaket");
				mysql_query("TRUNCATE stok_bukuservis");
				mysql_query("TRUNCATE tbl_abis_dkonfirmasi");
				mysql_query("TRUNCATE tbl_bayarsup_history");
				mysql_query("TRUNCATE tbl_bpkb");
				mysql_query("TRUNCATE tbl_cekfisik");
				mysql_query("TRUNCATE tbl_hutitipan");
				mysql_query("TRUNCATE tbl_kwitansi");
				mysql_query("TRUNCATE tbl_notabeli");
				mysql_query("TRUNCATE tbl_notabeli_det");
				mysql_query("TRUNCATE tbl_notajual");
				mysql_query("TRUNCATE tbl_notajual_det");
				mysql_query("TRUNCATE tbl_opname");
				mysql_query("TRUNCATE tbl_opname_det");
				mysql_query("TRUNCATE tbl_pengeluaranunit");
				mysql_query("TRUNCATE tbl_pesanan");
				mysql_query("TRUNCATE tbl_pesanan_det");
				mysql_query("TRUNCATE tbl_pindah");
				mysql_query("TRUNCATE tbl_pindah_det");
				mysql_query("TRUNCATE tbl_returbeli");
				mysql_query("TRUNCATE tbl_stnkbpkb");
				mysql_query("TRUNCATE tbl_stokunit");
				mysql_query("TRUNCATE tbl_stokunit");
				mysql_query("TRUNCATE tbl_transfer");
				mysql_query("TRUNCATE tbl_bensin");
				mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    '',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS DATABASE 1 $_REQUEST[nama]')
									");
				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
				}
				
			if(!empty($_REQUEST[del2]))
				{
				mysql_query("TRUNCATE tbl_pelanggan");
				mysql_query("TRUNCATE tbl_hohc");
				mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    '',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS DATABASE 2 $_REQUEST[nama]')
									");
				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
				}
				
			if(!empty($_REQUEST[del3]))
				{
				mysql_query("TRUNCATE tbl_kaskecil");
				mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    '',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS DATABASE 3 $_REQUEST[nama]')
									");
				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
				}
				
			if(!empty($_REQUEST[del4]))
				{
				mysql_query("TRUNCATE tbl_bensin");
				mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    '',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS DATABASE 4 $_REQUEST[nama]')
									");
				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
				}
				
			if(!empty($_REQUEST[del5]))
				{
				mysql_query("DELETE FROM tbl_karyawan WHERE posisi NOT IN ('1','6')");
				mysql_query("DELETE FROM tbl_user WHERE user!='administrator'");
				mysql_query("TRUNCATE tbl_insentif_grup");
				mysql_query("TRUNCATE tbl_insentif_inc");
				mysql_query("TRUNCATE tbl_insentif_karyawan");
				mysql_query("TRUNCATE tbl_kompensasi");
				mysql_query("TRUNCATE tbl_lembur");
				mysql_query("TRUNCATE tbl_potkompensasi");
				mysql_query("TRUNCATE tbl_uangharian");
				mysql_query("TRUNCATE tbl_uanglembur");
				mysql_query("TRUNCATE tbl_uanglembur");
				mysql_query("TRUNCATE abs_status");
				mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    '',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS DATABASE 5 $_REQUEST[nama]')
									");
				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
				}
				
			if(!empty($_REQUEST[del6]))
				{
				mysql_query("TRUNCATE tbl_masterbarang");
				mysql_query("TRUNCATE tbl_grossubsidi");
				mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    '',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS DATABASE 6 $_REQUEST[nama]')
									");
				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
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
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>HAPUS <small>DATABASE</small></h4>
									<!--
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-karyawan" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Karyawan Baru</button>
										</a>
										<a data-toggle="modal" data-target="#compose-modal-log-karyawan" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-list"></i> &nbsp; Log</button>
										</a>
	                           		</div>
									-->
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KETERANGAN DATA</th>
			                                    <th style="padding:7px">HAPUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data Pembelian, Stok dan Penjualan (Semua Transaksi Yang Menyangkut Ketiganya Juga Akan Dihapus) </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del1=1"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data Pelanggan </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del2=2"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data Kas Kecil </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del3=3"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data Bensin </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del4=4"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data Karyawan Kecuali Direksi (Semua Data SDM Yang Menyangkut Karyawan Juga Akan Dihapus) </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del5=5"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data Master Barang Dan Master Pajak </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del6=6"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL TAMBAH KARYAWAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-karyawan" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KARYAWAN BARU</h4>
				                    </div>
											
				                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:420px;">
				                    	<table>
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NIK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nik" class="form-control" style="width: 50%" maxlength="12" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" onchange="populateSelect1(this.value)" required style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM x23_posisi WHERE id!='1' ORDER BY posisi");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>'><?echo $dA[posisi]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PANGKAT</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="pangkat" required style="width: 50%" disabled="">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM x23_pangkat ORDER BY pangkat");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[pangkat]?>'><?echo $dA[pangkat]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TEMPAT/TGL LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="1"><input type="text" name="tmplahir" maxlength="20" class="form-control" required></td>
				                    			<td colspan="1" width="20%"><input type="text" name="tgllahir" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="noktp" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="notelepon" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL MULAI KERJA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tglmulaikerja" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>GAJI POKOK</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ugapok" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="uharian" id="uang2" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ukomisi" id="uang3" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ulembur" id="uang4" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->
<?
						}
?>
			        </div>
				</section>
			</aside>
			
	
        <script src="js/jquery.min.js"></script>
        
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>