<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

function create_google_url()
{
	$google_client = new Google_Client();
	// $google_client->setAuthConfig('./client_secret.json');
	$google_client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
	$google_client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
	$google_client->setScopes(array(
		"https://www.googleapis.com/auth/userinfo.email",
		"https://www.googleapis.com/auth/userinfo.profile",
	));
	return $google_client->createAuthUrl();
}

function get_google_token($code)
{
	$google_client = new Google_Client();
	$google_client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
	$google_client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
	$google_client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
	return $google_client->fetchAccessTokenWithAuthCode($code);
}

function fetch_google_users($access_token)
{
	$google_client = new Google_Client();
	$google_client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
	$google_client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
	$google_client->setAccessToken($access_token);
	$google_service = new Google_Service_Oauth2($google_client);
	return $google_service->userinfo->get();
}

function revoke_google_token()
{
	$google_client = new Google_Client();
	$google_client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
	$google_client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
	return $google_client->revokeToken();
}

function show_google_data($users_array)
{
	$newUsers = array(
		'user_platform_id' => $users_array['id'],
		'user_nama' => $users_array['name'],
		'user_login' => NULL,
		'user_followers' => NULL,
		'user_following' => NULL,
		'user_location' => NULL,
		'user_bio' => NULL,
		'user_images_assets' => array(
			'user_avatar_url' => $users_array['picture']
		),
		'user_platform' => 'Google',
		'user_created_at' => date('Y-m-d H:i:s'),
	);
	return $newUsers;
}
