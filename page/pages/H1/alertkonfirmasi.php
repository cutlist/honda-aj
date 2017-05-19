<?
	if($submenu == 'A')
		{
			$periode_tahun = date("Y");
			$periode_bulan = date('m');
?>
			<meta http-equiv="refresh" content="10"></meta>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;">
			                	<h4>ALERT <small>DAFTAR KONFIRMASI</small></h4>
	                                <div class="inner col-xs-12">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd;cursor:pointer" onclick="location.href='<?echo "?opt=".md5(abis)."&submenu=A&menu=".md5(abis_dkonfirmasi)?>'">    
		                                	<div class="btn-danger" style="width:100%;height:358px;border-radius:5px;padding:5px;">
                                			<?
											$d1  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_abis_dkonfirmasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND status='0'"));
                                			?>
	                                			<h2>ANDA MEMILIKI</h2>
		                                    	<span style="font-size:145px;letter-spacing:5px;"><b><?echo $d1[total]?></b></span>
		                                    	
		                                    	<div class="clearfix"><h4>Konfirmasi Yang Membutuhkan Respon Anda</h4></div>
		                                    </div>
	                                    </div>
	                                </div>
	                                <!--
	                                <div class="inner col-xs-5">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
		                                	<div class="" style="width:100%;overflow-x:hidden;overflow-y:auto;height:358px;border-radius:5px;padding:5px;">
		                                			<h3>PERIHAL KONFIRMASI</h3>
		                                			</br>
							                        <table id="example2" class="table table-hover" style="width:100%;padding-right:20px">
							                            <tbody>
			                                	<?
													$q1	 = mysql_query("SELECT * FROM tbl_abis_dkonfirmasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND status='0' ORDER BY tanggal");
													while($d1  = mysql_fetch_array($q1))
														{
						                       	?>
														<tr style='cursor:pointer;' onclick="location.href='<?echo "?opt=".md5(abis)."&menu=".md5(abis_dkonfirmasi)."&submenu=view&id=$d1[id]"?>'">
			                                    			<td align="left" style="padding:15px"><?echo $d1[kasus]?></td>
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
		                                	</div>
	                                    </div>
	                                </div>
	                                -->
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
?>