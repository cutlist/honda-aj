<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[update]))
			{
			$perusahaan = strtoupper($_REQUEST['perusahaan']);
			$nama = strtoupper($_REQUEST['nama']);
			$alamatperusahaan = strtoupper($_REQUEST['alamatperusahaan']);
			$kotaperusahaan = strtoupper($_REQUEST['kotaperusahaan']);
			$kepalacabang = strtoupper($_REQUEST['kepalacabang']);
			$npwp = strtoupper($_REQUEST['npwp']);
			$ppkp = strtoupper($_REQUEST['ppkp']);
			$alamatnpwp = strtoupper($_REQUEST['alamatnpwp']);
			$kotanpwp = strtoupper($_REQUEST['kotanpwp']);
			$kodedealer = strtoupper($_REQUEST['kodedealer']);
			$namacabang = strtoupper($_REQUEST['namacabang']);
											
				
			$q1 = mysql_query("UPDATE tbl_perusahaan SET
											perusahaan='$perusahaan', 
											nama='$nama', 
											alamatperusahaan='$alamatperusahaan', 
											kotaperusahaan='$kotaperusahaan', 
											kepalacabang='$kepalacabang', 
											npwp='$npwp', 
											ppkp='$ppkp', 
											alamatnpwp='$alamatnpwp', 
											kotanpwp='$kotanpwp', 
											namacabang='$namacabang', 
											kodedealer='$kodedealer'
										WHERE id='1'	
							");
			if($q1)
				{
				//echo "<script>alert ('Proses berhasil.')</script>";
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
						if($_SESSION[posisi]=='DIREKSI'){$ket = "required";}
						else{$ket = "disabled";}
?>
			            <div class="col-xs-12">		                
			                <div class="small-box bg-teal" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<i class="fa fa-building-o" style="font-size:44px"></i> 
			                	<h4 style="border-bottom:1px dashed #fff;padding-bottom:5px"><b>MASTER PERUSAHAAN</b></h4>
			                	<form method="post" action="" enctype="multipart/form-data">
			                    	<table style="width:90%;font-size:13px;font-weight:bold;">
			                    		<tr>
			                    			<td align="right">PERUSAHAAN</td>
			                    			<td></td>
			                    			<td><input type="text" name="perusahaan" value="<?echo $d1[perusahaan]?>" class="form-control" maxlength="30" style="width:80%" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right" width="35%">NAMA</td>
			                    			<td></td>
			                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="50" style="width:80%" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right" valign="top">ALAMAT</td>
			                    			<td></td>
			                    			<td><textarea name="alamatperusahaan" class="form-control" style="width:80%" <?echo $ket?>><?echo $d1[alamatperusahaan]?></textarea></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">KOTA</td>
			                    			<td></td>
			                    			<td><input type="text" name="kotaperusahaan" value="<?echo $d1[kotaperusahaan]?>" class="form-control" maxlength="20" style="width:80%" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">NAMA CABANG</td>
			                    			<td></td>
			                    			<td><input type="text" name="namacabang" value="<?echo $d1[namacabang]?>" class="form-control" style="width:80%" maxlength="30" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">KODE DEALER</td>
			                    			<td></td>
			                    			<td><input type="text" name="kodedealer" value="<?echo $d1[kodedealer]?>" class="form-control" style="width:80%" maxlength="10" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">KEPALA CABANG</td>
			                    			<td></td>
			                    			<td><input type="text" name="kepalacabang" value="<?echo $d1[kepalacabang]?>" class="form-control" style="width:80%" maxlength="30" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td colspan="2" ></td>
			                    			<td style="border-bottom:1px dashed #fff;padding-bottom:5px;width:80%"></td>
			                    		</tr>
			                    		<tr>
			                    			<td colspan="3" style="height:10px"></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">NPWP</td>
			                    			<td></td>
			                    			<td><input type="text" name="npwp" value="<?echo $d1[npwp]?>" class="form-control" maxlength="30" style="width:80%" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">PPKP</td>
			                    			<td></td>
			                    			<td colspan="2"><input type="text" name="ppkp" value="<?echo $d1[ppkp]?>" class="form-control" maxlength="50" style="width:80%" <?echo $ket?>></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right" valign="top">ALAMAT</td>
			                    			<td></td>
			                    			<td><textarea name="alamatnpwp" class="form-control" style="width:80%" <?echo $ket?>><?echo $d1[alamatnpwp]?></textarea></td>
			                    		</tr>
			                    		<tr>
			                    			<td align="right">KOTA</td>
			                    			<td></td>
			                    			<td><input type="text" name="kotanpwp" value="<?echo $d1[kotanpwp]?>" class="form-control" maxlength="30" style="width:80%" <?echo $ket?>></td>
			                    		</tr>
				                    	<input type="hidden" name="update" value="1">
	                            	</table>
		                        <div class="modal-footer clearfix" style="border-top:1px dashed #fff;padding-bottom:5px">
									<?
										if($_SESSION[posisi]=='DIREKSI'){
									?>
										<button type="submit" class="btn btn-danger"><i class="fa fa-edit"></i> &nbsp;Update</button>
									<?
										}
									?>
								</div>
								</form>
			                </div>
			            </div>
<?
						}
?>
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