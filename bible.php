<?php header("Content-type: text/html; charset=UTF-8");
	$pgm = "/bible.php";
	$pgm = "/app";
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>inZOE BIBLE</title>
<link rel="shortcut icon" href="/images/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="/images/favicon/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="/images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
<link rel="manifest" href="/images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
<link href="bible.css" rel="stylesheet" type="text/css"> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="bible.js"></script>
<SCRIPT language="javascript" type="text/javascript">
/*
var myaudio = document.getElementById("inzoe_audio");
myaudio.addEventListener("ended", function (e) {
	alert('test');
	var pchap_no  = $("#pchap_no").val();
	var pchap_max = $("#pchap_max").val();
	var next_pchap_no = pchap_no + 1;
	if(next_pchap_no <= pchap_max) fnPlayAudio(next_pchap_no);
}, true);
*/
</script>
</head>
<body><div class="wrapper" id="top">
		<div class="main_head">
		<div class="main">
			<div class="main_head_left">
				<input type="hidden" id="ptype" name="ptype" value="1">
				<input type="hidden" id="pbook_no" name="pbook_no" value="1">
				<input type="hidden" id="pchap_no" name="pchap_no">
				<input type="hidden" id="pchap_max" name="pchap_max">
				<button type='button' id="btn_book_type1" class='btn_book_type btn_book_type_on' onClick='fnChangeBookType(1)'>성경</button>
				<button type='button' id="btn_book_type2" class='btn_book_type' onClick='fnChangeBookType(2)'>라이프스터디</button>
			</div>
			<div class="main_head_right">
				<audio id="inzoe_audio" class="audio" src="" controls autoplay></audio>
			</div>
        </div></div>
        <!-- ./search options -->
        
<section>
<div id="mid-container">
	<div class="main">
		<div class="blank_height_5"></div>
		<div class="left-panel">
			<div class="book_reader">
<div class="main_container">
	<div class="main_left_book">
		<div class="left_book_ot">
<?
$BAbbrKorOT = array("창", "출", "레", "민", "신",
		"수", "삿", "룻", "삼상", "삼하",
		"왕상", "왕하", "대상", "대하", "스",
		"느", "에", "욥", "시", "잠",
		"전", "아", "사", "렘", "애",
		"겔", "단", "호", "욜", "암",
		"옵", "욘", "미", "나", "합",
		"습", "학", "슥", "말");

$BAbbrKorNT = array(
		"마", "막", "눅", "요", "행",
		"롬", "고전", "고후", "갈", "엡",
		"빌", "골", "살전", "살후", "딤전",
		"딤후", "딛", "몬", "히", "약",
		"벧전", "벧후", "요일", "요이", "요삼",
		"유", "계");

	$class_style="btn book btn_on";
	// 구약
	for ($i=0; $i<count($BAbbrKorOT); $i++) {
		//$num = sprintf('%02d', $i+1);
		$num = $i + 1;
		if($i==0) $class_style="btn btn_book btn_on";
		else $class_style="btn btn_book btn_on";

		echo "<button type='button' id='book$num' class='$class_style' onClick='fnChangeBook($num)'>$BAbbrKorOT[$i]</button>";
	}
?>
		</div>
		<div class="left_book_nt">
<?
	// 신약
	for ($i=0; $i<count($BAbbrKorNT); $i++) {
		$num = $i + 40;
		echo "<button type='button' id='book$num' class='$class_style' onClick='fnChangeBook($num)'>$BAbbrKorNT[$i]</button>";
	}
?>
		</div>
	</div>
	<div class="main_right_list">
<?
	for ( $i=1; $i<=150; $i+=1) {
		echo "<button type='button' id='chap$i' class='btn btn_chap' onClick='fnPlayAudio($i)'>$i</button>";
	}
?>
	</div>
	<!--div class="main_list">
	</div-->
</div>
			</div>						
		</div>
	</div>
</div>
</section>
</div>
	
</body></html>

</body>
</html>
