<!doctype html>
<html>

<?php
$loggedin = 0;
$loginUrl ="";
$advancedinfo = "";
;


include "header.php";
include "login.php";
$accessToken = ($_SESSION[fb_token]);
?>




</ul>
</div>
</div>


</div>




	<?php
	if ($loggedin==1){

  if ($_GET[type]=='Profile'){

  //render form to define Livestream to Facebook Profile
   echo"
   <div class='content'>
           <h2 class='content-head is-center'>Create Live Event</h2>
                           <form class='pure-form pure-form-stacked' method='POST' action='create.php'>
                               <fieldset>
                                   <label for='token' $advancedinfo>Token</label>
                                   <input type='text' name='token' id='token' value='$accessToken' readonly='readonly' $advancedinfo>

                                   <label for='Profile'>Profile</label>
                                   <input type='text' name='Profile' id='Profile' value='$user[name]' readonly='readonly'>

                                   <label for='profileid' $advancedinfo>Profile ID</label>
                                   <input type='text' name='profileid' id='profileid' value='$user[id]' readonly='readonly' $advancedinfo>

                                   <label for='title'>Title</label>
                                   <input type='text' name='title' id='title'>

                                   <label for='description'>Description</label>
                                   <input type='text' name='description' id='description'>

                                   <button type='submit' class='pure-button button-create' > <i class='fas fa-video'></i>    Create Event</button>
                               </fieldset>
                           </form>
     </div>
     ";

}  elseif ($_GET[type]=='Page'){

	$pagetoken = $fb->get('/' . $_GET[pageid] . '?fields=access_token')->getGraphNode()->asArray();

	$page = $fb->get('/' . $_GET[pageid])->getGraphNode()->asArray();

  //render form to define Livestream to Facebook Page
   echo"
   <div class='content'>
           <h2 class='content-head is-center'>Create Live Event</h2>
                           <form class='pure-form pure-form-stacked' method='POST' action='create.php'>
                               <fieldset>
                                   <label for='pagetoken' $advancedinfo>Page Token</label>
                                   <input type='text' name='pagetoken' id='pagetoken' value='$pagetoken[access_token]' readonly='readonly' $advancedinfo>

                                   <label for='page'>Page</label>
                                   <input type='text' name='page' id='page' value='$page[name]' readonly='readonly'>

                                   <label for='pageid' $advancedinfo>Page ID</label>
                                   <input type='text' name='pageid' id='pageid' value='$page[id]' readonly='readonly' $advancedinfo>

                                   <label for='title'>Title</label>
                                   <input type='text' name='title' id='title'>

                                   <label for='description'>Description</label>
                                   <input type='text' name='description' id='description'>

                                   <button type='submit' class='pure-button button-create' > <i class='fas fa-video'></i>    Create Event</button>
                               </fieldset>
                           </form>
     </div>
     ";


	 } elseif ($_GET[type]=='Group'){

	 	$group = $fb->get('/' . $_GET[groupid])->getGraphNode()->asArray();

	   //render form to define Livestream to Facebook Group
	    echo"
	    <div class='content'>
	            <h2 class='content-head is-center'>Create Live Event</h2>
	                            <form class='pure-form pure-form-stacked' method='POST' action='create.php'>
	                                <fieldset>
																	<label for='token' $advancedinfo>Token</label>
																	<input type='text' name='token' id='token' value='$accessToken' readonly='readonly' $advancedinfo>

	                                    <label for='group'>Group</label>
	                                    <input type='text' name='group' id='group' value='$group[name]' readonly='readonly'>

	                                    <label for='groupid' $advancedinfo>Group ID</label>
	                                    <input type='text' name='groupid' id='groupid' value='$group[id]' readonly='readonly' $advancedinfo>

	                                    <label for='title'>Title</label>
	                                    <input type='text' name='title' id='title'>

	                                    <label for='description'>Description</label>
	                                    <input type='text' name='description' id='description'>

	                                    <button type='submit' class='pure-button button-create' > <i class='fas fa-video'></i>    Create Event</button>
	                                </fieldset>
	                            </form>
	      </div>
	      ";
			}else{
				//No stream type selected, redirecting to Home
				header('Location: ./');
			}

} else {
	//Not logged in, redirecting to Home
  header('Location: ./');

}

?>
