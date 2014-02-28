<?php
	session_start();
	require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	
	$notweets["recent"] = 30;
	$notweets["popular"] = 10;
	$consumerkey = "yK8JOWxMao6uo49Vz7wLrQ";
	$consumersecret = "9nXebFU3vlZpAB2uquuq9cZLO1d3nacQqujkWMI78Y";
	$accesstoken = "97114532-v6mktzQJgKNQrPeo9ixPRaINOpuuHm18AmeUc2O9G";
	$accesstokensecret = "Vq2yMtmFo80q7ufGUU6YIa5RFkFqWhPrlhcBrPM7Fg1Xk";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}

	$tipo = "recent";
	if(isset($_GET['type'])) $tipo=$_GET['type'];

	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=%23forouno&count=".$notweets[$tipo]."&result_type=mixed");
	//$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=diedu89&count=".$notweets);
	echo json_encode($tweets);
?>