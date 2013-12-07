<?php
require_once("database.php");
$d = new database();
die(var_dump($d->getDrivers()));
$x = $d->query("SELECT * FROM users",true);
die(var_dump($x));

?>