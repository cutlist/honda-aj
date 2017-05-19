	
		<aside class="right-side">
		    <ol class="breadcrumb">
			    <?if($opt==md5(ksr)){?><li style="font-weight:bold"> KASIR</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(ksr)?>"> KASIR</a></li><?}?>
			    <?if($opt==md5(sdm)){?><li style="font-weight:bold"> SDM</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(sdm)?>"> SDM</a></li><?}?>
		    </ol>
		</aside>

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
				
		else if($opt==md5(ksr))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(kwitansi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(kwitansi);?>">
	                    <i class="fa fa-file-text"></i> <span>Kwitansi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(ujual)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(ujual);?>">
	                    <i class="ion ion-ios7-cart-outline"></i> <span>Update Penjualan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(kaskecil)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(kaskecil);?>">
	                    <i class="fa fa-book"></i> <span>Kas Kecil</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(aruskas)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(aruskas);?>">
	                    <i class="fa fa-retweet"></i> <span>Arus Kas</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(kasbon)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(kasbon);?>">
	                    <i class="fa fa-money"></i> <span>Cash Bon</span>
	                </a>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(sdm))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(piutang)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(piutang);?>">
	                    <i class="fa fa-exclamation"></i> <span>Piutang</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(absensi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-calendar"></i> 
	                    <span>Absensi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(absensi) && $submenu == "sync"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=sync&menu=".md5(absensi);?>"><i class="fa fa-refresh"></i> Synchronize</a></li>
			            <li><hr style="margin:0px"></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_individu"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_individu&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Individu</a></li>
			            <li class="<?if($menu==md5(absensi) && $submenu == "abs_rekap"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=abs_rekap&menu=".md5(absensi);?>"><i class="fa fa-angle-double-right"></i> Rekapitulasi</a></li>
			        </ul>
	            </li>
	            <li class="<?if($menu==md5(potkompensasi)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(potkompensasi);?>">
	                    <i class="fa fa-cut"></i> <span>Potongan Kompensasi</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(uangharian)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=B&menu=".md5(uangharian);?>">
	                    <i class="fa fa-location-arrow"></i> <span>Uang Harian</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(uanglembur)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=B&menu=".md5(uanglembur);?>">
	                    <i class="fa fa-moon-o"></i> <span>Pembayaran Lembur</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(kompensasi)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-archive"></i> 
	                    <span>Kompensasi</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li class="<?if($menu==md5(kompensasi) && $submenu == "kom_rincian"){echo "active";}?>"><a href="<? echo "?opt=$opt&submenu=kom_rincian&menu=".md5(kompensasi);?>"><i class="fa fa-angle-double-right"></i> Rincian</a></li>
			        </ul>
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
						
                		$dTarget = mysql_fetch_array(mysql_query("SELECT target FROM tbl_target WHERE bulan='$bulan' AND tahun='$tahun'"));
                		$dReal = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE bulan='$bulan' AND tahun='$tahun'"));
	            		?>
	            		<p><b><?echo "$dPeriode[namabln] $tahun"?></b></p>
	            	</div>
	            </li>
	        </ul>
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
		}
	?>
	        <div class="user-panel" style="position:absolute;bottom:10px;width:100%;text-align:center;cursor:pointer">
	            <div class="image" style=";">
	                <img src="img/circle.png" class="img-circle"/>
	            </div>
	            <div class="pull-left info" style="width:100%;text-align:center">
	                <?echo $_SESSION['namacabang']?>
	            </div>
	        </div>
		    </section>
		</aside>