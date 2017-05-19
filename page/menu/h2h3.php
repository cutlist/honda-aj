<?
if($_SESSION['hakakses']=='ALL')
	{
?>
	<aside class="right-side">	    
<?
    	include "include/waktu.php";
?>
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
        <ul class="sidebar-menu">
            <li class="<?if($menu==md5(karyawan)){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(karyawan);?>">
                    <i class="fa fa-users"></i> <span>Karyawan</span>
                </a>
            </li>
            <li class="<?if($menu==md5(user)){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(user);?>">
                    <i class="fa fa-user"></i> <span>User</span>
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
                <?echo $_SESSION['nama']?>
            </div>
        </div>
	    </section>
	</aside>
<?
		}
	else
		{
		if($_SESSION[posisi]=='KEPALA BENGKEL')
			{
			include "posisi/kepalabengkel.php";
			}
			
		else if($_SESSION[posisi]=='COUNTER PART')
			{
			include "posisi/counterpart.php";
			}
			
		else if($_SESSION[posisi]=='SALES ADVISOR')
			{
			include "posisi/sa.php";
			}
			
		else if($_SESSION[posisi]=='KASIR')
			{
			include "posisi/kasir.php";
			}
			
		else if($_SESSION[posisi]=='DIREKSI')
			{
			include "posisi/direksi.php";
			}
		}
?>