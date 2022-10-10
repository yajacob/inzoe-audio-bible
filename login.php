<?php
$person = strtolower($_POST['person']);

if($person) {
  if($person == "0153") {
    setcookie("access_bible", "true", time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Location: /main.php");
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