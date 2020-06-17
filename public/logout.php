<?php
	require('../src/config.php');
	$_SESSION['first_name'] = [];
	$_SESSION['id'] = [];

	unset($_SESSION['first_name']);
	unset($_SESSION['id']);
	//session_destroy();
	redirect($_SERVER['HTTP_REFERER']);
    exit;

	