<?
if($opt == md5(profile))
	{
	if($menu==md5(profile))
		{
		include "pages/$_SESSION[jns]/profile.php";
		}
	}
		
if($_SESSION['jns']=='H1' OR $_SESSION['jns']=='H1aj')
	{
	if(empty($opt) || empty($menu))
		{
		include "update.php";
		}

	else if($opt == md5(sms))
		{
		include "smsgateway.php";
		}

	else if($opt == md5(mstr))
		{
		if($menu==md5(user))
			{
			include "pages/$_SESSION[jns]/user.php";
			}
		else if($menu==md5(karyawan))
			{
			include "pages/$_SESSION[jns]/karyawan.php";
			}
		else if($menu==md5(barang))
			{
			include "pages/$_SESSION[jns]/barang.php";
			}
		else if($menu==md5(insentif))
			{
			include "pages/$_SESSION[jns]/komisi.php";
			}
		else if($menu==md5(perusahaan))
			{
			include "pages/perusahaan.php";
			}
		else if($menu==md5(daerah))
			{
			include "pages/daerah.php";
			}
		else if($menu==md5(leasing))
			{
			include "pages/leasing.php";
			}
		else if($menu==md5(gudang))
			{
			include "pages/$_SESSION[jns]/gudang.php";
			}
		else if($menu==md5(target))
			{
			include "pages/$_SESSION[jns]/target.php";
			}
		else if($menu==md5(grossubsidi))
			{
			include "pages/$_SESSION[jns]/pajakmatrix.php";
			}
		else if($menu==md5(del))
			{
			include "pages/del.php";
			}
		else if($menu==md5(lainbbn))
			{
			include "pages/$_SESSION[jns]/lainbbn.php";
			}
		else if($menu==md5(smsgateway))
			{
			include "pages/smsgateway.php";
			}
		}
		
	else if($opt == md5(pnjl))
		{
		if($menu==md5(stok))
			{
			include "pages/$_SESSION[jns]/stok.php";
			}
		else if($menu==md5(unitindent))
			{
			include "pages/$_SESSION[jns]/unitindent.php";
			}
		else if($menu==md5(pemesanan))
			{
			include "pages/$_SESSION[jns]/pemesanan.php";
			}
		else if($menu==md5(notajual))
			{
			include "pages/$_SESSION[jns]/notajual.php";
			}
		else if($menu==md5(indent))
			{
			include "pages/$_SESSION[jns]/indent.php";
			}
		else if($menu==md5(pesannopol))
			{
			include "pages/$_SESSION[jns]/pesannopol.php";
			}
		else if($menu==md5(cashbon))
			{
			include "pages/$_SESSION[jns]/cashbon.php";
			}
		else if($menu==md5(kinerjasales))
			{
			if($submenu=="individu")
				{
				include "pages/$_SESSION[jns]/ksindividu.php";
				}
			else if($submenu=="semua")
				{
				include "pages/$_SESSION[jns]/kssemua.php";
				}
			else if($submenu=="efektivitas")
				{
				include "pages/$_SESSION[jns]/ksefektivitas.php";
				}
			}
		else if($menu==md5(cashtempo))
			{
			include "pages/$_SESSION[jns]/cashtempo.php";
			}
		}
		
	else if($opt == md5(dplg))
		{
		if($menu==md5(pelanggan))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(pelangganohc))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(pelanggannonohc))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(perbaharuiohc))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(potensial))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(prospek))
			{
			include "pages/H1/pelanggan.php";
			}
		}
		
	else if($opt == md5(pmbl))
		{
		if($menu==md5(notabeli))
			{
			include "pages/$_SESSION[jns]/notabeli.php";
			}
		else if($menu==md5(bayarsup))
			{
			include "pages/$_SESSION[jns]/bayarsup.php";
			}
		}
		
	else if($opt == md5(sdm))
		{
		if($menu==md5(piutang))
			{
			include "pages/$_SESSION[jns]/piutang.php";
			}
		else if($menu==md5(potkompensasi))
			{
			include "pages/$_SESSION[jns]/potkompensasi.php";
			}
		else if($menu==md5(absensi))
			{
			if($submenu=="abs_individu")
				{
				include "pages/$_SESSION[jns]/abs_individu.php";
				}
			else if($submenu=="abs_rekap")
				{
				include "pages/$_SESSION[jns]/abs_rekap.php";
				}
			else if($submenu=="abs_dispensasi")
				{
				include "pages/$_SESSION[jns]/abs_dispensasi.php";
				}
			else if($submenu=="sync")
				{
				include "pages/$_SESSION[jns]/sync.php";
				}
			}
		else if($menu==md5(kompensasi))
			{
			if($submenu=="kom_rincian")
				{
				include "pages/$_SESSION[jns]/kom_rincian.php";
				}
			else if($submenu=="kom_rekap")
				{
				include "pages/$_SESSION[jns]/kom_rekap.php";
				}
			else if($submenu=="abs_dispensasi")
				{
				include "pages/$_SESSION[jns]/abs_dispensasi.php";
				}
			}
		else if($menu==md5(uangharian))
			{
			include "pages/$_SESSION[jns]/uangharian.php";
			}
		else if($menu==md5(uanglembur))
			{
			include "pages/$_SESSION[jns]/uanglembur.php";
			}
		}
		
	else if($opt == md5(gpdi))
		{
		if($menu==md5(konfnotabeli))
			{
			include "pages/$_SESSION[jns]/konfnotabeli.php";
			}
		else if($menu==md5(stok))
			{
			include "pages/$_SESSION[jns]/stok.php";
			}
		else if($menu==md5(pindahlokasi))
			{
			include "pages/$_SESSION[jns]/pindahlokasi.php";
			}
		else if($menu==md5(penyesuaianstok))
			{
			include "pages/$_SESSION[jns]/penyesuaianstok.php";
			}
		else if($menu==md5(cekfisik))
			{
			include "pages/$_SESSION[jns]/cekfisik.php";
			}
		else if($menu==md5(bensin))
			{
			include "pages/$_SESSION[jns]/bensin.php";
			}
		else if($menu==md5(opnamebensin))
			{
			include "pages/$_SESSION[jns]/opnamebensin.php";
			}
		else if($menu==md5(stokaksesoris))
			{
			include "pages/$_SESSION[jns]/stokaksesoris.php";
			}
		else if($menu==md5(statusaksesoris))
			{
			include "pages/$_SESSION[jns]/statusaksesoris.php";
			}
		else if($menu==md5(transferbrg))
			{
			include "pages/$_SESSION[jns]/transferbrg.php";
			}
		}
		
	else if($opt == md5(ksr))
		{
		if($menu==md5(ujual))
			{
			include "pages/$_SESSION[jns]/ujual.php";
			}
		else if($menu==md5(kaskecil))
			{
			include "pages/$_SESSION[jns]/kaskecil.php";
			}
		else if($menu==md5(kwitansi))
			{
			include "pages/$_SESSION[jns]/kwitansi.php";
			}
		else if($menu==md5(aruskas))
			{
			include "pages/$_SESSION[jns]/aruskas.php";
			}
		else if($menu==md5(kasbon))
			{
			include "pages/$_SESSION[jns]/kasbon.php";
			}
		}
		
	else if($opt == md5(adm))
		{
		if($menu==md5(pengeluaranunit))
			{
			include "pages/$_SESSION[jns]/pengeluaranunit.php";
			}
		else if($menu==md5(returbeli))
			{
			include "pages/$_SESSION[jns]/returbeli.php";
			}
		else if($menu==md5(kwitansi))
			{
			include "pages/$_SESSION[jns]/kwitansi.php";
			}
		else if($menu==md5(stnkbpkb))
			{
			include "pages/$_SESSION[jns]/stnkbpkb.php";
			}
		else if($menu==md5(konfsuratjalan))
			{
			include "pages/$_SESSION[jns]/konfsuratjalan.php";
			}
		else if($menu==md5(pembayaranleasing))
			{
			include "pages/$_SESSION[jns]/pembayaranleasing.php";
			}
		}
		
	else if($opt == md5(abis))
		{
		if($menu==md5(abis_penjualan))
			{
			include "pages/$_SESSION[jns]/abis_penjualan.php";
			}
		else if($menu==md5(abis_pembelian))
			{
			include "pages/$_SESSION[jns]/abis_pembelian.php";
			}
		else if($menu==md5(abis_arusunit))
			{
			include "pages/$_SESSION[jns]/abis_arusunit.php";
			}
		else if($menu==md5(abis_sleasing))
			{
			include "pages/$_SESSION[jns]/abis_sleasing.php";
			}
		else if($menu==md5(abis_dkonfirmasi))
			{
			include "pages/$_SESSION[jns]/abis_dkonfirmasi.php";
			}
		else if($menu==md5(abis_dkonfirmasipic))
			{
			include "pages/$_SESSION[jns]/abis_dkonfirmasipic.php";
			}
		else if($menu==md5(abis_ikesalahan))
			{
			include "pages/$_SESSION[jns]/abis_ikesalahan.php";
			}
		else if($menu==md5(alert))
			{
			include "pages/$_SESSION[jns]/alert.php";
			}
		}
		
	else if($opt == md5(bup))
		{
		if($menu==md5(bup))
			{
			include "pages/bup.php";
			}
		}
		
	else if($opt == md5(del))
		{
		if($menu==md5(del))
			{
			include "pages/del.php";
			}
		}
	}
	
