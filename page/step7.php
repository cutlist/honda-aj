<h2>Kirim SMS</h2>


<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<table>
<tr valign="top"><td><b>Masukkan No HP Tujuan</b></td><td>:</td><td><input type="text" name="nohp"></td></tr>
<tr valign="top"><td><b>Masukkan isi SMS</b><br>(maksimum panjang SMS adalah 160 karakter)</td><td>:</td><td><textarea name="sms" rows="5" cols="40"></textarea></td></tr>

</table>
<input type="submit" name="submit" value="Kirim SMS">
</form>

<?php
  if ($_POST['submit']) 
  {
   $nohp = $_POST['nohp'];
   $sms = $_POST['sms'];
   
   echo "<b>Status :</b><br>";
   echo "<pre>";
   passthru('gammu-smsd-inject -c smsdrc TEXT '.$nohp.' -text "'.$sms.'"');
   echo "</pre>";
  }
?> 
