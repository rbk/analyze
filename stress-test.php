<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Stress Test</title>
</head>
<body>
	<div id="connections"></div>
	<script>
		var total = 20;
		for( var i=0; i<total; i++ ){
			var iframe = document.createElement('iframe');
			iframe.setAttribute('src', 'http://gurustu.co');
			iframe.style.display = 'none';
			document.getElementById('connections').innerHTML = 'Connections Made: ' + total;
			document.body.appendChild( iframe );
		}

	</script>

	
</body>
</html>
