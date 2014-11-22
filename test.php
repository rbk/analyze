<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Page with embed code</h1>
	<iframe src="<?php echo base_url; ?>/embed.php" height="0" width="0"></iframe>
	<textarea name="" id="" cols="30" rows="10"><iframe src="<?php echo base_url; ?>/embed.php" height="0" width="0"></iframe></textarea>
</body>
</html>
