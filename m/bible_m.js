$(document).ready(init_doc);

function init_doc() {
	fnChangeBook(40);
	
	// 다음곡 실행
	var myaudio = document.getElementById("inzoe_audio");
	myaudio.addEventListener("ended", function (e) {
		var pchap_no  = $("#pchap_no").val();
		var pchap_max = $("#pchap_max").val();
		var next_pchap_no = parseInt(pchap_no) + 1;
		if(next_pchap_no <= pchap_max) fnPlayAudio(next_pchap_no);
	}, true);

}

function fnChangeBType(tmt) {
	if(tmt==1) {
		$("#menu_book_nt").show();
		$("#menu_book_ot").hide();
	}
	else {
		$("#menu_book_nt").hide();
		$("#menu_book_ot").show();
	}
}

function goBack() {
    window.history.back();
}

function setCookie(name,value,interval){
	var expires=new Date();
	expires.setTime(expires.getTime()+ interval);
	document.cookie=name+'='+ value+'; expires='+ expires.toGMTString()+'; path=/';
};

function getCookie(name){
	var cookies=document.cookie.toString().split('; ');
	for(var i=0;i<cookies.length;i++){
		if(cookies[i].split('=')[0]==name)
			return cookies[i].split('=')[1];
	};
	return null;
}

// Chap 설정 for Books
function fnChangeBookType(no) {
	$(".btn_book_type").css("background", "#37a8bb");
	$("#btn_book_type"+no).css("background", "#fc8a5a");
	$("#ptype").val(no);
	$(".chap").css("background", "#2d692d");
	if(no == 1)
		$("#head_book_type").text("성경");
	else if(no == 2)
		$("#head_book_type").text("라스");
	else {
		alert("개발이 진행중입니다.");
		$('#book_type_bl').attr('checked', 'checked');
		return;
	}
	
	pbook_no = $("#pbook_no").val();
	fnChangeBook(pbook_no);
}

// Chap 설정 for Books
function fnChangeBook(no) {
	var pbook_type = $("#ptype").val(); // 1: bible, 2: lifestudy
	var chap_arr = [];
	var book_nm_arr = [];

	// 라이프스터디
	if(pbook_type == 2) {
		var chap_arr = [0,
			120, 185, 64, 53, 30,
			15, 10, 8, 19, 19,
			12, 11, 5, 8, 5,
			5, 3, 38, 45, 8,
			2, 10, 54, 40, 4,
			27, 17, 9, 7, 3,
			1, 1, 4, 1, 3,
			1, 1, 15, 4,
			72, 70, 79, 51, 72, 
			69, 69, 59, 46, 97, 
			62, 65, 24, 7, 12, 
			8, 6, 2, 69, 14, 
			34, 13, 40, 2, 2,
			5, 68
		];
	}
	// 성경
	else {
		chap_arr = [0,
			50, 40, 27, 36, 34,
			24, 21, 4, 31, 24,
			22, 25, 29, 36, 10,
			13, 10, 42, 150, 31,
			12, 8, 66, 52, 5,
			48, 12, 14, 3, 9,
			1, 4, 7, 3, 3,
			3, 24, 21, 4,
			28, 16, 24, 21, 28,
			16, 16, 13, 6, 6,
			4, 4, 5, 3, 6,
			4, 3, 1, 13, 5,
			5, 3, 5, 1, 1,
			1, 22
		];
	}

	book_nm_arr = ["창세기", "출애굽기", "레위기", "민수기", "신명기",
		"여호수아","사사기", "룻기", "사무엘상", "사무엘하",
		"열왕기상", "열왕기하", "역대상", "역대하", "에스라",
		"느헤미야", "에스더", "욥기", "시편", "잠언",
		"전도서", "아가", "이사야", "예레미야", "예레미야애가",
		"에스겔", "다니엘", "호세아", "요엘", "아모스",
		"오바댜", "요나", "미가", "나훔", "하박국",
		"스바냐", "학개", "스가랴", "말라기",
		"마태복음", "마가복음", "누가복음", "요한복음", "사도행전",
		"로마서", "고린도전서", "고린도후서", "갈라디아서", "에베소서",
		"빌립보서", "골로새서", "데살로니가전서", "데살로니가후서", "디모데전서",
		"디모데후서", "디도서", "빌레몬서", "히브리서", "야고보서",
		"베드로전서", "베드로후서", "요한1서", "요한2서", "요한3서",
		"유다서", "요한계시록"];

	book_abbr_arr = ["창", "출", "레", "민", "신",
		"수", "삿", "룻", "삼상", "삼하",
		"왕상", "왕하", "대상", "대하", "스",
		"느", "에", "욥", "시", "잠",
		"전", "아", "사", "렘", "애",
		"겔", "단", "호", "욜", "암",
		"옵", "욘", "미", "나", "합",
		"습", "학", "슥", "말",
		"마", "막", "눅", "요", "행",
		"롬", "고전", "고후", "갈", "엡",
		"빌", "골", "살전", "살후", "딤전",
		"딤후", "딛", "몬", "히", "약",
		"벧전", "벧후", "요일", "요이", "요삼",
		"유", "계"];

	$(".btn_chap").hide();
	chap_cnt = chap_arr[no];
	book_name = book_nm_arr[no-1];
	$(".btn_book").css("background", "#37a8bb");
	$("#book"+no).css("background", "#fc8a5a");
	$("#pbook_no").val(no);
	$(".btn_chap").css("background", "#dddddd");
	$("#pchap_max").val(chap_cnt);

	for(i=0; i<=chap_cnt; i++) {
		$("#chap"+i).show();
	}

	var ptype = $("#ptype").val();
	if(ptype == 1)
		$("#head_book_type").text("성경 / "+ book_name);
	else
		$("#head_book_type").text("라이프스터디/"+ book_name);
}

