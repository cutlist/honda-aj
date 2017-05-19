		<aside class="right-side">
		    <ol class="breadcrumb">
			    <?if($opt==md5(adm)){?><li style="font-weight:bold"> ADMINISTRASI</li>
			    <?}else{?> <li><a href="?opt=<?echo md5(adm)?>"> ADMINISTRASI</a></li><?}?>
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
	        	<li class="<?if($menu==md5(konfsuratjalan)){echo "active";}?>">
	                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(konfsuratjalan);?>">
	                    <i class="fa fa-clipboard"></i> <span>Konfirmasi Surat Jalan</span>
	                </a>
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