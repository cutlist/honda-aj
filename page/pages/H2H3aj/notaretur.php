<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>NOTA RETUR BELI</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA  RETUR BELI / NO. NOTA BELI / NAMA SUPPLIER ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h2/notaretur.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
									
			                        <table id="example1" class="table table-striped" style="width:125%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA RETUR BELI</th>
			                                    <th style="padding:7px">TGL NOTA RETUR BELI</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th style="padding:7px" width="10%"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th style="padding:7px" width="10%"><center>POTONG BAYAR</br>NOTA BELI (RP)</center></th>
			                                    <th style="padding:7px" width="10%"><center>SISA (RP)</center></th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notaretur_vw WHERE id%2=0 AND (nonota LIKE '%$_REQUEST[cari]%' OR noretur LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notaretur_vw WHERE id%2=0 ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[status]=="2"){$status = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>SEBAGIAN NILAI RETUR BELI MEMOTONG NOTA BELI</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>SEMUA NILAI RETUR BELI SUDAH MEMOTONG NOTA BELI</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>NILAI RETUR BELI BELUM MEMOTONG NOTA BELI</span>";}
			                            ?>
			                                <tr>
			                                    <td><?echo $d1[noretur]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[potong],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[sisa],"0","",".")?></span></td>
			                                    <td><?echo $status?></td>
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
?>
	
        <script src="js/jquery.min.js"></script>
        
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>