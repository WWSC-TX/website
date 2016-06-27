<?php
if(isset($_GET['u'])) {
	$uri = $_GET['u'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $uri);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$text = curl_exec($ch);
	echo $text;
}