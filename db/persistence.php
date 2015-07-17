<?php

/**
 * @name persist
 * Class for persistence
 * @author Saqib
 */
class persist {
	
	private $user 	= 'bookuser';
	private $pass 	= 'bookpassword';
	private $db		= 'bookstore'; #table = books, 
	
	/**
	 * @name dbconn
	 * Execute given query
	 * @param string $query
	 */
	private function dbconn( $query ) {
		$mysqli = new mysqli("localhost", $this->user, $this->pass, $this->db);
		
		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		} 

		$rst = mysqli_query( $mysqli, $query );
		mysqli_close($mysqli);
		return $rst;
	} 
	
	/**
	 * @name execQuery
	 * Submit query and restun array resultset
	 * @param string $query
	 * @return array $rst
	 */
	public function execQuery( $query = null) {
		$rst = $this->dbconn( $query );
		return $rst;
	}
	
	# helpful queries
	/**
	 * @name getTitles
	 * Returns book titles for all books or
	 * Returns book title for specified book
	 * @param int $whereClause
	 * @return array array[id]=[title] 
	 */
	public function getTitles( $whereClause = NULL ) {
		if ($whereClause != NULL) {
			$q = "SELECT id, title from books
					WHERE id = $whereClause";
		} else {
			$q = "SELECT id, title from books";
		}
		$titles = array();
		$rst = $this->execQuery( $q );
		foreach ( $rst as $k => $v ) {
			$titles[$v['id']] = $v['title'] ;
		}
		return $titles;
	}
	
	/**
	 * @name getTitlesInfo
	 * For a given bookid returns array of book title and description
	 * @param int $titleid
	 * @return array $titlesinfo
	 */
	public function getTitlesInfo( $titleid ) {
		$q = "SELECT title, info from books where id = $titleid";
		$titlesinfo = array();
		$rst = $this->execQuery( $q );
		foreach ( $rst as $k => $v ) {
			$titlesinfo[$v['title']] = $v['info'] ;
		}
		return $titlesinfo;
	}
	
	/**
	 * @name logPurchase
	 * Logs deatils of buyers
	 * @param int $bookID
	 * @param string $userEmail
	 */
	public function logPurchase( $bookID, $userEmail ) {
		$q = "INSERT INTO `purchaselog`( `bookid`, `email` ) VALUES ( '$bookID', '$userEmail' )";
		$this->execQuery( $q );
	}
	
}

/**
 * @name persistDisplay
 * 
 * This class has been created and USED purely to demonstrate
 * inheritance and dependancies
 * 
 * @author Saqib
 */
class persistDisplay extends persist {
	
	/**
	 * @name displayResults
	 * Used to test this class below
	 * @param array $results
	 */
	public function displayResults( $results ) {
		foreach ( $results as $k => $v ) {
			echo "$k=>$v <br />";
		}
	}
}

// Test class
//$dbp = new persistDisplay();
//$dbp->displayResults( $dbp->getTitles() );
//echo "<br /><br />";
//#$dbp->displayResults(  $dbp->getTitlesInfo()  ) ;
//$rst = $dbp->logPurchase('5', 'sdfsdf@szdfsdf.com');
//print_r($rst);
?>

