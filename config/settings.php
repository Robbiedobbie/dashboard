<?php

// use this file to set some specific details about this server
// such as the device name (for the page title and navigation bar)

$device_name = "HomeServer";
$loginEnabled = true;

//If this is set the loginUser and loginPass settings will be ignored. If not using, set to false
//Calculate the hash like this: md5($loginUser.":".$loginRealm.":".$loginPass);
$loginA1Hash = "cf0af44236de69510475772e8488af4b";
$loginRealm = "Dashboard - ".$device_name;
//the following can be left empty if loginA1Hash is set
$loginUser = "root";
$loginPass = "";


?>
