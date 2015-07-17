<html>
<head>
<title>Home Page</title>
</head>

<?php 
require_once 'db/persistence.php';
$dbp = new persistDisplay();

require_once 'cookie/cookie.php';
$ck = new cookieMonster();
$ck->checkViewedBooks();
?>

<body>

<h1>Home Page</h1>

<p>A Great Document Website</p>

<p>You haven't viewed any documents yet</p>

<p><strong>Documents you have viewed:</strong></p>

<?php 
$bookViewed = $ck->booksViewed;
foreach ( $bookViewed as $kID ) {
	$bookTitle = $dbp->getTitles($kID);
	echo "<p>$bookTitle[$kID]</p>";
}
?>

<!--<p>Title Z</p> -->
 
<?php 

if ( isset( $_POST['boughtbookid'] ) ) {
	$userEmail = $_POST['email'];
	if( !empty($userEmail) ) {
		echo "<p><strong>You have just bought:</strong></p>";
		$bookBought = $_POST['bookid'];
		$boughtTitle =  $dbp->getTitles( $bookBought );
		echo "<p>" . $boughtTitle[ $bookBought ] . "</p>
		<p>The full document will be sent to you shortly.</p>";
		
		$dbp->logPurchase($bookBought, $userEmail);
		$ck->deleteCookies();
	} else {
		echo "No Email Set - Go back and enter an email address<br /><br />";
	}
}
?>

<a href="list.php">View The Document List</a>

</body>
</html>