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

	<h2 class='content-head is-center'>Select a page</h2>
	<div class='pagelist'>

";

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


	<a href=./define.php?pageid=$page[id]&type=Page>
		<button class='button-page pure-button'>
	  <div class='button-content'>
	<div> <img class='pure-img-responsive' src='$pagepic[url]' alt='$page[name]'></div>
	<div class='page'>$page[name]</div>

	<div class='push forbidden'>Permissions  <i class='fas fa-times-circle'></i></div>

	</div>

	 </button></a>


	";



}


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
