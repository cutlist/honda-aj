<?
		if(!empty($_REQUEST[scan]))
			{
				mysql_query("INSERT INTO _tools VALUES ('$_REQUEST[scan]')");
			}
		if(!empty($_REQUEST[reset]))
			{
				mysql_query("TRUNCATE _tools");
			}
?>
		<script type="text/javascript">
			var s5_taf_parent = window.location;
			function popup_print(){
				window.open('printaj/tools.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
				}
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-header">
			                        <h3 class="box-title">Tools Stock Taking Sparepart</h3>                                    
			                    </div><!-- /.box-header -->
			                    
			                    <div class="box-body table-responsive" style="width:55%;margin:0 auto">
				                    <form method="POST" action="" enctype="multipart/form-data">
			                            <div class="small-box bg-green" style="width:100%;margin:0 auto;margin-bottom:30px;cursor: pointer;"">
			                                <div class="inner">
				                    			<input type="text" name="scan" class="form-control" style="width:60%;margin:0 auto;text-align: center" autofocus>
			                                </div>
			                                <a href="#" class="small-box-footer">
			                                   	Tools Stock Taking Sparepart <i class="fa fa-arrow-circle-down"></i>
			                                </a>
			                            </div>
                                    
				                    	<table border="0" width="100%" style="margin: 0 auto">
				                    		<tr><!--
												<td align="center"><button type="submit" class="btn btn-warning" style="width:200px"><i class="fa fa-barcode"></i> &nbsp; Scan !</button></td>
												-->
												<td align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&reset=1"?>"><button type="button" onclick="return confirm('Anda Yakin Akan Mengulang Perhitungan?')" class="btn btn-danger" style="width:200px"><i class="fa fa-refresh"></i> &nbsp;Reset</button></a></td>
				                    		</tr>
				                    		<tr>
				                    			<td height="20px"></td>
				                    		</tr>
				                    	</table>
				                    </form>
				                    
                                    <div style="float:right;" class="col-xs-3">
                                    	<table width="100%" border="0">
                                    		<tr>
                                    			<td><a href="#" onClick="popup_print()"><button type="button" class="btn btn-info pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
									</div>
			                        <table id="example1" class="table table-bordered table-hover" style="width:100%;padding-right:20px">
										<thead>
											<tr>
												<th><center>NAMA BARANG</center></th>
												<th width="25%"><center>KUANTITAS (PCS)</center></th>
											</tr>
										</thead>
			                            <tbody>
			                        <?
										$q2	 = mysql_query("SELECT scan,COUNT(scan) AS qty FROM _tools GROUP BY scan");
										while($d2  = mysql_fetch_array($q2))
											{
											echo"
												<tr> 
													<td align='left'>$d2[scan]</td>
													<td align='right'><span style='padding-right:30%'>$d2[qty]<span></td>
												</tr>";
											}
										?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="10">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
			        </div>
				</section>
			</aside>
			
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": false,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>