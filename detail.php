<html>
<head>
<title>Document Detail</title>
</head>

<body>
<?php 
require_once 'db\persistence.php';
require_once 'cookie/cookie.php';

$titleid = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : '' ; 

if( $titleid ) {
	$books = new persistDisplay();
	$bookDetails = $books->getTitlesInfo( $titleid );
	foreach ( $bookDetails as $title => $book ) {
?>
		
<h1><?php echo "$title"; ?></h1>

<h2>Info</h2>

<p>
<?php echo $book; ?>
</p>		
	
<?php 		
	}
	$ck = new cookieMonster();
	$ck->setBooksCookie($titleid);
}
?>

<p><a href="list.php">No Thanks</a></p>

<?php 
if( !$titleid ) { ?>
	<p>Email Address: <input type="text" name="email" /><a href="home.php">Buy!!</a></p>
<?php } else { ?>

	<form action="home.php" method="post">
	<input type="hidden" name="bookid" value="<?php echo $titleid; ?>" />
	<p>Email Address: <input type="text" name="email" value="name@domain.com" /></p>
	<input name="boughtbookid" type="submit" value="Buy!!">
	</form>

<?php }
?>

</body>
</html>