<?php
	require('../src/config.php');
	$_SESSION = [];
	session_destroy();
	redirect($_SERVER['HTTP_REFERER']);
    exit;

	