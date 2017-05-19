
        <header class="header">
            <a href="?opt=" class="logo">
			<?
			if($_SESSION['jns']=='H2H3' OR $_SESSION['jns']=='H2H3aj')
				{
			?>
            	<img src="../gambar/llogo-whiteh2h3.png" style="height:25px;margin-top:-13px">
			<?	
				}
			else 
				{
			?>
            	<img src="../gambar/llogo-whiteh1.png" style="height:25px;margin-top:-13px">
			<?
				}
			?>
            </a>
            
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-left">
                    <ul class="nav navbar-nav">	
                    <?						
					if($_SESSION['jns']=='H1' OR $_SESSION['jns']=='H1aj')
						{
						if($_SESSION['hakakses']=='ALL')
							{
					?>
	                        <li class="dropdown messages-menu">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                <span style="font-weight:bold">
	                                	<?
	                                	if(empty($opt)){echo "MENU UTAMA";}
	                                	else if($opt==md5(mstr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> MASTER";}
	                                	else if($opt==md5(sms)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> SMS GATEWAY";}
	                                	?> 
	                                	<i class="caret" style="margin:10px 0px 10px 20px;float:right;"></i>
	                                </span>
	                            </a>
	                            <ul class="dropdown-menu">
								    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(mstr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> MASTER<?}else{?><a href="?opt=<?echo md5(mstr)?>"> MASTER</a><?}?></li>
									<li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(sms)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  SMS GATEWAY<?}else{?><a href="?opt=<?echo md5(sms)?>"> SMS GATEWAY</a><?}?></li>
								</ul>
	                        </li>
					<?
							}
							
						else
							{
							if($_SESSION[posisi]=='DIREKSIX')
								{
					?>
		                        <li class="dropdown messages-menu">
		                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                                <span style="font-weight:bold">
		                                	<?
		                                	if(empty($opt)){echo "MENU UTAMA";}
		                                	else if($opt==md5(mstr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> MASTER";}
		                                	else if($opt==md5(pnjl)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PENJUALAN";}
		                                	else if($opt==md5(dplg)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PELANGGAN";}
		                                	else if($opt==md5(ksr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> KASIR";}
		                                	else if($opt==md5(gpdi)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> GUDANG & PDI";}
		                                	else if($opt==md5(adm)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> ADMINISTRASI";}
		                                	else if($opt==md5(pmbl)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PEMBELIAN";}
		                                	else if($opt==md5(sdm)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> SDM";}
		                                	else if($opt==md5(abis)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> AKTIVITAS BISNIS";}
		                                	else if($opt==md5(bup)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> BACKUP";}
		                                	else if($opt==md5(del)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> HAPUS";}
		                                	else if($opt==md5(profile)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PROFILE";}
		                                	?> 
		                                	<i class="caret" style="margin:10px 0px 10px 20px;float:right;"></i>
		                                </span>
		                            </a>
		                            <ul class="dropdown-menu">
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(mstr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> MASTER<?}else{?><a href="?opt=<?echo md5(mstr)?>"> MASTER</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(pnjl)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PENJUALAN<?}else{?><a href="?opt=<?echo md5(pnjl)?>"> PENJUALAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(dplg)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PELANGGAN <?}else{?><a href="?opt=<?echo md5(dplg)?>"> PELANGGAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(ksr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  KASIR<?}else{?><a href="?opt=<?echo md5(ksr)?>"> KASIR</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(gpdi)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  GUDANG & PDI<?}else{?><a href="?opt=<?echo md5(gpdi)?>"> GUDANG & PDI</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(adm)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  ADMINISTRASI<?}else{?><a href="?opt=<?echo md5(adm)?>"> ADMINISTRASI</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(pmbl)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PEMBELIAN<?}else{?><a href="?opt=<?echo md5(pmbl)?>"> PEMBELIAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(sdm)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  SDM<?}else{?><a href="?opt=<?echo md5(sdm)?>"> SDM</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(abis)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  AKTIVITAS BISNIS<?}else{?><a href="?opt=<?echo md5(abis)?>"> AKTIVITAS BISNIS</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(bup)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  BACKUP<?}else{?><a href="?opt=<?echo md5(bup)?>&menu=<?echo md5(bup)?>"> BACKUP</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(del)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  HAPUS<?}else{?><a href="?opt=<?echo md5(del)?>&menu=<?echo md5(del)?>"> HAPUS</a><?}?></li>
		                            </ul>
		                        </li>
					<?
								}
								
							if($_SESSION[posisi]=='PICX')
								{
					?>
		                        <li class="dropdown messages-menu">
		                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                                <span style="font-weight:bold">
		                                	<?
		                                	if(empty($opt)){echo "MENU UTAMA";}
		                                	else if($opt==md5(mstr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> MASTER";}
		                                	else if($opt==md5(pnjl)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PENJUALAN";}
		                                	else if($opt==md5(dplg)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PELANGGAN";}
		                                	else if($opt==md5(ksr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> KASIR";}
		                                	else if($opt==md5(gpdi)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> GUDANG & PDI";}
		                                	else if($opt==md5(adm)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> ADMINISTRASI";}
		                                	else if($opt==md5(pmbl)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PEMBELIAN";}
		                                	else if($opt==md5(sdm)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> SDM";}
		                                	else if($opt==md5(abis)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> AKTIVITAS BISNIS";}
		                                	else if($opt==md5(bup)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> BACKUP";}
		                                	else if($opt==md5(del)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> HAPUS";}
		                                	else if($opt==md5(profile)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PROFILE";}
		                                	?> 
		                                	<i class="caret" style="margin:10px 0px 10px 20px;float:right;"></i>
		                                </span>
		                            </a>
		                            <ul class="dropdown-menu">
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(mstr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> MASTER<?}else{?><a href="?opt=<?echo md5(mstr)?>"> MASTER</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(pnjl)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PENJUALAN<?}else{?><a href="?opt=<?echo md5(pnjl)?>"> PENJUALAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(dplg)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PELANGGAN <?}else{?><a href="?opt=<?echo md5(dplg)?>"> PELANGGAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(ksr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  KASIR<?}else{?><a href="?opt=<?echo md5(ksr)?>"> KASIR</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(gpdi)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  GUDANG & PDI<?}else{?><a href="?opt=<?echo md5(gpdi)?>"> GUDANG & PDI</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(adm)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  ADMINISTRASI<?}else{?><a href="?opt=<?echo md5(adm)?>"> ADMINISTRASI</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(pmbl)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PEMBELIAN<?}else{?><a href="?opt=<?echo md5(pmbl)?>"> PEMBELIAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(sdm)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  SDM<?}else{?><a href="?opt=<?echo md5(sdm)?>"> SDM</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(abis)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  AKTIVITAS BISNIS<?}else{?><a href="?opt=<?echo md5(abis)?>"> AKTIVITAS BISNIS</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(bup)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  BACKUP<?}else{?><a href="?opt=<?echo md5(bup)?>&menu=<?echo md5(bup)?>"> BACKUP</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(del)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  HAPUS<?}else{?><a href="?opt=<?echo md5(del)?>&menu=<?echo md5(del)?>"> HAPUS</a><?}?></li>
		                            </ul>
		                        </li>
					<?
								}
								
							}
						}
						
					else if($_SESSION['jns']=='H2H3' OR $_SESSION['jns']=='H2H3aj')
						{
						if($_SESSION['hakakses']=='ALL')
							{
					?>
	                        <li class="dropdown messages-menu">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                <span style="font-weight:bold">
	                                	<?
	                                	if(empty($opt)){echo "MENU UTAMA";}
	                                	else if($opt==md5(mstr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> MASTER";}
	                                	?> 
	                                	<i class="caret" style="margin:10px 0px 10px 20px;float:right;"></i>
	                                </span>
	                            </a>
	                            <ul class="dropdown-menu">
								    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(mstr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> MASTER<?}else{?><a href="?opt=<?echo md5(mstr)?>"> MASTER</a><?}?></li>
								</ul>
	                        </li>
					<?
							}
							
						else
							{
							if($_SESSION[posisi]=='DIREKSIX')
								{
					?>
		                        <li class="dropdown messages-menu">
		                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                                <span style="font-weight:bold">
		                                	<?
		                                	if(empty($opt)){echo "MENU UTAMA";}
		                                	else if($opt==md5(mstr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> MASTER";}
		                                	else if($opt==md5(pnjl)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PENJUALAN";}
		                                	else if($opt==md5(svc)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> SERVIS";}
		                                	else if($opt==md5(dplg)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PELANGGAN";}
		                                	else if($opt==md5(ksr)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> KASIR";}
		                                	else if($opt==md5(gpdi)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> GUDANG SPARE PART";}
		                                	else if($opt==md5(adm)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> ADMINISTRASI";}
		                                	else if($opt==md5(pmbl)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PEMBELIAN";}
		                                	else if($opt==md5(sdm)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> SDM";}
		                                	else if($opt==md5(abis)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> AKTIVITAS BISNIS";}
		                                	else if($opt==md5(bup)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> BACKUP";}
		                                	else if($opt==md5(del)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> HAPUS";}
		                                	else if($opt==md5(profile)){echo "MENU UTAMA <i class='fa fa-angle-double-right'></i> PROFILE";}
		                                	?> 
		                                	<i class="caret" style="margin:10px 0px 10px 20px;float:right;"></i>
		                                </span>
		                            </a>
		                            <ul class="dropdown-menu">
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(mstr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> MASTER<?}else{?><a href="?opt=<?echo md5(mstr)?>"> MASTER</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(pnjl)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PENJUALAN<?}else{?><a href="?opt=<?echo md5(pnjl)?>"> PENJUALAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(svc)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  SERVIS<?}else{?><a href="?opt=<?echo md5(svc)?>"> SERVIS</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(dplg)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PELANGGAN <?}else{?><a href="?opt=<?echo md5(dplg)?>"> PELANGGAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(ksr)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  KASIR<?}else{?><a href="?opt=<?echo md5(ksr)?>"> KASIR</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(gpdi)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  GUDANG SPARE PART<?}else{?><a href="?opt=<?echo md5(gpdi)?>"> GUDANG SPARE PART</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(adm)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  ADMINISTRASI<?}else{?><a href="?opt=<?echo md5(adm)?>"> ADMINISTRASI</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(pmbl)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  PEMBELIAN<?}else{?><a href="?opt=<?echo md5(pmbl)?>"> PEMBELIAN</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(sdm)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-left"></i>  SDM<?}else{?><a href="?opt=<?echo md5(sdm)?>"> SDM</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(abis)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  AKTIVITAS BISNIS<?}else{?><a href="?opt=<?echo md5(abis)?>"> AKTIVITAS BISNIS</a><?}?></li>
									    <li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(del)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  HAPUS<?}else{?><a href="?opt=<?echo md5(del)?>&menu=<?echo md5(del)?>"> HAPUS</a><?}?></li>
		                            	<li style="font-weight:bold;padding-left:5%" class="header"><?if($opt==md5(bup)){?> &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>  BACKUP<?}else{?><a href="?opt=<?echo md5(bup)?>"> BACKUP</a><?}?></li>
		                            </ul>
		                        </li>
					<?
								}
							}
						}
					?>
                    </ul>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">							
                   		<li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?echo $_SESSION['nama']?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="img/circle-o.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?echo $_SESSION['nama']?></br>
                                        <span style="font-size:13px"><?echo $_SESSION['posisi']?></span>
                                    </p>
                                        
                                        <small>Last login <?echo $_SESSION['lastlogin']?></small>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<? echo "?opt=".md5(profile)."&submenu=A&menu=".md5(profile);?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="module/logout.php" class="btn btn-default btn-flat" onclick="return confirm('Anda yakin akan keluar dari sistem?')">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>