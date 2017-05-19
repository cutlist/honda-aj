<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
@media print {
html, body {
    width: 8.27in; /* was 9.5in */
    height: 9.5in; /* was 8.27in */
    display: block;
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
<body style="font-size:12px">
<?
error_reporting(0);
include "../../include/application_top.php";
//include "../include/function.php";

?>

	<div class="col-xs-12" style="text-align:center">
		<h4><b>DETAIL BARANG</b></h4>
	</div>
	</br>
	<div class="col-xs-12">
		<div class="col-xs-6" style="font-size:12px">
            <table width="100%">
        		<tr>
        			<td width="35%">KODE BARANG</td>
        			<td width="3%">:</td>
        			<td><?echo $_REQUEST[kodebarang]?></td>
        		</tr>
            	<tr>
            		<td>NAMA BARANG</td>
            		<td>:</td>
        			<td><?echo $_REQUEST[namabarang]?></td>
            	</tr>
            	<tr>
            		<td>VARIAN</td>
            		<td>:</td>
        			<td><?echo $_REQUEST[varian]?></td>
            	</tr>
            </table>
        </div>
		<div class="col-xs-6" style="font-size:12px">
            <table width="100%">
            	<tr>
            		<td width="35%">GUDANG</td>
            		<td width="3%">:</td>
        			<td><?echo $_REQUEST[gudang]?></td>
        		</tr>
            	<tr>
            		<td>RAK</td>
            		<td>:</td>
        			<td><?echo $_REQUEST[rak]?></td>
            	</tr>
            	<tr>
            		<td>TOTAL STOK</td>
            		<td>:</td>
        			<td><?echo number_format($_REQUEST[totalstok])?> PCS</td>
            	</tr>
            </table>
        </div>
    </div>
	
    <div class="col-xs-12" style="margin-top:20px">
        <div class="box box-info">
            <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
                <table id="example2" class="table table-striped table-hover">
                    <thead style="color:#666;font-size:13px">
                        <tr>
                            <th width="12%" style="padding:7px">NO. NOTA BELI</th>
                            <th style="padding:7px">NAMA SUPPLIER</th>
                            <th width="10%" style="padding:7px"><center>TANGGAL BELI</center></th>
							<?
							if($_SESSION[posisi]=='DIREKSI')
								{
							?>
                            	<th width="12%" style="padding:7px"><center>HARGA BELI + PPN (RP)</center></th>
                            <?
                            	}
                            ?>
                            <th width="14%" style="padding:7px"><center>HARGA JUAL NORMAL (RP)</center></th>
                            <th width="7%" style="padding:7px"><center>STOK</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?	                         
					$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE id%2=0 AND idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND rak='$_REQUEST[rak]'");
                    while($dA = mysql_fetch_array($qA))
                    	{
                    	$dS = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notabeli_vw WHERE id%2=0 AND nonota='$dA[nonota]'"));
                    	if(empty($dA[stok])){
							$stok = "0";
							}
						else{
							$stok = $dA[stok];
							}
                    ?>
                        <tr style="cursor:pointer">
                            <td><?echo $dA[nonota]?></td>
                            <td><?echo $dS[nama]?></td>
                            <td align="center"><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
							<?
							if($_SESSION[posisi]=='DIREKSI')
								{
							?>
                            	<td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih]*1.1,"0","",".")?></span></td>
                            <?
                            	}
                            ?>
                            <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
                            <td align="right"><span style="margin-right:0%"><?echo number_format($stok,"0","",".")?> PCS</span></td>
                        </tr>
                        
                    <?
						$no++;
                    	}
                     ?>
                    </tbody>
                    <!--
                    <tfoot>
                    	<tr>
                    		<th colspan=""></th>
                    		<th colspan="" align="right">GRAND TOTAL</th>
                    		<td colspan="" align="right"><span style="margin-right:0%"><b><?echo number_format($d1[totalqty])?> PCS</b></span></td>
                    		<td colspan="" align="right"></td>
                    		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[grandtotal])?></b></span></td>
                    		<th colspan="2"></th>
                    	</tr>
                    </tfoot>
                    -->
                </table>
            </div>
        </div>
    </div>

</body>