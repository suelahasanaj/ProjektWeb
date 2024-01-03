<?php 

	session_start();

	$_SESSION = array();

	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-86400, '/');
	}

	session_destroy();

	// ridrejtimi i perdoruesit ne faqen e hyrjes
	header('Location: login.php?action=logout');

 ?>