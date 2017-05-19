<?php
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain

unset ($_SESSION["user"]);
unset ($_SESSION["pass"]);
session_destroy();

echo '<meta http-equiv="refresh" content="0;url=../../" />';
?>