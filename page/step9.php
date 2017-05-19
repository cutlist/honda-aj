<h2>Hentikan Service</h2>

<p>Klik tombol di bawah ini untuk menghentikan Service!</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="submit" value="HENTIKAN SERVICE"></td></tr>
</form>

<?php
  if ($_POST['submit']) 
  {
   echo "<b>Status :</b><br>";
   echo "<pre>";
   passthru("gammu-smsd -k");
   echo "</pre>";
  }
?> 
