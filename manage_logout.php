<?php
/*
=====================================================
File Name: manage_logout.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Destroys the supervisor session and redirects to login page
=====================================================
*/
session_start();
$_SESSION = array();
session_destroy();
header("Location: manage_login.php");
exit();
?>
