    <!-- mousetrap -->
    <script src="js/mousetrap.js" type="text/javascript"></script> 
        
	    <?
	    	//include "include/waktu.php";
		if($_SESSION['jns']=='H1' OR $_SESSION['jns']=='H1aj')
			{
	    ?>
			<aside class="right-side">
			    <ol class="breadcrumb" style="width: 200%">
				    <?if($opt==md5(mstr)){?><li style="font-weight:bold"> &nbsp;&nbsp; MASTER</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(mstr)?>"> &nbsp;&nbsp; MASTER</a></li><?}?>
				    <?if($opt==md5(pnjl)){?><li style="font-weight:bold">PENJUALAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(pnjl)?>">PENJUALAN</a></li><?}?>
				    <?if($opt==md5(dplg)){?><li style="font-weight:bold">PELANGGAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(dplg)?>">PELANGGAN</a></li><?}?>
				    <?if($opt==md5(ksr)){?><li style="font-weight:bold">KASIR</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(ksr)?>">KASIR</a></li><?}?>
				    <?if($opt==md5(gpdi)){?><li style="font-weight:bold">GUDANG & PDI</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(gpdi)?>">GUDANG & PDI</a></li><?}?>
				    <?if($opt==md5(adm)){?><li style="font-weight:bold">ADMINISTRASI</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(adm)?>">ADMINISTRASI</a></li><?}?>
				    <?if($opt==md5(pmbl)){?><li style="font-weight:bold">PEMBELIAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(pmbl)?>">PEMBELIAN</a></li><?}?>
				    <?if($opt==md5(sdm)){?><li style="font-weight:bold">SDM</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(sdm)?>">SDM</a></li><?}?>
				    <?if($opt==md5(abis)){?><li style="font-weight:bold">AKTIVITAS BISNIS</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(abis)?>">AKTIVITAS BISNIS</a></li><?}?>
				    <?if($opt==md5(bup)){?><li style="font-weight:bold">BACKUP</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(bup)?>">BACKUP</a></li><?}?>
			    </ol>
			</aside>
		<?
			}
			
		if($_SESSION['jns']=='H2H3' OR $_SESSION['jns']=='H2H3aj')
			{
	    ?>
	    	<aside class="right-side">
			    <ol class="breadcrumb" style="width: 200%">
				    <?if($opt==md5(mstr)){?><li style="font-weight:bold"> &nbsp;&nbsp; MASTER</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(mstr)?>"> &nbsp;&nbsp; MASTER</a></li><?}?>
				    <?if($opt==md5(pnjl)){?><li style="font-weight:bold">PENJUALAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(pnjl)?>">PENJUALAN</a></li><?}?>
				    <?if($opt==md5(svc)){?><li style="font-weight:bold">SERVIS</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(svc)?>">SERVIS</a></li><?}?>
				    <?if($opt==md5(dplg)){?><li style="font-weight:bold">PELANGGAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(dplg)?>">PELANGGAN</a></li><?}?>
				    <?if($opt==md5(ksr)){?><li style="font-weight:bold">KASIR</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(ksr)?>">KASIR</a></li><?}?>
				    <?if($opt==md5(gpdi)){?><li style="font-weight:bold">GUDANG SPARE PART</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(gpdi)?>">GUDANG SPARE PART</a></li><?}?>
				    <?if($opt==md5(adm)){?><li style="font-weight:bold">ADMINISTRASI</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(adm)?>">ADMINISTRASI</a></li><?}?>
				    <?if($opt==md5(pmbl)){?><li style="font-weight:bold">PEMBELIAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(pmbl)?>">PEMBELIAN</a></li><?}?>
				    <?if($opt==md5(sdm)){?><li style="font-weight:bold">SDM</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(sdm)?>">SDM</a></li><?}?>
				    <?if($opt==md5(abis)){?><li style="font-weight:bold">AKTIVITAS BISNIS</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(abis)?>">AKTIVITAS BISNIS</a></li><?}?>
				    <?if($opt==md5(bup)){?><li style="font-weight:bold">BACKUP</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(bup)?>">BACKUP</a></li><?}?>
			    </ol>
			</aside>
		<?
			}
		?>

		<aside class="left-side sidebar-offcanvas">
		    <section class="sidebar">
	<?
	if($_SESSION['jns']=='H1' OR $_SESSION['jns']=='H1aj')
		{
		if(empty($opt))
			{
	?>
	        <ul class="sidebar-menu">
	            <li style="padding:5px">
	            	<div style="background:#fce4d2;min-height:200px;line-height:17px;padding:15px;text-align:center;">
	            		<h4 style="margin-top:10px;margin-bottom:0px"><b><?echo $_SESSION['namaperusahaan']?></b></h4>
	            		<p><?echo $_SESSION['alamatperusahaan']?></p>
	            		
	            		<h4 style="margin-top:10px;margin-bottom:0px">PERIODE</h4>
	            		<?
                		$bulan = date("m");
                		$tahun = date("Y");
                		$dPeriode = mysql_fetch_array(mysql_query("SELECT namabln FROM tbl_bulan WHERE angkabln='$bulan'"));
						
                		$dTarget = mysql_fetch_array(mysql_query("SELECT target FROM tbl_target WHERE bulan='$bulan' AND tahun='$tahun'"));
                		$dReal = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE bulan='$bulan' AND tahun='$tahun'"));
	            		?>
	            		<p><b><?echo "$dPeriode[namabln] $tahun"?></b></p>
	            		
	            		<h4 style="margin-top:10px;margin-bottom:0px">TARGET</h4>
	            		<p><b><?echo number_format($dTarget[target])?></b></p>
	            		
	            		<h4 style="margin-top:10px;margin-bottom:0px">REALISASI</h4>
	            		<p><b><?echo number_format($dReal[total])?></b></p>
	            	</div>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(mstr))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(karyawan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(karyawan);?>" id="1">
	                    <i class="fa fa-users"></i> <span><u>K</u>aryawan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(user)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(user);?>" id="2">
	                    <i class="fa fa-user"></i> <span><u>U</u>ser</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(barang)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(barang);?>" id="3">
	                    <i class="fa fa-dropbox"></i> <span><u>B</u>arang</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(grossubsidi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(grossubsidi);?>" id="4">
	                    <i class="fa fa-bolt"></i> <span><u>P</u>ajak Matrix</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(insentif)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(insentif);?>" id="5">
	                    <i class="fa fa-dollar"></i> <span>K<u>o</u>misi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(lainbbn)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(lainbbn);?>" id="5">
	                    <i class="fa fa-dollar"></i> <span>Biaya Lain-Lain BBN</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(leasing)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(leasing);?>" id="6">
	                    <i class="fa fa-money"></i> <span><u>L</u>easing</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(gudang)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(gudang);?>" id="7">
	                    <i class="fa fa-th"></i> <span><u>G</u>udang</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(daerah)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-tag"></i>
	                    <span><u>D</u>aerah</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(daerah) && $submenu == "kab"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=kab&menu=".md5(daerah);?>" id="8">
							<i class="fa fa-angle-double-right"></i> Kabupaten/Kota</a></li>
			            <li <?if($menu==md5(daerah) && $submenu == "kec"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=kec&menu=".md5(daerah);?>">
			                <i class="fa fa-angle-double-right"></i> Kecamatan</a></li>
			            <li <?if($menu==md5(daerah) && $submenu == "kel"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=kel&menu=".md5(daerah);?>">
			                <i class="fa fa-angle-double-right"></i> Kelurahan</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(target)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(target);?>" id="10">
	                    <i class="fa fa-dot-circle-o"></i> <span><u>T</u>arget</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(perusahaan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(perusahaan);?>" id="9">
	                    <i class="fa fa-building-o"></i> <span>Pe<u>r</u>usahaan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(del)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(del);?>">
	                     <i class="fa fa-trash-o"></i> <span>Hapus Database</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("u", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("b", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("g", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			  	Mousetrap.bind("d", function() {
				    GoToLocation(document.getElementById("8").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("9").href);
				  	});
			  	Mousetrap.bind("t", function() {
				    GoToLocation(document.getElementById("10").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(pnjl))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(stok)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(stok);?>" id="1">
	                    <i class="fa fa-search"></i> <span><u>L</u>ihat Stok</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(unitindent)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(unitindent);?>" id="2">
	                    <i class="fa fa-lock"></i> <span><u>U</u>nit Indent</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pemesanan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pemesanan);?>" id="3">
	                    <i class="ion ion-bag"></i> <span><u>P</u>emesanan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(indent)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(indent);?>" id="4">
	                    <i class="fa fa-book"></i> <span><u>I</u>ndent</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(notajual)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(notajual);?>" id="5">
	                    <i class="ion ion-ios7-cart-outline""></i> <span>P<u>e</u>njualan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pesannopol)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pesannopol);?>" id="6">
	                    <i class="fa fa-bookmark"></i> <span>Pe<u>m</u>esanan NOPOL</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(kinerjasales)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-gears"></i>
	                    <span><u>K</u>inerja Sales</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(kinerjasales) && $submenu == "individu"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=individu&menu=".md5(kinerjasales);?>" id="7">
							<i class="fa fa-angle-double-right"></i> Individu</a></li>
			            <li <?if($menu==md5(kinerjasales) && $submenu == "semua"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=semua&menu=".md5(kinerjasales);?>">
			                <i class="fa fa-angle-double-right"></i> Semua</a></li>
			            <li <?if($menu==md5(kinerjasales) && $submenu == "efektivitas"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=efektivitas&menu=".md5(kinerjasales);?>">
			                <i class="fa fa-angle-double-right"></i> Efektivitas Prospek</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(cashtempo)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(cashtempo);?>" id="8">
	                    <i class="fa fa-bell"></i> <span><u>C</u>ash Tempo Dealer</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("u", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("i", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});;
			  	Mousetrap.bind("e", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("m", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			  	Mousetrap.bind("c", function() {
				    GoToLocation(document.getElementById("8").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(dplg))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(pelanggan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pelanggan);?>" id="1">
	                    <i class="fa fa-tags"></i> <span><u>D</u>aftar Pelanggan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pelangganohc)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=B&menu=".md5(pelangganohc);?>" id="2">
	                    <i class="fa fa-credit-card"></i> <span><u>O</u>HC</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pelanggannonohc)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=C&menu=".md5(pelanggannonohc);?>" id="3">
	                    <i class="fa fa-bookmark-o"></i> <span><u>N</u>on OHC</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(perbaharuiohc)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=D&menu=".md5(perbaharuiohc);?>" id="4">
	                    <i class="fa fa-star"></i> <span><u>P</u>erbaharui OHC</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(potensial)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=potensial&menu=".md5(potensial);?>" id="5">
	                    <i class="fa fa-retweet"></i> <span>P<u>e</u>langgan Potensial</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(prospek)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=prospek&menu=".md5(prospek);?>" id="6">
	                    <i class="fa fa-rocket"></i> <span>P<u>r</u>ospek Terpilih</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("d", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("e", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(ksr))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(kwitansi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(kwitansi);?>" id="1">
	                    <i class="fa fa-file-text"></i> <span><u>K</u>witansi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(ujual)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(ujual);?>" id="2">
	                    <i class="ion ion-ios7-cart-outline"></i> <span><u>U</u>pdate Penjualan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(kaskecil)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(kaskecil);?>" id="3">
	                    <i class="fa fa-book"></i> <span>K<u>a</u>s Kecil</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(aruskas)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(aruskas);?>" id="4">
	                    <i class="fa fa-retweet"></i> <span>A<u>r</u>us Kas</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(kasbon)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(kasbon);?>" id="5">
	                    <i class="fa fa-money"></i> <span><u>C</u>ash Bon</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("u", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});;
			  	Mousetrap.bind("c", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});;
			</script>
	<?
			}
				
		else if($opt==md5(gpdi))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(cekfisik)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(cekfisik);?>" id="1">
	                    <i class="fa fa-check"></i> <span><u>C</u>ek Fisik</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(konfnotabeli)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=unit&menu=".md5(konfnotabeli);?>" id="2">
	                    <i class="fa fa-file"></i> <span><u>K</u>onfirmasi Nota Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(stok)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(stok);?>" id="3">
	                    <i class="fa fa-search"></i> <span><u>L</u>ihat Stok</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(stokaksesoris)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(stokaksesoris);?>" id="4">
	                    <i class="fa fa-gift"></i> <span><u>S</u>tok Aksesoris</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(statusaksesoris)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(statusaksesoris);?>" id="5">
	                    <i class="fa fa-asterisk"></i> <span>S<u>t</u>atus Aksesoris (Masuk)</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pindahlokasi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pindahlokasi);?>" id="6">
	                    <i class="fa fa-exchange"></i> <span><u>P</u>indah Lokasi</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(transferbrg)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-exchange"></i>
	                    <span><u>M</u>utasi Barang</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(transferbrg) && ($submenu == "A" || $submenu == "B" || $submenu == "C" || $submenu == "D")){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(transferbrg);?>" id="10">
							<i class="fa fa-angle-double-right"></i> Keluar</a></li>
			            <li <?if($menu==md5(transferbrg) && ($submenu == "F" || $submenu == "G" || $submenu == "H" || $submenu == "I")){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=F&menu=".md5(transferbrg);?>">
			                <i class="fa fa-angle-double-right"></i> Masuk</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(penyesuaianstok)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(penyesuaianstok);?>" id="7">
	                    <i class="fa fa-wrench"></i> <span>St<u>o</u>ck Opname Barang</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(opnamebensin)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(opnamebensin);?>" id="8">
	                    <i class="fa fa-dashboard"></i> <span>Stock Op<u>n</u>ame Bensin</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(bensin)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(bensin);?>" id="9">
	                    <i class="fa fa-map-marker"></i> <span><u>B</u>ensin</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("c", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("s", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});;
			  	Mousetrap.bind("m", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});;
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});;
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});;
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("8").href);
				  	});;
			  	Mousetrap.bind("b", function() {
				    GoToLocation(document.getElementById("9").href);
				  	});;
			</script>
	<?
			}
				
		else if($opt==md5(adm))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(pengeluaranunit)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pengeluaranunit);?>" id="1">
	                    <i class="fa fa-truck"></i> <span><u>P</u>engeluaran Unit</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(returbeli)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(returbeli);?>" id="2">
	                    <i class="fa fa-undo"></i> <span><u>R</u>etur Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(stnkbpkb)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(stnkbpkb);?>" id="3">
	                    <i class="fa fa-files-o"></i> <span><u>S</u>TNK & BPKB</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(konfsuratjalan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(konfsuratjalan);?>" id="4">
	                    <i class="fa fa-clipboard"></i> <span><u>K</u>onfirmasi Surat Jalan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pembayaranleasing)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pembayaranleasing);?>" id="5">
	                    <i class="fa fa-dollar"></i> <span>P<u>e</u>mbayaran Leasing &</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Main Dealer</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("s", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});;
			  	Mousetrap.bind("e", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});;
			</script>
	<?
			}
				
		else if($opt==md5(pmbl))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(notabeli)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(notabeli);?>" id="1">
	                    <i class="fa fa-file-o"></i> <span><u>N</u>ota Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(bayarsup)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(bayarsup);?>" id="2">
	                    <i class="fa fa-dollar"></i> <span><u>P</u>embayaran</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(sdm))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(piutang)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(piutang);?>" id="1">
	                    <i class="fa fa-exclamation"></i> <span><u>P</u>iutang</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(absensi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-calendar"></i> 
	                    <span><u>A</u>bsensi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(absensi) && $submenu == "sync"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=sync&menu=".md5(absensi);?>" id="2"><i class="fa fa-refresh"></i> Synchronize</a></li>
			            <li><hr style="margin:0px"></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_individu"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_individu&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Individu</a></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_rekap"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_rekap&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Rekapitulasi</a></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_dispensasi"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_dispensasi&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Dispensasi</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(potkompensasi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(potkompensasi);?>" id="3">
	                    <i class="fa fa-cut"></i> <span>P<u>o</u>tongan Kompensasi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(uangharian)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(uangharian);?>" id="4">
	                    <i class="fa fa-location-arrow"></i> <span><u>U</u>ang Harian</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(uanglembur)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-moon-o"></i> 
	                    <span>Ua<u>n</u>g Lembur</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(uanglembur) && $submenu == "A"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=A&menu=".md5(uanglembur);?>" id="5"><i class="fa fa-angle-double-right"></i> Daftar Lembur</a></li>
			            <li class="<?if($menu==md5(uanglembur) && $submenu == "B"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=B&menu=".md5(uanglembur);?>"><i class="fa fa-angle-double-right"></i> Pembayaran</a></li>
			        </ul>
	            </li>
	            <li class="treeview <?if($menu==md5(kompensasi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-archive"></i> 
	                    <span><u>K</u>ompensasi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(kompensasi) && $submenu == "kom_rincian"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=kom_rincian&menu=".md5(kompensasi);?>" id="6"><i class="fa fa-angle-double-right"></i> Rincian</a></li>
			            <li class="<?if($menu==md5(kompensasi) && $submenu == "kom_rekap"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=kom_rekap&menu=".md5(kompensasi);?>"><i class="fa fa-angle-double-right"></i> Rekapitulasi</a></li>
			        </ul>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("u", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(abis))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(abis_penjualan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_penjualan);?>" id="1">
	                    <i class="fa fa-paperclip"></i> <span><u>P</u>enjualan Unit</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_pembelian)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_pembelian);?>" id="2">
	                    <i class="fa fa-paperclip"></i> <span>P<u>e</u>mbelian Unit</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_arusunit)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_arusunit);?>" id="3">
	                    <i class="fa fa-paperclip"></i> <span><u>A</u>rus Unit</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_sleasing)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_sleasing);?>" id="4">
	                    <i class="fa fa-paperclip"></i> <span><u>S</u>urvey Leasing</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_dkonfirmasi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_dkonfirmasi);?>" id="5">
	                    <i class="fa fa-file"></i> <span><u>D</u>aftar Konfirmasi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_ikesalahan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_ikesalahan);?>" id="6">
	                    <i class="fa fa-times"></i> <span><u>I</u>ndikasi Kesalahan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(alert)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(alert);?>" id="7">
	                    <i class="fa fa-bullseye"></i> <span>A<u>l</u>ert</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("e", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("s", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("d", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("i", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(profile))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(profile)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(profile);?>">
	                    <i class="fa fa-user"></i> <span>Profile <?//echo $_SESSION[jns]?></span>
	                </a>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(del))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(del)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(del);?>">
	                     <i class="fa fa-trash-o"></i> <span>Hapus Database</span>
	                </a>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(bup))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(bup)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(bup);?>">
	                    <i class="fa fa-hdd-o"></i> <span>Backup Database</span>
	                </a>
	            </li>
	        </ul>
	<?
			}
		}
		
	else if($_SESSION['jns']=='H2H3' OR $_SESSION['jns']=='H2H3aj')
		{
		if(empty($opt))
			{
	?>
	        <ul class="sidebar-menu">
	            <li style="padding:5px">
	            	<div style="background:#fce4d2;min-height:200px;line-height:17px;padding:15px;text-align:center;">
	            		<h4 style="margin-top:10px;margin-bottom:0px"><b><?echo $_SESSION['namaperusahaan']?></b></h4>
	            		<p><?echo $_SESSION['alamatperusahaan']?></p>
	            		
	            		<h4 style="margin-top:10px;margin-bottom:0px">PERIODE</h4>
	            		<?
                		$bulan = date("m");
                		$tahun = date("Y");
                		$dPeriode = mysql_fetch_array(mysql_query("SELECT namabln FROM tbl_bulan WHERE angkabln='$bulan'"));
	            		?>
	            		<p><b><?echo "$dPeriode[namabln] $tahun"?></b></p>
	            	</div>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(mstr))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(karyawan)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(karyawan);?>">
	                    <i class="fa fa-users"></i> <span><u>K</u>aryawan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(user)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(user);?>">
	                    <i class="fa fa-user"></i> <span><u>U</u>ser</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(supplier)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(supplier);?>">
	                    <i class="fa fa-users"></i> <span><u>S</u>upplier</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(barang)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(barang);?>">
	                    <i class="fa fa-dropbox"></i> <span><u>B</u>arang</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(hargabarang)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-download"></i>
	                    <span><u>H</u>arga</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(hargabarang) && $submenu == "input" || $submenu == "B"){?>class="active"<?}?>">
			                <a id="5" href="<? echo "?opt=$opt&submenu=input&menu=".md5(hargabarang);?>">
							<i class="fa fa-angle-double-right"></i> Input Harga</a></li>
			            <li <?if($menu==md5(hargabarang) && $submenu == "daftar" || $submenu == "C"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=daftar&menu=".md5(hargabarang);?>">
			                <i class="fa fa-angle-double-right"></i> Cari Nota Beli</a></li>
			            <li <?if($menu==md5(hargabarang) && $submenu == "ubah" || $submenu == "D"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=ubah&menu=".md5(hargabarang);?>">
			                <i class="fa fa-angle-double-right"></i> Ubah Harga</a></li>
			            <!--
			            <li <?if($menu==md5(hargabarang) && $submenu == "daftar2"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=daftar2&menu=".md5(hargabarang);?>">
			                <i class="fa fa-angle-double-right"></i> Daftar Harga</a></li>
			            -->
					</ul>
	            </li>
	            <li class="<?if($menu==md5(jasa)){echo "active";}?>">
	                <a id="6" href="<? echo "?opt=$opt&submenu=A&menu=".md5(jasa);?>">
	                    <i class="fa fa-thumbs-up"></i> <span><u>J</u>asa</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(tarifjasa)){echo "active";}?>">
	                <a id="7" href="<? echo "?opt=$opt&submenu=A&menu=".md5(tarifjasa);?>">
	                    <i class="fa fa-dollar"></i> <span><u>T</u>arif Jasa ke Konsumen</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(komisi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-money"></i>
	                    <span>K<u>o</u>misi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(komisi) && $submenu == "A"){?>class="active"<?}?>">
			                <a id="12" href="<? echo "?opt=$opt&submenu=A&menu=".md5(komisi);?>">
							<i class="fa fa-angle-double-right"></i> Omset Bruto</a></li>
			            <li <?if($menu==md5(komisi) && $submenu == "B"){?>class="active"<?}?>">
			                <a id="12" href="<? echo "?opt=$opt&submenu=B&menu=".md5(komisi);?>">
							<i class="fa fa-angle-double-right"></i> Jasa</a></li>
					</ul>
	            </li>
	            <!--
	            <li class="<?if($menu==md5(tarifjasa2)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(tarifjasa2);?>">
	                    <i class="fa fa-dollar"></i> <span>Tarif Jasa ke Mekanik</span>
	                </a>
	            </li>
	            -->
	            <li class="<?if($menu==md5(kelompokjasa)){echo "active";}?>">
	                <a id="8" href="<? echo "?opt=$opt&submenu=A&menu=".md5(kelompokjasa);?>">
	                    <i class="fa fa-th"></i> <span><u>P</u>engelompokkan Jasa</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(gudang)){echo "active";}?>">
	                <a id="9" href="<? echo "?opt=$opt&submenu=A&menu=".md5(gudang);?>">
	                    <i class="fa fa-archive"></i> <span><u>G</u>udang</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(rak)){echo "active";}?>">
	                <a id="10" href="<? echo "?opt=$opt&submenu=A&menu=".md5(rak);?>">
	                    <i class="fa fa-archive"></i> <span><u>R</u>ak</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(perusahaan)){echo "active";}?>">
	                <a id="11" href="<? echo "?opt=$opt&submenu=A&menu=".md5(perusahaan);?>">
	                    <i class="fa fa-building-o"></i> <span>P<u>e</u>rusahaan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(del)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(del);?>">
	                     <i class="fa fa-trash-o"></i> <span>Hapus Database</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("u", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("s", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("b", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("h", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("j", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("t", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("8").href);
				  	});
			  	Mousetrap.bind("g", function() {
				    GoToLocation(document.getElementById("9").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("10").href);
				  	});
			  	Mousetrap.bind("e", function() {
				    GoToLocation(document.getElementById("11").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(pnjl))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(stok)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(stok);?>">
	                    <i class="fa fa-search"></i> <span><u>L</u>ihat Stok</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(notajual)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(notajual);?>">
	                    <i class="ion ion-ios7-cart-outline""></i> <span><u>P</u>enjualan</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(historyjual)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-search"></i>
	                    <span><u>R</u>iwayat</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(historyjual) && $submenu == "A" OR $submenu == "B"){?>class="active"<?}?>">
			                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(historyjual);?>">
							<i class="fa fa-angle-double-right"></i> No. Nota Jual</a></li>
			            <li <?if($menu==md5(historyjual) && $submenu == "C" OR $submenu == "D"){?>class="active"<?}?>">
			                <a id="3" href="<? echo "?opt=$opt&submenu=C&menu=".md5(historyjual);?>">
							<i class="fa fa-angle-double-right"></i> Nama Barang</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(indent)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(indent);?>">
	                    <i class="fa fa-book"></i> <span><u>I</u>ndent</span>
	                </a>
	            </li>
	            <!--
	            <li class="<?if($menu==md5(returjual)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(returjual);?>">
	                    <i class="fa fa-random""></i> <span>Retur Jual</span>
	                </a>
	            </li>
	            -->
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("h", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(dplg))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(pelanggan)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(pelanggan);?>">
	                    <i class="fa fa-tags"></i> <span><u>D</u>aftar Pelanggan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pelangganohc)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=B&menu=".md5(pelangganohc);?>">
	                    <i class="fa fa-credit-card"></i> <span><u>O</u>HC</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pelanggannonohc)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=C&menu=".md5(pelanggannonohc);?>">
	                    <i class="fa fa-bookmark-o"></i> <span><u>N</u>on OHC</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(perbaharuiohc)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=D&menu=".md5(perbaharuiohc);?>">
	                    <i class="fa fa-star"></i> <span><u>P</u>erbarui OHC</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(potensialh2)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=potensialh2&menu=".md5(potensialh2);?>" id="5">
	                    <i class="fa fa-retweet"></i> <span>P<u>e</u>langgan Potensial</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("d", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("e", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(ksr))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="treeview <?if($menu==md5(kwitansi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-file-text"></i> 
	                    <span><u>K</u>witansi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(kwitansi) && $submenu == "A"){echo "active";}?>"><a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(kwitansi);?>"><i class="fa fa-angle-double-right"></i> Servis</a></li>
			            <li class="<?if($menu==md5(kwitansi) && $submenu == "B"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=B&menu=".md5(kwitansi);?>"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
			            <li class="<?if($menu==md5(kwitansi) && $submenu == "C"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=C&menu=".md5(kwitansi);?>"><i class="fa fa-angle-double-right"></i> Indent</a></li>
			            <li class="<?if($menu==md5(kwitansi) && $submenu == "D"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=D&menu=".md5(kwitansi);?>"><i class="fa fa-angle-double-right"></i> <span style="font-size:12.5px">Pembayaran Piutang &</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Potongan Kompensasi</span></a></li>
			            <li class="<?if($menu==md5(kwitansi) && $submenu == "E"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=E&menu=".md5(kwitansi);?>"><i class="fa fa-angle-double-right"></i> Piutang Karyawan</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(kaskecil)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(kaskecil);?>">
	                    <i class="fa fa-book"></i> <span>K<u>a</u>s Kecil</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(aruskas)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(aruskas);?>">
	                    <i class="fa fa-retweet"></i> <span>A<u>r</u>us Kas</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(pndharian)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-file"></i> 
	                    <span><u>P</u>endapatan Harian</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(pndharian) && $submenu == "A"){echo "active";}?>"><a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(pndharian);?>"><i class="fa fa-angle-double-right"></i> Servis</a></li>
			            <li class="<?if($menu==md5(pndharian) && $submenu == "B"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=B&menu=".md5(pndharian);?>"><i class="fa fa-angle-double-right"></i> Penjualan Barang</a></li>
			        </ul>
	            </li>
	            <li class="treeview <?if($menu==md5(laporanws1) || $menu==md5(laporanws2) || $menu==md5(laporanws3) || $menu==md5(laporanws4)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-thumb-tack"></i> 
	                    <span><u>L</u>aporan Penjualan</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Workshop (Non KPB)</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(laporanws4) && $submenu == "A"){echo "active";}?>"><a id="5" href="<? echo "?opt=$opt&submenu=A&menu=".md5(laporanws4);?>"><i class="fa fa-angle-double-right"></i> MPM</a></li>
			            <li class="<?if($menu==md5(laporanws1) && $submenu == "A"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=A&menu=".md5(laporanws1);?>"><i class="fa fa-angle-double-right"></i> SUMA</a></li>
			            <li class="<?if($menu==md5(laporanws3) && $submenu == "A"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=A&menu=".md5(laporanws3);?>"><i class="fa fa-angle-double-right"></i> Gembira Ria</a></li>
			            <li class="<?if($menu==md5(laporanws2) && $submenu == "A"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=A&menu=".md5(laporanws2);?>"><i class="fa fa-angle-double-right"></i> Lainnya</a></li>
			        </ul>
	            </li>
	            <li class="<?if($menu==md5(tutupharian)){echo "active";}?>">
	                <a id="6" href="<? echo "?opt=$opt&submenu=A&menu=".md5(tutupharian);?>">
	                    <i class="fa fa-minus-square"></i> <span><u>T</u>utup Harian</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("t", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(gpdi))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	        	<li class="<?if($menu==md5(konfnotabeli)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(konfnotabeli);?>">
	                    <i class="fa fa-file"></i> <span><u>K</u>onfirmasi Nota Beli</span>
	                </a>
	            </li>
	        	<li class="<?if($menu==md5(konfnotaclaim)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(konfnotaclaim);?>">
	                    <i class="fa fa-file"></i> <span>K<u>o</u>nfirmasi Claim Oli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(konfreturbeli)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(konfreturbeli);?>">
	                    <i class="fa fa-file"></i> <span>Ko<u>n</u>firmasi Retur Beli</span>
	                </a>
	            </li>
				<li class="<?if($menu==md5(stok)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(stok);?>">
	                    <i class="fa fa-search"></i> <span><u>L</u>ihat Stok</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pindahlokasi)){echo "active";}?>">
	                <a id="5" href="<? echo "?opt=$opt&submenu=A&menu=".md5(pindahlokasi);?>">
	                    <i class="fa fa-exchange"></i> <span><u>P</u>indah Lokasi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(penyesuaianstok)){echo "active";}?>">
	                <a id="6" href="<? echo "?opt=$opt&submenu=A&menu=".md5(penyesuaianstok);?>">
	                    <i class="fa fa-wrench"></i> <span><u>S</u>tock Opname</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(stokminimum)){echo "active";}?>">
	                <a id="7" href="<? echo "?opt=$opt&submenu=A&menu=".md5(stokminimum);?>">
	                    <i class="fa fa-minus"></i> <span>Stok <u>M</u>inimum</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("s", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("m", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(adm))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(returbeli)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(returbeli);?>">
	                    <i class="fa fa-undo"></i> <span><u>R</u>etur Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(notaretur)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(notaretur);?>">
	                    <i class="fa fa-share-square-o"></i> <span>Potong Nota Retur Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(bayarkpb)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(bayarkpb);?>">
	                    <i class="fa fa-dollar"></i> <span><u>P</u>enagihan KPB ke MPM</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(kwitansikpb)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(kwitansikpb);?>">
	                    <i class="fa fa-file"></i> <span><u>K</u>witansi Penagihan KPB</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(claimoli)){echo "active";}?>">
	                <a id="5" href="<? echo "?opt=$opt&submenu=A&menu=".md5(claimoli);?>">
	                    <i class="fa fa-circle-o"></i> <span>P<u>e</u>nagihan Oli Ke MPM</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("c", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(pmbl))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(notabeli)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(notabeli);?>">
	                    <i class="fa fa-file-o"></i> <span><u>N</u>ota Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(bayarsup)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(bayarsup);?>">
	                    <i class="fa fa-dollar"></i> <span><u>P</u>embayaran</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(sdm))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(piutang)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(piutang);?>">
	                    <i class="fa fa-exclamation"></i> <span><u>P</u>iutang</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(absensi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-calendar"></i> 
	                    <span><u>A</u>bsensi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(absensi) && $submenu == "sync"){echo "active";}?>"><a id="2" href="<? echo "?opt=$opt&submenu=sync&menu=".md5(absensi);?>"><i class="fa fa-refresh"></i> Synchronize</a></li>
			            <li><hr style="margin:0px"></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_individu"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_individu&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Individu</a></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_rekap"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_rekap&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Rekapitulasi</a></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_dispensasi"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_dispensasi&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Dispensasi</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(potkompensasi)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(potkompensasi);?>">
	                    <i class="fa fa-cut"></i> <span>P<u>o</u>tongan Kompensasi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(uangharian)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(uangharian);?>">
	                    <i class="fa fa-location-arrow"></i> <span><u>U</u>ang Harian</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(uanglembur)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-moon-o"></i> 
	                    <span>Ua<u>n</u>g Lembur</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(uanglembur) && $submenu == "A"){echo "active";}?>"><a id="5" href="<? echo "?opt=$opt&submenu=A&menu=".md5(uanglembur);?>"><i class="fa fa-angle-double-right"></i> Daftar Lembur</a></li>
			            <li class="<?if($menu==md5(uanglembur) && $submenu == "B"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=B&menu=".md5(uanglembur);?>"><i class="fa fa-angle-double-right"></i> Pembayaran</a></li>
			        </ul>
	            </li>
	            <li class="treeview <?if($menu==md5(kompensasi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-archive"></i> 
	                    <span><u>K</u>ompensasi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(kompensasi) && $submenu == "kom_rincian"){echo "active";}?>"><a id="6" href="<? echo "?opt=$opt&submenu=kom_rincian&menu=".md5(kompensasi);?>"><i class="fa fa-angle-double-right"></i> Rincian</a></li>
			            <li class="<?if($menu==md5(kompensasi) && $submenu == "kom_rekap"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=kom_rekap&menu=".md5(kompensasi);?>"><i class="fa fa-angle-double-right"></i> Rekapitulasi</a></li>
			        </ul>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("u", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(abis))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(abis_penjualan)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_penjualan);?>">
	                    <i class="fa fa-paperclip"></i> <span><u>R</u>ingkasan Penjualan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_servis)){echo "active";}?>">
	                <a id="2" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_servis);?>">
	                    <i class="fa fa-paperclip"></i> <span>R<u>i</u>ngkasan Servis</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_motorservis)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_motorservis);?>">
	                    <i class="fa fa-paperclip"></i> <span>Ri<u>n</u>gkasan Motor Servis</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_pembelian)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_pembelian);?>">
	                    <i class="fa fa-paperclip"></i> <span>Rin<u>g</u>kasan Pembelian</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_arusbarang)){echo "active";}?>">
	                <a id="5" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_arusbarang);?>">
	                    <i class="fa fa-paperclip"></i> <span>Ring<u>k</u>asan Arus Barang</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_dkonfirmasi)){echo "active";}?>">
	                <a id="6" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_dkonfirmasi);?>">
	                    <i class="fa fa-file"></i> <span><u>D</u>aftar Konfirmasi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(abis_ikesalahan)){echo "active";}?>">
	                <a id="7" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_ikesalahan);?>">
	                    <i class="fa fa-times"></i> <span>Indik<u>a</u>si Kesalahan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(alert)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(alert);?>" id="8">
	                    <i class="fa fa-bullseye"></i> <span>A<u>l</u>ert</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("i", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("g", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("d", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			  	Mousetrap.bind("l", function() {
				    GoToLocation(document.getElementById("8").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(svc))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(antrianinput)){echo "active";}?>">
	                <a id="1" href="<? echo "?opt=$opt&submenu=A&menu=".md5(antrianinput);?>">
	                    <i class="fa fa-tags"></i> <span><u>I</u>nput Antrian</span>
	                </a>
	            </li>
	            <li>
	                <a id="2" target="_blank" href="antrianshow.php">
	                    <i class="fa fa-desktop"></i> <span><u>A</u>ntrian Berjalan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(servisjr)){echo "active";}?>">
	                <a id="8" href="<? echo "?opt=$opt&submenu=A&menu=".md5(servisjr);?>">
	                    <i class="fa fa-search"></i> <span><u>P</u>eriksa Servis JR</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(notaservice)){echo "active";}?>">
	                <a id="3" href="<? echo "?opt=$opt&submenu=A&menu=".md5(notaservice);?>">
	                    <i class="fa fa-play"></i> <span><u>M</u>emulai Servis</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(notaservice2)){echo "active";}?>">
	                <a id="4" href="<? echo "?opt=$opt&submenu=A&menu=".md5(notaservice2);?>">
	                    <i class="fa fa-wrench"></i> <span>I<u>n</u>put Nota Servis</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(historyservice)){echo "active";}?>">
	                <a id="5" href="<? echo "?opt=$opt&submenu=A&menu=".md5(historyservice);?>">
	                    <i class="fa fa-wrench"></i> <span><u>R</u>iwayat Servis</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(kinerjamekanik)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-gears"></i>
	                    <span><u>K</u>inerja Mekanik</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(kinerjamekanik) && $submenu == "individu"){?>class="active"<?}?>">
			                <a id="6" href="<? echo "?opt=$opt&submenu=individu&menu=".md5(kinerjamekanik);?>">
							<i class="fa fa-angle-double-right"></i> Individu</a></li>
			            <li <?if($menu==md5(kinerjamekanik) && $submenu == "semua"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=semua&menu=".md5(kinerjamekanik);?>">
			                <i class="fa fa-angle-double-right"></i> Semua (Pcs)</a></li>
			            <li <?if($menu==md5(kinerjamekanik) && $submenu == "semuaomset"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=semuaomset&menu=".md5(kinerjamekanik);?>">
			                <i class="fa fa-angle-double-right"></i> Semua (Rp)</a></li>
					</ul>
	            </li>
	            <li class="<?if($menu==md5(tutupservis)){echo "active";}?>">
	                <a id="7" href="<? echo "?opt=$opt&submenu=A&menu=".md5(tutupservis);?>">
	                    <i class="fa fa-check-square-o"></i> <span><u>T</u>utup Servis</span>
	                </a>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("i", function() {
				    GoToLocation(document.getElementById("1").href);
				  	});
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("2").href);
				  	});
			  	Mousetrap.bind("m", function() {
				    GoToLocation(document.getElementById("3").href);
				  	});
			  	Mousetrap.bind("n", function() {
				    GoToLocation(document.getElementById("4").href);
				  	});
			  	Mousetrap.bind("r", function() {
				    GoToLocation(document.getElementById("5").href);
				  	});
			  	Mousetrap.bind("k", function() {
				    GoToLocation(document.getElementById("6").href);
				  	});
			  	Mousetrap.bind("t", function() {
				    GoToLocation(document.getElementById("7").href);
				  	});
			  	Mousetrap.bind("p", function() {
				    GoToLocation(document.getElementById("8").href);
				  	});
			</script>
	<?
			}
				
		else if($opt==md5(bup))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(bup)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(bup);?>">
	                    <i class="fa fa-hdd-o"></i> <span>Backup Database</span>
	                </a>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(del))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(del)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(del);?>">
	                     <i class="fa fa-trash-o"></i> <span>Hapus Database</span>
	                </a>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(profile))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(profile)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(profile);?>">
	                    <i class="fa fa-user"></i> <span>Profile <?//echo $_SESSION[jns]?></span>
	                </a>
	            </li>
	        </ul>
	<?
			}
		}
	?>
	        <div class="user-panel" style="position:absolute;bottom:15px;width:100%;text-align:center;cursor:pointer">
	            <div class="image" style=";">
	                <img src="img/circle.png" class="img-circle"/>
	            </div>
	            <div class="pull-left info" style="width:100%;text-align:center">
	                <?echo $_SESSION['namacabang']?>
	            </div>
	        </div>
		    </section>
		</aside>
