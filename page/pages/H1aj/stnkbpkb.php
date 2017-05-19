<?
	if($submenu == 'A')
		{	
?>
		<aside class="right-side">
		    <section class="content">
		        <div class="row">
		            <div class="col-xs-12">	
		            <?
		            if(empty($mod) || $mod=='harian')
		            	{
		            ?>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                            	<!--
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=bulanan"?>">Tahunan</a></li>
                                <li class="active"><a href="#tab_1-1" data-toggle="tab">Bulanan</a></li>
                                -->
                                <li class="pull-left header"><h4>ADMINISTRASI <small>STNK & BPKB</small></h4></li>
                            </ul>
                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
                                <div class="tab-pane active">
                                    <div style="float:left;width:30%;margin-left:15px">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
                                    	if(!empty($_REQUEST[tahun]) && !empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = $_REQUEST[tahun];
                                    		$periode_bulan = $_REQUEST[bulan];
											}
                                    	else if(empty($_REQUEST[tahun]) && empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = date("Y");
											$periode_bulan = date('m');
                                    		}
										?>
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									<?
									if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
										{
									?>
		                           		<div style="float:right" class="col-xs-7">
											<button type="button"  onclick="window.open('print/h1/stnkbpkb.php?tahun=<?echo $periode_tahun?>&bulan=<?echo $periode_bulan?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
		                           		</div>
									<?
										}
									?>
									
									<div class="col-xs-12" style="width:100%;margin:0 auto;margin-top:10px">
				                        <table id="example1" class="table table-striped table-bordered" style="min-width:520%">
				                            <thead style="cursor:pointer">
												<th class="btn-info" style="text-align:center;width:1%">UBAH</th>
												<th class="btn-info" style="text-align:center;width:100px">NO. NOTA JUAL</th>
												<th class="btn-info" style="text-align:center;width:100px">TGL NOTA JUAL</th>
												<th class="btn-info" style="text-align:center;width:280px">NAMA PELANGGAN</th>
												<th class="btn-info" style="text-align:center;">ALAMAT</th>
												<th class="btn-info" style="text-align:center;">KELURAHAN</th>
												<th class="btn-info" style="text-align:center;">KECAMATAN</th>
												<th class="btn-info" style="text-align:center;">KABUPATEN</th>
												<th class="btn-info" style="text-align:center;width:150px">NO. TELEPON</th>
												<th class="btn-info" style="text-align:center;">NO. RANGKA</th>
												<th class="btn-info" style="text-align:center;">NO. MESIN</th>
												<th class="btn-info" style="text-align:center;">KODE BARANG</th>
												<th class="btn-info" style="text-align:center;">NAMA BARANG</th>
												<th class="btn-info" style="text-align:center;">VARIAN</th>
												<th class="btn-info" style="text-align:center;">WARNA</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL STCK SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL STCK DIAMBIL</th>
												<th class="btn-info" style="text-align:center;width:300px">NAMA PENGAMBIL STCK</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL KIRIM STNK KE SAMSAT</th>
												<th class="btn-info" style="text-align:center;width:200px">TANGGAL NOTICE PAJAK SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">NOMOR POLISI</th>
												<th class="btn-info" style="text-align:center;width:150px">NOMOR STNK</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL STNK SELESAI</th>
												<th class="btn-info" style="text-align:center;width:220px">TANGGAL NOTICE PAJAK & STNK DIAMBIL</th>
												<th class="btn-info" style="text-align:center;width:300px">NAMA PENGAMBIL NOTICE & STNK</th>
												<th class="btn-info" style="text-align:center;width:150px">NOMOR BPKB</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL BPKB SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL BPKB DIAMBIL</th>
												<th class="btn-info" style="text-align:center;width:300px">NAMA PENGAMBIL BPKB</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											$qX = mysql_query("SELECT * FROM tbl_stnkbpkb WHERE id%2=0 AND nonota IN (SELECT nonota FROM tbl_notajual WHERE adm='1' AND bulan='$periode_bulan' AND tahun='$periode_tahun')");
											while($dX = mysql_fetch_array($qX))
												{
													$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nonota='$dX[nonota]'"));
													$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
													$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dX[idbarang]'"));
													$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE norangka='$dX[norangka]'"));
													$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dX[norangka]'"));
													if($d3[stckselesai]=='0000-00-00' || $d3[stckselesai]=='1970-01-01'){
														$stckselesai = '<span style="text-align:center">-</span>';
														}
													else{
														$stckselesai = date("d-m-Y",strtotime($d3[stckselesai]));
														}
													if($d3[stckdiambil]=='0000-00-00' || $d3[stckdiambil]=='1970-01-01'){
														$stckdiambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stckdiambil = date("d-m-Y",strtotime($d3[stckdiambil]));
														}
													if(empty($d3[stckpengambil])){
														$stckpengambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stckpengambil = $d3[stckpengambil];
														}
													if($d3[krmstnkesmsat]=='0000-00-00' || $d3[krmstnkesmsat]=='1970-01-01'){
														$krmstnkesmsat = '<div style="text-align:center">-</div>';
														}
													else{
														$krmstnkesmsat = date("d-m-Y",strtotime($d3[krmstnkesmsat]));
														}
													if($d3[noticeselesai]=='0000-00-00' || $d3[noticeselesai]=='1970-01-01'){
														$noticeselesai = '<div style="text-align:center">-</div>';
														}
													else{
														$noticeselesai = date("d-m-Y",strtotime($d3[noticeselesai]));
														}
													if(empty($d3[nopol])){
														$nopol = '<div style="text-align:center">-</div>';
														}
													else{
														$nopol = $d3[nopol];
														}
													if(empty($d3[nostnk])){
														$nostnk = '<div style="text-align:center">-</div>';
														}
													else{
														$nostnk = $d3[nostnk];
														}
													if($d3[stnkselesai]=='0000-00-00' || $d3[stnkselesai]=='1970-01-01'){
														$stnkselesai = '<div style="text-align:center">-</div>';
														}
													else{
														$stnkselesai = date("d-m-Y",strtotime($d3[stnkselesai]));
														}
													if($d3[stnkdiambil]=='0000-00-00' || $d3[stnkdiambil]=='1970-01-01'){
														$stnkdiambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stnkdiambil = date("d-m-Y",strtotime($d3[stnkdiambil]));
														}
													if(empty($d3[stnkpengambil])){
														$stnkpengambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stnkpengambil = $d3[stnkpengambil];
														}
													if(empty($d3[nobpkb])){
														$nobpkb = '<div style="text-align:center">-</div>';
														}
													else{
														$nobpkb = $d3[nobpkb];
														}
													if($d3[bpkbselesai]=='0000-00-00' || $d3[bpkbselesai]=='1970-01-01'){
														$bpkbselesai = '<div style="text-align:center">-</div>';
														}
													else{
														$bpkbselesai = date("d-m-Y",strtotime($d3[bpkbselesai]));
														}
													if($d3[bpkbdiambil]=='0000-00-00' || $d3[bpkbdiambil]=='1970-01-01'){
														$bpkbdiambil = '<div style="text-align:center">-</div>';
														}
													else{
														$bpkbdiambil = date("d-m-Y",strtotime($d3[bpkbdiambil]));
														}
														
													if($dA[jnstransaksi]=='KREDIT' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='LEASING'))
														{
														$dL = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
														$bpkbpengambil = $dL[namaleasing];
														}
													else
														{
														if(empty($d3[bpkbpengambil])){
															$bpkbpengambil = '<div style="text-align:center">-</div>';
															}
														else{
															$bpkbpengambil = $d3[bpkbpengambil];
															}
														}
											?>
													<tr>
					                                    <td align="center" valign="top"><div class="btn-group">
					                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
					                                                <span class="caret"></span>
					                                                <span class="sr-only">Actions</span>
					                                            </button>
					                                            <ul class="dropdown-menu" role="menu" style="font-size: 12px">
					                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=B&norangka=$dX[norangka]&tahun=$_REQUEST[tahun]&bulan=$_REQUEST[bulan]"?>"><i class="fa fa-pencil"></i>&nbsp;Ubah Detail</a></li>
					                                            </ul>
					                                        </div>
					                                    </td>
														<td align="center"><?echo $dA[nonota]?></td>
														<td align="center"><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
														<td align="left"><?echo $d1[nama]?></td>
			                                    		<td align="left"><?echo $d1[alamat]?></td>
			                                    		<td align="left"><?echo $d1[namakel]?></td>
			                                    		<td align="left"><?echo $d1[namakec]?></td>
			                                    		<td align="left"><?echo $d1[namakab]?></td>
			                                    		<td align="right"><?echo $d1[notelepon]?></td>
			                                    		<td align="right"><?echo $d4[norangka]?></td>
			                                    		<td align="right"><?echo $d4[nomesin]?></td>
			                                    		<td align="left"><?echo $d2[kodebarang]?></td>
			                                    		<td align="left"><?echo $d2[namabarang]?></td>
			                                    		<td align="left"><?echo $d2[varian]?></td>
			                                    		<td align="left"><?echo $d2[warna]?></td>
			                                    		<td align="center"><?echo $stckselesai?></td>
			                                    		<td align="center"><?echo $stckdiambil?></td>
			                                    		<td align="left"><?echo $stckpengambil?></td>
			                                    		<td align="center"><?echo $krmstnkesmsat?></td>
			                                    		<td align="center"><?echo $noticeselesai?></td>
			                                    		<td align="center"><?echo $nopol?></td>
			                                    		<td align="center"><?echo $nostnk?></td>
			                                    		<td align="center"><?echo $stnkselesai?></td>
			                                    		<td align="center"><?echo $stnkdiambil?></td>
			                                    		<td align="left"><?echo $stnkpengambil?></td>
			                                    		<td align="center"><?echo $nobpkb?></td>
			                                    		<td align="center"><?echo $bpkbselesai?></td>
			                                    		<td align="center"><?echo $bpkbdiambil?></td>
			                                    		<td align="left"><?echo $bpkbpengambil?></td>
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
                    <?
                    	}
                    	
		            else if($mod=='bulanan')
		            	{
		            ?>
                        <div class="nav-tabs-custom" style="border-radius:4px 4px 0 0">
                            <ul class="nav nav-tabs pull-right" style="border-radius:4px 4px 0 0">
                                <li class="active"><a href="#tab_2-2" data-toggle="tab">Tahunan</a></li>
                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=harian"?>">Bulanan</a></li>
                                <li class="pull-left header"><h4>ADMINISTRASI <small>STNK & BPKB</small></h4></li>
                            </ul>
                            <div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">											
                                <div class="tab-pane active">
                                    <div style="float:left;width:30%;margin-left:15px">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
                                    	if(!empty($_REQUEST[tahun]))
                                    		{
                                    		$periode_tahun = $_REQUEST[tahun];
											}
                                    	else if(empty($_REQUEST[tahun]))
                                    		{
                                    		$periode_tahun = date("Y");
                                    		}
										?>
                                    		<tr>
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td><td width="70%"></td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
									<div class="col-xs-12" style="width:100%;margin:0 auto;margin-top:10px">
				                        <table id="example1" class="table table-striped table-bordered" style="min-width:310%">
				                            <thead style="cursor:pointer">
												<th class="btn-info" style="text-align:center;width:1%">UBAH</th>
												<th class="btn-info" style="text-align:center;width:100px">NO. NOTA JUAL</th>
												<th class="btn-info" style="text-align:center;width:100px">TGL NOTA JUAL</th>
												<th class="btn-info" style="text-align:center;width:280px">NAMA PELANGGAN</th>
												<th class="btn-info" style="text-align:center;">ALAMAT</th>
												<th class="btn-info" style="text-align:center;">KELURAHAN</th>
												<th class="btn-info" style="text-align:center;">KECAMATAN</th>
												<th class="btn-info" style="text-align:center;">KABUPATEN</th>
												<th class="btn-info" style="text-align:center;width:150px">NO. TELEPON</th>
												<th class="btn-info" style="text-align:center;">NO. RANGKA</th>
												<th class="btn-info" style="text-align:center;">NO. MESIN</th>
												<th class="btn-info" style="text-align:center;">KODE BARANG</th>
												<th class="btn-info" style="text-align:center;">BARANG</th>
												<th class="btn-info" style="text-align:center;">VARIAN</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL STCK SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL STCK DIAMBIL</th>
												<th class="btn-info" style="text-align:center;width:150px">NAMA PENGAMBIL STCK</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL KIRIM STNK KE SAMSAT</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL NOTICE PAJAK SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL STNK SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL NOTICE PAJAK & STNK DIAMBIL</th>
												<th class="btn-info" style="text-align:center;width:150px">NAMA PENGAMBIL NOTICE & STNK</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL BPKB SELESAI</th>
												<th class="btn-info" style="text-align:center;width:150px">TANGGAL BPKB DIAMBIL</th>
												<th class="btn-info" style="text-align:center;width:150px">NAMA PENGAMBIL BPKB</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											$qX = mysql_query("SELECT * FROM tbl_stnkbpkb WHERE nonota IN (SELECT nonota FROM tbl_notajual WHERE adm='1' AND tahun='$periode_tahun')");
											while($dX = mysql_fetch_array($qX))
												{
													$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nonota='$dX[nonota]'"));
													$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
													$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dX[idbarang]'"));
													$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE norangka='$dX[norangka]'"));
													$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dX[norangka]'"));
													if($d3[stckselesai]=='0000-00-00' || $d3[stckselesai]=='1970-01-01'){
														$stckselesai = '-';
														}
													else{
														$stckselesai = $d3[stckselesai];
														}
													if($d3[stckdiambil]=='0000-00-00' || $d3[stckdiambil]=='1970-01-01'){
														$stckdiambil = '-';
														}
													else{
														$stckdiambil = $d3[stckdiambil];
														}
													if(empty($d3[stckpengambil])){
														$stckpengambil = '-';
														}
													else{
														$stckpengambil = $d3[stckpengambil];
														}
													if($d3[krmstnkesmsat]=='0000-00-00' || $d3[krmstnkesmsat]=='1970-01-01'){
														$krmstnkesmsat = '-';
														}
													else{
														$krmstnkesmsat = date("d-m-Y",strtotime($d3[krmstnkesmsat]));
														}
													if($d3[noticeselesai]=='0000-00-00' || $d3[noticeselesai]=='1970-01-01'){
														$noticeselesai = '-';
														}
													else{
														$noticeselesai = $d3[noticeselesai];
														}
													if($d3[stnkselesai]=='0000-00-00' || $d3[stnkselesai]=='1970-01-01'){
														$stnkselesai = '-';
														}
													else{
														$stnkselesai = $d3[stnkselesai];
														}
													if($d3[stnkdiambil]=='0000-00-00' || $d3[stnkdiambil]=='1970-01-01'){
														$stnkdiambil = '-';
														}
													else{
														$stnkdiambil = $d3[stnkdiambil];
														}
													if(empty($d3[stnkpengambil])){
														$stnkpengambil = '-';
														}
													else{
														$stnkpengambil = $d3[stnkpengambil];
														}
													if($d3[bpkbselesai]=='0000-00-00' || $d3[bpkbselesai]=='1970-01-01'){
														$bpkbselesai = '-';
														}
													else{
														$bpkbselesai = $d3[bpkbselesai];
														}
													if($d3[bpkbdiambil]=='0000-00-00' || $d3[bpkbdiambil]=='1970-01-01'){
														$bpkbdiambil = '-';
														}
													else{
														$bpkbdiambil = $d3[bpkbdiambil];
														}
														
													if($dA[jnstransaksi]=='KREDIT' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='LEASING'))
														{
														$dL = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
														$bpkbpengambil = $dL[namaleasing];
														}
													else
														{
														if(empty($d3[bpkbpengambil])){
															$bpkbpengambil = '-';
															}
														else{
															$bpkbpengambil = $d3[bpkbpengambil];
															}
														}
											?>
													<tr>
					                                    <td align="center" valign="top"><div class="btn-group">
					                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
					                                                <span class="caret"></span>
					                                                <span class="sr-only">Actions</span>
					                                            </button>
					                                            <ul class="dropdown-menu" role="menu" style="font-size: 12px">
					                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=B&norangka=$dX[norangka]"?>"><i class="fa fa-pencil"></i>&nbsp;Ubah Detail</a></li>
					                                            </ul>
					                                        </div>
					                                    </td>
														<td align="center"><?echo $dA[nonota]?></td>
														<td align="center"><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
														<td align="left"><?echo $d1[nama]?></td>
			                                    		<td align="left"><?echo $d1[alamat]?></td>
			                                    		<td align="left"><?echo $d1[namakel]?></td>
			                                    		<td align="left"><?echo $d1[namakec]?></td>
			                                    		<td align="left"><?echo $d1[namakab]?></td>
			                                    		<td align="right"><?echo $d1[notelepon]?></td>
			                                    		<td align="left"><?echo $d4[norangka]?></td>
			                                    		<td align="left"><?echo $d4[nomesin]?></td>
			                                    		<td align="left"><?echo $d2[kodebarang]?></td>
			                                    		<td align="left"><?echo $d2[namabarang]?></td>
			                                    		<td align="left"><?echo $d2[varian]?></td>
			                                    		<td align="center"><?echo $stckselesai?></td>
			                                    		<td align="center"><?echo $stckdiambil?></td>
			                                    		<td align="center"><?echo $stckpengambil?></td>
			                                    		<td align="center"><?echo $krmstnkesmsat?></td>
			                                    		<td align="center"><?echo $noticeselesai?></td>
			                                    		<td align="center"><?echo $stnkselesai?></td>
			                                    		<td align="center"><?echo $stnkdiambil?></td>
			                                    		<td align="center"><?echo $stnkpengambil?></td>
			                                    		<td align="center"><?echo $bpkbselesai?></td>
			                                    		<td align="center"><?echo $bpkbdiambil?></td>
			                                    		<td align="center"><?echo $bpkbpengambil?></td>
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
                    <?
                    	}
                    ?>
                    </div>
		        </div>
                
			</section>
		</aside>
<?
		}
		
	else if ($submenu == 'B')
		{
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE norangka='$_REQUEST[norangka]'"));
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nonota='$dX[nonota]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dX[idbarang]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE nonota='$dA[nonota]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$_REQUEST[norangka]'"));
		if($d3[stckselesai]=='0000-00-00' || $d3[stckselesai]=='1970-01-01'){
			$stckselesai = '';
			}
		else{
			$stckselesai = date("d-m-Y",strtotime($d3[stckselesai]));
			}
		if($d3[stckdiambil]=='0000-00-00' || $d3[stckdiambil]=='1970-01-01'){
			$stckdiambil = '';
			}
		else{
			$stckdiambil = date("d-m-Y",strtotime($d3[stckdiambil]));
			}
		if(empty($d3[stckpengambil])){
			$stckpengambil = '';
			}
		else{
			$stckpengambil = $d3[stckpengambil];
			}
		if($d3[krmstnkesmsat]=='0000-00-00' || $d3[krmstnkesmsat]=='1970-01-01'){
			$krmstnkesmsat = '';
			}
		else{
			$krmstnkesmsat = date("d-m-Y",strtotime($d3[krmstnkesmsat]));
			}
		if($d3[noticeselesai]=='0000-00-00' || $d3[noticeselesai]=='1970-01-01'){
			$noticeselesai = '';
			}
		else{
			$noticeselesai = date("d-m-Y",strtotime($d3[noticeselesai]));
			}
		if(empty($d3[nopol])){
			$nopol = '';
			}
		else{
			$nopol = $d3[nopol];
			}
		if(empty($d3[nostnk])){
			$nostnk = '';
			}
		else{
			$nostnk = $d3[nostnk];
			}
		if($d3[stnkselesai]=='0000-00-00' || $d3[stnkselesai]=='1970-01-01'){
			$stnkselesai = '';
			}
		else{
			$stnkselesai = date("d-m-Y",strtotime($d3[stnkselesai]));
			}
		if($d3[stnkdiambil]=='0000-00-00' || $d3[stnkdiambil]=='1970-01-01'){
			$stnkdiambil = '';
			}
		else{
			$stnkdiambil = date("d-m-Y",strtotime($d3[stnkdiambil]));
			}
		if(empty($d3[stnkpengambil])){
			$stnkpengambil = '';
			}
		else{
			$stnkpengambil = $d3[stnkpengambil];
			}
		if(empty($d3[nobpkb])){
			$nobpkb = '';
			}
		else{
			$nobpkb = $d3[nobpkb];
			}
		if($d3[bpkbselesai]=='0000-00-00' || $d3[bpkbselesai]=='1970-01-01'){
			$bpkbselesai = '';
			}
		else{
			$bpkbselesai = date("d-m-Y",strtotime($d3[bpkbselesai]));
			}
		if($d3[bpkbdiambil]=='0000-00-00' || $d3[bpkbdiambil]=='1970-01-01'){
			$bpkbdiambil = '';
			}
		else{
			$bpkbdiambil = date("d-m-Y",strtotime($d3[bpkbdiambil]));
			}
										
		if($dA[jnstransaksi]=='KREDIT' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='LEASING'))
			{
			$dL = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
			$bpkbpengambil = $dL[namaleasing];
			}
		else
			{
			if(empty($d3[bpkbpengambil])){
				$bpkbpengambil = '';
				}
			else{
				$bpkbpengambil = $d3[bpkbpengambil];
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                    <h4>ADMINISTRASI <small>STNK & BPKB</small></h4>
			                    
			                    <!--
			                    <script>
			                    function CekAmbilBPKB() {
									var s;
									if (document.stnkbpkb.bpkbpengambil.value != ''){
										s = confirm("Click OK to Submit Order. Click Cancel to Cancel");
										if (s=="true"){
										  	alert("Thank You for Your Order!");
										  	return true;
											} 
										else{
										  	return false;
											}
										}	
									}
								</script>
								-->
								
					            	<form method="post" name="stnkbpkb" onsubmit="return CekAmbilBPKB();" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>">
									<div style="padding:20px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="35%">NO. NOTA JUAL</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 25%" value="<?echo $dX[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL NOTA JUAL</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($dA[tglnota]))?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>NAMA PELANGGAN</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" maxlength="4" style="width:55%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>ALAMAT</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d1[alamat]?>" class="form-control" maxlength="4" style="width:100%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>KELURAHAN</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d1[namakel]?>" class="form-control" maxlength="4" style="width:50%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>KECAMATAN</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d1[namakec]?>" class="form-control" maxlength="4" style="width:50%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>KABUPATEN</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d1[namakab]?>" class="form-control" maxlength="4" style="width:50%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NOMOR TELEPON</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="4" style="width:30%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NOMOR RANGKA</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d4[norangka]?>" class="form-control" maxlength="4" style="width:50%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NOMOR MESIN</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d4[nomesin]?>" class="form-control" maxlength="4" style="width:50%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>KODE BARANG</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d2[kodebarang]?>" class="form-control" maxlength="4" style="width:100%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA BARANG</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d2[namabarang]?>" class="form-control" maxlength="4" style="width:100%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>VARIAN</td>
				                        		<td >:</td>
				                        		<td><input type="text" value="<?echo $d2[varian]?>" class="form-control" maxlength="4" style="width:100%;" readonly></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL STCK SELESAI</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="stckselesai" value="<?echo $stckselesai?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL STCK DIAMBIL</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="stckdiambil" value="<?echo $stckdiambil?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENGAMBIL STCK</td>
				                        		<td >:</td>
				                        		<td><input type="text" name="stckpengambil" value="<?echo $stckpengambil?>" class="form-control" style="width:55%;"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL KIRIM STNK KE SAMSAT</td>
				                        		<td >:</td>
				                        		<?php
				                        		/*
				                        		$dCek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE notajual='$dX[nonota]' AND status='1'"));
				                        		if(empty($dCek[id]))
				                        			{
												?>
													<td><input type="text" value="Pemesanan NOPOL Ini Belum Dicetak." style="width: 55%" class="form-control" readonly=""></td>
												<?
													}
												else
				                        			{
												?>
													<td><input type="text" name="krmstnkesmsat" value="<?echo $krmstnkesmsat?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
												<?
													}
												*/
				                        		?>
				                    			<td><input type="text" name="krmstnkesmsat" value="<?echo $krmstnkesmsat?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
												
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL NOTICE PAJAK SELESAI</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="noticeselesai" value="<?echo $noticeselesai?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NOMOR POLISI</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="nopol" value="<?echo $nopol?>"class="form-control" style="width:55%;"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NOMOR STNK</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="nostnk" value="<?echo $nostnk?>" class="form-control" style="width:55%;"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL STNK SELESAI</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="stnkselesai" value="<?echo $stnkselesai?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL NOTICE & STNK DIAMBIL</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="stnkdiambil" value="<?echo $stnkdiambil?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENGAMBIL NOTICE & STNK</td>
				                        		<td >:</td>
				                        		<td><input type="text" name="stnkpengambil" value="<?echo $stnkpengambil?>" class="form-control" style="width:55%;"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NOMOR BPKB</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="nobpkb" value="<?echo $nobpkb?>" class="form-control" style="width:55%;"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL BPKB SELESAI</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="bpkbselesai" value="<?echo $bpkbselesai?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL BPKB DIAMBIL</td>
				                        		<td >:</td>
				                    			<td><input type="text" name="bpkbdiambil" value="<?echo $bpkbdiambil?>" style="width: 25%" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENGAMBIL BPKB</td>
				                        		<td >:</td>
				                        		<td><input type="text" name="bpkbpengambil" value="<?echo $bpkbpengambil?>" class="form-control" style="width:75%;" <?if($dA[jnstransaksi]=='KREDIT' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='LEASING')){?>readonly=""<?}?>></td>
				                        	</tr>
		                            	</table>
		                            </div>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="nonota" value="<?echo $dX[nonota]?>"/>
				           				<input type="hidden" name="norangka" value="<?echo $_REQUEST[norangka]?>"/>
			                    		<input type="hidden" name="tahun" value="<?echo $_REQUEST[tahun]?>">
			                    		<input type="hidden" name="bulan" value="<?echo $_REQUEST[bulan]?>">
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                        </form>
			                    </div>
				            </div>
				        </div>
			        </div>
				</section>
			</aside>
			
        <script src="js/jquery.min.js"></script>
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
<?
		}
		
	else if($submenu == 'save')
		{
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
        
		$stckselesai	= date("Y-m-d",strtotime($_REQUEST[stckselesai]));
		$stckdiambil	= date("Y-m-d",strtotime($_REQUEST[stckdiambil]));
		$stckpengambil	= strtoupper($_REQUEST[stckpengambil]);
		$krmstnkesmsat	= date("Y-m-d",strtotime($_REQUEST[krmstnkesmsat]));
		$noticeselesai	= date("Y-m-d",strtotime($_REQUEST[noticeselesai]));
		$nopol	= strtoupper($_REQUEST[nopol]);
		$nostnk	= strtoupper($_REQUEST[nostnk]);
		$stnkselesai	= date("Y-m-d",strtotime($_REQUEST[stnkselesai]));
		$stnkdiambil	= date("Y-m-d",strtotime($_REQUEST[stnkdiambil]));
		$stnkpengambil	= strtoupper($_REQUEST[stnkpengambil]);
		$nobpkb	= strtoupper($_REQUEST[nobpkb]);
		$bpkbselesai	= date("Y-m-d",strtotime($_REQUEST[bpkbselesai]));
		$bpkbdiambil	= date("Y-m-d",strtotime($_REQUEST[bpkbdiambil]));
		$bpkbpengambil	= strtoupper($_REQUEST[bpkbpengambil]);
		
		if(!empty($_REQUEST[stckdiambil]) && empty($_REQUEST[stckselesai])){
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		else{
			if(!empty($_REQUEST[stckpengambil]) && empty($_REQUEST[stckdiambil])){
				echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
				exit();
				}
			else{
				if(!empty($_REQUEST[krmstnkesmsat]) && empty($_REQUEST[stckpengambil])){
					echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
					exit();
					}
				else{
					if(!empty($_REQUEST[noticeselesai]) && empty($_REQUEST[krmstnkesmsat])){
						echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
						exit();
						}
					else{
						if(!empty($_REQUEST[nopol]) && empty($_REQUEST[noticeselesai])){
							echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
							exit();
							}
						else{
							if(!empty($_REQUEST[nostnk]) && empty($_REQUEST[nopol])){
								echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
								exit();
								}
							else{
								if(!empty($_REQUEST[stnkselesai]) && empty($_REQUEST[nostnk])){
									echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
									exit();
									}
								else{
									if(!empty($_REQUEST[stnkdiambil]) && empty($_REQUEST[stnkselesai])){
										echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
										print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
										exit();
										}
									else{
										if(!empty($_REQUEST[stnkpengambil]) && empty($_REQUEST[stnkdiambil])){
											echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
											print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
											exit();
											}
										else{
											if(!empty($_REQUEST[nobpkb]) && empty($_REQUEST[stnkpengambil])){
												echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
												print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
												exit();
												}
											else{
												if(!empty($_REQUEST[bpkbselesai]) && empty($_REQUEST[nobpkb])){
													echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
													exit();
													}
												else{
													$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nonota='$_REQUEST[nonota]'"));
													if(!empty($_REQUEST[bpkbdiambil]) && empty($_REQUEST[bpkbselesai])){
														echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
														print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
														exit();
														}
													else{
														if($dA[jnstransaksi]=='CASH' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='DEALER')){
															if(!empty($_REQUEST[bpkbpengambil]) && empty($_REQUEST[bpkbdiambil])){
																echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Sebelumnya Tidak Boleh Kosong.')</script>";
																print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
																exit();
																}
															else{
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		
		/* #################################################################################################################################################### */
		if($stckselesai > $stckdiambil && !empty($_REQUEST[stckdiambil]))
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal STCK Di Ambil Melewati Tanggal STCK Selesai.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		if($krmstnkesmsat > $noticeselesai && !empty($_REQUEST[noticeselesai]))
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Kirim STNK Ke Samsat Melewati Tanggal Notice Pajak Selesai.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		if(!empty($_REQUEST[stnkdiambil]) AND ($stnkselesai > $stnkdiambil))
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal STNK Selesai Melewati Tanggal STNK Diambil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		if(!empty($_REQUEST[bpkbdiambil]) AND ($bpkbselesai > $bpkbdiambil))
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal BPKB Selesai Melewati Tanggal BPKB Diambil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
			
		$dCek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$_REQUEST[nonota]' AND (namaambilbpkb='$bpkbpengambil' OR namaambilbpkb2='$bpkbpengambil')"));
		$dCek2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$_REQUEST[nonota]'"));
		if($dA[jnstransaksi]=='CASH' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='DEALER')){
			if(!empty($_REQUEST[bpkbpengambil])){
				if(!empty($dCek2[namaambilbpkb2])){
					$npbpkb = "$dCek2[namaambilbpkb] Atau $dCek2[namaambilbpkb2]";
					}
				else{
					$npbpkb = "$dCek2[namaambilbpkb]";
					}
				if(empty($dCek[id])){
				?>
					<script>
					    var r = confirm("Nama Pengambil BPKB Yang Diinput (<?echo $bpkbpengambil?>),\nBerbeda Dengan Rencana Nama Pengambil BPKB Di Menu Pengeluaran Unit (<?echo $npbpkb?>).\nApakah Anda Yakin Menyimpan Data Ini?");
					    if (r == true){
					    	window.location = "<?echo "?opt=$opt&menu=$menu&submenu=save2&norangka=$_REQUEST[norangka]&bpkbpengambil=$bpkbpengambil&bpkbdiambil=$bpkbdiambil";?>";
					   		} 
					   	if (r == false){
					    	window.location = "<?echo "?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]&tidak";?>";
					    	}
					</script>
				<?
					exit();
					}
				}
			}
			
		$q1 = mysql_query("UPDATE tbl_stnkbpkb SET
												stckselesai='$stckselesai', 
												stckdiambil='$stckdiambil',
												stckpengambil='$stckpengambil', 
												krmstnkesmsat='$krmstnkesmsat',
												noticeselesai='$noticeselesai',
												stnkselesai='$stnkselesai', 
												stnkdiambil='$stnkdiambil',
												stnkpengambil='$stnkpengambil', 
												bpkbselesai='$bpkbselesai',
												bpkbdiambil='$bpkbdiambil', 
												bpkbpengambil='$bpkbpengambil', 
												nopol='$nopol', 
												nostnk='$nostnk', 
												nobpkb='$nobpkb', 
												updatex='$updatex'
											WHERE norangka='$_REQUEST[norangka]'
							");	
		
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_stnkbpkb',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'UBAH STNK BPKB $_REQUEST[norangka] $_REQUEST[nonota]')
							");
				
		
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		}
	else if($submenu == 'save2')
		{
		$q1 = mysql_query("UPDATE tbl_stnkbpkb SET
												bpkbdiambil='$_REQUEST[bpkbdiambil]', 
												bpkbpengambil='$_REQUEST[bpkbpengambil]'
											WHERE norangka='$_REQUEST[norangka]'
							");	
		
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_stnkbpkb',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'UBAH STNK BPKB $_REQUEST[norangka]')
							");
				
		
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&norangka=$_REQUEST[norangka]'/>";
			exit();
			}
		}
?>
	