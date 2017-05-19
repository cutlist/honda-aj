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
$judul = "ARUSKAS_H1$periode_tahun-$periode_bulan.xls";
header("Content-Disposition: attachment; filename=$judul");

									$dA1  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bayarsup_history WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'"));
					                $dA2  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='OUTPUT' AND status='1'"));
					                $dA2B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='INPUT' AND status='1'"));
		                            $dA3  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='piutang' AND status='1'"));

		                            $dA5A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA5B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='GAJI' AND status='1' AND potkompensasi='1'"));
		                            $dA6  = mysql_fetch_array(mysql_query("SELECT SUM(komisi) AS total FROM tbl_notajual_det WHERE substr(tglbayarkomisi,6,2)='$periode_bulan' AND substr(tglbayarkomisi,1,4)='$periode_tahun' AND statuskomisi='1'"));
		                            $dA7  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND jnskwitansi IN ('pengembalian')"));
		                            $dA8  = mysql_fetch_array(mysql_query("SELECT SUM(totuharian) AS total FROM tbl_uangharian WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1'"));
		                            $dA9  = mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS total FROM tbl_uanglembur WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun'"));
		                            $dA10A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'"));
		                            $dA10B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND metodebayar='TUNAI' AND status='1'"));
		                            $dA11 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM tbl_kompensasi WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1'"));
		                            $dA12 = mysql_fetch_array(mysql_query("SELECT SUM(totjumselisih) AS total FROM tbl_opname WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1'"));
		                            //$dA12 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('cashtempo')"));
		                        	$dA13A = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('nopol') AND status='1' AND jumlah>=0"));
		                        	$dA13B = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('nopol') AND status='1' AND jumlah<0"));
		                        	$dA14  = mysql_fetch_array(mysql_query("SELECT SUM(bayar) AS total FROM tbl_notabeli WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND gtbayarppn!=''"));
		                        	$dA16  = mysql_fetch_array(mysql_query("SELECT SUM(bbn) AS total FROM tbl_notajual_det_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1'"));

									$dA18  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND jnskwitansi IN ('penambahan')"));

									$mutasimasuk   = mysql_fetch_array(mysql_query("SELECT SUM(harga+ppn) AS total FROM tbl_transfer WHERE jenis='MASUK' AND substr(tgltransfer,6,2)='$periode_bulan' AND substr(tgltransfer,1,4)='$periode_tahun' AND status='1'"));
		                            $mutasikeluar  = mysql_fetch_array(mysql_query("SELECT SUM(harga+ppn) AS total FROM tbl_transfer WHERE jenis='KELUAR' AND substr(tgltransfer,6,2)='$periode_bulan' AND substr(tgltransfer,1,4)='$periode_tahun' AND status='1'"));

		                            /* ============= LABA KREDIT ============= */
		                        	$dLabaKredit   = mysql_fetch_array(mysql_query("SELECT SUM(M) AS total FROM tbl_labakredit2_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
		                        	$dModalKredit  = mysql_fetch_array(mysql_query("SELECT SUM(C) AS total, SUM(UM) AS umtotal FROM tbl_labakredit2_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
		                        	$dhlaba  	   = mysql_fetch_array(mysql_query("SELECT SUM(bunga) AS total FROM tbl_hlaba WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));

		                            /* ============= TRANSAKSI KREDIT ============= */
		                            $uangmuka = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('umuka')"));
									$otr  	  = mysql_fetch_array(mysql_query("SELECT SUM(bayarotr) AS total FROM tbl_notajual_det_vw WHERE substr(tglotr,6,2)='$periode_bulan' AND substr(tglotr,1,4)='$periode_tahun' AND statusotr='1'"));
		                            $gross    = mysql_fetch_array(mysql_query("SELECT SUM(bayargross) AS total FROM tbl_notajual_det_vw WHERE substr(tglgross,6,2)='$periode_bulan' AND substr(tglgross,1,4)='$periode_tahun' AND statusgross='1'"));
		                            $subsidi  = mysql_fetch_array(mysql_query("SELECT SUM(bayarsubsidi) AS total FROM tbl_notajual_det_vw WHERE substr(tglsubsidi,6,2)='$periode_bulan' AND substr(tglsubsidi,1,4)='$periode_tahun' AND statussubsidi='1'"));
		                            $matrix  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarmatrix) AS total FROM tbl_notajual_det_vw WHERE substr(tglmatrix,6,2)='$periode_bulan' AND substr(tglmatrix,1,4)='$periode_tahun' AND statusmatrix='1'"));
		                            $scpahm  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarscpahm) AS total FROM tbl_notajual_det_vw WHERE substr(tglscpahm,6,2)='$periode_bulan' AND substr(tglscpahm,1,4)='$periode_tahun' AND statusscpahm='1'"));
		                            $scpmd  	= mysql_fetch_array(mysql_query("SELECT SUM(bayarscpmd) AS total FROM tbl_notajual_det_vw WHERE substr(tglscpmd,6,2)='$periode_bulan' AND substr(tglscpmd,1,4)='$periode_tahun' AND statusscpmd='1'"));
		                            $tambahlain  	= mysql_fetch_array(mysql_query("SELECT SUM(tambahlain) AS total FROM tbl_notajual_det_vw WHERE substr(tgltambahlain,6,2)='$periode_bulan' AND substr(tgltambahlain,1,4)='$periode_tahun' AND tambahlain!=''"));
		                            $kuranglain 	= mysql_fetch_array(mysql_query("SELECT SUM(kuranglain) AS total FROM tbl_notajual_det_vw WHERE substr(tglkuranglain,6,2)='$periode_bulan' AND substr(tglkuranglain,1,4)='$periode_tahun' AND kuranglain!=''"));
									
		                            /* ============= TRANSAKSI CASH ============= */
									$uangtitipan = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('titip')"));
									$pelunasan = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('lunas')"));
									$cashtempo = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('cashtempo')"));
									$dLabaCash = mysql_fetch_array(mysql_query("SELECT SUM(ppnjual_min_ppnbeli) AS total FROM tbl_labacash1_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
												
		                            /* ============= SISA PPN ============= */
		                        	$dA15  = mysql_fetch_array(mysql_query("SELECT SUM(tppnjual_min_ppnbeli) AS total,id FROM tbl_notajual WHERE (jnstransaksi='CASH' OR jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER') AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND sisabayar<='0'"));
		                        	
									if($dA14['total']!=0){
										$PenguranganPpnBeli = $dA14['total'];
										}
									else{
										$PenguranganPpnBeli = "0";
										}
		                         		                        	
		                            $out = $dA1[total]+$dA2[total]+$dA3[total]+$dA7[total]+$dA8[total]+$dA9[total]+$dA6[total]+$dA11[total]+$dA12[total]-$dA13B[total]+$dA14[total]+
										   $dA15[total]+$dA16[total]+$mutasimasuk[total]+$kuranglain[total]-$PenguranganPpnBeli;
		                            $in  = $uangtitipan[total]+$pelunasan[total]+$cashtempo[total]+$uangmuka[total]+$dA5A[total]+$dA5B[total]+$otr[total]+$gross[total]+$subsidi[total]+$matrix[total]+$scpahm[total]+
		                            	   $scpmd[total]+$dA10A[total]+$dA10B[total]+$dA2B[total]+$dA13A[total]+$mutasikeluar[total]+$dA18[total]+$tambahlain[total];
		                            $re  = $in-$out-
		                            		$uangmuka[total]-$otr[total]-$gross[total]-$subsidi[total]-$matrix[total]+$dLabaKredit[total]+$dModalKredit[total]-//Laba Kredit
		                            		$dLabaCash[total] //Laba Cash
		                            		;
		                            		
		                            //$re  = $in-$out-
		                            //		$dModalKredit[umtotal]-$otr[total]-$gross[total]-$subsidi[total]-$matrix[total]+$dModalKredit[total];//Laba Kredit -$dhlaba[total]
		                            if($re < 0){
		                            	$ketre = "RUGI KOTOR";
		                            	$totre = -1*$re;
										}
		                            else if($re > 0){
		                            	$ketre = "LABA KOTOR";
		                            	$totre = $re;
										}
		                            else {
		                            	$ketre = "LABA KOTOR";
		                            	$totre = 0;
										}
?>
	<h4>LAPORAN ARUS KAS H1 PERIODE BULAN <?echo $periode_bulan?> TAHUN <?echo $periode_tahun?></h4>
    <table style='width:150%'>
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
			                            <!-- ############################ PEMBAYARAN BELI UNIT ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN BELI UNIT</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT tanggal,jumlah,nonota,id FROM tbl_bayarsup_history WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT grandtotalppn FROM tbl_notabeli WHERE nonota='$d1[nonota]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_bayarsup_history WHERE nonota='$d1[nonota]' ORDER BY id ASC LIMIT 0,1"));
					                            	if($d3[id] == $d1[id]){
														$jumlah = $d1[jumlah]-$d2[grandtotalppn];
														}
													else{
														$jumlah = $d1[jumlah];
														}
					                            	
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PEMBAYARAN KE SUPPLIER UNTUK NOTA BELI <?echo $d1['nonota']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($jumlah,"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA14['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN PPN BELI UNIT ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PEMBAYARAN PPN BELI UNIT</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT tglnota,gtbayarppn,nonota FROM tbl_notabeli WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND gtbayarppn!=''");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglnota']))?></td>
					                                    <td>PEMBAYARAN PPN NOTA BELI <?echo $d1['nonota']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['gtbayarppn'],"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if(!empty($dA15['id']))
												{
											?>
			                            <!-- ############################ SISA PPN ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">SISA PPN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT tppnjual_min_ppnbeli AS total,tglnota,nonota FROM tbl_notajual WHERE (jnstransaksi='CASH' OR jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER') AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND sisabayar<='0'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglnota']))?></td>
					                                    <td>SISA PPN UNTUK NOTA JUAL <?echo $d1['nonota']?></td>
					                                <?
					                                if($d1['total'] >= 0)
					                                	{
													?>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],"0","",".")?></span></td>
													<?
														}
					                                if($d1['total'] < 0)
					                                	{
													?>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(abs($d1['total']),"0","",".")?></span></td>
			                                    		<td align="center">-</td>
													<?
														}
					                                ?>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA16['total']!=0)
												{
											?>
			                            <!-- ############################ BBN ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">BBN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
													$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglnota']))?></td>
					                                    <td>BBN UNTUK NOTA JUAL <?echo $d1['nonota']?> A.N. <?echo "$d3[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bbn'],"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
													
											if($dA13B['total']!=0)
												{
											?>
			                            <!-- ############################ PENGEMBALIAN PEMBAYARAN PEMESANAN NOPOL ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGEMBALIAN PEMBAYARAN PEMESANAN NOPOL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='nopol' AND jumlah<'0' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT notajual FROM tbl_bpkb WHERE nopesan='$d1[nomor]' OR notajual='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>UANG PEMBAYARAN PESANAN NOPOL NO. NOTA JUAL <?echo "$d2[notajual]"?> A.N. <?echo "$d3[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format(abs($d1['jumlah']),"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA7['total']!=0)
												{
											?>
			                            <!-- ############################ PENGEMBALIAN UANG MUKA/TITIPAN ######################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGEMBALIAN UANG MUKA/TITIPAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' AND jnskwitansi IN ('pengembalian')");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	//$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PENGEMBALIAN NOTA PESAN <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
												$q1 = mysql_query("SELECT * FROM tbl_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='OUTPUT' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo $d1['keterangan']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
												$q1 = mysql_query("SELECT * FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='piutang' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo $d1['nama']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
												$q1 = mysql_query("SELECT * FROM tbl_uangharian WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1' AND totuharian!=0 ORDER BY updatex");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
						                    ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
					                                    <td><?echo "$d1[nama] ".date("d-m-Y",strtotime($d1['dari']))." s/d ".date("d-m-Y",strtotime($d1['sampai']))?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totuharian'],"0","",".")?></span></td>
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
												$q1 = mysql_query("SELECT * FROM tbl_uanglembur WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' ORDER BY updatex");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
					                                    <td><?echo "$d1[nama] TANGGAL ".date("d-m-Y",strtotime($d1['tanggal']))?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['ulembur'],"0","",".")?></span></td>
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
												$q1 = mysql_query("SELECT * FROM tbl_kompensasi WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND status='1' ORDER BY updatex");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayar']))?></td>
					                                    <td><?echo "$d1[nama] PERIODE $d1[bulan] $d1[tahun]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($kuranglain['total']!=0)
												{
											?>
			                            <!-- ############################ PENGURANGAN PEMBAYARAN ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">PENGURANGAN PEMBAYARAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglkuranglain,6,2)='$periode_bulan' AND substr(tglkuranglain,1,4)='$periode_tahun' AND kuranglain!=''");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglkuranglain']))?></td>
					                                    <td>PENGURANGAN PEMBAYARAN NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> KETERANGAN : <?echo "$d1[ketkuranglain]"?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['kuranglain'],"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($dA12['total']!=0)
												{
											?>
			                            <!-- ############################ SELISIH STOCK OPNAME ################################################################################ -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">KERUGIAN SELISIH DARI STOCK OPNAME</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_opname WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND status='1' ORDER BY inputx");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
													if(!empty($d1['totjumselisih']))
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
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['totjumselisih'],"0","",".")?></span></td>
					                                </tr>
					                        <?
															
														}
					                            	}
												}
												
											if($dA6['total']!=0)
												{
											?>
			                            <!-- ############################ CASH BON ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">CASH BON</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE substr(tglbayarkomisi,6,2)='$periode_bulan' AND substr(tglbayarkomisi,1,4)='$periode_tahun' AND statuskomisi='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglbayarkomisi']))?></td>
					                                    <td>PEMBAYARAN BROKER <?echo $d1['ref']?> UNTUK NOTA JUAL <?echo $d1['nonota']?></td>
			                                    		<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['komisi'],"0","",".")?></span></td>
					                                </tr>
					                        <?
					                            	}
												}
		                            
											if($mutasimasuk['total']!=0)
												{
											?>
			                            <!-- ############################ MUTASI BARANG MASUK ########################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#fa1515;color:#fff"><b style="padding:20px">MUTASI BARANG MASUK</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT *,SUM(harga+ppn) AS total FROM tbl_transfer WHERE jenis='MASUK' AND substr(tgltransfer,6,2)='$periode_bulan' AND substr(tgltransfer,1,4)='$periode_tahun' AND status='1' GROUP BY notransfer");
												while($d1 = mysql_fetch_array($q1))
													{
													$dD = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idasal]'"))
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgltransfer']))?></td>
					                                    <td><?echo "MUTASI BARANG MASUK NO. MUTASI $d1[notransfer] ASAL : $dD[nama]"?></td>
														<td align="center">-</td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],"0","",".")?></span></td>
			                                    	</tr>
											<?
													}
												}
												
											if($uangmuka['total']!=0)
												{
											?>
			                            <!-- ############################ UANG MUKA TRANSAKSI KREDIT ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">UANG MUKA TRANSAKSI KREDIT / CASH TEMPO LEASING</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi IN ('umuka')");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	//$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>UANG MUKA NOTA PESAN <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											/*
											if($dLabaKredit['total']!=0)
												{
											?>
			                            <!-- ############################ LABA TRANSAKSI KREDIT ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">LABA TRANSAKSI KREDIT / CASH TEMPO LEASING</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_labakredit2_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	//$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglnota']))?></td>
					                                    <td>LABA NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['M'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
											*/
												
											if($otr['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN OTR ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN OTR</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglotr,6,2)='$periode_bulan' AND substr(tglotr,1,4)='$periode_tahun' AND statusotr='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
					                            	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglotr']))?></td>
					                                    <td>PEMBAYARAN OTR NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarotr'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($gross['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN GROSS ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN GROSS</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglgross,6,2)='$periode_bulan' AND substr(tglgross,1,4)='$periode_tahun' AND statusgross='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
					                            	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglgross']))?></td>
					                                    <td>PEMBAYARAN GROSS NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayargross'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($subsidi['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN SUBSIDI SETELAH PAJAK ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN SUBSIDI SETELAH PAJAK</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglsubsidi,6,2)='$periode_bulan' AND substr(tglsubsidi,1,4)='$periode_tahun' AND statussubsidi='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
					                            	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglsubsidi']))?></td>
					                                    <td>PEMBAYARAN SUBSIDI SETELAH PAJAK NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarsubsidi'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($matrix['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN MATRIX SETELAH PAJAK ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN MATRIX SETELAH PAJAK</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglmatrix,6,2)='$periode_bulan' AND substr(tglmatrix,1,4)='$periode_tahun' AND statusmatrix='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
					                            	$d4 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id='$d1[idleasing]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglmatrix']))?></td>
					                                    <td>PEMBAYARAN MATRIX SETELAH PAJAK NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> DARI <?echo "$d4[namaleasing]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarmatrix'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($scpahm['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN SCP AHM ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN SCP AHM</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglscpahm,6,2)='$periode_bulan' AND substr(tglscpahm,1,4)='$periode_tahun' AND statusscpahm='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglscpahm']))?></td>
					                                    <td>PEMBAYARAN SCP AHM NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarscpahm'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($scpmd['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN SCP MD ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN SCP MD</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tglscpmd,6,2)='$periode_bulan' AND substr(tglscpmd,1,4)='$periode_tahun' AND statusscpmd='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tglscpmd']))?></td>
					                                    <td>PEMBAYARAN SCP MD NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['bayarscpmd'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($tambahlain['total']!=0)
												{
											?>
			                            <!-- ############################ PENAMBAHAN PEMBAYARAN ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PENAMBAHAN PEMBAYARAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE substr(tgltambahlain,6,2)='$periode_bulan' AND substr(tgltambahlain,1,4)='$periode_tahun' AND tambahlain!=''");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgltambahlain']))?></td>
					                                    <td>PENAMBAHAN PEMBAYARAN NOTA JUAL <?echo "$d1[nonota]"?> A.N. <?echo "$d3[nama]"?> KETERANGAN : <?echo "$d1[kettambahlain]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['tambahlain'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($uangtitipan['total']!=0)
												{
											?>
			                            <!-- ############################ UANG TITIPAN CASH ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">UANG TITIPAN TRANSAKSI CASH / CASH TEMPO DEALER</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='titip'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	//$d2 = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>UANG TITIPAN NOTA PESAN <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($pelunasan['total']!=0)
												{
											?>
			                            <!-- ############################ PELUNASAN TRANSAKSI CASH ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PELUNASAN CASH DAN PPN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='lunas'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT ppn FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PELUNASAN NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlah]-$d2[ppn],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PPN NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d2[ppn],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
												
											if($cashtempo['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN CASH TEMPO DEALER ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN CASH TEMPO DEALER</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='cashtempo'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT ppn FROM tbl_notajual WHERE nonota='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PEMBAYARAN CASH TEMPO DEALER NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PPN NOTA JUAL <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d2[ppn],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
													
											if($dA18['total']!=0)
												{
											?>
			                            <!-- ############################ PENAMBAHAN UANG MUKA / UANG TITIPAN ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PENAMBAHAN UANG MUKA/UANG TITIPAN</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='penambahan' AND jumlah>='0' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>PENAMBAHAN UANG MUKA/UANG TITIPAN NO. NOTA PESAN <?echo "$d1[nomor]"?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
					                        <?
					                            	}
												}
													
											if($dA13A['total']!=0)
												{
											?>
			                            <!-- ############################ PEMBAYARAN PEMESANAN NOPOL ####################################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN PEMESANAN NOPOL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnskwitansi='nopol' AND jumlah>='0' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
					                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$d1[nomor]' OR notajual='$d1[nomor]'"));
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
													if(empty($d2[notajual])){
														$no = "NO. NOTA PESAN $d2[nopesan]";
														}
													if(!empty($d2[notajual])){
														$no = "NO. NOTA JUAL $d2[notajual]";
														}
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td>UANG PEMBAYARAN PESANAN NOPOL <?echo $no?> A.N. <?echo "$d3[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMASUKAN KAS KECIL</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_kaskecil WHERE substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND jenis='INPUT' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
					                                    <td><?echo $d1['keterangan']?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN (TUNAI)</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND jenis='pembayaran' AND metodebayar='TUNAI' AND status='1'");
					                            while($d1 = mysql_fetch_array($q1))
					                            	{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN PIUTANG KARYAWAN DIPOTONG GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND potkompensasi='1' AND jenis='pembayaran' AND metodebayar='GAJI' AND potkompensasi='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI (TUNAI)</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND metodebayar='TUNAI' AND status='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
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
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">PEMBAYARAN POTONGAN KOMPENSASI DIPOTONG GAJI</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT * FROM tbl_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI' AND potkompensasi='1'");
												while($d1 = mysql_fetch_array($q1))
													{
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgl']))?></td>
					                                    <td><?echo "$d1[nama] $d1[ket] DIAMBIL DARI $d1[metodebayar]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
											<?
													}
												}
		                            
											if($mutasikeluar['total']!=0)
												{
											?>
			                            <!-- ############################ MUTASI BARANG KELUAR ########################################################################### -->
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#00aed9;color:#fff"><b style="padding:20px">MUTASI BARANG KELUAR</b></td>
				                                </tr>
				                            <?
												$q1 = mysql_query("SELECT *,SUM(harga+ppn) AS total FROM tbl_transfer WHERE jenis='KELUAR' AND substr(tgltransfer,6,2)='$periode_bulan' AND substr(tgltransfer,1,4)='$periode_tahun' AND status='1' GROUP BY notransfer");
												while($d1 = mysql_fetch_array($q1))
													{
													$dD = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idtujuan]'"))
											?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tgltransfer']))?></td>
					                                    <td><?echo "MUTASI BARANG KELUAR NO. MUTASI $d1[notransfer] TUJUAN : $dD[nama]"?></td>
					                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['total'],"0","",".")?></span></td>
			                                    		<td align="center">-</td>
					                                </tr>
											<?
													}
												}
											?>
				                                <tr style="cursor:pointer;">
				                                    <td colspan="4" style="background-color:#aaa;color:#fff"><b style="padding:20px">TOTAL</b></td>
				                                </tr>
				                                <tr style="cursor:pointer">
				                                    <td colspan="2"></td>
				                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($in,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($out,"0","",".")?></span></td>
		                                    	</tr>
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