
		<aside class="right-side">
		    <ol class="breadcrumb">
			    <?if($opt==md5(pnjl)){?><li style="font-weight:bold"> PENJUALAN</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(pnjl)?>"> PENJUALAN</a></li><?}?>
			    <?if($opt==md5(svc)){?><li style="font-weight:bold"> SERVIS</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(svc)?>"> SERVIS</a></li><?}?>
			    <?if($opt==md5(gpdi)){?><li style="font-weight:bold"> GUDANG SPARE PART</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(gpdi)?>"> GUDANG SPARE PART</a></li><?}?>
			    <?if($opt==md5(adm)){?><li style="font-weight:bold">ADMINISTRASI</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(adm)?>">ADMINISTRASI</a></li><?}?>
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