<?php

/**************************************************************
"Learning with Texts" (LWT) is released into the Public Domain.
This applies worldwide.
In case this is not legally possible, any entity is granted the
right to use this work for any purpose, without any conditions, 
unless such conditions are required by law.


Developed by J. P. in 2011, 2012, 2013.
***************************************************************/

/**************************************************************
lwtstart.php
------------
This script must be installed into the WordPress main directory.
To start LWT (and to login into WordPress), use this URL:
http://...path-to-wp-blog.../lwtstart.php
Cookies must be enabled.
The lwt installation must be in sub directory "lwt" under
the WP main drectory.
In the "lwt" directory, "connect.inc.php" must contain 
include "wp_logincheck.inc.php"; 
at the end!
To properly logout from both WordPress and LWT, use:
http://...path-to-wp-blog.../lwtstop.php
***************************************************************/

require_once( 'wp-load.php' );

if (is_user_logged_in()){
	global $current_user;

	get_currentuserinfo();
	$wpuser = $current_user->ID;

	setcookie('LWT-WP-User', $wpuser, time() + 60*60*18, '/');
	header("Location: ./lwt/index.php");
	exit;
}
else { 
	setcookie('LWT-WP-User', $wpuser, time() - 1000, '/');
	header("Location: ./wp-login.php?redirect_to=./lwtstart.php");
	exit;
}

?>