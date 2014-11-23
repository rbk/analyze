<?php
// echo phpinfo(INFO_VARIABLES);
// extract( $_SERVER );
// echo $_COOKIE['PHPSESSID'];
// echo $HTTP_USER_AGENT;
// echo '<h1>' . $REQUEST_TIME . '</h1>';
// echo '<h1>' . $REQUEST_TIME_FLOAT . '</h1>';
// echo $REQUEST_SCHEME;
// echo $HTTP_HOST;
// die();
	require 'config.php'; 
	// $iourl = get_headers( io_url );
	// echo ( $iourl ) ? 'test' : die();
	// $check = file_get_contents( io_url );
	// echo $check;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<pre>
		<?php
		// print_r( $_SERVER );
?>
	</pre>

	<h1>Page with embed code</h1>
	<iframe src="<?php echo base_url; ?>/embed.php" height="0" width="0"></iframe>
	<!-- <textarea name="" id="" cols="30" rows="10"><iframe src="<?php echo base_url; ?>/embed.php" height="0" width="0"></iframe></textarea> -->
</body>
</html>
