<!doctype html>
<html>

<?php
$loggedin = 0;
$loginUrl ="";
$errortype="";
$advancedinfo = "hidden";

include "header.php";
include "login.php";
$token = ($_SESSION[fb_token]);
?>

</ul>
</div>
</div>

</div>

<?php

if (!empty($_POST[profileid])) {
$id=$_POST[profileid];

}

elseif (!empty($_POST[pageid])) {
$id=$_POST[pageid];
$token=$_POST[pagetoken];
}

elseif (!empty($_POST[groupid])) {
$id=$_POST[groupid];
}

else {
header('Location: ./');
}




try {
  $response = $fb->post('/' . $id . '/live_videos',  array (title => $_POST[title], description => $_POST[description]),  $token );
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  $errortype="Graph API";
  include "error.php";
  exit;

} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  $errortype="SDK";
  include "error.php";
  exit;
}

$responsearray = $response->getGraphNode()->asArray();

$livevideo = $fb->get('/' . $responsearray[id] . '?fields=id,title,description,stream_url,secure_stream_url')->getGraphNode()->asArray();


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


  <script>  window.fbAsyncInit = function() {
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
          </label></div>

          <label class="copylabel" for="rtmplink">RTMP Link</label>
          <div class="input-group">
            <input class="copyinput" type="text" name="rtmplink" id="rtmplink" value="<?php echo  $livevideo[stream_url] ?>" readonly="readonly">
            <span class="input-group-button">
              <button class="pure-button ctc-button" type="button" data-clipboard-target="#rtmplink">
                <i class="fas fa-clipboard-list"></i>Copy to Clipboard
              </button>
            </span>
          </div>

          <label class="copylabel" for="rtmpslink">RTMPS Link</label>
          <div class="input-group">
            <input class="copyinput" type="text" name="rtmpslink" id="rtmpslink" value="<?php echo $livevideo[secure_stream_url] ?>" readonly="readonly">
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
																<label for="eventid">Live Video ID</label>
																<input type="text" name="pagetoken" id="pagetoken" value="<?php echo $livevideo[id] ?>" readonly="readonly">

                                <label for="title">Title</label>
																<input type="text" name="title" id="title" value="<?php echo $livevideo[title] ?>" readonly="readonly">

																<label for="description">Description</label>
																<input type="text" name="description" id="description" value="<?php echo $livevideo[description] ?>" readonly="readonly">

																<label for="page" hidden>Page</label>
																<input type="text" name="page" id="page" value="<?php echo $_POST[page] ?>" readonly="readonly" hidden>

																<label for="pageid" hidden>Page ID</label>
																<input type="text" name="pageid" id="pageid" value="<?php echo $_POST[pageid] ?>" readonly="readonly" hidden>




																<button type="submit" class="pure-button button-create" > <i class="fas fa-video"></i>    Go Live</button>
														</fieldset>
												</form>
	</div>
