<?php

// initiating a session
if (!session_id()) {
	session_start();
}

// getting all required facebook graph sdk files
require('./vendor/autoload.php');

// app configurations
// FB APP information needs to be put here
define('APP_ID', '');
define('APP_SECRET', '');
define('GRAPH_VERSION', 'v3.2');
define('APP_URL', 'https://fb.cromex.org');

// initiating a FB instance
$fb = new Facebook\Facebook([
  'app_id' => APP_ID,
  'app_secret' => APP_SECRET,
  'default_graph_version' => GRAPH_VERSION
]);

//requesting a FB Login Helper
$helper = $fb->getRedirectLoginHelper();

//requesting user access token
$accessToken = $helper->getAccessToken();

if (isset($accessToken) || isset($_SESSION['fb_token'])) {
	$_SESSION['fb_token'] = isset($accessToken) ? (string) $accessToken : $_SESSION['fb_token'];

	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		header('Location: ./');
	}

	// checking if user access token is not valid then ask user to login again
	$debugToken = $fb->get('/debug_token?input_token='. $_SESSION['fb_token'], APP_ID . '|' . APP_SECRET)
	->getGraphNode()
	->asArray();

	if (isset($debugToken['error']['code'])) {
		unset($_SESSION['fb_token']);
		$loginUrl = $helper->getLoginUrl(APP_URL);
		echo '<a href="' . $loginUrl . '"><i class="fas fa-sign-in-alt">Log in with Fcebook!</a>';
		exit;
	}


	// setting default user access token for future requests
	$fb->setDefaultAccessToken($_SESSION['fb_token']);
		//echo "The access token used is: " . $_SESSION['fb_token'];



	// printing public user info as an array
	$user = $fb->get('/me')
		->getGraphNode()
		->asArray();
	//print_r($user);

	$userpic = $fb->get('me/picture?redirect=0')->getGraphNode()->asArray();

  $loggedin = 1;
	echo "





<div class='button-content'>

	<div class='home'>
	<a href='./'>
<i class='fas fa-home'></i>
</a>
</div>


		<div class='push logged'>$user[name] </i></div>


<div class='profilepic'> <img class='pure-img-responsive userpic' src='$userpic[url]' alt='$user[name]'></div>


	</div>

	 ";


 } else {
   $loggedin = 0;

   $permissions = array("publish_video", "publish_pages", "manage_pages", "publish_to_groups", "user_videos");

 	// making login with facebook url
   $loginUrl = $helper->getLoginUrl(APP_URL, $permissions);
   //echo '<a href="' . $loginUrl . '">Log in wh Facebook!</a>';
 }


?>
