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


if (empty($_POST[pageid])) {
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

								<li class="pure-menu-item"><a href="#" class="pure-menu-link">Define</a></li>

								<li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Get RTMP Links</a></li>
						</ul>
</div>
</div>



<?php

	/*Printing values received via POST
	echo "</br>Received PageID $_POST[pageid] ";
	echo "</br>Received Title $_POST[title] ";
	echo "</br>Received Desription $_POST[description] ";
	echo "</br>Received Token $_POST[pagetoken] ";



	echo "</br></br></br></br></br>";



	echo "</br>The page access token received is: " . $_POST['pagetoken'];*/

	//retreiving page access token


	//echo "</br>The page access token retreived is: " . $pagetoken[access_token];
	//print_r ($pagetoken);


	//echo "</br></br></br></br></br>";




	//Really necessary?
	//$pageid = $_POST[pageid];





	//$token = $_SESSION['fb_token'];
	//echo "The Token is  $token";

	//Retreiving Page Access Token once again, really necessary??
	$pagetoken = $fb->get('/' . $_POST[pageid] . '?fields=access_token')->getGraphNode()->asArray();

	//Creating Live Event using retreived Page Access Token and received Page ID, Title and Desciption
	try {
  // Returns a `FacebookFacebookResponse` object
   $response = $fb->post('/' . $_POST[pageid] . '/live_videos',  array (title => $_POST[title], description => $_POST[description]), $pagetoken[access_token] );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$livevideo = $response->getGraphNode()->asArray();
//echo "</br>The Live Video Event was created:";
//print_r ($livevideo);



$broadcastid = $livevideo[id];
$rtmpurl = $livevideo[stream_url];
$rtmpsurl = $livevideo[secure_stream_url];




?>




<div class="content">


  <script src="https://unpkg.com/clipboard@2.0.0/dist/clipboard.min.js"></script>

  <script>
     var clipboard = new ClipboardJS('.btn');
     clipboard.on('success', function(e) {
         console.log(e);
     });
     clipboard.on('error', function(e) {
         console.log(e);
     });
     </script>


     <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '233920717367739',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


     <h2 class="content-head is-center">Go Live</h2>


      <div class="infobox"
         <label class="pure-form">
            You Facebook Live Event was created. Now you can copy your RTMP Link to your Encoder App. If your Livestream is not automatically published, you can use to Go Live button to publish it.
          </label>


          <label class="copylabel" for="rtmplink">RTMP Link</label>
          <div class="input-group">
            <input class="copyinput" type="text" name="rtmplink" id="rtmplink" value="<?php echo $rtmpurl ?>" readonly="readonly">
            <span class="input-group-button">
              <button class="pure-button ctc-button" type="button" data-clipboard-target="#rtmplink">
                <i class="fas fa-clipboard-list"></i>Copy to Clipboard
              </button>
            </span>
          </div>

          <label class="copylabel" for="rtmpslink">RTMPS Link</label>
          <div class="input-group">
            <input class="copyinput" type="text" name="rtmpslink" id="rtmpslink" value="<?php echo $rtmpsurl ?>" readonly="readonly">
            <span class="input-group-button">
              <button class="pure-button ctc-button" type="button" data-clipboard-target="#rtmpslink">
                <i class="fas fa-clipboard-list"></i>Copy to Clipboard
              </button>
            </span>
          </div>

          <label class="copylabel" for="serverurl">Server URL</label>
          <div class="input-group">
            <input class="copyinput" type="text" name="serverurl" id="serverurl" value="Parser not yet implemented" readonly="readonly">
            <span class="input-group-button">
              <button class="pure-button ctc-button" type="button" data-clipboard-target="#serverurl">
                <i class="fas fa-clipboard-list"></i>Copy to Clipboard
              </button>
            </span>
          </div>

          <label class="copylabel" for="streamkey">Stream Key</label>
          <div class="input-group">
            <input class="copyinput" type="text" name="streamkey" id="streamkey" value="Parser not yet implemented" readonly="readonly">
            <span class="input-group-button">
              <button class="pure-button ctc-button" type="button" data-clipboard-target="#streamkey">
                <i class="fas fa-clipboard-list"></i>Copy to Clipboard
              </button>
            </span>
          </div>






												<form class="pure-form pure-form-stacked" method="POST" action="publish.php">
														<fieldset>
																<label for="eventid">Event ID</label>
																<input type="text" name="pagetoken" id="pagetoken" value="<?php echo $livevideo[id] ?>" readonly="readonly">

                                <label for="title">Title</label>
																<input type="text" name="title" id="title" value="<?php echo $livevideo[title] ?>" readonly="readonly">

																<label for="description">Description</label>
																<input type="text" name="description" id="description" value="<?php echo$livevideo[description] ?>" readonly="readonly">

																<label for="page">Page</label>
																<input type="text" name="page" id="page" value="<?php echo $_POST[page] ?>" readonly="readonly">

																<label for="pageid">Page ID</label>
																<input type="text" name="pageid" id="pageid" value="<?php echo $_POST[pageid] ?>" readonly="readonly">




																<button type="submit" class="pure-button button-create" > <i class="fas fa-video"></i>    Go Live</button>
														</fieldset>
												</form>
	</div>

<?php


	// to get live video info
	//$LiveVideo = $fb->get('/' . $broadcastid);
	//$LiveVideo = $LiveVideo->getGraphNode()->asArray();
	//print_r($LiveVideo);


//echo "The URL for the Live Event $broadcastid is $rtmpurl";

//print_r ($broadcastid);
//print_r ($rtmpurl);


/*
$ch =
curl_init("https://graph.facebook.com/v3.1/489022444919121?access_token=EAAE39Me992UBAKQDJQTrfge7HJaTZANqPqpsVGZCzTdUZBOzUafqylXFFALgiGcD11y2r6QQU1c24WZAlF3fnVSJx3nwWDlAn98Aiq1qdVx928VTZAkCYauMLIGLitrFmH3wTpAW4w40kBQ3UzVoFI9WWV68oA6ZBq10MPCrD9elsZCuqeK75uZBkzzW2MGL8iEVgciRlrn4hwZDZD");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$res = json_decode(curl_exec($ch));
curl_close($ch);

print_r($res);



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://graph.facebook.com/v3.1/" . $broadcastid . "?access_token=" . $pagetoken[access_token],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"persistent_stream_key_status\"\r\n\r\nENABLE\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: c9815af7-9ef3-4dad-8e73-626984923f28",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
  ),
));

$res = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $res;
}

	/*

	try {
  // Returns a `FacebookFacebookResponse` object
  //$response = $fb->post('/$pageid/live_videos',$_SESSION['fb_token'] );
  //$response = $fb->post('/$pageid/live_videos',$_SESSION['fb_token'], [title => $_POST[title], description => $_POST[description]]  );

  $createLiveVideo = $fb->post('/350278908396657/live_videos', $_SESSION['fb_token'], );
	$createLiveVideo = $createLiveVideo->getGraphNode()->asArray();
		print_r($createLiveVideo);


} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


*/

} else {
	// making login with facebook url

	$loginUrl = $helper->getLoginUrl(APP_URL);
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}


?>
