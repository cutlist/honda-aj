    <!-- mousetrap -->
    <script src="js/mousetrap.js" type="text/javascript"></script> 
        
	    	<aside class="right-side">
			    <ol class="breadcrumb" style="width: 200%">
				    <?if($opt==md5(pnjl)){?><li style="font-weight:bold">PENJUALAN</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(pnjl)?>">PENJUALAN</a></li><?}?>
				    <?if($opt==md5(svc)){?><li style="font-weight:bold">SERVIS</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(svc)?>">SERVIS</a></li><?}?>
				    <?if($opt==md5(sdm)){?><li style="font-weight:bold">SDM</li>
				    <?}else{?> <li><a href="?opt=<?echo md5(sdm)?>">SDM</a></li><?}?>
			    </ol>
			</aside>
		<aside class="left-side sidebar-offcanvas">
		    <section class="sidebar">
	<?
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
	                    <i class="fa fa-minus"></i> <span>St<u>o</u>k Minimum</span>
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
			  	Mousetrap.bind("o", function() {
				    GoToLocation(document.getElementById("67").href);
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
	            <li class="treeview <?if($menu==md5(absensi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-calendar"></i> 
	                    <span><u>A</u>bsensi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_individu"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_individu&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Individu</a></li>
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
			        </ul>
	            </li>
	        </ul>
			<script>
			function GoToLocation(url){
			    window.location = url;
			  		}
			  	Mousetrap.bind("a", function() {
				    GoToLocation(document.getElementById("2").href);
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
	            <li class="<?if($menu==md5(abis_dkonfirmasi)){echo "active";}?>">
	                <a id="6" href="<? echo "?opt=$opt&submenu=A&menu=".md5(abis_dkonfirmasi);?>">
	                    <i class="fa fa-file"></i> <span><u>D</u>aftar Konfirmasi</span>
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
