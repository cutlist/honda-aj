<h2>Setting SMS Gateway</h2>

<?php
$handle = @fopen("smsdrc", "r");
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

		if (substr_count($buffer, 'user = ') > 0)
		{
		   $split = explode("user = ", $buffer);
		   $user = $split[1];
		}

		if (substr_count($buffer, 'password = ') > 0)
		{
		   $split = explode("password = ", $buffer);
		   $pass = $split[1];
		}

		if (substr_count($buffer, 'database = ') > 0)
		{
		   $split = explode("database = ", $buffer);
		   $db = $split[1];
		}
		
		$baris[] = $buffer; 
    }
    fclose($handle);
}

if ($_GET['op'] == "simpan")
{
  $port = $_POST['port'];
  $connection = $_POST['connection'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $db = $_POST['db'];  
  
  $handle = @fopen("smsdrc", "w");
  
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
	 else if (substr_count($baris[$i], 'user = ') > 0)
	 {
	    $text = "user = ".$user."\n";
	 }
	 else if (substr_count($baris[$i], 'password = ') > 0)
	 {
	    $text = "password = ".$pass."\n";
	 }
	 else if (substr_count($baris[$i], 'database = ') > 0)
	 {
	    $text = "database = ".$db."\n";
	 }	 
	 else $text = $baris[$i];
	 fwrite($handle, $text);
  }
  fclose($handle); 
  echo "<p>Konfigurasi SMS Gateway sudah disimpan</p>";  
}

?> 

<p>Masukkan konfigurasi SMS Gateway berikut ini!</p>

<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>&op=simpan">
<table>
 <tr><td>PORT</td><td>:</td><td><input type="text" name="port" value="<?php echo $port;?>"></td></tr>
 <tr><td>CONNECTION</td><td>:</td><td><input type="text" name="connection" value="<?php echo $connection;?>"></td></tr>
 <tr><td>USERNAME (MySQL)</td><td>:</td><td><input type="text" name="user" value="<?php echo $user;?>"></td></tr>
 <tr><td>PASSWORD (MySQL)</td><td>:</td><td><input type="text" name="pass" value="<?php echo $pass;?>"></td></tr>
 <tr><td>DATABASE NAME (MySQL)</td><td>:</td><td><input type="text" name="db" value="<?php echo $db;?>"></td></tr>
 <tr><td></td><td></td><td><input type="submit" name="submit" value="Simpan"></td></tr>
</table>

</form>