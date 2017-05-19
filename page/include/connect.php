<?
$server = 'localhost';
$user = 'root';
$password = 'yaapalah';
$db = 'alx_honda';
mysql_connect( $server, $user, $password ) or die( mysql_error() );
mysql_select_db($db) or die( mysql_error() );
?>