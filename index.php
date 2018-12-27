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

<a href='https://fb.cromex.org/define.php?type=Profile'>
  <button class='button-page pure-button'>
    <div class='button-content-main'>
        <div class='page'><i class='fas fa-user'></i> Profile
        </div>
    </div>

  </button>
</a>



<a href='https://fb.cromex.org/select.php?type=Page'>
  <button class='button-page pure-button'>
    <div class='button-content-main'>
        <div class='page'><i class='fas fa-flag'></i> Page
        </div>
    </div>

  </button>
</a>

<a href='https://fb.cromex.org/select.php?type=Group'>
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
?>




</div>

</body>
</html>
