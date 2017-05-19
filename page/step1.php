<h2>Setting Config Modem</h2>

<?php
$handle = @fopen("gammurc", "r");
$baris = array();
if ($handle) {
    while (!feof($handle)) {
        $buffer = fgets($handle);
        if (substr_count($buffer, 'port = ') > 0)
		{
		   $split = explode("port = ", $buffer);
		   $port = str_replace(":", "", $split[1]);
		}
		
		if (substr_count($buffer, 'connection = ') > 0)
		{
		   $split = explode("connection = ", $buffer);
		   $connection = $split[1];
		}
		$baris[] = $buffer; 
    }
    fclose($handle);
}

if ($_GET['op'] == "simpan")
{
  $port = $_POST['port'];
  $connection = $_POST['connection'];
  
  $handle = @fopen("gammurc", "w");
  
  for ($i=0; $i<=count($baris)-1; $i++)
  {
     if (substr_count($baris[$i], 'port = ') > 0)
	 {
	    $text = "port = ".$port.":\n"; 
	 }
	 else if (substr_count($baris[$i], 'connection = ') > 0)
	 {
	    $text = "connection = ".$connection."\n";
	 }
	 else $text = $baris[$i];
	 fwrite($handle, $text);
  }
  fclose($handle); 
  echo "<p>Setting Config Modem Sudah Disimpan</p>";  
}

?> 

<p>Masukkan nomor port dan jenis connection pada form di bawah ini!</p>

<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=A"?>&op=simpan">
<table>
 <tr><td>PORT</td><td>:</td><td><input type="text" name="port" value="<?php echo $port;?>"></td></tr>
 <tr><td>CONNECTION</td><td>:</td><td><input type="text" name="connection" value="<?php echo $connection;?>"></td></tr>
 <tr><td></td><td></td><td><input type="submit" name="submit" value="Simpan"></td></tr>
</table>
</form>
