<?php
error_reporting(0);
require_once ("../include/application_top.php");

$user 	= $_POST['user'];
$pass   = md5($_POST['pass']);
//echo $pass;

$dt  = mysql_fetch_array(mysql_query("SELECT id FROM temp_toolss"));
$isas  = mysql_fetch_array(mysql_query("SELECT ed FROM temp_tools WHERE id='fc949bfa1ab025827c202d28566a52d2'"));
if($isas[ed]=='0'){
	$isas1 = mysql_fetch_array(mysql_query("SELECT ed FROM temp_tools WHERE id='6e41a62e524f27717a3b2d8226599493'"));
	if($isas1[ed]=='0'){
		$ed = $dt[id];	
		}
	if($isas1[ed]=='1'){
		$isas2 = mysql_fetch_array(mysql_query("SELECT ed FROM temp_tools WHERE id='842aa9d3d29c15ea34be50f74d8455d1'"));
		if($isas2[ed]=='0'){
			$ed = date('Y-m-d', strtotime('+10 days', strtotime($dt[id])));
			}
		if($isas2[ed]=='1'){
			$isas3 = mysql_fetch_array(mysql_query("SELECT ed FROM temp_tools WHERE id='78e2a2222d8e32dc537cbb54de3577c7'"));
			if($isas2[ed]=='0'){
				$ed = date('Y-m-d', strtotime('+20 days', strtotime($dt[id])));
				}
			if($isas3[ed]=='1'){
				$ed = date('Y-m-d', strtotime('+30 days', strtotime($dt[id])));
				}
			}
		}

	if(date("Y-m-d")>="$ed"){
		print '<meta http-equiv="refresh" content="0;url=../../expired.php"/>';
		exit();
		}
		//echo "<script>alert ('$ed')</script>";
		//exit();
	}

if(empty($user) || empty($pass))
	{
		echo '<script>alert ("User atau Password Tidak boleh kosong.")</script>';
		print '<meta http-equiv="refresh" content="0;url=../../index.php"/>';
		exit();
	}
else
	{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE user ='$user'"));
		if ($d1[status]=="TIDAK AKTIF")
			{
			echo '<script>alert ("User Sudah Tidak Aktif Lagi.")</script>';
			print '<meta http-equiv="refresh" content="0;url=../../index.php"/>';
			exit();
			}
				
		if (empty($d1['user']))
			{
			echo '<script>alert ("User belum terdaftar.")</script>';
			print '<meta http-equiv="refresh" content="0;url=../../index.php"/>';
			exit();
			}
		else
			{
			if($d1['pass'] != $pass)
				{
				echo '<script>alert ("Password salah.")</script>';
				print '<meta http-equiv="refresh" content="0;url=../../index.php"/>';
				exit();	
				}
			else
				{
				$_SESSION['user'] = strtoupper($user);
				$_SESSION['nama'] = $d1['nama'];
				$_SESSION['posisi'] = $d1['posisi'];
				$_SESSION['id']   = $d1['id'];
				
				$dP = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
				$_SESSION['namaperusahaan'] 	= $dP['perusahaan'];
				$_SESSION['alamatperusahaan']   = $dP['alamatperusahaan'];
				$_SESSION['kodedealer']   = $dP['kodedealer'];
				$_SESSION['namacabang']   = $dP['namacabang'];
				
				$_SESSION['hakakses'] = $d1['hakakses'];
				if(substr($_SESSION['user'],-3,3)=="-AJ"){
					$_SESSION['jns'] = 'H1aj';
					}
				else{
					$_SESSION['jns'] = 'H1';
					}
				}
			}
			
		   	$nohp = "085768933371";
		   	$sms = date("d-m-Y H:i:s")." $_SESSION[user] $ip $hostname";
   			//passthru('gammu-smsd-inject -c smsdrc TEXT '.$nohp.' -text "'.$sms.'"');
   			//atau
   			mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', '$sms', 'sigerit.com')");
   
		mysql_query("INSERT INTO log (user,login,ip,hostname) VALUES ('$_SESSION[user]',NOW(),'$ip','$hostname')");
		
		$d2 = mysql_fetch_array(mysql_query("SELECT login FROM log WHERE user='$_SESSION[user]' ORDER BY login DESC LIMIT 1, 1"));
		$_SESSION['lastlogin'] = $d2['login'];
		
		header("location: ../?opt=");
	}
?>