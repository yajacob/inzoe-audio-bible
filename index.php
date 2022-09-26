<html>
<script type="text/javascript">
window.onload = function () {
	let timestamp = localStorage.getItem("access_bible");
	let loginFlag = false;

	if (timestamp) {
		let now = new Date().getTime();
		let diff = now - timestamp;
		if (diff < 1000 * 60 * 60 * 24) {
			loginFlag = true;
		}
	}

	if (!loginFlag) {
		let person = prompt("Please enter access code:");
		if (person == "0153") {
			localStorage.setItem("access_bible", new Date().getTime());
      window.location.href = "/main.php";
		} else {
			window.location.href = "/welcome.php";
		}
	}
}
</script>
</html>