<?php
	session_start();
	if( !isset($argv[1]) || $argv[1] != "console" ){
		echo "Permission denied";
		exit(0);
	}

	require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	
	$consumerkey = "yK8JOWxMao6uo49Vz7wLrQ";
	$consumersecret = "9nXebFU3vlZpAB2uquuq9cZLO1d3nacQqujkWMI78Y";
	$accesstoken = "97114532-v6mktzQJgKNQrPeo9ixPRaINOpuuHm18AmeUc2O9G";
	$accesstokensecret = "Vq2yMtmFo80q7ufGUU6YIa5RFkFqWhPrlhcBrPM7Fg1Xk";
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);	 

	$counter=0;
	do{
		if($counter % 15 == 0){		
			$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=%23tuvotastvx&count=30&result_type=recent");
			//Check twitter response for errors.
			if ( isset( $tweets->errors[0]->code )) {
			    // If errors exist, print the first error for a simple notification.
			    echo "Error encountered: ".$tweets->errors[0]->message." Response code:" .$tweets->errors[0]->code;
			} else {
			    // No errors exist. Write tweets to json/txt file.
			    $file = "tweets_recent.json";
			    $fh = fopen($file, 'w') or die("can't open file");
			    fwrite($fh, json_encode($tweets));
			    fclose($fh);
			    echo "escribe recientes\n";
			}
		}

		if($counter % 30 == 0){		

			$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=%23tuvotastvx&count=30&result_type=popular-RT");

			//Check twitter response for errors.
			if ( isset( $tweets->errors[0]->code )) {
			    // If errors exist, print the first error for a simple notification.
			    echo "Error encountered: ".$tweets->errors[0]->message." Response code:" .$tweets->errors[0]->code;
			} else {
			    // No errors exist. Write tweets to json/txt file.
			    $file = "tweets_popular.json";
			    $fh = fopen($file, 'w') or die("can't open file");
			    fwrite($fh, json_encode($tweets));
			    fclose($fh);
			    echo "escribe destacados\n";
			}
		}
		echo date('G:i:s') . "<br>\n";
		sleep(1);
	}while($counter++ <= 50);

	echo "terminado";


	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}