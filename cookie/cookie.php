<?php

class cookieMonster {
	
	private $bookCookie = 'books';
	private $bookidurl = 'bookid';
	public $booksViewed = array( ) ;
	
	/**
	 * @name getBookCookie
	 * Returns Cookie Name
	 */
	public function getBookCookie( ) {
		return $this->bookCookie;
	}
	
	/**
	 * @name setBooksCookie
	 * Sets cookie name
	 * @param int $bookid
	 */
	public function setBooksCookie( $bookid ) {
		setcookie( "books[$bookid]", $bookid, time() +3600, '/' );
	}
	
	/**
	 * @name getUrlBookId
	 * NOTE: This function only used in this class for testing purposes.
	 * It is not used in the other classes
	 * 
	 * Returns bookid only if valid parameter is set and is available 
	 * for $_GET
	 * @return int $bookid
	 */
	public function getUrlBookId ( ) {
		$bookid = isset( $_GET[ $this->bookidurl ] ) ? intval( $_GET[ $this->bookidurl ] ) : '' ;
		# return valid id only 
		if ( !$bookid || $bookid == 0 ) {
			return 'Not a Valid Id';
		} else {
			return $bookid;
		}
	}
	
	/**
	 * @name getValidBookCookie
	 * Will check to see if supplied bookid is a valid bookid
	 * and it exists in the database as a valid bookid and
	 * returns the valid bookid for use
	 * @param int $bookid
	 * @return int $bookid
	 */
	public function getValidBookCookie( $bookid ) {
		$bookid = intval($bookid);
		if( $bookid ) {
			if( isset( $_COOKIE[ $this->getBookCookie() ] )  ){
				return $_COOKIE[ $this->getBookCookie() ][$bookid];
			}
		}
	}
	
	/**
	 * @name checkViewedBooks
	 * Checks cookies to see which books have been viewed
	 * @return array booksViewed
	 */
	public function checkViewedBooks( ) {
		if( isset( $_COOKIE[ $this->bookCookie ] ) ) {
			$this->booksViewed = "";
			foreach ( $_COOKIE[ $this->bookCookie ] as $k => $v) {
				$this->booksViewed[$k] = $v;
			}
		}
	}
	/**
	 * @name deleteCookies
	 * Will delete all stored cookies created by this class ...
	 */
	public function deleteCookies( ) {
		$booksCookie = $_COOKIE[ $this->bookCookie ] ; 
		if ( isset( $booksCookie ) ) {
			foreach ( $booksCookie as $k => $v) {
				unset( $v );
				setcookie ($booksCookie[$k], "", time() - 3600);
			}
		}
	}

}





/**
 * Individual Tests below for class - 
 */

/**
$ck = new cookieMonster( );
//$ck->setBooksCookie('4');
$urlid = $ck->getUrlBookId();
#echo $urlid;
$ck->setBooksCookie( $ck->getUrlBookId( ) );
if( $urlid != 0 ){
	$ck->setBooksCookie( $ck->getUrlBookId( ) );
} else {
	echo "Not a valid id";
}

#check for valid cookie saved
$bId = $ck -> getValidBookCookie( $ck -> getUrlBookId() ) ;
echo ">$bId<";
if ($bId != 0 || $bId !='') {
	echo "<pre>Valid $bId </pre>";
} else {
	echo "<pre>Not Valid</pre>";
}

//$ck->deleteCookies();
*/