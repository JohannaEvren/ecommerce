<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/');
define('SRC_PATH',  __DIR__ . '/');

// Include functions and classes
require('app/functions.php');
require('app/main.js');