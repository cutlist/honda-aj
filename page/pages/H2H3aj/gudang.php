<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{	
				$gudang	= strtoupper($_REQUEST['gudang']);
				$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND gudang='$gudang'"));
				if(!empty($dCek[id])){
					echo "<script>alert ('Gudang Tersebut Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					
				}
							
				$q1 = mysql_query("INSERT INTO x23_gudang (
													gudang) 
												VALUES (
													'$gudang');
									");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_gudang',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH GUDANG $gudang')
									");
						
						
						if($q1 && $q2)
							{
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}

			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM x23_gudang WHERE id%2=0 AND id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_gudang',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS GUDANG $_REQUEST[gudang]')
									");
				
				
				if($q1 && $q2)
					{
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				}
			}
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah])){				
				$gudang	= strtoupper($_REQUEST['gudang']);
				$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND gudang='$gudang'"));
				if(!empty($dCek[id])){
					echo "<script>alert ('Gudang Tersebut Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
				}
							
				$q1 = mysql_query("UPDATE x23_gudang SET
													gudang='$gudang'
											WHERE id%2=0 AND id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_gudang',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH GUDANG $gudang')
									");
					
					if($q1 && $q2)
						{
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
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
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>GUDANG</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-gudang" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Gudang Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NAMA GUDANG</th>
			                                    <th width="5%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_gudang");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[gudang]?></td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL TAMBAH GUDANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-gudang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:40%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH GUDANG BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA GUDANG</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="gudang" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
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
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>GUDANG &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Gudang</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA GUDANG</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="gudang" value="<?echo $d1[gudang]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required=""></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
            });
        </script>