<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pitstream Mobile Creator</title>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


    <!--
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">
    <link rel="stylesheet" href="grids-responsive-min.css">
    -->

    <link rel="stylesheet" href="pure-min.css">
    <link rel="stylesheet" href="fblc.css">

</head>

<body>
  <div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal psheader">
      <img class="pure-img-responsive psheaderimg" src="pslogo.jpg" alt="Pitstream">

    </div>
    <div class="home-menu pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list"><li class="pure-menu-item logged">




<?php

//check if page was opened directly. If no Page ID has been passed, redirect to start
if (empty($_GET[pageid])) {
  header('Location: ./');
}

// initiating a session
if (!session_id()) {
	session_start();
}

// getting all required facebook graph sdk files
require('./vendor/autoload.php');

// app configurations
// FB APP information needs to be put here
define('APP_ID', '233920717367739');
define('APP_SECRET', '7f5eb36b77971f1007337fcf04b23cc2');
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
		echo '<a href="' . $loginUrl . '"><i class="fas fa-sign-in-alt">Log in with Facebook!</a>';
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
	 echo "You are logged in as $user[name]";


?>

</li>
</ul>
</div>
<div class="home-menu pure-menu pure-menu-horizontal">
						<ul class="pure-menu-list">
								<li class="pure-menu-item"><a href="#" class="pure-menu-link">Select Page</a></li>

								<li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Define</a></li>

								<li class="pure-menu-item"><a href="#" class="pure-menu-link">Get RTMP Links</a></li>
						</ul>
</div>
</div>




	<?php
	//echo "</br>Received PageID $_GET[pageid] ";

	$pagetoken = $fb->get('/' . $_GET[pageid] . '?fields=access_token')->getGraphNode()->asArray();
		//print_r ($pagetoken);



	$page = $fb->get('/' . $_GET[pageid])->getGraphNode()->asArray();
	// echo "</br>You are creating a Live Event for $page[name] with PageID  $page[id] ";

	 ?>

	 <div class="content">
           <h2 class="content-head is-center">Create Live Event</h2>
                           <form class="pure-form pure-form-stacked" method="POST" action="create.php">
                               <fieldset>
                                   <label for="pagetoken">Page Token</label>
                                   <input type="text" name="pagetoken" id="pagetoken" value="<?php echo $pagetoken[access_token] ?>" readonly="readonly">

                                   <label for="page">Page</label>
                                   <input type="text" name="page" id="page" value="<?php echo $page[name] ?>" readonly="readonly">

                                   <label for="pageid">Page ID</label>
                                   <input type="text" name="pageid" id="pageid" value="<?php echo $page[id] ?>" readonly="readonly">

                                   <label for="title">Title</label>
                                   <input type="text" name="title" id="title">

                                   <label for="description">Description</label>
                                   <input type="text" name="description" id="description">

                                   <button type="submit" class="pure-button button-create" > <i class="fas fa-video"></i>    Create Event</button>
                               </fieldset>
                           </form>
     </div>

	<?php


} else {
	// making login with facebook url
	$loginUrl = $helper->getLoginUrl(APP_URL);
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}

?>
