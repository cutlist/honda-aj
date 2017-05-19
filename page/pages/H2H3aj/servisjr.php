<?
	if($submenu == 'A')
		{
		$noservis 	= strtoupper($_REQUEST[noservis]);
		$km 		= preg_replace( "/[^0-9]/", "",$_REQUEST[km]);
		
			
		if(!empty($_REQUEST[input]))
			{
			$dPeriksa =mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice WHERE id%2=0 AND nonota='$noservis'"));
			if(empty($dPeriksa[id]))
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&note=6&input='/>";
				exit();
				}
				
			if($_REQUEST[km] == "0"){
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&note=1&input='/>";
				exit();
				}
			if(!empty($noservis)){
				$dCkm = mysql_fetch_array(mysql_query("SELECT km FROM x23_notaservice WHERE id%2=0 AND nonota='$noservis'"));
				$selisihkm = abs($km-$dCkm[km]);
				if($selisihkm > "500"){
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&note=2&input='/>";
					exit();
					}
				}
				
			$dCns =mysql_fetch_array(mysql_query("SELECT *,(TO_DAYS(CURDATE())- TO_DAYS(tglnota)) AS lama FROM x23_notaservice WHERE id%2=0 AND nonota='$noservis'"));
			if(empty($dCns[id]))
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&note=3&input='/>";
				exit();
				}
			if($dCns[lama] > "7")
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&note=4&input='/>";
				exit();
				}
				
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&note=5&input='/>";
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
			                	<h4>SERVIS <small>PERIKSA SERVIS JR</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Mohon Ulangi, Karena KM Tidak Boleh 0 (Nol)!</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="2")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Servis JR tidak dapat dilakukan, Karena KM Saat Ini Melebihi Batas KM Garansi Servis JR!</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="3")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Servis JR tidak dapat dilakukan, Karena Nomor Nota Servis Sebelumnya Tidak Ada Pada Database!</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="4")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Servis JR tidak dapat dilakukan, Karena Tanggal Nota Servis Sudah Melewati 7 Hari!</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="6")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Nomor Servis Sebelumnya Salah Atau Tidak Ada Pada Database!</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="5")
										{
									?>
	                                    <div class="alert alert-success  alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-check"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Servis JR dapat dilakukan! Silahkan Melanjutkan Ke Menu Input Antrian.</p>
	                                    </div>
									<?
										}
									?>
			                	
				                   	<form method="post"  action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA SERVIS SEBELUMNYA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="noservis" class="form-control" autofocus style="width: 30%" maxlength="20" required></td> 
				                    		</tr>
				                    		<tr>
				                    			<td>KM SAAT INI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="km" class="form-control uang" style="width: 15%;text-align:right" value="" maxlength="8" onkeypress="return buat_angka(event,'1234567890')" required=""></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i> &nbsp;Periksa</button>
				                	</div>
									</form>
			                    </div>
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
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
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