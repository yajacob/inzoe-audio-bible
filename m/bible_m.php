<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>in ZOE Life</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<!--jQuery 사용-->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
	<!--jQuery Mobile -->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="./bible_m.js" type="text/javascript"></script>
	<!--link href="./docs/main.css" rel="stylesheet" type="text/css"-->
	<!--link href="./bible.css" rel="stylesheet" type="text/css"-->
<style>
.btn_book {
	background-color: #07889b; 
	color: #ffffff;
	width: 50px;
	margin: 4px;
	padding: 5px;
}

.btn_book_on {
	background-color: #fc4a1a; 
}

.btn_chap {
	background-color: #565656; 
	color: #ffffff;
	width: 50px;
}

.btn_chap_on {
	background-color: #fc4a1a; 
}
</style>
</head>
<body>
	<div data-role="page" id="page">
<input type="hidden" id="ptype" name="ptype" value="1">
<input type="hidden" id="pbook_no" name="pbook_no" value="1">
<input type="hidden" id="pchap_no" name="pchap_no">
<input type="hidden" id="pchap_max" name="pchap_max">
		<!--메뉴 패널-->
		<div data-role="panel" id="panel">
			<a href="#" data-rel="close" class="ui-btn ui-corner-all ui-icon-delete ui-btn-icon-notext"></a>
			<!--h1>Menu</h1-->
			<div data-role="controlgroup" data-type="horizontal" style="margin-left:48px;">
				<a href="#" class="ui-btn" onClick="fnChangeBType(1)">  신 약  </a>
				<a href="#" class="ui-btn" onClick="fnChangeBType(2)">  구 약  </a>
			</div>

			<div id="menu_book_ot" class="menu_books" style="display:none;">
<?
	$class_style="btn book btn_on";
	// 구약
	for ($i=0; $i<count($BAbbrKorOT); $i++) {
		//$num = sprintf('%02d', $i+1);
		$num = $i + 1;
		if($i==0) $class_style="ui-btn ui-btn-inline ui-mini btn_book btn_on";
		else $class_style="ui-btn ui-btn-inline ui-mini btn_book";

		echo "<button type='button' id='book$num' class='$class_style' style='color:#555555;width:50px;-moz-box-shadow: none !important;' onClick='fnChangeBook($num)'>$BAbbrKorOT[$i]</button>";
	}
?>
			</div>
			<div id="menu_book_nt" class="menu_book">
<?
	// 신약
	for ($i=0; $i<count($BAbbrKorNT); $i++) {
		$num = $i + 40;
		echo "<button type='button' id='book$num' class='$class_style' style='color:#555555;width:50px;-moz-box-shadow: none !important;' onClick='fnChangeBook($num)'>$BAbbrKorNT[$i]</button>";
	}
?>
			</div>
		</div>
		<!--상단 바-->
		<div data-role="header" id="header">
			<h1 id="head_book_type">성 경</h1>
			<!--메뉴버튼-->
			<a href="#panel" data-icon="grid" id="menu">Menu</a>
			<!--SET BOOK-->
			<a href="#set_book" data-rel="dialog" data-icon="gear">Book</a>
		</div>
		<!--본문-->
		<div data-role="content">
			<audio id="inzoe_audio" class="audio" style="width:100%;" src="http://zoeword.ddns.net/dat_bible/BL40_MATT/BL40_MATT (1).mp3" controls autoplay></audio><br>

<?
	for ( $i=1; $i<=150; $i+=1) {
		echo "<a href='javascript:fnPlayAudio($i);' id='chap$i' class='ui-btn ui-btn-inline ui-mini btn_chap' style='padding:8px; width:38px;'>$i</a>";
	}
?>
		</div>
		<div data-role="footer" id="footer"></div>
	</div>
	<!--로그인 다이얼로그창-->
	<div data-role="page" id="set_book">
		<div data-role="header">
		   <h1>Set Book</h1>
		</div>
		<div data-role="content">
			<div data-role="fieldcontain">
				<label for="book_type_bl">성경</label>
				<input type="radio" name="book_type" id="book_type_bl" value="1" checked="checked" onClick="fnChangeBookType(1);" />
				<label for="book_type_ls">라이프스터디</label>
				<input type="radio" name="book_type" id="book_type_ls" value="2" onClick="fnChangeBookType(2)" />
				<label for="book_type_hm">찬송</label>
				<input type="radio" name="book_type" id="book_type_hm" value="3" disabled />
			</div>
		</div>
		<div data-role="footer"></div>
	</div>
</body>
</html>