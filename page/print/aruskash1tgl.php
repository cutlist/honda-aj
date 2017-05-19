<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";

$pecah = explode(" s.d. ", $_REQUEST[periode]);
$periode_awal  = date("Y-m-d",strtotime($pecah[0]));
$periode_akhir = date("Y-m-d",strtotime($pecah[1]));

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "ARUSKAS-$periode_awal/$periode_akhir.xls";
header("Content-Disposition: attachment; filename=$judul");
    		
    $dA1  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bayarsup_history WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir'"));
    $dA2  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='OUTPUT'"));
    $dA2B  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='INPUT'"));
    $dA3  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='piutang' AND status='1'"));
    $dA4C = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('titip','lunas')"));
    $dA4K = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('umuka')"));
    $dA5A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'"));
    $dA5B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='pembayaran' AND metodebayar='GAJI' AND status='1' AND potkompensasi='1'"));
    $dA6  = mysql_fetch_array(mysql_query("SELECT SUM(komisi) AS total FROM tbl_notajual_det WHERE tglbayarkomisi BETWEEN '$periode_awal' AND '$periode_akhir' AND statuskomisi='1'"));
    $dA7  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND jnskwitansi IN ('pengembalian')"));
    $dA8  = mysql_fetch_array(mysql_query("SELECT SUM(totuharian) AS total FROM tbl_uangharian WHERE tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1'"));
    $dA9  = mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS total FROM tbl_uanglembur WHERE tglbayar BETWEEN '$periode_awal' AND '$periode_akhir'"));
    $dA10A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_potkompensasi WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'"));
    $dA10B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_potkompensasi WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND metodebayar='TUNAI' AND status='1'"));
    $dA11 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM tbl_kompensasi WHERE tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1'"));
	$dA12 = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM tbl_opname WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1'"));
		                        	
    $dXotr  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarotr) AS total FROM tbl_notajual_det_vw WHERE tglotr BETWEEN '$periode_awal' AND '$periode_akhir' AND statusotr='1'"));
    $dXgross  	= mysql_fetch_array(mysql_query("SELECT SUM(bayargross) AS total FROM tbl_notajual_det_vw WHERE tglgross BETWEEN '$periode_awal' AND '$periode_akhir' AND statusgross='1'"));
    $dXsubsidi  = mysql_fetch_array(mysql_query("SELECT SUM(bayarsubsidi) AS total FROM tbl_notajual_det_vw WHERE tglsubsidi BETWEEN '$periode_awal' AND '$periode_akhir' AND statussubsidi='1'"));
    $dXmatrix  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarmatrix) AS total FROM tbl_notajual_det_vw WHERE tglmatrix BETWEEN '$periode_awal' AND '$periode_akhir' AND statusmatrix='1'"));
    $dXscpahm  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarscpahm) AS total FROM tbl_notajual_det_vw WHERE tglscpahm BETWEEN '$periode_awal' AND '$periode_akhir' AND statusscpahm='1'"));
    $dXscpmd  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarscpmd) AS total FROM tbl_notajual_det_vw WHERE tglscpmd BETWEEN '$periode_awal' AND '$periode_akhir' AND statusscpmd='1'"));

    $out = $dA1[total]+$dA2[total]+$dA3[total]+$dA7[total]+$dA8[total]+$dA9[total]+$dA6[total]+$dA11[total]+$dA12[total];
    $in  = $dA4C[total]+$dA4K[total]+$dA5A[total]+$dA5B[total]+$dXotr[total]+$dXgross[total]+$dXsubsidi[total]+$dXmatrix[total]+$dXscpahm[total]+$dXscpmd[total]+$dA10A[total]+$dA10B[total]+$dA2B[total];
    $re  = $in-$out;
    
    if($re < 0){
    	$ketre = "RUGI KOTOR";
    	$totre = -1*$re;
		}
    else if($re > 0){
    	$ketre = "LABA KOTOR";
    	$totre = $re;
		}
    else {
    	$ketre = "RESULT";
    	$totre = 0;
		}
