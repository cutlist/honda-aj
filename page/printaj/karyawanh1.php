<style>
@media print {
html, body {
    width: 8.27in; /* was 9.5in */
    height: 9.5in; /* was 8.27in */
    display: block;
    letter-spacing: 4px;
    font-size: 16px;
    /*font-size: auto; NOT A VALID PROPERTY */
}

@page {
    size: 8.27in 9.5in /* . Random dot? */;
}
}
</style>
<script>
setTimeout("window.close();", 1);
window.print();
</script>
<body style="font-family:Century Gothic">
<?
error_reporting(0);
include "../include/application_top.php";
include "../include/function.php";
$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
	<div style="width:1150px">
	<h2 style="text-align: center;margin-top:50px">DETAIL KARYAWAN <?echo $d1[nama]?></br>CV ANUGRAH JAYA</h2>
    	<div style="width:60%;padding:50px;float:left;margin-left:50px">
        	<table style="width: 100%">
        		<tr>
        			<td width="40%">NAMA KARYAWAN</td>
        			<td width="2%">:</td>
        			<td colspan="2"><?echo $d1[nama]?></td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>NIK</td>
        			<td>:</td>
        			<td colspan="2"><?echo $d1[nik]?></td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>POSISI</td>
        			<td>:</td>
        			<td colspan="2"><?echo $d1[posisi]?></td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>TEMPAT LAHIR</td>
        			<td>:</td>
        			<td colspan="2"><?echo $d1[tmplahir]?></td>
				</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>TGL LAHIR</td>
        			<td>:</td>
        			<td colspan="2"><?echo date("d-m-Y",strtotime($d1[tgllahir]))?></td>
				</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>NO. KTP/NO. IDENTITAS</td>
        			<td>:</td>
        			<td><?echo $d1[noktp]?></td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>NOMOR TELEPON</td>
        			<td>:</td>
        			<td><?echo "'".$d1[notelepon]?></td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td valign="top" >ALAMAT</td>
        			<td valign="top" >:</td>
        			<td valign="top" colspan="2"><?echo $d1[alamat]?></td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>TGL MULAI KERJA</td>
        			<td>:</td>
        			<td colspan="2"><?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?></td>
				</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>GAJI POKOK</td>
        			<td>:</td>
        			<td colspan="">Rp <?echo number_format($d1[ugapok],"0","",".")?> Per Bulan</td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>UANG HARIAN</td>
        			<td>:</td>
        			<td colspan="">Rp <?echo number_format($d1[uharian],"0","",".")?> Per Hari</td>
        		</tr>
        		<tr><td></br></td></tr>
        		<tr>
        			<td>UANG LEMBUR</td>
        			<td>:</td>
        			<td colspan="">Rp <?echo number_format($d1[ulembur],"0","",".")?> Per Kali</td>
        		</tr>
        	</table>
        </div>
        <?
        if(!empty($d1[photo]))
        	{
		?>
        	<div style="padding:20px;text-align: center;float: right;width:20%;margin-right:20px"">
        		<div style="padding:20px;width:80%;padding-top:30px">
            		<b>PHOTO KARYAWAN</b></br></br>
            		<img src="../../foto/H1/H1_<?echo $d1[photo]?>" width="120px"/>
        		</div>
        	</div>
		<?
			}
        ?>
	</div>
</body>