function fnPlayAudio(pchap_no) {
	var ptype    = $("#ptype").val();
	var pbook_no = $("#pbook_no").val();
	$("#pchap_no").val(pchap_no);
	
	var BOOK_NAME = ["", 
		"GEN", "EXO", "LEV", "NUM", "DEUT", 
		"JOSH", "JUDG", "RUTH", "1-SAM", "2-SAM", 
		"1-KINGS", "2-KINGS", "1-CHRON", "2-CHRON", "EZRA",
		"NEH", "ESTH", "JOB", "PSA", "PROV", 
		"ECCL", "SS", "ISA", "JER", "LAM", 
		"EZEK", "DAN", "HOS", "JOEL", "AMOS", 
		"OBAD", "JONAH", "MIC", "NAH", "HAB",
		"ZEPH", "HAG", "ZECH", "MAL",
		"MATT", 
		"MARK", "LUKE", "JOHN", "ACTS", "ROM",
		"1-COR", "2-COR", "GAL", "EPH", "PHIL",
		"COL", "1-THES", "2-THES", "1-TIM", "2-TIM",
		"TITUS", "PHIL", "HEB", "JAMES", "1-PET",
		"2-PET", "1-JOHN", "2-JOHN", "3-JOHN", "JUDE", "REV"];

	var pbook_name = BOOK_NAME[pbook_no];
	
	$(".btn_chap").css("background", "#dddddd");
	$("#chap"+pchap_no).css("background", "#fc8a5a");

	if(ptype == 1) {
		var sourceUrl = "http://zoeword.ddns.net/dat_bible/";
		if(pbook_no < 10) pbook_no = "BL0" + pbook_no;
		else pbook_no = "BL" + pbook_no;
		pbook_name = pbook_no + "_" + pbook_name;
		sourceUrl += pbook_name + "/" + pbook_name + " (" + pchap_no + ").mp3";
	}
	else {
		var sourceUrl = "http://zoeword.ddns.net/dat_lifestudy/";
		if(pbook_no < 10) pbook_no = "LS0" + pbook_no;
		else pbook_no = "LS" + pbook_no;
		pbook_name = pbook_no + "_" + pbook_name;
		sourceUrl += pbook_name + "/" + pbook_name + " (" + pchap_no + ").mp3";
	}

	writePlayLog(pbook_name, pchap_no);
		
	$("#inzoe_audio").attr("src", sourceUrl);
	$("#inzoe_audio")[0].play();

}

function writePlayLog(pbook_name, pchap_no)
{
	var ajax_url  = "/write_play_log.php";
	var ajax_data = {};
    ajax_data['pbook_name'] = pbook_name;
    ajax_data['pchap_no']   = pchap_no;

    $.ajax({
        async:false,
        type: "POST",
        url: ajax_url,
        data: ajax_data,
        dataType: "text"
    }).done(function( msg ) {
		//alert(msg);
    });

}
