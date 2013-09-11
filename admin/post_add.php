<?php

session_start();
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
}

# I had my db user/pass hard-coded here!
mysql_connect('localhost','wut','the?');
mysql_select_db('mutt357_finaldrive');


$status = 'Fill out the form below. When you are finished click Add Post once.';
$display_content = TRUE;

if(count($_POST) > 0) {
	$error_list = array();
	$status = '';

	$content = $_POST['content'];

	if(empty($content)) {
		$error_list[] = 'You forgot to enter some content!<br />';
	}
		if(count($error_list) > 0) {
		$status .= "<ul>\n";

		foreach($error_list as $error) {
			$status .= "<li>$error</li>\n";
		}

		$status .= "</ul>\n";
	}
	else {
	$sql = "INSERT INTO news ";
	$sql .= "SET posted=NOW(),content='$content' ";

	if(mysql_query($sql)) {
		header('Location: index.php');
	}
		else {
			$status = 'Sorry. I was not able to add your post.';
		}
	$display_content = FALSE;
	}

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>Add New Post</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<h1>Add New Post</h1>
	<div><?php echo $status; ?></div>
<?php if($display_content == TRUE) { ?>
	<form action="post_add.php" method="post">

		<dl>
			<dt><label for="content">Content</label></dt>
			<dd><textarea cols="40" rows="20" name="content" id="content"><?php echo $content; ?></textarea></dd>

		</dl>
		<input type="submit" name="submit" value="Add Post" />
		<input type="reset" name="reset" value="Reset Form" />
		<input type="button" name="cancel" value="Cancel" onclick="window.location='admin.php'" />
	</form>
<?php } ?>
</body>
</html>