<?php

session_start();
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
}

# I had my db user/pass hard-coded here!
mysql_connect('localhost','wut','the?');
mysql_select_db('mutt357_finaldrive');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>Administrative Portal</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<div id="container">
	<h2>Administrative Portal</h2>
	<div id="addnews">
		<h2>News blog</h2>
		<a href="post_add.php">Add News item</a>
		<ul>

<?php

$sql = "SELECT id, posted ";
$sql .="FROM news ";
$sql .= "ORDER BY posted DESC ";

$result = mysql_query($sql);

while($row = mysql_fetch_assoc($result)) {
	$id = $row['id'];
	$posted = $row['posted'];

	echo "<li> [ <a href=\"post_remove.php?id=$id\">x</a> ] <a href=\"post_modify.php?id=$id\"> $id ($posted)</a></li>\n";
}

?>
	</ul>
	</div><!--addnews end--!>

	<div id="guestbook">
		<h2>Guestbook</h2>
		<ul>
<?php

$sql2 = "SELECT entry_id, name ";
$sql2 .= "FROM guestbook ";
$sql2 .= "ORDER BY entry_id DESC ";

$result2 = mysql_query($sql2);

while($row2 = mysql_fetch_assoc($result2)) {
	$entry_id = $row2['entry_id'];
	$name = $row2['name'];

	echo "<li> [ <a href=\"entry_remove.php?entry_id=$entry_id\">x</a> ] <a href=\"entry_modify.php?entry_id\">$name</a> </li>\n";

}

?>
		</ul>


	</div><!--guestbook end--!>

	</div><!--container end--!>


</body>

</html>