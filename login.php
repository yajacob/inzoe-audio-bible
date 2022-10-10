<?php
$person = strtolower($_GET['person']);

if($person) {
  if($person == "0153") {
    setcookie("access_bible", "true", time() + (86400 * 7), "/"); // 86400 = 1 day
    header("Location: /index.php");
  } else {
    header("Location: /login.php");
  }
}
?>
<script>
  var person = prompt("암호를 입력해주세요.", "");
  if (person != null) {
    location.href = "/login.php?person=" + person;
  }
</script>