<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/asset/css/common.css"/>
<?php
	if(isset($css)){
		foreach ($css as $path) {
			echo '<link rel="stylesheet" type="text/css" href="/asset/css/'.$path.'.css"/> ';
		}
	}
?>
<script type="text/javascript" src="https://static.gabia.com/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
</head>
<body>

	<ul>
		<li><a href="/board/lists"><h3>YHH's Board</h3></a></li>
	</ul>
