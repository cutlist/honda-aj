<h2>Test Koneksi Modem</h2>


<form method="post" action="">
<input type="submit" name="submit" value="CEK KONEKSI">
</form>

<?php
if ($_POST['submit'])
{
   echo "<b>Status :</b><br>";
   echo "<pre>";
   passthru("gammu -c gammurc identify", $hasil);
   echo "</pre>";
}
?> 
