<?php

$name = isset($_GET['name']) ? $_GET['name'] : false;
$age = isset($_GET['age']) ? $_GET['age'] : false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Testform</title>
	<meta charset="UTF-8" />


	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
</head>

<body>

	<?php

	// Name sent in
	if ($name) {
		echo '<header class="site-header" id="header">
        		<h1 class="site-headertitle" data-lead-id="site-header-title">Dankuwel ' . htmlentities($name) . '</h1>
    			</header>
		<div>  </div>
    <div class="main-content">
		<i class="fa fa-thumbs-up" style="font-size:48px"></i>
        <p class="main-contentbody" data-lead-id="main-content-body">Dankuwel voor alles flink in te vullen :)</p>
    </div>';
	}



	?>

	<div id="debug">

	</div>

</body>

</html>