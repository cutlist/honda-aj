		<aside class="right-side">
		    <ol class="breadcrumb">
			    <?if($opt==md5(gpdi)){?><li style="font-weight:bold"> GUDANG & PDI</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(gpdi)?>"> GUDANG & PDI</a></li><?}?>
			    <?if($opt==md5(sdm)){?><li style="font-weight:bold"> SDM</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(sdm)?>"> SDM</a></li><?}?>
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
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pengeluaranunit);?>">
	                    <i class="fa fa-truck"></i> <span>Pengeluaran Unit</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(returbeli)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(returbeli);?>">
	                    <i class="fa fa-undo"></i> <span>Retur Beli</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(stnkbpkb)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(stnkbpkb);?>">
	                    <i class="fa fa-files-o"></i> <span>STNK & BPKB</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(konfsuratjalan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(konfsuratjalan);?>">
	                    <i class="fa fa-clipboard"></i> <span>Konfirmasi Surat Jalan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pembayaranleasing)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pembayaranleasing);?>">
	                    <i class="fa fa-dollar"></i> <span>Pembayaran Leasing</span>
	                </a>
	            </li>
	        </ul>
	<?
			}
				
		else if($opt==md5(sdm))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
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