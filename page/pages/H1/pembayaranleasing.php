<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[tagihanls]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$q1 = mysql_query("UPDATE tbl_notajual_det SET statustagihanls='1',tgltagihanls='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[tagihanls]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_notajual_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'KIRIM TAGIHAN LEASING $_REQUEST[nonota]')
								");
			}
			
		if(!empty($_REQUEST[otr]))
			{
			if($_REQUEST[statustagihanls]=='0')
				{
				echo "<script>alert ('Pembayaran Belum Berhasil, Karena Status Tagihan Ke Leasing : Belum Tertagih.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&periode=$_REQUEST[periode]'/>";
				exit();
				}
				
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusotr='0',bayarotr='',tglotr='0000-00-00',updatex='$updatex' WHERE id='$_REQUEST[otr]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET OTR $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusotr='1',bayarotr='$bayar',tglotr='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[otr]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR OTR $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			}
			
		if(!empty($_REQUEST[gross]))
			{
			if($_REQUEST[statustagihanls]=='0')
				{
				echo "<script>alert ('Pembayaran Belum Berhasil, Karena Status Tagihan Ke Leasing : Belum Tertagih.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&periode=$_REQUEST[periode]'/>";
				exit();
				}
				
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusgross='0',bayargross='',tglgross='0000-00-00',updatex='$updatex' WHERE id='$_REQUEST[gross]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET GROSS $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusgross='1',bayargross='$bayar',tglgross='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[gross]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR GROSS $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			}
		
		if(!empty($_REQUEST[subsidi]))
			{
			if($_REQUEST[statustagihanls]=='0')
				{
				echo "<script>alert ('Pembayaran Belum Berhasil, Karena Status Tagihan Ke Leasing : Belum Tertagih.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&periode=$_REQUEST[periode]'/>";
				exit();
				}
				
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statussubsidi='0',bayarsubsidi='',tglsubsidi='0000-00-00',updatex='$updatex' WHERE id='$_REQUEST[subsidi]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET SUBSIDI $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statussubsidi='1',bayarsubsidi='$bayar',tglsubsidi='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[subsidi]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR SUBSIDI $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			}
		
		if(!empty($_REQUEST[matrix]))
			{
			if($_REQUEST[statustagihanls]=='0')
				{
				echo "<script>alert ('Pembayaran Belum Berhasil, Karena Status Tagihan Ke Leasing : Belum Tertagih.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&periode=$_REQUEST[periode]'/>";
				exit();
				}
				
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusmatrix='0',bayarmatrix='',tglmatrix='0000-00-00',updatex='$updatex' WHERE id='$_REQUEST[matrix]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET MATRIX $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusmatrix='1',bayarmatrix='$bayar',tglmatrix='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[matrix]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR MATRIX $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			}
			
		if(!empty($_REQUEST[scpahm]))
			{
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusscpahm='0',bayarscpahm='',tglscpahm='0000-00-00',updatex='$updatex' WHERE id='$_REQUEST[scpahm]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET SCPAHM $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusscpahm='1',bayarscpahm='$bayar',tglscpahm='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[scpahm]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR SCPAHM $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			}
			
		if(!empty($_REQUEST[scpmd]))
			{
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusscpmd='0',bayarscpmd='',tglscpmd='0000-00-00',updatex='$updatex' WHERE id='$_REQUEST[scpmd]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET SCPMD $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET statusscpmd='1',bayarscpmd='$bayar',tglscpmd='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[scpmd]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR SCPMD $_REQUEST[bayar] $_REQUEST[nonota]')
									");
				}
			}
			
		if(!empty($_REQUEST[tambahlain]))
			{
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET tambahlain='',tgltambahlain='0000-00-00',kettambahlain='',updatex='$updatex' WHERE id='$_REQUEST[tambahlain]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET TAMBAH LAIN $_REQUEST[tambahlain] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST[tgltambahlain]));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST[jmltambahlain]);
				$ket       	= strtoupper($_REQUEST[kettambahlain]);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET tambahlain='$bayar',tgltambahlain='$tglbayar',kettambahlain='$ket',updatex='$updatex' WHERE id='$_REQUEST[tambahlain]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR TAMBAH LAIN $_REQUEST[tambahlain] $_REQUEST[nonota]')
									");
				}
			}
			
		if(!empty($_REQUEST[kuranglain]))
			{
			if(!empty($_REQUEST[reset])){
				$q1 = mysql_query("UPDATE tbl_notajual_det SET kuranglain='',tglkuranglain='0000-00-00',ketkuranglain='',updatex='$updatex' WHERE id='$_REQUEST[kuranglain]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET KURANG LAIN $_REQUEST[kuranglain] $_REQUEST[nonota]')
									");
				}
			else{
				$tglbayar   = date("Y-m-d", strtotime($_REQUEST[tglkuranglain]));
				$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST[jmlkuranglain]);
				$ket       	= strtoupper($_REQUEST[ketkuranglain]);
				$q1 = mysql_query("UPDATE tbl_notajual_det SET kuranglain='$bayar',tglkuranglain='$tglbayar',ketkuranglain='$ket',updatex='$updatex' WHERE id='$_REQUEST[kuranglain]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notajual_det',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR KURANG LAIN $_REQUEST[kuranglain] $_REQUEST[nonota]')
									");
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
                           		<div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">	
				                	<h4>ADMINISTRASI <small>PEMBAYARAN LEASING & MAIN DEALER</small></h4>	 
	                                    <div style="float:right;width:45%">
					                   	<form method="post" action="" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    		<!--
	                                    			<td align="right">
														<a href="print/kas1.php" target="_blank" style="cursor:pointer">
					                           				<button type="button" class="btn btn-info"><i class="fa fa-print"></i> &nbsp; Cetak</button>
														</a>
													</td>
												-->
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tgl Nota Jual"  class="form-control pull-right" id="reservation"/>
			                                            </div>
	                                    			</td>
	                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
													<?
													if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
														{
													?>
														<button type="button"  onclick="window.open('print/h1/pembayaranleasing.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                           			<?
				                           				}
				                           			?>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
										</div>
										
									<?
									if(!empty($_REQUEST[periode]))
										{
									?>	
			                        	<table id="example2" class="table table-bordered table-striped" style="min-width:560%">
											<thead>
												<tr>
													<th rowspan="2">TGL NOTA JUAL</th>
													<th rowspan="2">NO. NOTA JUAL</th>
													<th rowspan="2">KODE BARANG</th>
													<th rowspan="2">NAMA BARANG</th>
													<th rowspan="2">VARIAN</th>
													<th rowspan="2">NO. RANGKA</th>
													<th rowspan="2">NO. MESIN</th>
													<th rowspan="2">TANGGAL UNIT KELUAR</th>
													<th rowspan="2">NAMA PELANGGAN</th>
													<th rowspan="2">NAMA SALES/COUNTER</th>
													<th rowspan="2">STATUS PENJUALAN</th>
													<th rowspan="2">STATUS TAGIHAN KE LEASING</th>
													<th rowspan="2">OTR (RP)</th>
													<th rowspan="2">STATUS OTR</th>
													<th rowspan="2">NAMA LEASING</th>
													<th rowspan="2">MASA ANGSURAN (X)</th>
													<th rowspan="2">GROSS (RP)</th>
													<th rowspan="2">STATUS GROSS</th>
													<th rowspan="2">SUBSIDI SETELAH PAJAK (RP)</th>
													<th rowspan="2">STATUS SUBSIDI</th>
													<th rowspan="2">MATRIX SETELAH PAJAK (RP)</th>
													<th rowspan="2">STATUS MATRIX</th>
													<th rowspan="2">SCP AHM (RP)</th>
													<th rowspan="2">STATUS SCP AHM</th>
													<th rowspan="2">SCP MD (RP)</th>
													<th rowspan="2">STATUS SCP MD</th>
													<th colspan="6"><center>LAIN-LAIN</center></th>
												</tr>
												<tr>
													<th>PENAMBAHAN PEMBAYARAN</th>
													<th>TANGGAL TRANSAKSI PENAMBAHAN</th>
													<th>KETERANGAN TRANSAKSI PENAMBAHAN</th>
													<th>PENGURANGAN PEMBAYARAN</th>
													<th>TANGGAL TRANSAKSI PENGURANGAN</th>													
													<th>KETERANGAN TRANSAKSI PENGURANGAN</th>													
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
				                            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
				                            
				                            //echo  $_SESSION[periode_awal].$_SESSION[periode_akhir];
				                            
											//$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING' OR jnstransaksi='KREDIT')");
											$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND  tglsampai!='0000-00-00'");
											while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
				                            	$dUK  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$d1[nonota]'"));
				                            	$dPlg  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
				                            	$dSls  = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id='$d1[iduser]'"));
				                            	$dLsg  = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
				                            	
				                            	//$dTot = mysql_fetch_array(mysql_query("SELECT SUM(otr) AS totr,SUM(gross) AS tgross,SUM(subsidipajak) AS tsubsidipajak,SUM(matrixpajak) AS tmatrixpajak,SUM(scpahm) AS tscpahm,SUM(scpmd) AS tscpmd FROM tbl_notajual_det_vw WHERE jnstransaksi='KREDIT' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'"));
				                            	$dTot = mysql_fetch_array(mysql_query("SELECT SUM(otr) AS totr,SUM(gross) AS tgross,SUM(subsidipajak) AS tsubsidipajak,SUM(matrixpajak) AS tmatrixpajak,SUM(scpahm) AS tscpahm,SUM(scpmd) AS tscpmd FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND  tglsampai!='0000-00-00'"));
				                            	
				                            	if($d1[jnstransaksi]=='KREDIT')
				                            		{
					                            	if($d1[statusotr]=='0'){
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusgross]=='0'){
								                        $statusgross = "<a data-toggle='modal' data-target='#compose-modal-gross0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusgross = "<a data-toggle='modal' data-target='#compose-modal-gross1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statussubsidi]=='0'){
								                        $statussubsidi = "<a data-toggle='modal' data-target='#compose-modal-subsidi0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statussubsidi = "<a data-toggle='modal' data-target='#compose-modal-subsidi1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusmatrix]=='0'){
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusscpahm]=='0'){
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusscpmd]=='0'){
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statustagihanls]=='0'){
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Tertagih</span></a>";
														}
													else{
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Tertagih</span></a>";
														}
													}
				                            	else if($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='LEASING')
				                            		{
					                            	if($d1[statusotr]=='0'){
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusotr = "<a data-toggle='modal' data-target='#compose-modal-otr1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusmatrix]=='0'){
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusmatrix = "<a data-toggle='modal' data-target='#compose-modal-matrix1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	$statusgross  		= "-";
													$statussubsidi 		= "-";
								                    $statusscpahm 		= "-";
													$statusscpmd 		= "-";
					                            	if($d1[statustagihanls]=='0'){
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terkirim</span></a>";
														}
													else{
								                        $statustagihanls = "<a data-toggle='modal' data-target='#compose-modal-tagihanls1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terkirim</span></a>";
														}
													}
												else{
					                            	$statusotr 		= "-";
					                            	$statusgross 	= "-";
													$statussubsidi 	= "-";
													$statusmatrix 	= "-";
													if($d1[statusscpahm]=='0'){
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpahm = "<a data-toggle='modal' data-target='#compose-modal-scpahm1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	if($d1[statusscpmd]=='0'){
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														}
													else{
								                        $statusscpmd = "<a data-toggle='modal' data-target='#compose-modal-scpmd1$d1[id]'><span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Terbayar</span></a>";
														}
					                            	$statustagihanls = "-";
													}
													
													if(empty($dUK[tanggal])){
														$dUKtanggal = "-";
														}
													else{
														$dUKtanggal = date("d-m-Y",strtotime($dUK[tanggal]));
														}
														
					                            	if(empty($d1[tambahlain])){
								                        $tambahlain = "<a data-toggle='modal' data-target='#compose-modal-tambahlain0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:200px'>Masukkan Penambahan</span></a>";
														}
													else{
								                        $tambahlain = "<a data-toggle='modal' data-target='#compose-modal-tambahlain1$d1[id]'>".number_format($d1[tambahlain],"0","",".")." &nbsp;&nbsp;&nbsp;<i class='fa fa-search'></i></a>";
														}
														
					                            	if(empty($d1[kuranglain])){
								                        $kuranglain = "<a data-toggle='modal' data-target='#compose-modal-kuranglain0$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:200px'>Masukkan Pengurangan</span></a>";
														}
													else{
								                        $kuranglain = "<a data-toggle='modal' data-target='#compose-modal-kuranglain1$d1[id]'>".number_format($d1[kuranglain],"0","",".")." &nbsp;&nbsp;&nbsp;<i class='fa fa-search'></i></a>";
														}
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
				                                	<td align="center"><?echo $d1[nonota]?></td>
				                                	<td align="left"><?echo $dBrg[kodebarang]?></td>
				                                	<td align="left"><?echo $dBrg[namabarang]?></td>
				                                	<td align="left"><?echo $dBrg[varian]?></td>
				                                	<td align="center"><?echo $d1[norangka]?></td>
				                                	<td align="center"><?echo $dBrg[nomesin]?></td>
				                                	<td align="center"><?echo $dUKtanggal?></td>
				                                	<td align="left"><?echo $dPlg[nama]?></td>
				                                	<td align="left"><?echo $dSls[nama]?></td>
				                                	<td align="left"><?echo $d1[jnstransaksi]?></td>
				                                	<td align="center"><?echo $statustagihanls?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[otr],"0","",".")?></span></td>
				                                	<td align="center"><?echo $statusotr?></td>
				                                	<td align="left"><?if(empty($dLsg[namaleasing])){echo "-";}else{echo $dLsg[namaleasing];}?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[termin])){echo "-";}else{echo $d1[termin];}?></span></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[gross])){echo "-";}else{echo number_format($d1[gross],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusgross?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[subsidipajak])){echo "-";}else{echo number_format($d1[subsidipajak],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statussubsidi?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[matrixpajak])){echo "-";}else{echo number_format($d1[matrixpajak],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusmatrix?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[scpahm])){echo "-";}else{echo number_format($d1[scpahm],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusscpahm?></td>
			                                		<td align="right"><span style="padding-right:20%"><?if(empty($d1[scpmd])){echo "-";}else{echo number_format($d1[scpmd],"0","",".");}?></span></td>
				                                	<td align="center"><?echo $statusscpmd?></td>
				                                	<td align="center"><?echo $tambahlain?></td>
				                                	<td align="left"><?if($d1[tgltambahlain]=="0000-00-00"){echo "-";}else{echo date("d-m-Y",strtotime($d1[tgltambahlain]));}?></td>
				                                	<td align="left"><?if(empty($d1[kettambahlain])){echo "-";}else{echo $d1[kettambahlain];}?></td>
				                                	<td align="center"><?echo $kuranglain?></td>
				                                	<td align="left"><?if($d1[tglkuranglain]=="0000-00-00"){echo "-";}else{echo date("d-m-Y",strtotime($d1[tglkuranglain]));}?></td>
				                                	<td align="left"><?if(empty($d1[ketkuranglain])){echo "-";}else{echo $d1[ketkuranglain];}?></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <td colspan="11">&nbsp;</td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[totr],"0","",".")?></b></span></td>
				                                	<td colspan="2">&nbsp;</td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tgross],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tsubsidipajak],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tmatrixpajak],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tscpahm],"0","",".")?></b></span></td>
				                                    <td align="center"><b>TOTAL : </b></td>
			                                		<td align="right"><span style="padding-right:20%"><b><?echo number_format($dTot[tscpmd],"0","",".")?></b></span></td>
				                                </tr>
				                            </tfoot>
				                        </table>
								        <?  
										//$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING' OR jnstransaksi='KREDIT')");
										$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
										while($d1 = mysql_fetch_array($q1))
			                            	{
								        ?>
									<!-- ################## MODAL TAMBAHLAIN0 ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-tambahlain0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:50%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT TRANSAKSI PENAMBAHAN</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="35%">TANGGAL PENAMBAHAN</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tgltambahlain" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:50%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH PENAMBAHAN</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="jmltambahlain" maxlength="12" value="" style="width:50%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>KETERANGAN PENAMBAHAN</td>
									                    			<td>:</td>
									                    			<td><textarea name="kettambahlain" maxlength="400" style="width:100%;" class="form-control" required=""></textarea>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="tambahlain" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL TAMBAHLAIN1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-tambahlain1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:50%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL TRANSAKSI PENAMBAHAN</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="35%">TANGGAL PENAMBAHAN</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tgltambahlain" value="<?echo date("d-m-Y",strtotime($d1[tgltambahlain]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:50%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH PENAMBAHAN</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="jmltambahlain" maxlength="12" value="<?echo number_format($d1[tambahlain],"0","",".")?>" style="width:50%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>KETERANGAN PENAMBAHAN</td>
									                    			<td>:</td>
									                    			<td><textarea name="kettambahlain" maxlength="400" style="width:100%;" class="form-control" readonly=""><?echo $d1[kettambahlain]?></textarea>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="tambahlain" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL KURANGLAIN0 ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-kuranglain0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:50%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT TRANSAKSI PENGURANGAN</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="35%">TANGGAL PENGURANGAN</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglkuranglain" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:50%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH PENGURANGAN</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="jmlkuranglain" maxlength="12" value="" style="width:50%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>KETERANGAN PENGURANGAN</td>
									                    			<td>:</td>
									                    			<td><textarea name="ketkuranglain" maxlength="400" style="width:100%;" class="form-control" required=""></textarea>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="kuranglain" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL KURANGLAIN1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-kuranglain1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:50%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL TRANSAKSI PENGURANGAN</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="35%">TANGGAL PENGURANGAN</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglkuranglain" value="<?echo date("d-m-Y",strtotime($d1[tglkuranglain]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:50%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH PENGURANGAN</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="jmlkuranglain" maxlength="12" value="<?echo number_format($d1[kuranglain],"0","",".")?>" style="width:50%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>KETERANGAN PENGURANGAN</td>
									                    			<td>:</td>
									                    			<td><textarea name="ketkuranglain" maxlength="400" style="width:100%;" class="form-control" readonly=""><?echo $d1[ketkuranglain]?></textarea>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="kuranglain" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									
									
									
									<!-- ################## MODAL TAGIHANLS0 ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-tagihanls0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT TANGGAL KIRIM TAGIHAN</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="tagihanls" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL TAGIHANLS1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-tagihanls1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL TANGGAL KIRIM TAGIHAN</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglotr]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL OTR0 ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-otr0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN OTR</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="bayar" value="<?echo number_format($d1[otr],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="otr" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL OTR1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-otr1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL PEMBAYARAN OTR</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglotr]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" value="<?echo number_format($d1[bayarotr],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" readonly=""> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="otr" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL GROSS0 ################################################################################################# -->
									        <div class="modal fade " id="compose-modal-gross0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN GROSS</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="bayar" value="<?echo number_format($d1[gross],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="gross" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL GROSS1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-gross1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL PEMBAYARAN GROSS</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglgross]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" value="<?echo number_format($d1[bayargross],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" readonly=""> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="gross" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL SUBSIDI0 ################################################################################################# -->
									        <div class="modal fade " id="compose-modal-subsidi0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN SUBSIDI</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="bayar" value="<?echo number_format($d1[subsidipajak],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="subsidi" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL SUBSIDI1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-subsidi1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL PEMBAYARAN SUBSIDI</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglsubsidi]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" value="<?echo number_format($d1[bayarsubsidi],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" readonly=""> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="subsidi" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL MATRIX0 ################################################################################################# -->
									        <div class="modal fade " id="compose-modal-matrix0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN MATRIX</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="bayar" value="<?echo number_format($d1[matrixpajak],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="matrix" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL MATRIX1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-matrix1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL PEMBAYARAN MATRIX</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglmatrix]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" value="<?echo number_format($d1[bayarmatrix],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" readonly=""> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="matrix" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="statustagihanls" value="<?echo $d1[statustagihanls]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL SCP AHM0 ################################################################################################# -->
									        <div class="modal fade " id="compose-modal-scpahm0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN SCP AHM</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="bayar" value="<?echo number_format($d1[scpahm],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="scpahm" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL SCP AHM1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-scpahm1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL PEMBAYARAN SCP AHM</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglscpahm]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" value="<?echo number_format($d1[bayarscpahm],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" readonly=""> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="scpahm" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
									<!-- ################## MODAL SCP MD0 ################################################################################################# -->
									        <div class="modal fade " id="compose-modal-scpmd0<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN SCP MD</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="bayar" value="<?echo number_format($d1[scpmd],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="scpmd" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
															<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									<!-- ################## MODAL SCP MD1 ################################################################################################### -->
									        <div class="modal fade " id="compose-modal-scpmd1<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">DETAIL PEMBAYARAN SCP MD</h4>
									                    </div>
														
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglscpmd]))?>" class="form-control" style="width:80%" readonly="">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" value="<?echo number_format($d1[bayarscpmd],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" readonly=""> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		
									                   	<form method="post" action="" enctype="multipart/form-data">
									                    		<input type="hidden" name="reset" value="1">
									                    		<input type="hidden" name="scpmd" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
							                            	</table>
									               		</div>
								                        <div class="modal-footer clearfix">
															<?
															if($_SESSION[posisi]=='DIREKSI')
																{
															?>
								                            	<button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Batal</button>
															<?	
																}
															?>
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									                	</div>
														</form>
									                </div>
									            </div>
									        </div>
									<!-- ################################################################################################################################# -->
									
								        <?
								        	}
								        ?>
				                    <?
				                    	}
				                    ?>
			                    	</div>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
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
<?
		}
?>