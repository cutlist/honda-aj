<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
		<?
			$dI=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
		?>
			<a class="brand" href="?menu=home"><?echo $dI['nama'];?> | Sistem Informasi Biro Jasa</a>
			<div class="nav-collapse">
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-cog"></i> <?echo strtoupper($_SESSION['nama']);?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
					 <li><a href="?menu=profile">Profile</a></li>
					 <li><a href="module/logout.php" title="Logout" onclick="return confirm('Anda Ingin Logout?')">Logout</a></li>
					</ul>
				</li>
			</ul>
		 </div>
		</div> 
	</div> 
</div>

<?
if($_SESSION['lvl'] == 'PIMPINAN')
	{
?>
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
			 <ul class="mainnav">
				<li <?if($menu == 'home'){?> class="active" <?}?>><a href="?menu=home"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
				<li <?if($menu == 'master'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd "></i><span>Master</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=master&act=A1">Master Merek R2/R3</a></li>
						<li><a href="?menu=master&act=B1">Master Merek R4</a></li>
						<li><a href="?menu=master&act=A2">Master Tipe R2/R3</a></li>
						<li><a href="?menu=master&act=B2">Master Tipe R4</a></li>
						<li><a href="?menu=master&act=C1">Master Wilayah</a></li>
						<li><a href="?menu=master&act=D1">Master Tarif</a></li>
						<!--<li><a href="#">Master Persyaratan</a></li>-->
						<hr style="margin:5px 0 0 0;">
						<li><a href="?menu=master&act=E1">Master Karyawan</a></li>
						<li><a href="?menu=master&act=F1">Master Login</a></li>
						<hr style="margin:5px 0 0 0;">
						<li><a href="?menu=master&act=delall" onclick="return confirm('Anda yakin untuk menghapus semua data pada sistem ini?')">Hapus Semua Data</a></li>
					</ul>
				</li>
				<li <?if($menu == 'jasa'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i><span>Jasa</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=jasa&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=jasa&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=jasa&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=jasa&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=jasa&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=jasa&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=jasa&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=jasa&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=jasa&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=jasa&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=jasa&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=jasa&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=jasa&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=jasa&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=jasa&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=jasa&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=jasa&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'patty'){?> class="active" <?}?>><a href="?menu=patty&act=A1"><i class="icon-briefcase"></i><span>Patty Cash</span> </a> </li>
				<li <?if($menu == 'kas'){?> class="active" <?}?>><a href="?menu=kas&act=A1"><i class="icon-retweet"></i><span>Kas Besar</span> </a> </li>
				<!--
				<li <?if($menu == 'rayon'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i><span>Patty Cash</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">History</a></li>
						<li><a href="#">Input & Output</a></li>
					</ul>
				</li>
				-->
				<li <?if($menu == 'gaji'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-money"></i><span style="margin-left:-6px">Penggajian</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=gaji&act=A1">Gaji Bulanan</a></li>
						
					</ul>
				</li>
				<li <?if($menu == 'update'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-refresh"></i><span>Update</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=update&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=update&act=B1">BBN Perusahaan</a></li>
					</ul>
				</li>
				<li <?if($menu == 'kutipan'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment"></i><span>Kutipan</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=kutipan&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=kutipan&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=kutipan&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=kutipan&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=kutipan&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=kutipan&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=kutipan&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=kutipan&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=kutipan&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=kutipan&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=kutipan&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<!--
				<li <?if($menu == 'tterima'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-copy"></i><span style="margin-left:-6px"> &nbsp; T. Terima</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=tterima&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=tterima&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=tterima&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=tterima&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=tterima&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=tterima&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=tterima&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=tterima&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=tterima&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=tterima&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=tterima&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=tterima&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=tterima&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=tterima&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=tterima&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=tterima&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=tterima&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=tterima&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=tterima&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				-->
				<li <?if($menu == 'cetak' || $menu == 'kwpelunasan' || $menu == 'tterima'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print"></i><span style="margin-left:-6px"> &nbsp; Cetak</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<!--<li><a href="?menu=cetak&act=A1">Kwitansi DP </a></li>-->
						<li><a href="?menu=cetak&act=B1">Kwitansi Pelunasan </a></li>
						<li><a href="?menu=cetak&act=C1">Tanda Terima </a></li>
					</ul>
				</li>
				<li <?if($menu == 'laporan'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file"></i><span style="margin-left:-6px"> &nbsp; Laporan</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=laporan&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=laporan&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=laporan&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=laporan&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=laporan&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=laporan&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=laporan&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=laporan&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=laporan&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=laporan&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=laporan&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=laporan&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=laporan&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=laporan&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=laporan&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=laporan&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=laporan&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=laporan&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=laporan&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
						<hr style="margin:5px 0 0 0;">
						<li><a href="?menu=laporan&act=gaji">Gaji Bulanan</a></li>
						<hr style="margin:5px 0 0 0;">
						<li><a href="?menu=laporan&act=rl">Rugi Laba</a></li>
					</ul>
				</li>
			 </ul>
			</div>
		</div>
	</div>
<?
	}
	
if($_SESSION['lvl'] == 'ADMIN')
	{
?>
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
			 <ul class="mainnav">
				<li <?if($menu == 'home'){?> class="active" <?}?>><a href="?menu=home"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
				<li <?if($menu == 'master'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd "></i><span>Master</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=master&act=A1">Master Merek R2/R3</a></li>
						<li><a href="?menu=master&act=B1">Master Merek R4</a></li>
						<li><a href="?menu=master&act=A2">Master Tipe R2/R3</a></li>
						<li><a href="?menu=master&act=B2">Master Tipe R4</a></li>
						<li><a href="?menu=master&act=C1">Master Wilayah</a></li>
						<li><a href="?menu=master&act=D1">Master Tarif</a></li>
						<hr style="margin:5px 0 0 0;">
						<li><a href="?menu=master&act=E1">Master Karyawan</a></li>
						<li><a href="?menu=master&act=F1">Master Login</a></li>
						<hr style="margin:5px 0 0 0;">
						<li><a href="?menu=master&act=delall" onclick="return confirm('Anda yakin untuk menghapus semua data pada sistem ini?')">Hapus Semua Data</a></li>
					</ul>
				</li>
				<li <?if($menu == 'jasa'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i><span>Jasa</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=jasa&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=jasa&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=jasa&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=jasa&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=jasa&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=jasa&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=jasa&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=jasa&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=jasa&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=jasa&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=jasa&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=jasa&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=jasa&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=jasa&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=jasa&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=jasa&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=jasa&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'export'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print "></i><span>Export</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=export&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=export&act=B1">BBN Perusahaan</a></li>
					</ul>
				</li>
				<li <?if($menu == 'patty'){?> class="active" <?}?>><a href="?menu=patty&act=A1"><i class="icon-briefcase"></i><span>Patty Cash</span> </a> </li>
				<li <?if($menu == 'kas'){?> class="active" <?}?>><a href="?menu=kas&act=A1"><i class="icon-retweet"></i><span>Kas Besar</span> </a> </li>
				<li <?if($menu == 'update'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-refresh"></i><span>Update</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=update&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=update&act=B1">BBN Perusahaan</a></li>
					</ul>
				</li>
				<li <?if($menu == 'kutipan'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment"></i><span>Kutipan</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=kutipan&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=kutipan&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=kutipan&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=kutipan&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=kutipan&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=kutipan&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=kutipan&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=kutipan&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=kutipan&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=kutipan&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=kutipan&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'tterima'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-copy"></i><span style="margin-left:-6px"> &nbsp; T. Terima</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=tterima&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=tterima&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=tterima&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=tterima&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=tterima&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=tterima&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=tterima&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=tterima&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=tterima&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=tterima&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=tterima&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=tterima&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=tterima&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=tterima&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=tterima&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=tterima&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=tterima&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=tterima&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=tterima&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'cetak' || $menu == 'kwpelunasan' || $menu == 'tterima'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print"></i><span style="margin-left:-6px"> &nbsp; Cetak</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<!--<li><a href="?menu=cetak&act=A1">Kwitansi DP </a></li>-->
						<li><a href="?menu=cetak&act=B1">Kwitansi Pelunasan </a></li>
						<li><a href="?menu=cetak&act=C1">Tanda Terima </a></li>
					</ul>
				</li>
				<li <?if($menu == 'matifaktur'){?> class="active" <?}?>><a href="?menu=matifaktur&act=A1"><i class="icon-time"></i><span>Faktur</span> </a> </li>
			 </ul>
			</div>
		</div>
	</div>
<?
	}
	
if($_SESSION['lvl'] == 'KEUANGAN')
	{
?>
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
			 <ul class="mainnav">
				<li <?if($menu == 'home'){?> class="active" <?}?>><a href="?menu=home"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
				<li <?if($menu == 'jasa'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i><span>Jasa</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=jasa&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=jasa&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=jasa&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=jasa&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=jasa&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=jasa&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=jasa&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=jasa&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=jasa&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=jasa&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=jasa&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=jasa&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=jasa&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=jasa&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=jasa&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=jasa&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=jasa&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'patty'){?> class="active" <?}?>><a href="?menu=patty&act=A1"><i class="icon-briefcase"></i><span>Patty Cash</span> </a> </li>
				<!--
				<li <?if($menu == 'rayon'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i><span>Patty Cash</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">History</a></li>
						<li><a href="#">Input & Output</a></li>
					</ul>
				</li>
				-->
				<li <?if($menu == 'kutipan'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment"></i><span>Kutipan</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=kutipan&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=kutipan&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=kutipan&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=kutipan&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=kutipan&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=kutipan&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=kutipan&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=kutipan&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=kutipan&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=kutipan&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=kutipan&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
			 </ul>
			</div>
		</div>
	</div>
<?
	}
	
if($_SESSION['lvl'] == 'PROSES')
	{
?>
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
			 <ul class="mainnav">
				<li <?if($menu == 'home'){?> class="active" <?}?>><a href="?menu=home"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
				<li <?if($menu == 'jasa'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i><span>Jasa</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=jasa&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=jasa&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=jasa&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=jasa&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=jasa&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=jasa&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=jasa&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=jasa&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=jasa&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=jasa&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=jasa&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=jasa&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=jasa&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=jasa&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=jasa&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=jasa&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=jasa&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'export'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print "></i><span>Export</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=export&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=export&act=B1">BBN Perusahaan</a></li>
					</ul>
				</li>
				<li <?if($menu == 'kutipan'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment"></i><span>Kutipan</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=kutipan&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=kutipan&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=kutipan&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=kutipan&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=kutipan&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=kutipan&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=kutipan&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=kutipan&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=kutipan&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=kutipan&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=kutipan&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=kutipan&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=kutipan&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
			 </ul>
			</div>
		</div>
	</div>
<?
	}
	
if($_SESSION['lvl'] == 'PENYERAHAN')
	{
?>
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
			 <ul class="mainnav">
				<li <?if($menu == 'home'){?> class="active" <?}?>><a href="?menu=home"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
				<li <?if($menu == 'jasa'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i><span>Jasa</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=jasa&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=jasa&act=B1">BBN Perusahaan</a></li>
						<li><a href="?menu=jasa&act=C1">Perpanjangan (PKB) Perorangan </a></li>
						<li><a href="?menu=jasa&act=D1">Perpanjangan (PKB) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=E1">Perpanjangan STNK & Plat 5 Tahunan Perorangan</a></li>
						<li><a href="?menu=jasa&act=F1">Perpanjangan STNK & Plat 5 Tahunan Perusahaan</a></li>
						<li><a href="?menu=jasa&act=G1">Pergantian STNK Hilang atas nama Perorangan</a></li>
						<li><a href="?menu=jasa&act=H1">Pergantian STNK Hilang atas nama Perusahaan</a></li>
						<li><a href="?menu=jasa&act=I1">Balik Nama Kendaraan ke Perorangan </a></li>
						<li><a href="?menu=jasa&act=J1">Balik Nama Kendaraan ke Perusahaan</a></li>
						<li><a href="?menu=jasa&act=K1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perorangan</a></li>
						<li><a href="?menu=jasa&act=L1">Mutasi Kendaraan (masih 1 pemilik yang sama) Perusahaan</a></li>
						<li><a href="?menu=jasa&act=M1">Rubentina (rubah bentuk ganti warna) Perorangan </a></li>
						<li><a href="?menu=jasa&act=N1">Rubentina (rubah bentuk ganti warna) perusahaan </a></li>
						<li><a href="?menu=jasa&act=O1">Perpanjangan "KIR" Kendaraan Pengangkut Barang/Orang</a></li>
						<li><a href="?menu=jasa&act=P1">Pembuatan SIM</a></li>
						<li><a href="?menu=jasa&act=Q1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) PT</a></li>
						<li><a href="?menu=jasa&act=R1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) CV </a></li>
						<li><a href="?menu=jasa&act=S1">Pembuatan SIUP TDP SITU dan HO (Ijin Gangguan) Perorangan </a></li>
					</ul>
				</li>
				<li <?if($menu == 'update'){?>class="dropdown active"<?}else{?>class="dropdown"<?}?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-refresh"></i><span>Update</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="?menu=update&act=A1">BBN Perorangan </a></li>
						<li><a href="?menu=update&act=B1">BBN Perusahaan</a></li>
					</ul>
				</li>
			 </ul>
			</div>
		</div>
	</div>
<?
	}
?>