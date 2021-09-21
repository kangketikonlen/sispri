<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Abraham\TwitterOAuth\TwitterOAuth;

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

function create_twitter_url()
{
	$OAUTH_CALLBACK = base_url('portal/twitter_callback');
	$CONSUMER_KEY = $_ENV['CONSUMER_KEY'];
	$CONSUMER_SECRET = $_ENV['CONSUMER_SECRET'];
	$access_token = $_ENV['ACCESS_TOKEN'];
	$access_token_secret = $_ENV['ACCESS_TOKEN_SECRET'];
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token, $access_token_secret);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $OAUTH_CALLBACK));
	return $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
}

function get_twitter_users()
{
	$CONSUMER_KEY = $_ENV['CONSUMER_KEY'];
	$CONSUMER_SECRET = $_ENV['CONSUMER_SECRET'];
	$access_token = $_ENV['ACCESS_TOKEN'];
	$access_token_secret = $_ENV['ACCESS_TOKEN_SECRET'];
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token, $access_token_secret);
	return $connection->get("account/verify_credentials");
}

function show_twitter_data($users_array)
{
	$newUsers = array(
		'user_platform_id' => $users_array['id'],
		'user_nama' => $users_array['name'],
		'user_login' => $users_array['screen_name'],
		'user_followers' => $users_array['followers_count'],
		'user_following' => $users_array['statuses_count'],
		'user_location' => $users_array['location'],
		'user_bio' => $users_array['description'],
		'user_images_assets' => array(
			'user_avatar_url' => $users_array['profile_image_url_https']
		),
		'user_platform' => 'Twitter',
		'user_created_at' => $users_array['created_at'],
	);
	return $newUsers;
}
