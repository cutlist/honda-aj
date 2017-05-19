<?
			if(!empty($_REQUEST[del1]))
				{
				
//mysql_query("TRUNCATE 	x23_gudang");
//mysql_query("TRUNCATE 	x23_karyawan");
//mysql_query("TRUNCATE 	x23_kelompokjasa");
//mysql_query("TRUNCATE 	x23_kelompokjasa_det");
//mysql_query("TRUNCATE 	x23_kelompokjasa_oli");
//mysql_query("TRUNCATE 	x23_masterbarang");
//mysql_query("TRUNCATE 	x23_masterjasa ;");
//mysql_query("TRUNCATE     x23_masteroli");
//mysql_query("TRUNCATE 	x23_pangkat");
//mysql_query("TRUNCATE 	x23_scanhistory");
//mysql_query("TRUNCATE 	x23_scankeluar");
//mysql_query("TRUNCATE 	x23_scanmasuk");
//mysql_query("TRUNCATE 	x23_posisi");
//mysql_query("TRUNCATE 	x23_rak");
//mysql_query("TRUNCATE 	x23_supplier");
//mysql_query("TRUNCATE 	x23_tarifjasa");
//mysql_query("TRUNCATE 	x23_tarifjasa2");
//mysql_query("TRUNCATE 	x23_user");

mysql_query("TRUNCATE 	temp_abs_x23_Overbreak");
mysql_query("TRUNCATE 	temp_abs_x23_overtime");
mysql_query("TRUNCATE 	temp_abs_x23_status");
mysql_query("TRUNCATE 	temp_abs_x23_terlambat");
mysql_query("TRUNCATE 	temp_x23_abispenjualan");
mysql_query("TRUNCATE 	temp_x23_abisservis");
mysql_query("TRUNCATE 	temp_x23_bayarsup_notaretur");
mysql_query("TRUNCATE 	temp_x23_claimoli_det");
mysql_query("TRUNCATE 	temp_x23_kmindividu_wktsvc");
mysql_query("TRUNCATE 	temp_x23_konfclaim_det");
mysql_query("TRUNCATE 	temp_x23_opname_det");
mysql_query("TRUNCATE 	temp_x23_pndharian");
mysql_query("TRUNCATE 	x23_abis_dkonfirmasi");
mysql_query("TRUNCATE 	x23_abis_ikesalahan");
mysql_query("TRUNCATE 	x23_antrian");
mysql_query("TRUNCATE 	x23_bayarsup_history");
mysql_query("TRUNCATE 	x23_claimoli_det");
mysql_query("TRUNCATE 	x23_indent");
mysql_query("TRUNCATE 	x23_indent_det");
mysql_query("TRUNCATE 	x23_insentif_inc");
mysql_query("TRUNCATE 	x23_insentif_karyawan");
mysql_query("TRUNCATE 	x23_interval");
mysql_query("TRUNCATE 	x23_kaskecil");
mysql_query("TRUNCATE 	x23_kompensasi");
mysql_query("TRUNCATE 	x23_komsetbruto");
mysql_query("TRUNCATE 	x23_kwitansi");
mysql_query("TRUNCATE 	x23_kwitansikpb");
mysql_query("TRUNCATE 	x23_lembur");
mysql_query("TRUNCATE 	x23_notabeli");
mysql_query("TRUNCATE 	x23_notabeli_det");
mysql_query("TRUNCATE 	x23_notajual");
mysql_query("TRUNCATE 	x23_notajual_det");
mysql_query("TRUNCATE 	x23_notaretur");
mysql_query("TRUNCATE 	x23_notaretur_use");
mysql_query("TRUNCATE 	x23_notaservice");
mysql_query("TRUNCATE 	x23_notaservice_det");
mysql_query("TRUNCATE 	x23_opname");
mysql_query("TRUNCATE 	x23_opname_det");
mysql_query("TRUNCATE 	x23_penagihankpb");
mysql_query("TRUNCATE 	x23_pindah");
mysql_query("TRUNCATE 	x23_pindah_det");
mysql_query("TRUNCATE 	x23_piutang");
mysql_query("TRUNCATE 	x23_potkompensasi");
mysql_query("TRUNCATE 	x23_returbeli");
mysql_query("TRUNCATE 	x23_returbeli_det");
mysql_query("TRUNCATE 	x23_returjual");
mysql_query("TRUNCATE 	x23_returjual_det");
mysql_query("TRUNCATE 	x23_stokpart");
mysql_query("TRUNCATE 	x23_stokmin");
mysql_query("TRUNCATE 	x23_temp_hargajual");
mysql_query("TRUNCATE 	x23_temp_pindah_det");
mysql_query("TRUNCATE 	x23_temp_qtytiba");
mysql_query("TRUNCATE 	x23_tutupharian");
mysql_query("TRUNCATE 	x23_tutupservis");
mysql_query("TRUNCATE 	x23_uangharian");
mysql_query("TRUNCATE 	x23_uanglembur");

//mysql_query("TRUNCATE 	x23_kelompokjasa");
//mysql_query("TRUNCATE 	x23_kelompokjasa_det");
//mysql_query("TRUNCATE 	x23_kelompokjasa_oli");
//mysql_query("TRUNCATE 	x23_kjasa");
//mysql_query("TRUNCATE 	x23_masterbarang");
//mysql_query("TRUNCATE 	x23_masterjasa");
//mysql_query("TRUNCATE 	x23_masteroli");

				
				//echo "<script>alert ('Proses berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu'/>";
				exit();
				}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>HAPUS <small>DATABASE</small></h4>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KETERANGAN DATA</th>
			                                    <th style="padding:7px">HAPUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr style="cursor:pointer">
			                                    <td>Hapus Semua Data </td>
			                                    <td width="1%" align="center"><div class="btn-group">
												<a href="<?echo "?opt=$opt&menu=$menu&del1=1"?>"
			                                            <button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding: 0px 10px 0px 10px">
			                                            <i class="fa fa-trash-o"></i></button>
														</a>
			                                        </div>
			                                        </td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
?>
			        </div>
				</section>
			</aside>
			
	
        <script src="js/jquery.min.js"></script>
        
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>