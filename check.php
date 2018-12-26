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

if (!empty($_GET[eventid])) {




  try {
    $livevideo = $fb->get('/' . $_GET[eventid] . '?fields=id,title,description,stream_url,secure_stream_url,status')->getGraphNode()->asArray();
  } catch(\Facebook\Exceptions\FacebookResponseException $e) {
    $errortype="Graph API";
    include "error.php";
    exit;

  } catch(\Facebook\Exceptions\FacebookSDKException $e) {
    $errortype="SDK";
    include "error.php";
    exit;
  }




  ?>




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

  <div class='content'>
       <h2 class="content-head is-center">Go Live</h2>


        <div class="infobox"
           <label class="pure-form">
            If your video is still UNPUBLISHED please check if you are transmitting. The status should be LIVE. If your have ended your Livestream the status will be PROCESSING or VOD.
              </label></div>

            <label class="copylabel" for="status">Status</label>
            <div class="status"
            <?php

              if($livevideo[status] == "UNPUBLISHED") {
                echo "><i class='fas fa-exclamation-circle'></i> NOT LIVE";
              }
              elseif ($livevideo[status] == "LIVE") {
                echo "style='color: red';> <i class='far fa-dot-circle'></i> LIVE";
              } else {
                    echo ">" . $livevideo[status];
              }
?>
            </div>


            <label class="copylabel" for="rtmplink">RTMP Link</label>
            <div class="input-group">
              <input class="copyinput" type="text" name="rtmplink" id="rtmplink" value="<?php echo  $livevideo[stream_url] ?>" readonly="readonly">
              <span class="input-group-button">
                <button class="pure-button ctc-button" type="button" data-clipboard-target="#rtmplink">
                  <i class="fas fa-clipboard-list"></i> Copy to Clipboard
                </button>
              </span>
            </div>

            <label class="copylabel" for="rtmpslink">RTMPS Link</label>
            <div class="input-group">
              <input class="copyinput" type="text" name="rtmpslink" id="rtmpslink" value="<?php echo $livevideo[secure_stream_url] ?>" readonly="readonly">
              <span class="input-group-button">
                <button class="pure-button ctc-button" type="button" data-clipboard-target="#rtmpslink">
                  <i class="fas fa-clipboard-list"></i> Copy to Clipboard
                </button>
              </span>
            </div>

            <label class="copylabel" for="serverurl">Server URL</label>
            <div class="input-group">
              <input class="copyinput" type="text" name="serverurl" id="serverurl" value="Parser not yet implemented" readonly="readonly">
              <span class="input-group-button">
                <button class="pure-button ctc-button" type="button" data-clipboard-target="#serverurl">
                  <i class="fas fa-clipboard-list"></i> Copy to Clipboard
                </button>
              </span>
            </div>

            <label class="copylabel" for="streamkey">Stream Key</label>
            <div class="input-group">
              <input class="copyinput" type="text" name="streamkey" id="streamkey" value="Parser not yet implemented" readonly="readonly">
              <span class="input-group-button">
                <button class="pure-button ctc-button" type="button" data-clipboard-target="#streamkey">
                  <i class="fas fa-clipboard-list"></i> Copy to Clipboard
                </button>
              </span>
            </div>







            <form class="pure-form pure-form-stacked">

                    <label for="eventid">Live Video ID</label>
                    <input type="text" name="eventid" id="eventid" value="<?php echo $livevideo[id] ?>" readonly="readonly">

                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo $livevideo[title] ?>" readonly="readonly">

                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" value="<?php echo $livevideo[description] ?>" readonly="readonly">

                    <label for="page" hidden>Page</label>
                    <input type="text" name="page" id="page" value="<?php echo $_POST[page] ?>" readonly="readonly" hidden>

                    <label for="pageid" hidden>Page ID</label>
                    <input type="text" name="pageid" id="pageid" value="<?php echo $_POST[pageid] ?>" readonly="readonly" hidden>

                  </form>


                  <a href="./check.php?eventid=<?php echo $livevideo[id] ?>">	<button type="submit" class="pure-button button-create" > <i class="fas fa-video"></i>    Check Status</button></a>

  	</div>







<?php




}

else {
header('Location: ./');
}
?>
