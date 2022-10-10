<?
	include_once ($_SERVER['DOCUMENT_ROOT']."/lib/mobile_detect/Mobile_Detect.php");
	$detect = new Mobile_Detect;

	// login check
	if (isset($_COOKIE['access_bible'])) {
		if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
			include_once("./bible.php");
		}
		else if ( $detect->isMobile() ) {
			include_once("./bible_m.php");
		}
		else if( $detect->isTablet() ){
			include_once("./bible.php");
		}
		else {
			include_once("./bible.php");
		}
	}
	else {
		include_once("./login.php");
	}
?>
