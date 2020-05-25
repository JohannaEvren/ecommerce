<?php
	require('../src/config.php');
	$_SESSION = [];
	session_destroy();
	header('Location: login.php?logout');
	exit;
?>