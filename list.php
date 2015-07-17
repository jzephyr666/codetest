<!DOCTYPE html>
<HTML>
<head>
<title>Document List</title>
</head>

<body>

<?php
require_once 'cookie/cookie.php';
$ck = new cookieMonster( );

require_once 'db\persistence.php'; 
$dbp = new persistDisplay();
$titles = $dbp->getTitles() ;
?>

<h1>Documents</h1>

<?php foreach ( $titles as $id=>$title ) {
		$bId = $ck -> getValidBookCookie( $id ) ;
		if ($bId != 0 || $bId !='') {
?>
			<p><?php echo "*" . $title; ?><a href="detail.php?id=<?php echo $id;?>">More Info</a></p>
<?php 		} else { ?>
			<p><?php echo $title; ?><a href="detail.php?id=<?php echo $id;?>">More Info</a></p>
<?php		}
	
	}?>

<a href="home.php">Return To The Home Page</a>

</body>
</html>