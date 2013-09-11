<?php

session_start();
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
}

# I had my db user/pass hard-coded here!
mysql_connect('localhost','wut','the?');
mysql_select_db('mutt357_finaldrive');


if(count($_POST) > 0) {
	$entry_id = $_POST['entry_id'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$comments = $_POST['comments'];

	$sql = "UPDATE guestbook ";
	$sql .= "SET posted=NOW(), name='$name', location='$location', email='$email',website='$website', comments='$comments' ";
	$sql .= "WHERE entry_id=$entry_id ";

	if(mysql_query($sql)) {
		header('Location: admin.php');
	}
	else {
		die('$sql');
	}

}
else {
	$entry_id = $_GET['entry_id'];
	$sql = "SELECT name, location, email, website, comments ";
	$sql .= "FROM guestbook ";
	$sql .= "WHERE entry_id=$entry_id ";

	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$name = $row['name'];
	$location = $row['location'];
	$email = $row['email'];
	$website = $row['website'];
	$comments = $row['comments'];

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>Modify Entry</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<!--<link rel="stylesheet" type="text/css" href="../site.css" />--!>
</head>
<body>
	<div id="container">
		<div id="header">
		<div id="background1">
		</div>
		<div id="background2">
		</div>

		<div id="topnavigation">
			<h2>IMAGES</h2>
			<h2>car care</h2>
		</div> <!--closing div for topnavigation div-->
	</div>     <!--closing div for header div-->
		<div id="navbar">
				<div id="navigation">
				<ul>
					<li><a href="index.php" title="Administrative Portal">Portal</a></li>
					<li><a href="post_add.php" title="Add new News Item">AddPost</a></li>
					<li><a href="product_add.php" title="Add New Product">NewProduct</a></li>
					<li><a href="upload.php" title="Upload Image">UploadImages</a></li>
					<li><a href="../index.php" title="Images Car Care-Home">Website</a></li>
				</ul>
			</div>
		</div>

		<div id="contentgraphic">
   		<h3>Administrative Portal</h3>
   		</div>

		<div id="content">
		<div id="left_s">
			<h3>Modify Entry</h3>
			<p>Fill out the form below. When you are finished click Modify Entry once.</p>
			<form action="entry_modify.php" method="post">
			<input type="hidden" name="id" value="<?php echo $entry_id; ?>" />

				<dl>
					<dt><label for="name">Name</label></dt>
					<dd><input type="text" name="name" id="name" maxlength="40" value="<?php echo $name; ?>" /></dd>
					<dt><label for="comments">Comments</label></dt>
					<dd><textarea cols="40" rows="15" name="comments" name="comments"><?php echo $comments; ?></textarea></dd>
				</dl>
					<input type="submit" name="submit" value="Modify Entry" />
					<input type="reset" name="reset" value="Reset Form" />
					<input type="button" name="cancel" value="Cancel" onclick="window.location='admin.php'" />
			</form>
		</div>
		<div id="footer">
			<div id="bottomnavigation">
				<ul>
					<li><a href="index.php" title="Administrative Portal">Portal</a>  |</li>
					<li><a href="post_add.php" title="Add new News Item">AddPost</a> |</li>
					<li><a href="product_add.php" title="Add New Product">NewProduct</a> |</li>
					<li><a href="upload.php" title="Upload Image">UploadImages</a></li>
					<li><a href="../index.php" title="Images Car Care-Home">Website</a> | </li>
				</ul>

			</div>  <!--closing div for "bottomnavigation"-->
		<div id="copyright">
		<strong>Images Car Care  <em>copyright 2005</em></strong>
		</div>
		</div>      <!--closing div for "footer"-->
	</div>
	</div>
</body>
</html>