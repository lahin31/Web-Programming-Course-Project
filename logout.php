<?php
include 'dbconfig.php';
if(($user->logout())){
	header('Location: index.php');
}
?>