?>
	<h4>LAPORAN ARUS KAS PERIODE <?echo $periode_awal?> SAMPAI DENGAN <?echo $periode_akhir?></h4>
    <table style='width:100%'>
        <thead>
            <tr>
                <th style="height:45px;background:#37A58A;color:#fff;width:10%">TANGGAL</th>
                <th style="height:45px;background:#37A58A;color:#fff;width:60%">KETERANGAN</th>
                <th style="height:45px;background:#37A58A;color:#fff;width:15%">DEBET</th>
                <th style="height:45px;background:#37A58A;color:#fff;width:15%">KREDIT</th>
            </tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size:12px;">
			<?
			if($dA1['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN BELI UNIT ######################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN BELI UNIT</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT tanggal,jumlah,nonota FROM tbl_bayarsup_history WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir'");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td>PEMBAYARAN KE SUPPLIER NOTA BELI <?echo $d1['nonota']?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA7['total']!=0)
				{
			?>
        <!-- ############################ PENGEMBALIAN UANG MUKA/TITIPAN ######################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#fb4343;color:#fff"><b style="padding:20px">PENGEMBALIAN UANG MUKA/TITIPAN</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND jnskwitansi IN ('pengembalian')");
                while($d1 = mysql_fetch_array($q1))
                	{
                	//$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td>PENGEMBALIAN NOTA PESAN <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA2['total']!=0)
				{
			?>
        <!-- ############################ PENGELUARAN KAS KECIL ######################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#f25252;color:#fff"><b style="padding:20px">PENGELUARAN KAS KECIL</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_kaskecil WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='OUTPUT'");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td><?echo $d1['keterangan']?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA3['total']!=0)
				{
			?>
        <!-- ############################ PIUTANG KARYAWAN ################################################################################ -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#f26262;color:#fff"><b style="padding:20px">PIUTANG KARYAWAN</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='piutang' AND status='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
                        <td><?echo $d1['nama']?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA8['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN UANG HARIAN ################################################################################ -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#f26262;color:#fff"><b style="padding:20px">PEMBAYARAN UANG HARIAN</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_uangharian WHERE tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND totuharian!=0 ORDER BY updatex");
                while($d1 = mysql_fetch_array($q1))
                	{
            ?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
                        <td><?echo "$d1[nama] ".date("d-m-Y",strtotime($d1['dari']))." s/d ".date("d-m-Y",strtotime($d1['sampai']))?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totuharian'],0,",",".")?></span></td>
                    </tr>
            <?
            		/*
					$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_potkompensasi WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND tgl <= '$d1[tglbayar]' AND status='1' AND idkaryawan='$d1[idkaryawan]' AND metodebayar='UANG HARIAN'"));
					if(!empty($d2[id]))
						{
			?>
                        <tr style="cursor:pointer">
                            <td align="center"><?echo date("d-m-Y",strtotime($d2['tgl']))?></td>
                            <td style="padding-left:2%"><?echo "POTONGAN KOMPENSASI $d2[nama] $d2[ket]"?></td>
                            <td align="right"><span style="padding-right:20%"><?echo number_format($d2['jumlah'],0,",",".")?></span></td>
                    		<td align="center">-</td>
                        </tr>
			<?
						}
						
					$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND tgl <= '$d1[tglbayar]' AND status='1' AND idkaryawan='$d1[idkaryawan]' AND jenis='pembayaran' AND metodebayar='UANG HARIAN'"));
					if(!empty($d3[id]))
						{
			?>
                        <tr style="cursor:pointer">
                            <td align="center"><?echo date("d-m-Y",strtotime($d3['tgl']))?></td>
                            <td style="padding-left:2%"><?echo "POTONGAN PIUTANG $d3[nama] $d3[ket]"?></td>
                            <td align="right"><span style="padding-right:20%"><?echo number_format($d3['jumlah'],0,",",".")?></span></td>
                    		<td align="center">-</td>
                        </tr>
			<?
						}
					*/
                	}
				}
				
			if($dA9['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN UANG LEMBUR ################################################################################ -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#f26262;color:#fff"><b style="padding:20px">PEMBAYARAN UANG LEMBUR</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_uanglembur WHERE tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY updatex");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
                        <td><?echo "$d1[nama] TANGGAL ".date("d-m-Y",strtotime($d1['tanggal']))?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['ulembur'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA11['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN KOMPENSASI / GAJI ################################################################################ -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#f26262;color:#fff"><b style="padding:20px">PEMBAYARAN KOMPENSASI / GAJI</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_kompensasi WHERE tglbayar BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' ORDER BY updatex");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
                        <td><?echo "$d1[nama] PERIODE $d1[bulan] $d1[tahun]"?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],0,",",".")?></span></td>
                    </tr>
            <?
            	/*
					$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_potkompensasi WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND idkaryawan='$d1[idkaryawan]' AND metodebayar='GAJI'"));
					if(!empty($d2[id]))
						{
			?>
                        <tr style="cursor:pointer">
                            <td align="center"><?echo date("d-m-Y",strtotime($d2['tgl']))?></td>
                            <td style="padding-left:2%"><?echo "POTONGAN KOMPENSASI $d2[nama] $d2[ket]"?></td>
                            <td align="right"><span style="padding-right:20%"><?echo number_format($d2['jumlah'],0,",",".")?></span></td>
                    		<td align="center">-</td>
                        </tr>
			<?
						}
				*/
                	}
				}
			
			if($dA12['total']!=0)
				{
			?>
        <!-- ############################ SELISIH STOCK OPNAME ################################################################################ -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#f26262;color:#fff"><b style="padding:20px">KERUGIAN SELISIH DARI STOCK OPNAME</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_opname_vw WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' ORDER BY inputx");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d2 = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$d1[idgudang]'"));
                	if(!empty($d2[gudang])){
						$gudang = $d2[gudang];
						}
					else{
						$gudang = "SEMUA GUDANG";
						}
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td><?echo "SELISIH $d1[sisa] PCS PADA STOCK OPNAME $gudang"?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totjumselisih'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA6['total']!=0)
				{
			?>
        <!-- ############################ CASH BON ####################################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#ef8585;color:#fff"><b style="padding:20px">CASH BON</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE tglbayarkomisi BETWEEN '$periode_awal' AND '$periode_akhir' AND statuskomisi='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayarkomisi']))?></td>
                        <td>PEMBAYARAN BROKER <?echo $d1['ref']?> UNTUK NOTA JUAL <?echo $d1['nonota']?></td>
                		<td align="center">-</td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['komisi'],0,",",".")?></span></td>
                    </tr>
            <?
                	}
				}
				
			if($dA4K['total']!=0)
				{
			?>
        <!-- ############################ PENJUALAN KREDIT ####################################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PENJUALAN KREDIT / CASH TEMPO LEASING</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('umuka')");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td>UANG MUKA NOTA PESAN <?echo "$d2[nopesan]"?> A.N. <?echo "$d3[nama]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglotr BETWEEN '$periode_awal' AND '$periode_akhir' AND statusotr='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
                	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglotr']))?></td>
                        <td>PEMBAYARAN OTR NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarotr'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglgross BETWEEN '$periode_awal' AND '$periode_akhir' AND statusgross='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
                	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglgross']))?></td>
                        <td>PEMBAYARAN GROSS NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayargross'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglsubsidi BETWEEN '$periode_awal' AND '$periode_akhir' AND statussubsidi='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
                	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglsubsidi']))?></td>
                        <td>PEMBAYARAN SUBSIDI SETELAH PAJAK NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarsubsidi'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglmatrix BETWEEN '$periode_awal' AND '$periode_akhir' AND statusmatrix='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
                	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglmatrix']))?></td>
                        <td>PEMBAYARAN MATRIX SETELAH PAJAK NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarmatrix'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglscpahm BETWEEN '$periode_awal' AND '$periode_akhir' AND statusscpahm='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglscpahm']))?></td>
                        <td>PEMBAYARAN SCP AHM NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarscpahm'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE tglscpmd BETWEEN '$periode_awal' AND '$periode_akhir' AND statusscpmd='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tglscpmd']))?></td>
                        <td>PEMBAYARAN SCP MD NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarscpmd'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				}
				
			if($dA4C['total']!=0)
				{
			?>
        <!-- ############################ PENJUALAN CASH ####################################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PENJUALAN CASH / CASH TEMPO DEALER</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='titip'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td>UANG TITIPAN NOTA PESAN <?echo "$d2[nopesan]"?> A.N. <?echo "$d3[nama]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi='lunas'");
                while($d1 = mysql_fetch_array($q1))
                	{
                	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td>PELUNASAN NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				}
				
			if($dA2B['total']!=0)
				{
			?>
        <!-- ############################ PEMASUKAN KAS KECIL ######################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMASUKAN KAS KECIL</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_kaskecil WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='INPUT'");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
                        <td><?echo $d1['keterangan']?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				}
				
			if($dA5A['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN PIUTANG KARYAWAN (TUNAI) ########################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#28cdf5;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN (TUNAI)</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'");
                while($d1 = mysql_fetch_array($q1))
                	{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
                        <td><?echo "$d1[nama] $d1[ket]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
            <?
                	}
				}
				
			if($dA5B['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI########################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#28cdf5;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_piutang WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND potkompensasi='1' AND jenis='pembayaran' AND metodebayar='GAJI' AND potkompensasi='1'");
				while($d1 = mysql_fetch_array($q1))
					{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
                        <td><?echo "$d1[nama] $d1[ket] DIAMBI DARI $d1[metodebayar]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
			<?
					}
				}
    
			if($dA10B['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN POTONGAN KOMPENSASI (TUNAI) ########################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#28cdf5;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI (TUNAI)</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND metodebayar='TUNAI' AND status='1'");
				while($d1 = mysql_fetch_array($q1))
					{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
                        <td><?echo "$d1[nama] $d1[ket]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
			<?
					}
				}
    
			if($dA10A['total']!=0)
				{
			?>
        <!-- ############################ PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI ########################################################################### -->
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#28cdf5;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI</b></td>
                </tr>
            <?
				$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE tgl BETWEEN '$periode_awal' AND '$periode_akhir' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'");
				while($d1 = mysql_fetch_array($q1))
					{
			?>
                    <tr style="cursor:pointer">
                        <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
                        <td><?echo "$d1[nama] $d1[ket] DIAMBI DARI $d1[metodebayar]"?></td>
                        <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
                		<td align="center">-</td>
                    </tr>
			<?
					}
				}
				
			if($totre!=0)
				{
			?>
                <tr style="cursor:pointer;">
                    <td colspan="4" style="background-color:#aaa;color:#fff"><b style="padding:20px">TOTAL</b></td>
                </tr>
                <tr style="cursor:pointer">
                    <td colspan="2"></td>
                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($in,0,",",".")?></span></td>
                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($out,0,",",".")?></span></td>
            	</tr>
            <?
				}
			?>
        </tbody>
		<tfoot>
            <tr>
                <th>&nbsp;</th>
            </tr>
		</tfoot>
	</table>