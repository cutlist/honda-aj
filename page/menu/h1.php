<?
if($_SESSION['hakakses']=='ALL')
	{
?>
	<aside class="right-side">	    
<?
    	//include "include/waktu.php";
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
            		<h4 style="margin-top:10px;margin-bottom:0px">Selamat Datang Administrator <?$Administrator = "ARIEF PRADIPTA (isas) | sigerit.com"?></h4></br>
            		<h5>Ini Adalah Halaman Khusus Administrator Untuk Membuat Karyawan & User Pertama Kali, Serta Pengaturan SMS Gatway</h5>
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
			
	else if($opt==md5(sms))
		{
?>
        <ul class="sidebar-menu">
            <li class="<?if($submenu=="A"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=A&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Setting Config Modem</span>
                </a>
            </li>
            <li class="<?if($submenu=="B"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=B&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Test Koneksi Modem</span>
                </a>
            </li>
            <li class="<?if($submenu=="C"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=C&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Setting SMS Gateway</span>
                </a>
            </li>
            <li class="<?if($submenu=="D"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=D&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Buat Service</span>
                </a>
            </li>
            <li class="<?if($submenu=="E"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=E&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Jalankan Service</span>
                </a>
            </li>
            <li class="<?if($submenu=="F"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=F&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Kirim SMS</span>
                </a>
            </li>
            <li class="<?if($submenu=="G"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=G&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Terima SMS</span>
                </a>
            </li>
            <li class="<?if($submenu=="H"){echo "active";}?>">
                <a href="<? echo "?opt=$opt&submenu=H&menu=".md5(smsgateway);?>">
                    <i class="fa fa-star"></i> <span>Hentikan Service</span>
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
		if($_SESSION[posisi]=='ADMINISTRASI')
			{
			include "posisi/administrasi.php";
			}
			
		else if($_SESSION[posisi]=='SALES COUNTER')
			{
			include "posisi/scounter.php";
			}
			
		else if($_SESSION[posisi]=='GUDANG & PDI')
			{
			include "posisi/gpdi.php";
			}
			
		else if($_SESSION[posisi]=='KASIR')
			{
			include "posisi/kasir.php";
			}
			
		else if($_SESSION[posisi]=='SALES')
			{
			include "posisi/sales.php";
			}
			
		else if($_SESSION[posisi]=='DRIVER')
			{
			include "posisi/driver.php";
			}
			
		else if($_SESSION[posisi]=='DIREKSI')
			{
			include "posisi/direksi.php";
			}
			
		else if($_SESSION[posisi]=='PIC')
			{
			include "posisi/pic.php";
			}
		}
?>