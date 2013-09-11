<?php 

if(isset($_SESSION['login'], $_SESSION['passphrase'])) {
	
	$login = $_SESSION['login'];
	$passphrase = $_SESSION['passphrase'];		

	$sql = "SELECT id ";
	$sql .= "FROM user_accounts ";
	$sql .= "WHERE login='$login' AND passphrase='$passphrase' ";

	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) == 0) {
		header('Location: logout.php');
	}
}
else {
	header('Location: login.php');
}

?>