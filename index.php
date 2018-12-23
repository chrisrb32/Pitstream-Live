<!doctype html>
<html>

<?php
$loggedin = 3;
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
    <div class='content'>

    	<h2 class='content-head is-center'>Select a page</h2>
    	<div class='pagelist'>

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


}else {
  echo "
  <div class='content'>
    <h2 class='content-head is-center'>Please log in first</h2>";
echo '<a href="' . $loginUrl . '">Log in wh Facebook!</a>';
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
