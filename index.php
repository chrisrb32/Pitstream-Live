<!doctype html>
<html>

<?php
$loggedin = 0;
$loginUrl ="";
include "header.php";
include "login.php";

?>


</ul>
</div>
</div>



<?php

//echo $loggedin . 'test2';

if ($loggedin==1) {

echo "
<div class='content'>

	<h2 class='content-head is-center'>Select a target for Livestream</h2>
	<div class='pagelist'>

<div class='infobox'
    <label class='pure-form'>
    You can choose to stream to you personal profile, a page or a group.
    Events are not supported currently.
</label>

</div>

<a href='https://fb.cromex.org/select_page.php'>
  <button class='button-page pure-button'>
    <div class='button-content-main'>
        <div class='page'><i class='fas fa-user'></i> Profile
        </div>
    </div>

  </button>
</a>



<a href='https://fb.cromex.org/select_page.php'>
  <button class='button-page pure-button'>
    <div class='button-content-main'>
        <div class='page'><i class='fas fa-flag'></i> Page
        </div>
    </div>

  </button>
</a>

<a href='https://fb.cromex.org/select_group.php'>
  <button class='button-page pure-button'>
    <div class='button-content-main'>
        <div class='page'><i class='fas fa-users'></i> Group
        </div>
    </div>

  </button>
</a>


</div>



";




}else {
  echo "
  <div class='content'>
    <h2 class='content-head is-center'>Login</h2>";

echo '
<a href="' . $loginUrl . '">
<button class="pure-button button-login" > <i class="fas fa-sign-in-alt"></i>    Login to Facebook
</button>
</a>

';



}
	//print_r($pages);
	//print_r($pages[2][id]);
	//var_dump($pages[2][id]);
/*
} else {

  $permissions = array("publish_video", "publish_pages", "manage_pages", "publish_to_groups");

	// making login with facebook url
  $loginUrl = $helper->getLoginUrl(APP_URL, $permissions);
  	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}
*/
?>




</div>

</body>
</html>
