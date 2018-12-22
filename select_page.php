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


</ul>
</div>
</div>

<div class="content">

	<h2 class="content-head is-center">Select a page</h2>
	<div class="pagelist">

<?php




	//requesting list of pages managed by user (requires permission)
	$pages = $fb->get('/me/accounts')->getGraphEdge()->asArray();


//listing pages managed by user
//echo "</br>Please select the Page you want to create a Live Video Event for:";
//echo "<table cellpadding='10' cellspacing'10' border='1'>";
//echo "<tr> <th>Name</th> <th>id</th> <th>access_token</th> <th>category</th> <th>tasks</th> </tr>";
foreach($pages as $page) {

	//print_r ($page);

	$pagepic = $fb->get('/' . $page[id] . '/picture?redirect=0')->getGraphNode()->asArray();

	//print_r ($page[tasks]);



    echo "


	<a href=./define.php?pageid=$page[id]>
		<button class='button-page pure-button'>
	  <div class='button-content'>
	<div> <img class='pure-img-responsive' src='$pagepic[url]' alt='$page[name]'></div>
	<div class='page'>$page[name]</div>

	<div class='push forbidden'>Permissions  <i class='fas fa-times-circle'></i></div>

	</div>

	 </button></a>


	";
}



	//print_r($pages);
	//print_r($pages[2][id]);
	//var_dump($pages[2][id]);

} else {

  $permissions = array("publish_video", "publish_pages", "manage_pages", "publish_to_groups");

	// making login with facebook url
  $loginUrl = $helper->getLoginUrl(APP_URL, $permissions);
  	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}

?>




</div>

</body>
</html>
