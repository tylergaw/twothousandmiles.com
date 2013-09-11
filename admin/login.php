<?php

if(count($_POST) > 0) {
	$login = $_POST['login'];
	$passphrase = $_POST['passphrase'];

	# I had my db user/pass hard-coded here!
    mysql_connect('localhost','wut','the?');
	mysql_select_db('mutt357_finaldrive');

	$sql = "SELECT id ";
	$sql .= "FROM user_accounts ";
	$sql .= "WHERE login='$login' AND passphrase=MD5('$passphrase') ";

	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0) {
		session_start();
		$_SESSION['logged_in'] = TRUE;
		header('Location: index.php');
	}
	else {
		('Location: login.php');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>User Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<h1>User Login</h1>
	<form action="login.php" method="post">
		<dl>
			<dt><label for="login">Login</label></dt>
			<dd><input type="text" name="login" id="login" />
			<dt><label for="passphrase">Passphrase</label></dt>
			<dd><input type="password" name="passphrase" id="passphrase" />
		</dl>
		<input type="submit" name="submit" value="Log In" />
		<input type="reset" name="reset" value="Reset Form" />
	</form>
</body>
</html>