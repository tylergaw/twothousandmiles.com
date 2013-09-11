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
	$title = $_POST['title'];
	$content = $_POST['content'];

	if(empty($title)) {
		$error_list[] = 'You forgot to enter a title!<br />';
	}

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
	$sql .= "SET posted=NOW(),title='$title', content='$content' ";

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
	<title>Images Car Wash-Add New Post</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="../site.css" />
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
		<div id="addpost">
		<h3>Add New Post</h3>
	<div><?php echo $status; ?></div>
<?php if($display_content == TRUE) { ?>
	<form action="post_add.php" method="post">

		<dl>
			<dt><label for="title">Title</label></dt>
			<dd><input type="text" name="title" id="title" maxlength="55" value="<?php echo $title; ?>" /></dd>
			<dt><label for="content">Content</label></dt>
			<dd><textarea cols="40" rows="15" name="content" name="content"><?php echo $content; ?></textarea></dd>

		</dl>
		<input type="submit" name="submit" value="Add Post" />
		<input type="reset" name="reset" value="Reset Form" />
		<input type="button" name="cancel" value="Cancel" onclick="window.location='index.php'" />
	</form>
<?php } ?>
	</div>

	</div>
	</div>

</body>
</html>