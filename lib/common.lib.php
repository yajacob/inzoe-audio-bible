<?php

/**
 * URL 정보 가져오기
 * @param unknown $url
 * @return unknown
 */
function get_curl($url)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$g = curl_exec($ch);
	curl_close($ch);
	return $g;
}

function GetClientMacForUnixServer() {
    $macAddr=false;
    $arp=`arp -n`;
    $lines=explode("\n", $arp);

    foreach($lines as $line){
        $cols=preg_split('/\s+/', trim($line));

        if ($cols[0]==$_SERVER['REMOTE_ADDR']){
            $macAddr=$cols[2];
        }
    }

    return $macAddr;
}

function GetClientMacForWinServer() {
	ob_start(); // Turn on output buffering
	system('ipconfig /all'); //Execute external program to display output
	$mycom = ob_get_contents(); // Capture the output into a variable
	ob_clean(); // Clean (erase) the output buffer
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); // Find the position of Physical text
	$macAddr = substr($mycom,($pmac+36),17); // Get Physical Address

    return $macAddr;
}

/**
 * SELECT 태그 OPTION 만들기
 */
function select_option($arr_name, $arr_value, $sel_value) {
	$str = "";
	for($i = 0; $i < count($arr_name); $i++) {
		if($arr_value[$i] == $sel_value)
			$str .= "<option value='".$arr_value[$i]."' selected>".$arr_name[$i]."</option>";
		else
			$str .= "<option value='".$arr_value[$i]."'>".$arr_name[$i]."</option>";
	}
	return $str;
}

/**
 * for Debug - 변수확인 - 변수타입, 내용
 * 2016/02/29
 * @param 변수명 $var
 * ex) DEBUG($test);
 */
function DEBUG($var) {
	echo "<br><font color='blue'>[";
	$vtype = gettype($var);
	echo $vtype."]</font>[";

	if($vtype=="NULL")
		echo "This is NULL!";
		else if($vtype=="object")
			echo "This is objective!";
			else if($vtype=="array")
				echo "Array:".print_r($var);
				else
					echo $var;
					echo "]<br>";
}

/**
 * for Debug - 변수확인 - 변수명, 변수타입, 내용
 * 2016/02/29
 * @param 변수명 $var
 * @param 변수명2 $var_name
 * ex) DEBUG2($test, '$test');
 */
function DEBUG2($var, $var_name) {
	echo "<br><font color='red'>".$var_name." </font><font color='blue'>[";
	$vtype = gettype($var);
	echo $vtype."]</font>[";

	if($vtype=="NULL")
		echo "This is NULL!";
		else if($vtype=="object")
			echo "This is objective!";
			else if($vtype=="array")
				echo "Array:".print_r($var);
				else
					echo $var;
					echo "]<br>";
}

function rtn_mobile_chk() {
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone","iPod","IPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini","Windows CE","Nokia","Sony","Samsung","LGTelecom","SKT","Mobile","Phone");
    for($i=0; $i<count($ary_m); $i++){
        if(preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return $ary_m[$i];
            break;
        }
    }
    return "N";
}
?>
