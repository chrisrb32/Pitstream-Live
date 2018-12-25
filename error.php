<?php



echo'<div class="errorbox"><i class="fas fa-exclamation-circle"></i> Facebook ' .  $errortype . ' returned an error: ';


echo  $e->getMessage();


echo '</br></br> <a href="./"><button class="pure-button button-return" > <i class="fas fa-undo"></i> Return to home</button></a>'

 ?>
