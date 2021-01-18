<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="JB.css" />
<title>JB Pizza Company</title>
</head>
<body onload="showAll()">
<?php
session_start();
?>
	<div id="header"></div>
	<div id="title">
		<h1>
			<i>JB Pizza Company</i>
		</h1>
	</div>

	<div class='menubar'>
	<?php

if (! isset($_SESSION['user'])) {
    echo "<a class=\"buttons\" href=\"index.php\">Home</a>  ";
    echo "<a class=\"buttons\" href=\"register.php\">Register</a>  ";
    echo "<a class=\"buttons\" href=\"login.php\">Login</a>";
} else {
    echo "<a class=\"buttons\" href=\"index.php\">Home</a>  ";
    
    echo "<form action=\"controller.php\" method=\"POST\">
		<input class=\"buttons\" style=\"float: right;\"  type=\"submit\" name=\"logout\" value=\"Logout\">
	</form>";
    
    echo "<form action=\"controller.php\" method=\"POST\">
			<input class=\"buttons\" style=\"float: right;\" type=\"submit\" name=\"cart\"
				value=\"Shopping Cart\">
		</form>";
    echo "<br> <div id=\"msg\">" . $_SESSION['message'] . "</div>";
    $_SESSION['message'] = "";
}
?>
	</div>

	<div class="cart"> <?php

if (isset($_SESSION['cartmsg'])) {
    echo $_SESSION['cartmsg'];
    echo "<form action=\"controller.php\" method=\"POST\">
			<input class=\"buttons\" style=\"float: right;\" type=\"submit\" name=\"purchase\"
				value=\"Purchase\">
		</form>";
    echo "<form action=\"controller.php\" method=\"POST\">
			<input class=\"buttons\" style=\"float: right;\" type=\"submit\" name=\"clear\"
				value=\"Clear Cart\">
		</form>";
}
?> </div>
	<div id="allPizzas"></div>

	<script>
	var elementToChange = document.getElementById("allPizzas");	
	function showAll() {
		var index = -1;
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "JB.php?index=" + index, true);
		ajax.send();
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				var arr = JSON.parse(ajax.responseText);
				var str = ''
				for (var i = 0; i < arr.length; i++) {
						str += '<div class=pizza><img class="tabs" src=' + arr[i] + ' alt=Cover Picture onclick=info(' + i + ')></div>';
				}
				elementToChange.innerHTML = '<center>'+str+'</center>'
			}
		}
	}
	
	function info(x) {
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "JB.php?index=" + x, true);
		ajax.send();
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				var arr = JSON.parse(ajax.responseText);
			}
			elementToChange.innerHTML = '<div class="onepizza"><img class="profile" src='+arr[0]+' alt=Cover Picture><div class=thedetails><b>'
			+arr[1]+'</b><br>'+arr[2]+'<p>'+arr[3]+'</p><b>' + 
			"<form action=\"controller.php\" method=\"POST\"> Quantity <input type=\"number\" value=\"1\" name=\"amt\" min=\"1\" max=\"10\"> <input type=\"submit\" name=\"addItem\" value=\"Add to cart\"> <input name=\"pzID\" type=\"hidden\" value=" + x + "> </form></div></div>";
		}
		reviews(x);
	}

	function reviews(x) {
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "controller.php?function=getReviews");
		ajax.send();
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				var reviews = JSON.parse(ajax.responseText);
				var ss = reviews[x];
				var res = ss['reviews'].split("+");
				var xx = res[0].split(',');
				var yy = res[1].split(',');
				var zz = res[2].split(',');
				var str = '';
				elementToChange.innerHTML += '<div class=reviews><ul><li>' + '*'.repeat(parseInt(xx[1].substring(1, 2))) + '<ul><li>' + xx[0].substring(1, xx[0].length) + '</li></ul>'
				+ '<li>' + '*'.repeat(parseInt(yy[1].substring(1, 2))) + '<ul><li>' + yy[0].substring(1, yy[0].length) + '</li></ul>'
				+ '<li>' + '*'.repeat(parseInt(zz[1].substring(1, 2))) + '<ul><li>' + zz[0].substring(1, zz[0].length) + '</li></ul></ul></div>';
				console.log(str);
				return str;
			}
		}
	}
			
	</script>
</body>
</html>