<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','u655417478_root');
define('DB_PASS','123456');
define('DB_NAME','u655417478_carrental');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>