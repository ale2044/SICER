<?

date_default_timezone_set('America/Buenos_Aires');

$db_host="127.0.0.1";

$db_user="root";

$db_pass="admin";

$link=mysql_connect($db_host, $db_user, $db_pass) or die ("Error conectando a la base de datos.");

$db_nombre="afiliaciones";
mysql_select_db($db_nombre,$link);

return $link;

?>