		<aside class="right-side">
		    <ol class="breadcrumb">
			    <?if($opt==md5(adm)){?><li style="font-weight:bold"> ADMINISTRASI</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(adm)?>"> ADMINISTRASI</a></li><?}?>
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