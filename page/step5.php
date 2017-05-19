<h2>Buat Service</h2>

<p>Klik tombol di bawah ini untuk membuat Service!</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="submit" value="INSTALL SERVICE"></td></tr>
</form>

<?php
  if ($_POST['submit']) 
  {
   echo "<b>Status :</b><br>";
   echo "<pre>";
   passthru("gammu-smsd -k", $hasil);   
   passthru("gammu-smsd -u", $hasil);
   passthru("gammu-smsd -c smsdrc -i", $hasil);
   echo "</pre>";
  }
?> 
