$(document).ready(init_doc);

function init_doc() {
	fnChangeBook(1);
	$("#search").keypress(function(e) {
		var code = e.which;
		if (code == 13) {
			fnSearchKeyword();
		}
	});
	
	// 다음곡 실행
	var myaudio = document.getElementById("inzoe_audio");
	myaudio.addEventListener("ended", function (e) {
		var pchap_no  = $("#pchap_no").val();
		var pchap_max = $("#pchap_max").val();
		var next_pchap_no = parseInt(pchap_no) + 1;
		if(next_pchap_no <= pchap_max) fnPlayAudio(next_pchap_no);
	}, true);

}

function fnChangeBType(btype) {
	// OT
	if(btype=='OT') {
		$("#book_ot").show();
		$("#book_nt").hide();
	}
	else {
		$("#book_ot").hide();
		$("#book_nt").show();
	}
	fnChangeBook();
}

// Chap 설정 for Books
function fnChangeBook() {
	var book_chap_cnt = [0,
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
		1, 22];

	cno = book_chap_cnt[$("#books").val()-1];
	
	$('#chap_no').empty();
	for(i = 1; i <= cno; i++)
		$("#chap_no").append("<option value=" + i + ">" + i + "</option>");
	
}

function fnSearchKeyword() {
	var tform = document.form1;
	var keyword = $.trim($("#keyword").val());
	if(keyword == "") alert("Type a keyword for searching!");
	$("#mode").val("search");
	tform.submit();
}

function fnRead() {
	var tform = document.form1;
	var book_no = "";
	$("#mode").val("chap");
	
	var btype= $('input[name="btype"]:checked').val();
	if(btype == "OT") book_no = $("#book_ot").val();
	else book_no = $("#book_nt").val();
	
	$("#book_no").val(book_no);
	tform.submit();
}

function fnReadVerChap(dbfile, book_no, chap_no) {
	var tform = document.form1;

	$("#mode").val("chap");
	$("#bibleDB1").val(dbfile);
	$("#book_no").val(book_no);
	$("#chap_no").val(chap_no);
	tform.submit();
}

function fnReadChap(book_no, chap_no) {
	var tform = document.form1;
	
	$("#mode").val("chap");
	$("#book_no").val(book_no);
	$("#chap_no").val(chap_no);
	tform.submit();
}

function fnCompVer(book_no, chap_no, ver_no) {
	var tform = document.form1;
	$("#mode").val("verse");
	$("#book_no").val(book_no);
	$("#chap_no").val(chap_no);
	$("#ver_no").val(ver_no);
	tform.submit();
}

function goBack() {
    window.history.back();
}

function goOrg(book_abbr, book_no, chap_no) {
	// OT
	if(book_no < 40) org_url = "http://www.scripture4all.org/OnlineInterlinear/OTpdf/";
	// NT
	else org_url = "http://www.scripture4all.org/OnlineInterlinear/NTpdf/";
	org_url += book_abbr + chap_no + ".pdf";
	
	// alert(org_url);

    window.open(org_url,'_blank');
}

function fnAbbrHelp(lang) {
	if(lang=="KO")
		alert("*요절검색 기본사용방법\n" +
				"1. [요 3:16] 책이름 약어 뒤 공백이 한칸 필요합니다.\n" +
				"2. [요 3:16;마 1:1]책 사이의 구분자는 ';'입니다.\n" +
				"3. [요 3:16-17]범위는 '-'문자로 표시합니다.\n" +
				"4. [요 3:16,19]절의 구분자는 ','입니다.");
	else
		alert("* How to use for abbreviation\n" +
				"1. [Joh 3:16] a space needed after the book's abbr.\n" +
				"2. [Joh 3:16;Mat 1:1] use ';' to seperate books.\n" +
				"3. [Joh 3:16-17] use '-' for multiple continuous verses.\n" +
				"4. [Joh 3:16,19] use ',' for multiple seperated verses.");
	return false;
}

function fnLogin() {
	location.href = "/bible/login.php";
}

function fnLogin2() {
	$( "#dialog" ).dialog();
}

function fnLogout() {
	location.href = "/bible/logout.php";
}

function fnLifeStudy() {
	location.href = "/app?do=ls";
}

function fnReadBible() {
	location.href = "/app";
}

function fnSearchTitle() {
	var tform = document.form1;
	$("#mode").val("search_title");
	tform.submit();
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

function resizeText(multiplier) {
	var cookie_duration = 30*24*60*60*1000; 
	if (document.getElementById('div').style.fontSize == "") {
		var size = getCookie('font-size');
		if(size)
			document.getElementById('div').style.setProperty('font-size',size,'important');
		else
			document.getElementById('div').style.setProperty('font-size','1.0em');
	}
	document.getElementById('div').style.setProperty('font-size',parseFloat(document.getElementById('div').style.fontSize) + (multiplier * 0.1) + 'em', 'important');
	setCookie('font-size', document.getElementById('div').style.fontSize,cookie_duration);
}

document.addEventListener("DOMContentLoaded", function(event) {
	resizeText(0)
});

// Chap 설정 for Books
function fnChangeBookType(no) {
	$(".btn_book_type").css("background", "#07889b");
	$("#btn_book_type"+no).css("background", "#fc4a1a");
	$("#ptype").val(no);
	$(".chap").css("background", "#2d692d");

	pbook_no = $("#pbook_no").val();
	fnChangeBook(pbook_no);
}

// Chap 설정 for Books
function fnChangeBook(no) {
	var pbook_type = $("#ptype").val(); // 1: bible, 2: lifestudy
	var chap_arr = [];

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

	$(".btn_chap").hide();
	chap_cnt = chap_arr[no];
	$(".btn_book").css("background", "#07889b");
	$("#book"+no).css("background", "#fc4a1a");
	$("#pbook_no").val(no);
	$(".btn_chap").css("background", "#565656");
	$("#pchap_max").val(chap_cnt);

	for(i=0; i<=chap_cnt; i++) {
		$("#chap"+i).show();
	}
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
	
	$(".btn_chap").css("background", "#565656");
	$("#chap"+pchap_no).css("background", "#fc4a1a");

	if(ptype == 1) {
		var sourceUrl = "http://bible.ddns.net/dat_bible/";
		if(pbook_no < 10) pbook_no = "BL0" + pbook_no;
		else pbook_no = "BL" + pbook_no;
		pbook_name = pbook_no + "_" + pbook_name;
		sourceUrl += pbook_name + "/" + pbook_name + " (" + pchap_no + ").mp3";
	}
	else {
		var sourceUrl = "http://bible.ddns.net/dat_lifestudy/";
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
