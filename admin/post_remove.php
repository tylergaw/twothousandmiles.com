<?php

session_start();
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
}

# I had my db user/pass hard-coded here!
mysql_connect('localhost','wut','the?');
mysql_select_db('mutt357_finaldrive');

$id = $_GET['id'];

$sql = "DELETE FROM news ";
$sql .= "WHERE id=$id ";

if(mysql_query($sql)) {
	header('Location: index.php');
}
else {
	die("oh man");
}


?>