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

echo "<div class='content'>";



if ($_GET[type]=='Page'){
//requesting list of pages managed by user (requires permission)

echo "<h2 class='content-head is-center'>Select a Page</h2>";



//$pages = $fb->get('/me/accounts')->getGraphEdge()->asArray();

try {
	$pages = $fb->get('/me/accounts')->getGraphEdge()->asArray();
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  $errortype="Graph API";
  include "error.php";
  exit;

} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  $errortype="SDK";
  include "error.php";
  exit;
}

//print_r ($pages);

foreach($pages as $page) {

$tasks = $page[tasks];



	$pagepic = $fb->get('/' . $page[id] . '/picture?redirect=0')->getGraphNode()->asArray();

    echo "<div class='targetlist'>
	<a href=./define.php?pageid=$page[id]&type=Page>
		<button class='button-page pure-button'>
	  <div class='button-content'>
	<div> <img class='pure-img-responsive targetpic' src='$pagepic[url]' alt='$page[name]'></div>
	<div class='listentry'>$page[name]</div>";


  if (array_search("CREATE_CONTENT",$tasks,strict)){
  echo"  <div class='push permitted'><i class='fas fa-check-circle'></i></div>";
  }else{
  echo" <div class='push forbidden'><i class='fas fa-times-circle'></i></div>";
  }

echo "</div></button></a>";

}

}

elseif ($_GET[type]=='Group'){

//requesting list of pages managed by user (requires permission)
//

try {
	$groups = $fb->get('me/groups?fields=permissions,name&limit=3')->getGraphEdge()->asArray();
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  $errortype="Graph API";
  include "error.php";
  exit;

} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  $errortype="SDK";
  include "error.php";
  exit;
}

//print_r ($groups);

echo "<h2 class='content-head is-center'>Select a Group</h2>";
echo "<div class='targetlist'>";
foreach($groups as $group) {

$grouppic = $fb->get('/' . $group[id] . '/picture?redirect=0')->getGraphNode()->asArray();



echo"
<a href=./define.php?groupid=$group[id]&type=Group>
  <button class='button-page pure-button'>
  <div class='button-content'>
<div> <img class='pure-img-responsive targetpic' src='$grouppic[url]' alt='$group[name]'></div>
<div class='listentry'>$group[name]</div>";


if (in_array("Publish to Group",$group[permissions],strict)){
echo"<div class='push permitted'><i class='fas fa-check-circle'></i></div>";
}else{

echo"<div class='push forbidden'><i class='fas fa-times-circle'></i></div>";
}
echo "</div></button></a>";

}

echo "</div>";

}


} else {

header('Location: ./');

/*
  $permissions = array("publish_video", "publish_pages", "manage_pages", "publish_to_groups");

	// making login with facebook url
  $loginUrl = $helper->getLoginUrl(APP_URL, $permissions);
  	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
*/


}


?>

</div>
</body>
</html>
