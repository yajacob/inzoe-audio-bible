<?php
$person = strtolower($_GET['person']);

// person list array
$person_list = ["0728", "lordjesus", "0153", "6644", "1014"];

// 0728 장모님
// 6644 우자매님
// 1014 종은자매님

if ($person) {
  // check if person is in the list
  if (in_array($person, $person_list)) {
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