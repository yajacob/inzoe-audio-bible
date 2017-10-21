<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/lib/db.mysql.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/lib/common.lib.php");

$db = new Db();    
$mac_addr = GetClientMacForWinServer();

// Quote and escape form submitted values
$pbook_name = $db -> quote($_REQUEST['pbook_name']);
$pchap_no   = $db -> quote($_REQUEST['pchap_no']);
$pageUri    = $db -> quote($_SERVER['REQUEST_URI']);
$ip_addr    = $db -> quote($_SERVER["REMOTE_ADDR"]);
$mac_addr   = $db -> quote($mac_addr);
$logDate    = $db -> quote(date('YmdHis'));

// Insert the values into the database
$sql = "INSERT INTO _log_play_bible (book_name, chap_no, ip_addr, mac_addr, logdate) ";
$sql.= "VALUES ($pbook_name, $pchap_no, $ip_addr, $mac_addr, $logDate)";
$result = $db -> query($sql);
echo $result;
?>