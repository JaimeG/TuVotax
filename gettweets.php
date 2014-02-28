<?php
	session_start();
	require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	
	$notweets = 30;
	$consumerkey = "yK8JOWxMao6uo49Vz7wLrQ";
	$consumersecret = "9nXebFU3vlZpAB2uquuq9cZLO1d3nacQqujkWMI78Y";
	$accesstoken = "97114532-v6mktzQJgKNQrPeo9ixPRaINOpuuHm18AmeUc2O9G";
	$accesstokensecret = "Vq2yMtmFo80q7ufGUU6YIa5RFkFqWhPrlhcBrPM7Fg1Xk";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=%23forouno&count=".$notweets."&result_type=recent");	 
	//$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=diedu89&count=".$notweets);
	echo json_encode($tweets);
?>