else if($_SESSION['jns']=='H2H3' OR $_SESSION['jns']=='H2H3aj')
	{	
	if(empty($opt) || empty($menu))
		{
		include "update.php";
		}
		
	else if($opt == "profile")
		{
		include "pages/profile.php";
		}

	else if($opt == md5(mstr))
		{
		if($menu==md5(user))
			{
			include "pages/$_SESSION[jns]/user.php";
			}
		else if($menu==md5(karyawan))
			{
			include "pages/$_SESSION[jns]/karyawan.php";
			}
		else if($menu==md5(supplier))
			{
			include "pages/$_SESSION[jns]/supplier.php";
			}
		else if($menu==md5(barang))
			{
			include "pages/$_SESSION[jns]/barang.php";
			}
		else if($menu==md5(oli))
			{
			include "pages/$_SESSION[jns]/oli.php";
			}
		else if($menu==md5(jasa))
			{
			include "pages/$_SESSION[jns]/jasa.php";
			}
		else if($menu==md5(tarifjasa))
			{
			include "pages/$_SESSION[jns]/tarifjasa.php";
			}
		else if($menu==md5(tarifjasa2))
			{
			include "pages/$_SESSION[jns]/tarifjasa2.php";
			}
		else if($menu==md5(kelompokjasa))
			{
			include "pages/$_SESSION[jns]/kelompokjasa.php";
			}
		else if($menu==md5(gudang))
			{
			include "pages/$_SESSION[jns]/gudang.php";
			}
		else if($menu==md5(rak))
			{
			include "pages/$_SESSION[jns]/rak.php";
			}
		else if($menu==md5(perusahaan))
			{
			include "pages/perusahaan.php";
			}
		else if($menu==md5(hargabarang))
			{
			include "pages/$_SESSION[jns]/hargabarang.php";
			}
		else if($menu==md5(komisi))
			{
			include "pages/$_SESSION[jns]/komisi.php";
			}
		if($menu==md5(del))
			{
			include "pages/delh2h3.php";
			}
		}
		
	else if($opt == md5(pnjl))
		{
		if($menu==md5(stok))
			{
			include "pages/$_SESSION[jns]/stok.php";
			}
		else if($menu==md5(notajual))
			{
			include "pages/$_SESSION[jns]/notajual.php";
			}
		else if($menu==md5(historyjual))
			{
			include "pages/$_SESSION[jns]/historyjual.php";
			}
		else if($menu==md5(indent))
			{
			include "pages/$_SESSION[jns]/indent.php";
			}
		else if($menu==md5(returjual))
			{
			include "pages/$_SESSION[jns]/returjual.php";
			}
		}
		
	else if($opt == md5(dplg))
		{
		if($menu==md5(pelanggan))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(pelangganohc))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(pelanggannonohc))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(perbaharuiohc))
			{
			include "pages/H1/pelanggan.php";
			}
		else if($menu==md5(potensialh2))
			{
			include "pages/H1/pelanggan.php";
			}
		}
		
	else if($opt == md5(pmbl))
		{
		if($menu==md5(notabeli))
			{
			include "pages/$_SESSION[jns]/notabeli.php";
			}
		else if($menu==md5(bayarsup))
			{
			include "pages/$_SESSION[jns]/bayarsup.php";
			}
		}
		
	else if($opt == md5(sdm))
		{
		if($menu==md5(piutang))
			{
			include "pages/$_SESSION[jns]/piutang.php";
			}
		else if($menu==md5(potkompensasi))
			{
			include "pages/$_SESSION[jns]/potkompensasi.php";
			}
		else if($menu==md5(absensi))
			{
			if($submenu=="abs_individu")
				{
				include "pages/$_SESSION[jns]/abs_individu.php";
				}
			else if($submenu=="abs_rekap")
				{
				include "pages/$_SESSION[jns]/abs_rekap.php";
				}
			else if($submenu=="abs_dispensasi")
				{
				include "pages/$_SESSION[jns]/abs_dispensasi.php";
				}
			else if($submenu=="sync")
				{
				include "pages/$_SESSION[jns]/sync.php";
				}
			}
		else if($menu==md5(kompensasi))
			{
			if($submenu=="kom_rincian")
				{
				include "pages/$_SESSION[jns]/kom_rincian.php";
				}
			else if($submenu=="kom_rekap")
				{
				include "pages/$_SESSION[jns]/kom_rekap.php";
				}
			else if($submenu=="abs_dispensasi")
				{
				include "pages/$_SESSION[jns]/abs_dispensasi.php";
				}
			}
		else if($menu==md5(uangharian))
			{
			include "pages/$_SESSION[jns]/uangharian.php";
			}
		else if($menu==md5(uanglembur))
			{
			include "pages/$_SESSION[jns]/uanglembur.php";
			}
		}
		
	else if($opt == md5(gpdi))
		{
		if($menu==md5(konfnotabeli))
			{
			include "pages/$_SESSION[jns]/konfnotabeli.php";
			}
		else if($menu==md5(konfnotaclaim))
			{
			include "pages/$_SESSION[jns]/konfnotaclaim.php";
			}
		else if($menu==md5(konfreturbeli))
			{
			include "pages/$_SESSION[jns]/konfreturbeli.php";
			}
		else if($menu==md5(stok))
			{
			include "pages/$_SESSION[jns]/stok.php";
			}
		else if($menu==md5(pindahlokasi))
			{
			include "pages/$_SESSION[jns]/pindahlokasi.php";
			}
		else if($menu==md5(penyesuaianstok))
			{
			include "pages/$_SESSION[jns]/penyesuaianstok.php";
			}
		else if($menu==md5(cekfisik))
			{
			include "pages/$_SESSION[jns]/cekfisik.php";
			}
		else if($menu==md5(tools))
			{
			include "pages/$_SESSION[jns]/tools.php";
			}
		else if($menu==md5(stokminimum))
			{
			include "pages/$_SESSION[jns]/stokminimum.php";
			}
		}
		
	else if($opt == md5(ksr))
		{
		if($menu==md5(kwitansi))
			{
			include "pages/$_SESSION[jns]/kwitansi.php";
			}
		else if($menu==md5(kaskecil))
			{
			include "pages/$_SESSION[jns]/kaskecil.php";
			}
		else if($menu==md5(aruskas))
			{
			include "pages/$_SESSION[jns]/aruskas.php";
			}
		else if($menu==md5(kasbon))
			{
			include "pages/$_SESSION[jns]/kasbon.php";
			}
		else if($menu==md5(pndharian))
			{
			include "pages/$_SESSION[jns]/pndharian.php";
			}
		else if($menu==md5(laporanws1))
			{
			include "pages/$_SESSION[jns]/laporanws1.php";
			}
		else if($menu==md5(laporanws2))
			{
			include "pages/$_SESSION[jns]/laporanws2.php";
			}
		else if($menu==md5(laporanws3))
			{
			include "pages/$_SESSION[jns]/laporanws3.php";
			}
		else if($menu==md5(laporanws4))
			{
			include "pages/$_SESSION[jns]/laporanws4.php";
			}
		else if($menu==md5(tutupharian))
			{
			include "pages/$_SESSION[jns]/tutupharian.php";
			}
		}
		
	else if($opt == md5(adm))
		{
		if($menu==md5(returbeli))
			{
			include "pages/$_SESSION[jns]/returbeli.php";
			}
		else if($menu==md5(notaretur))
			{
			include "pages/$_SESSION[jns]/notaretur.php";
			}
		else if($menu==md5(bayarkpb))
			{
			include "pages/$_SESSION[jns]/bayarkpb.php";
			}
		else if($menu==md5(kwitansikpb))
			{
			include "pages/$_SESSION[jns]/kwitansikpb.php";
			}
		else if($menu==md5(claimoli))
			{
			include "pages/$_SESSION[jns]/claimoli.php";
			}
		}
		
	else if($opt == md5(svc))
		{
		if($menu==md5(antrianinput))
			{
			include "pages/$_SESSION[jns]/antrianinput.php";
			}
		else if($menu==md5(antrianshow))
			{
			include "pages/$_SESSION[jns]/antrianshow.php";
			}
		else if($menu==md5(notaservice))
			{
			include "pages/$_SESSION[jns]/notaservice.php";
			}
		else if($menu==md5(servisjr))
			{
			include "pages/$_SESSION[jns]/servisjr.php";
			}
		else if($menu==md5(notaservice2))
			{
			include "pages/$_SESSION[jns]/notaservice2.php";
			}
		else if($menu==md5(historyservice))
			{
			include "pages/$_SESSION[jns]/historyservice.php";
			}
		else if($menu==md5(arusservis))
			{
			include "pages/$_SESSION[jns]/arusservis.php";
			}
		else if($menu==md5(tutupservis))
			{
			include "pages/$_SESSION[jns]/tutupservis.php";
			}
		else if($menu==md5(kinerjamekanik))
			{
			if($submenu=="individu")
				{
				include "pages/$_SESSION[jns]/kmindividu.php";
				}
			else if($submenu=="semua")
				{
				include "pages/$_SESSION[jns]/kmsemua.php";
				}
			else if($submenu=="semuaomset")
				{
				include "pages/$_SESSION[jns]/kmsemuaomset.php";
				}
			}
		}
		
	else if($opt == md5(abis))
		{
		if($menu==md5(abis_penjualan))
			{
			include "pages/$_SESSION[jns]/abis_penjualan.php";
			}
		else if($menu==md5(abis_servis))
			{
			include "pages/$_SESSION[jns]/abis_servis.php";
			}
		else if($menu==md5(abis_motorservis))
			{
			include "pages/$_SESSION[jns]/abis_motorservis.php";
			}
		else if($menu==md5(abis_pembelian))
			{
			include "pages/$_SESSION[jns]/abis_pembelian.php";
			}
		else if($menu==md5(abis_arusbarang))
			{
			include "pages/$_SESSION[jns]/abis_arusbarang.php";
			}
		else if($menu==md5(abis_sleasing))
			{
			include "pages/$_SESSION[jns]/abis_sleasing.php";
			}
		else if($menu==md5(abis_dkonfirmasi))
			{
			include "pages/$_SESSION[jns]/abis_dkonfirmasi.php";
			}
		else if($menu==md5(abis_ikesalahan))
			{
			include "pages/$_SESSION[jns]/abis_ikesalahan.php";
			}
		else if($menu==md5(alert))
			{
			include "pages/$_SESSION[jns]/alert.php";
			}
		}
		
	else if($opt == md5(bup))
		{
		if($menu==md5(bup))
			{
			include "pages/bup.php";
			}
		}
		
	else if($opt == md5(del))
		{
		if($menu==md5(del))
			{
			include "pages/delh2h3.php";
			}
		}
	}
?>
<!--
			<aside class="right-side">
				<footer style="text-align: center; margin-top: -20px; margin-bottom: 20px; font-size: 11px">
	            	<img src="../favicon.ico" width="18px"> CV. ANUGRAH JAYA - Anugerah Jaya Information System &reg; 2016
                </footer>
            </aside>
-->