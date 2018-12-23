<!doctype html>
<html>

<?php
$loggedin = 0;
$loginUrl ="";
$accessToken="";

print_r ($_GET[type]);
include "header.php";
include "login.php";
?>




</ul>
</div>
</div>

<div class="home-menu pure-menu pure-menu-horizontal">
						<ul class="pure-menu-list">
								<li class="pure-menu-item"><a href="#" class="pure-menu-link">Select <?php echo $type ?> </a></li>

								<li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Define Stream</a></li>

								<li class="pure-menu-item"><a href="#" class="pure-menu-link">Get RTMP Links</a></li>
						</ul>
</div>
</div>




	<?php

  if ($_GET[type]=='Profile'){

  //render form to define Livestream to Facebook Page
   echo"
   <div class='content'>
           <h2 class='content-head is-center'>Create Live Event</h2>
                           <form class='pure-form pure-form-stacked' method='POST' action='create.php'>
                               <fieldset>
                                   <label for='pagetoken'>Token</label>
                                   <input type='text' name='pagetoken' id='pagetoken' value='$accessToken' readonly='readonly'>

                                   <label for='page'>Profile</label>
                                   <input type='text' name='page' id='page' value='$user[name]' readonly='readonly'>

                                   <label for='pageid'>Profile ID</label>
                                   <input type='text' name='pageid' id='pageid' value='$user[id]' readonly='readonly'>

                                   <label for='title'>Title</label>
                                   <input type='text' name='title' id='title'>

                                   <label for='description'>Description</label>
                                   <input type='text' name='description' id='description'>

                                   <button type='submit' class='pure-button button-create' > <i class='fas fa-video'></i>    Create Event</button>
                               </fieldset>
                           </form>
     </div>
     ";

}


  elseif ($_GET[type]=='Page'){

	$pagetoken = $fb->get('/' . $_GET[pageid] . '?fields=access_token')->getGraphNode()->asArray();

	$page = $fb->get('/' . $_GET[pageid])->getGraphNode()->asArray();

  //render form to define Livestream to Facebook Page
   echo"
   <div class='content'>
           <h2 class='content-head is-center'>Create Live Event</h2>
                           <form class='pure-form pure-form-stacked' method='POST' action='create.php'>
                               <fieldset>
                                   <label for='pagetoken'>Page Token</label>
                                   <input type='text' name='pagetoken' id='pagetoken' value='$pagetoken[access_token]' readonly='readonly'>

                                   <label for='page'>Page</label>
                                   <input type='text' name='page' id='page' value='$page[name]' readonly='readonly'>

                                   <label for='pageid'>Page ID</label>
                                   <input type='text' name='pageid' id='pageid' value='$page[id]' readonly='readonly'>

                                   <label for='title'>Title</label>
                                   <input type='text' name='title' id='title'>

                                   <label for='description'>Description</label>
                                   <input type='text' name='description' id='description'>

                                   <button type='submit' class='pure-button button-create' > <i class='fas fa-video'></i>    Create Event</button>
                               </fieldset>
                           </form>
     </div>
     ";

} else {
	// making login with facebook url
	//$loginUrl = $helper->getLoginUrl(APP_URL);
	//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
  header('Location: ./');
  //exit;
}

?>
