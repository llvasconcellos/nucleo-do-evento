<?
	/*****  ServiceClicks::get  ***************************************
	 *
	 *  $Id: get.php,v 1.4 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_ServiceClicks_LOADED ) == true )
		return ;

	$_OFFICE_GET_ServiceClicks_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceClicks_get_AllTrackingURLs  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 17, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_get_AllTrackingURLs ( &$dbh,
						$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$urls = Array() ;

		$query = "SELECT * FROM chatclicktracking WHERE aspID = $aspid ORDER BY name ASC" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$urls[] = $data ;
			return $urls ;
		}
		return false ;
	}

	/*****  ServiceClicks_get_TrackingURLInfo  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 17, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_get_TrackingURLInfo ( &$dbh,
						$aspid,
						$trackid,
						$key )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" )
			|| ( $key == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatclicktracking WHERE aspID = $aspid AND trackID = $trackid AND unique_key = $key" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceClicks_get_TrackingURLInfoByID  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 17, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_get_TrackingURLInfoByID ( &$dbh,
						$aspid,
						$trackid )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatclicktracking WHERE trackID = $trackid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceClicks_get_TotalTrackingClicks  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 21, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_get_TotalTrackingClicks ( &$dbh,
						$aspid,
						$trackid )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" ) )
		{
			return false ;
		}

		$query = "SELECT SUM(clicks) AS total FROM chatclicks WHERE trackID = $trackid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceClicks_get_TotalTrackingClicksDay  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 21, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_get_TotalTrackingClicksDay ( &$dbh,
						$aspid,
						$trackid,
						$begin,
						$end )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" )
			|| ( $begin == "" ) || ( $end == "" ) )
		{
			return false ;
		}

		$stats = Array() ;

		$query = "SELECT * FROM chatclicks WHERE trackID = $trackid AND aspID = $aspid AND statdate >= $begin AND statdate < $end" ;

		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$stats[] = $data ;
			return $stats ;
		}
		return false ;
	}

	/*****  ServiceClicks_get_TotalTrackingClicksMonth  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Jan 21, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_get_TotalTrackingClicksMonth ( &$dbh,
						$aspid,
						$trackid,
						$begin,
						$end )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" )
			|| ( $begin == "" ) || ( $end == "" ) )
		{
			return false ;
		}

		$stats = Array() ;

		$query = "SELECT SUM(clicks) AS total FROM chatclicks WHERE trackID = $trackid AND aspID = $aspid AND statdate >= $begin AND statdate < $end" ;

		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

?>