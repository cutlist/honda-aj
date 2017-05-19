<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";

$periode_tahun = $_REQUEST[tahun];
$periode_bulan = $_REQUEST[bulan];

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "ARUSKAS_H2H3-$periode_tahun-$periode_bulan.xls";
header("Content-Disposition: attachment; filename=$judul");

									$dA1   = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_bayarsup_history WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'"));
					                $dA2   = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='OUTPUT' AND status='1'"));
					                $dA2B  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='INPUT' AND status='1'"));
		                            $dA3   = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='piutang' AND status='1'"));
		                            $dA4S  = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='servis' AND status='1'"));
		                            $dA4J1 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah>=0 AND status='1'"));
		                            $dA4J2 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah<0 AND status='1'"));
		                            
		                            $dA4I  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='indent' AND status='1'"));
		                            $dA4I2 = mysql_fetch_array(mysql_query("SELECT SUM(jumlahho) AS total FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='indent' AND status='1'"));
		                            $dA5A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA5B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='GAJI' AND status='1' AND potkompensasi='1'"));
		                            //$dA6A  = mysql_fetch_array(mysql_query("SELECT SUM(jumlahbayarkpb) AS total FROM x23_notajual_det WHERE substr(tglbayarkpb,6,2)='$periode_bulan' AND substr(tglbayarkpb,1,4)='$periode_tahun' AND statusbayar='1'"));
		                            $dA6B  = mysql_fetch_array(mysql_query("SELECT SUM(jumlahbayar) AS total,SUM(jumlahtagih) AS total2 FROM x23_penagihankpb WHERE substr(tglpembayaran,6,2)='$periode_bulan' AND substr(tglpembayaran,1,4)='$periode_tahun' AND statuspembayaran='TERBAYAR'"));
		                            $dA8   = mysql_fetch_array(mysql_query("SELECT SUM(totuharian) AS total FROM x23_uangharian WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1'"));
		                            $dA9   = mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS total FROM x23_uanglembur WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun'"));
		                            $dA10A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'"));
		                            $dA10B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA11  = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_kompensasi WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1'"));
		                            $dA12A = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM x23_opname WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND totjumselisih>=0 AND status='1'"));
		                            $dA12B = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM x23_opname WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND totjumselisih<0 AND status='1'"));
		                            //$dA12 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('CASHTEMPO')"));
		                            
		                            $dA13 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_returjual WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
		                            $dA14 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_notaretur_use WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
									
									$POTdPKBdrMPM = round($dA6B[total2]*0.02,0);
		                        	
		                            $out = $dA1[total]+$dA2[total]+$dA3[total]+$dA8[total]+$dA9[total]+$dA11[total]+$dA4J2[total]+$dA12A[total]+$dA13[total];//$dA4J2[total]+$dA12A[total]+$dA13[total]
		                            $in  = $dA5A[total]+$dA5B[total]+$dA10A[total]+$dA10B[total]+$dA4S[total]+$dA4J1[total]+$dA4I[total]+$dA4I2[total]+$dA2B[total]-$dA12B[total]+$dA6A[total]+$dA14[total]+$dA6B[total]-$POTdPKBdrMPM;
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
	<h4>LAPORAN ARUS KAS H2H3 PERIODE BULAN <?echo $periode_bulan?> TAHUN <?echo $periode_tahun?></h4>
    <table style='width:100%'>
        <thead>
            <tr>
                <th style="height:45px;background:#37A58A;color:#fff;width:10%">TANGGAL</th>
                <th style="height:45px;background:#37A58A;color:#fff;width:60%">KETERANGAN</th>
                <th style="height:45px;background:#37A58A;color:#fff;width:15%">UANG MASUK (RP)</th>
                <th style="height:45px;background:#37A58A;color:#fff;width:15%">UANG KELUAR (RP)</th>
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
			                            <!-- ############################ PEMBAYARAN PEMBELIAN ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN PEMBELIAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT tanggal,jumlah,nonota FROM x23_bayarsup_history WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notabeli_vw WHERE nonota='$d1[nonota]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PEMBAYARAN KE SUPPLIER NOTA BELI <?echo $d1['nonota']?> SUPLLIER <?echo $d2[nama]?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA13['total']!=0)
												{
											?>
			                            <!-- ############################ RETUR JUAL ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">RETUR JUAL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_returjual_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notajual_vw WHERE nonota='$d1[nonotajual]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PEMBAYARAN RETUR JUAL NOTA RETUR <?echo $d1['noreturjual']?> UNTUK NOTA JUAL <?echo $d1['nonotajual']?> DARI <?echo $d2[nama]?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA4J2['total']!=0)
												{
											?>
			                            <!-- ############################ PENGEMBALIAN KELEBIHAN BAYAR ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGEMBALIAN KELEBIHAN BAYAR</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah<0 AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PENGEMBALIAN KELEBIHAN BAYAR NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(($d1['pembulatan']),0,",",".")?></span></td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA6B['total']!=0)
												{
											?>
			                            <!-- ############################ POTONGAN PEMBAYARAN SERVIS KPB DARI MPM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">POTONGAN PEMBAYARAN SERVIS KPB DARI MPM SEBESAR 2%</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE substr(tglpembayaran,6,2)='$periode_bulan' AND substr(tglpembayaran,1,4)='$periode_tahun' AND statuspembayaran='TERBAYAR'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$d1[kodepaket]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE nonota='$d1[nonotaservis]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglpembayaran']))?></td>
					                                    <td>POTONGAN NO. NOTA SERVIS <?echo "$d1[nonotaservis]"?> <?echo "$d2[nama]"?> A.N. <?echo "$d3[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(round(($d1['jumlahtagih']*0.02),0),0,",",".")?></span></td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA2['total']!=0)
												{
											?>
			                            <!-- ############################ PENGELUARAN KAS KECIL ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGELUARAN KAS KECIL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='OUTPUT'");
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
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PIUTANG KARYAWAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='piutang' AND status='1'");
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
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN UANG HARIAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_uangharian WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1' AND totuharian!=0 ORDER BY updatex");
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
					                            	}
												}
												
											if($dA9['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN UANG LEMBUR ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN UANG LEMBUR</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_uanglembur WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' ORDER BY updatex");
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
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN KOMPENSASI / GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kompensasi WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1' ORDER BY updatex");
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
					                            	}
												}
												
											if($dA12A['total']!=0)
												{
											?>
			                            <!-- ############################ SELISIH STOCK OPNAME ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">KERUGIAN SELISIH DARI STOCK OPNAME</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_opname_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND totjumselisih > 0 ORDER BY inputx");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo "TERJADI SELISIH PADA STOCK OPNAME $d1[gudang]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totjumselisih'],0,",",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA4S['total']!=0)
												{
											?>
			                            <!-- ############################ SERVIS ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">SERVIS</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='servis' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
													if($d1[pembulatan] > $d1[jumlah]){
														$ket = "(PEMBULATAN)";
														}
													else{$ket = "";}
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>SERVIS NOTA SERVIS <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama] $ket"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['pembulatan'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
					                            }
												
											if($dA4J1['total']!=0)
												{
											?>
			                            <!-- ############################ PENJUALAN BARANG ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PENJUALAN BARANG</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penjualan' AND jumlah>=0 AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
													if($d1[pembulatan] > $d1[jumlah]){
														$ket = "(PEMBULATAN)";
														}
													else{$ket = "";}
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PENJUALAN BARANG NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama] $ket"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['pembulatan'],0,",",".");?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA14['total']!=0)
												{
											?>
			                            <!-- ############################ RETUR BELI ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">RETUR BELI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_notaretur_use WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$d1[idsupplier]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>RETUR BELI NO. NOTA RETUR <?echo "$d1[noretur]"?> SUPPLIER <?echo "$d2[nama]"?> BAYAR NOTA BELI <?echo $d1[nonota2]?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA6A['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN BARANG KPB DARI MPM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN BARANG KPB DARI MPM</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE substr(tglbayarkpb,6,2)='$periode_bulan' AND substr(tglbayarkpb,1,4)='$periode_tahun' AND statusbayar='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
													$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayarkpb']))?></td>
					                                    <td>NO. NOTA SERVIS <?echo "$d1[nonota]"?> NO. KPB <?echo "$d2[nama]"?> BARANG : <?echo "$d1[kodebarang] - $d1[namabarang] - $d1[varian]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlahbayarkpb'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA6B['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN SERVIS KPB DARI MPM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN SERVIS KPB DARI MPM</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE substr(tglpembayaran,6,2)='$periode_bulan' AND substr(tglpembayaran,1,4)='$periode_tahun' AND statuspembayaran='TERBAYAR'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$d1[kodepaket]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE nonota='$d1[nonotaservis]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglpembayaran']))?></td>
					                                    <td>NO. NOTA SERVIS <?echo "$d1[nonotaservis]"?> <?echo "$d2[nama]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlahbayar'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?	
					                            	}
					                            }
												
											if($dA4I['total']!=0)
												{
											?>
			                            <!-- ############################ UANG MUKA BARANG INDENT ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">UANG MUKA BARANG INDENT</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='indent' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
						                        	if($d1[tambahdp]=="0")
						                        		{
											?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>UANG MUKA BARANG INDENT NOTA INDENT <?echo "$d1[nomor]. $d1[keterangan]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>BIAYA HO BARANG INDENT NOTA INDENT <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlahho'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
					                        <?
					                        			}
						                        	if($d1[tambahdp]=="1")
						                        		{
											?>
						                                <tr style="cursor:pointer">
						                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td>TAMBAH UANG MUKA BARANG INDENT NOTA INDENT <?echo "$d1[nomor]"?> A.N. <?echo "$d2[nama]. $d1[keterangan]"?></td>
						                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
				                                    		<td align="center">-</td>
						                                </tr>
					                        <?
					                        			}
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
												$q1 = mysql_query("SELECT * FROM x23_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='INPUT'");
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
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN (TUNAI)</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'");
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
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND potkompensasi='1' AND jenis='pembayaran' AND metodebayar='GAJI' AND potkompensasi='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
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
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI (TUNAI)</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND metodebayar='TUNAI' AND status='1'");
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
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
											<?
													}
												}
												
											if($dA12B['total']!=0)
												{
											?>
			                            <!-- ############################ KELEBIHAN SELISIH DARI STOCK OPNAME ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00c0ef;color:#fff"><b style="padding:20px">KELEBIHAN SELISIH DARI STOCK OPNAME</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM x23_opname_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND totjumselisih < 0 ORDER BY inputx");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo "LEBIH ".-1*$d1[totselisih]." PCS PADA STOCK OPNAME $d1[gudang]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(-1*$d1['totjumselisih'],0,",",".")?></span></td>
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
            <tr>
                <th>&nbsp;</th>
            </tr>
			
    	<tr style="background-color:#f85858;color:#000">
    		<td><span style="font-size:18px;font-weight:normal;">TOTAL PENGELUARAN</span></td>
			<td><span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($out,"0","",".")?></span></td>
    	</tr>
    	<tr style="background-color:#00c0ef;color:#000">
    		<td><span style="font-size:18px;font-weight:normal;">TOTAL PEMASUKAN</span></td>
			<td><span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($in,"0","",".")?></span></td>
    	</tr>
    	<tr style="background-color:#ff851b;color:#000">
    		<td><span style="font-size:18px;font-weight:normal;"><?echo $ketre?></span></td>
			<td><span style="font-size:18px;font-weight:normal;"><?echo "RP. ".number_format($totre,"0","",".")?></span></td>
    	</tr>
		</tfoot>
    </table>