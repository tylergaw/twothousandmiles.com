<?php

session_start();
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
}

# I had my db user/pass hard-coded here!
mysql_connect('localhost','wut','the?');
mysql_select_db('mutt357_finaldrive');

$entry_id = $_GET['entry_id'];

$sql = "DELETE FROM guestbook ";
$sql .= "WHERE entry_id=$entry_id ";

if(mysql_query($sql)) {
	header('Location: index.php');
}
else {
	die("oh man");
}


?>