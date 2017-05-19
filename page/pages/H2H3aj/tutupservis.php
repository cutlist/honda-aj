<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[tutupservis]))
			{
			$p_tahun = date("Y");
			$p_bulan = date("m");
			
			$dA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scanmasuk WHERE id%2=0 AND tanggal=CURDATE()"));
			$asmasukbengkel = round($dA[total]/2);
			$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE()"));
			$asmulaiservis = $dB[total];
			$dC = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE() AND status!='0'"));
			$asselesaiservis = $dC[total];
			$dD = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scankeluar WHERE id%2=0 AND tanggal=CURDATE()"));
			$askeluarbengkel = round($dD[total]/2);
			$dF = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE() AND status='2'"));
			$askwitansiservis = $dF[total];
				
			$asnginap = round($dA[total]/2)-round($dD[total]/2);
			
			$nginap   = preg_replace( "/[^0-9]/", "",$_REQUEST['nginap']);
			//echo "<script>alert ('$nginap $asmasukbengkel')</script>";
			//exit();
			
			mysql_query("INSERT INTO x23_tutupservis (
											tahun,
											bulan,
											tanggal,
											asmulaiservis,
											asmasukbengkel,
											askeluarbengkel,
											asselesaiservis,
											askwitansiservis,
											asnginap,
											nginap,
											iduser,
											inputx) 
										VALUES (
											'$p_tahun',
											'$p_bulan',
											CURDATE(),
											'$asmulaiservis',
											'$asmasukbengkel',
											'$askeluarbengkel',
											'$asselesaiservis',
											'$askwitansiservis',
											'$asnginap',
											'$nginap',
											'$_SESSION[id]',
											NOW())
							");
							
			$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
			$idtutupservis	= $id[id];
							
			mysql_query("INSERT INTO x23_abis_dkonfirmasi (
											idtutupservis, 
											tahun, 
											bulan, 
											tanggal,
											kasus, 
											tbl,
											inputx) 
										VALUES (
											'$idtutupservis', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'KONFIRMASI TUTUP SERVIS : JUMLAH MOTOR MENGINAP $_REQUEST[nginap] UNIT', 
											'x23_tutupservis', 
											NOW())
						");
			/*
			if($asnginap < 0)
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis1, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$idtutupservis', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : JUMLAH SCAN KELUAR LEBIH BANYAK DARI JUMLAH SCAN MASUK', 
												'x23_tutupservis', 
												NOW())
							");
				}
			if($asmulaiservis != $asmasukbengkel)
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis2, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$idtutupservis', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH MULAI SERVIS DENGAN JUMLAH SCAN MASUK', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			if($asselesaiservis != $askeluarbengkel)
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis3, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$idtutupservis', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH SELESAI SERVIS DENGAN JUMLAH SCAN KELUAR', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			if($asselesaiservis != $askwitansiservis)
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis4, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$idtutupservis', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH KWITANSI SERVIS DENGAN JUMLAH SELESAI SERVIS', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			if($nginap > $asmasukbengkel)
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis5, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$idtutupservis', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : JUMLAH MOTOR MENGINAP LEBIH BANYAK DARI JUMLAH SCAN MASUK', 
												'x23_tutupservis', 
												NOW())
							");
				}
			*/
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
			exit();
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
						$dUM = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS tot FROM x23_notaservice_vw WHERE id%2=0 AND status='0'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>SERVIS <small>TUTUP SERVIS</small></h4>
									<?
									$dC = mysql_fetch_array(mysql_query("SELECT id FROM x23_tutupservis WHERE id%2=0 AND tanggal=CURDATE()"));
									if(empty($dC[id]))
										{
									?>
				                   		<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%"><h5>QTY MENGINAP</h5></td>
					                    			<td width="2%">:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                                        <input type="text" name="nginap" style="width:100%;text-align:right;height:45px" class="form-control uang" value="<?echo number_format($dUM[tot])?>" maxlength="6" onkeypress="return buat_angka(event,'1234567890')" readonly="">
					                                    	<span class="input-group-addon" style="width:30%;text-align:left">UNIT</span>
					                                    </div></td>
					                                <td></td>
					                    		</tr>
			                            	</table>
					               		</div>
										<input  type="hidden" name="tutupservis" value="1"/>
				                        <div class="modal-footer clearfix">
											<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Akan Menutup Servis Hari Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
	                                    </form>
									<?
										}
									else
										{
									?>
				                        <div class="modal-body">
											<h4>Hari Ini Sudah Dilakukan Tutup Servis</h4>
					               		</div>
									<?
										}
									?>
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
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>