<?php defined('BASEPATH') or exit('No direct script access allowed');
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

function create_github_url()
{
	$url = "https://github.com/login/oauth/authorize?client_id=";
	$client_id = $_ENV['GITHUB_CLIENT_ID'];
	return $url . $client_id . '&scope=repo$scope=user';
}

function get_github_token($code)
{
	$ch = curl_init();
	$url = "https://github.com/login/oauth/access_token";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt(
		$ch,
		CURLOPT_POSTFIELDS,
		"client_id=" . $_ENV['GITHUB_CLIENT_ID'] . "&client_secret=" . $_ENV['GITHUB_CLIENT_SECRET'] . "&code=" . $code . ""
	);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	$explode_1 = explode("&", $result);
	$newArray = [];
	foreach ($explode_1 as $explode_1 => $line) {
		list($key, $value) = explode("=", $line);
		$newArray[$key] = urldecode($value);
	}
	return $newArray;
}

function fetch_github_users($type_token, $access_token)
{
	$ch = curl_init();
	$url = "https://api.github.com/user";
	$headr = array();
	$headr[] = 'Authorization: ' . $type_token . ' ' . $access_token;
	$headr[] = 'user-agent: request';
	$headr[] = 'Content-type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	return $result;
}

function show_github_data($users_array)
{
	$newUsers = array(
		'user_platform_id' => $users_array['id'],
		'user_nama' => $users_array['name'],
		'user_login' => $users_array['login'],
		'user_followers' => $users_array['followers'],
		'user_following' => $users_array['following'],
		'user_location' => $users_array['location'],
		'user_bio' => $users_array['bio'],
		'user_images_assets' => array(
			'user_avatar_url' => $users_array['avatar_url']
		),
		'user_platform' => 'Github',
		'user_created_at' => $users_array['created_at'],
	);
	return $newUsers;
}
