
		<aside class="right-side">
		    <ol class="breadcrumb">
			    <?if($opt==md5(pnjl)){?><li style="font-weight:bold"> PENJUALAN</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(pnjl)?>"> PENJUALAN</a></li><?}?>
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
				
		else if($opt==md5(pnjl))
			{
	?>
	        <ul class="sidebar-menu" style="overflow-y:auto;overflow-x:hidden;height:500px;">
	            <li class="<?if($menu==md5(stok)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(stok);?>">
	                    <i class="fa fa-search"></i> <span>Lihat Stok</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(unitindent)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(unitindent);?>">
	                    <i class="fa fa-lock"></i> <span>Unit Indent</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pemesanan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pemesanan);?>">
	                    <i class="ion ion-bag"></i> <span>Pemesanan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(indent)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(indent);?>">
	                    <i class="fa fa-book"></i> <span>Indent</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(notajual)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(notajual);?>">
	                    <i class="ion ion-ios7-cart-outline""></i> <span>Penjualan</span>
	                </a>
	            </li>
	            <li class="<?if($menu==md5(pesannopol)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(pesannopol);?>">
	                    <i class="fa fa-bookmark"></i> <span>Pemesanan NOPOL</span>
	                </a>
	            </li>
	            <li class="treeview <?if($menu==md5(kinerjasales)){echo "active";}?>">
	                <a href="#">
	                    <i class="fa fa-gears"></i>
	                    <span>Kinerja Sales</span>
	                    <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
			            <li <?if($menu==md5(kinerjasales) && $submenu == "individu"){?>class="active"<?}?>">
			                <a href="<? echo "?opt=$opt&submenu=individu&menu=".md5(kinerjasales);?>">
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
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(cashtempo);?>">
	                    <i class="fa fa-bell"></i> <span>Cash Tempo Dealer</span>
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