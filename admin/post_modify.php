<?php

session_start();
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
}

# I had my db user/pass hard-coded here!
mysql_connect('localhost','wut','the?');
mysql_select_db('mutt357_finaldrive');


if(count($_POST) > 0) {
	$id = $_POST['id'];
	$content = $_POST['content'];

	$sql = "UPDATE news ";
	$sql .= "SET posted=NOW(),content='$content' ";
	$sql .= "WHERE id=$id ";

	if(mysql_query($sql)) {
		header('Location: index.php');
	}
	else {
		die("sumbitch broke.");
	}

}
else {
	$id = $_GET['id'];
	$sql = "SELECT content ";
	$sql .= "FROM news ";
	$sql .= "WHERE id=$id ";

	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$content =$row['content'];

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>Modify Post</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<h1>Modify Post</h1>
	<p>Fill out the form below. When you are finished click Modify Post once.</p>
	<form action="post_modify.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />

		<dl>
			<dt><label for="content">Content</label></dt>
			<dd><textarea cols="40" rows="20" name="content" id="content"><?php echo $content; ?></textarea></dd>
		</dl>
		<input type="submit" name="submit" value="Modify Post" />
		<input type="reset" name="reset" value="Reset Form" />
		<input type="button" name="cancel" value="Cancel" onclick="window.location='admin.php'" />
	</form>
</body>
</html>