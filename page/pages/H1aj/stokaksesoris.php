<?
	if($submenu == 'A')
		{
?>
		<script type="text/javascript">
			var s5_taf_parent = window.location;
			function popup_print(){
				window.open('printaj/stokunit.php?idgudang=<?echo $_REQUEST[idgudang]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
				}
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>LIHAT STOK AKSESORIS</h4>
			                	<!--
                                    <div style="float:right;" class="col-xs-5">
                                    	<table>
                                    		<tr>
                                    			<td width="99%"></td>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
									</div>
								-->
									
									<?
									if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
										{
									?>
                           				<button type="button"  onclick="window.open('printaj/h1/stokaksesoris.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
                           			<?
                           				}
                           			?>
			                        <table id="example1" class="table table-striped table-hover table-bordered">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px;width:10%">ACCU (PCS)</th>
			                                    <th style="padding:7px;width:12.5%">ALAS KAKI (PCS)</th>
			                                    <th style="padding:7px;width:15%">2 ANAK KUNCI (PCS)</th>
			                                    <th style="padding:7px;width:11.5%">HELM (PCS)</th>
			                                    <th style="padding:7px;width:12.5%">SPION (PCS)</th>
			                                    <th style="padding:7px;width:12.5%">TOOLKIT (PCS)</th>
			                                    <th style="padding:7px;width:11.5%">JAKET (PCS)</th>
			                                    <th style="padding:7px;width:13.5%">BUKU SERVIS (PCS)</th>
			                                    <!--
			                                    <th width="1%" style="padding:7px">AKSI</th>
			                                    -->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            	$d1 = mysql_fetch_array(mysql_query("SELECT SUM(accu/2) AS stok,SUM(jual/2) AS jual FROM stok_accu"));
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT SUM(alaskaki/2) AS stok,SUM(jual/2) AS jual FROM stok_alaskaki"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT SUM(anakkunci/2) AS stok,SUM(jual/2) AS jual FROM stok_anakkunci"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT SUM(helm/2) AS stok,SUM(jual/2) AS jual FROM stok_helm"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT SUM(spion/2) AS stok,SUM(jual/2) AS jual FROM stok_spion"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT SUM(toolkit/2) AS stok,SUM(jual/2) AS jual FROM stok_toolkit"));
			                            	$d7 = mysql_fetch_array(mysql_query("SELECT SUM(jaket/2) AS stok,SUM(jual/2) AS jual FROM stok_jaket"));
			                            	$d8 = mysql_fetch_array(mysql_query("SELECT SUM(bukuservis/2) AS stok,SUM(jual/2) AS jual FROM stok_bukuservis"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d1[stok]-$d1[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d2[stok]-$d2[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d3[stok]-$d3[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d4[stok]-$d4[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d5[stok]-$d5[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d6[stok]-$d6[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d7[stok]-$d7[jual])?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo round($d8[stok]-$d8[jual])?></span></td>
			                                    <!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-120px;font-size: 12px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-detailstok<?echo $d1[nonota]?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat Detail</a></li>
			                                           	</ul>
			                                        </div>
			                                        </td>
			                                    -->
			                                </tr>
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
?>
	
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
                    "bAutoWidth": true
                });
            });
        </script>