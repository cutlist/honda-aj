<?php
error_reporting(0);
require_once ("../include/application_top.php");

$key   = md5($_POST['key']);

if(empty($key))
	{
		echo '<script>alert ("User atau Password Tidak boleh kosong.")</script>';
		print '<meta http-equiv="refresh" content="0;url=../../index.php"/>';
		exit();
	}
else
	{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM temp_tools WHERE id ='$key'"));
		if ($d1[ed]=="1")
			{
			echo '<script>alert ("Kode Aktivasi Sudah Pernah Digunakan.")</script>';
			print '<meta http-equiv="refresh" content="0;url=../../expired.php"/>';
			exit();
			}
		if (empty($d1['id']))
			{
			echo '<script>alert ("Kode Aktivasi Salah.")</script>';
			print '<meta http-equiv="refresh" content="0;url=../../expired.php"/>';
			exit();
			}
		else
			{
			mysql_query("UPDATE temp_tools SET ed='1' WHERE id='$key'");
			$dt  = mysql_fetch_array(mysql_query("SELECT id FROM temp_toolss"));

			if($key == "6e41a62e524f27717a3b2d8226599493"){
				$ed = date('d-m-Y', strtotime('+10 days', strtotime($dt[id])));
				echo "<script>alert ('Aktivasi Berhasil. Masa Aktif Aplikasi SIHONDA Bertambah Sampai Tanggal $ed.')</script>";
				}
			if($key == "842aa9d3d29c15ea34be50f74d8455d1"){
				$ed = date('d-m-Y', strtotime('+20 days', strtotime($dt[id])));
				echo "<script>alert ('Aktivasi Berhasil. Masa Aktif Aplikasi SIHONDA Bertambah Sampai Tanggal $ed.')</script>";
				}
			if($key == "78e2a2222d8e32dc537cbb54de3577c7"){
				$ed = date('d-m-Y', strtotime('+30 days', strtotime($dt[id])));
				echo "<script>alert ('Aktivasi Berhasil. Masa Aktif Aplikasi SIHONDA Bertambah Sampai Tanggal $ed.')</script>";
				}
			if($key == "fc949bfa1ab025827c202d28566a52d2"){
				echo '<script>alert ("Aktivasi Berhasil.\nAplikasi SIHONDA Sudah Teraktivasi Sepenuhnya.")</script>';
				}
			}
			
					
			print '<meta http-equiv="refresh" content="0;url=../../index.php"/>';
	}
?>