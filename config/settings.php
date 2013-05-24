<?php

// use this file to set some specific details about this server
// such as the device name (for the page title and navigation bar)

$device_name = "HomeServer";
$loginEnabled = true;

//If this is set the loginUser and loginPass settings will be ignored. If not using, set to false
//Calculate the hash like this: md5($loginUser.":".$loginRealm.":".$loginPass);
$loginA1Hash = "cd95344cc70cc3e356754ffc640900aa";
$loginRealm = "Dashboard - ".$device_name;
//the following can be left empty if loginA1Hash is set
$loginUser = "root";
$loginPass = "";

/**
 * Storage
 */
//This enables/disables a function with which you can unmount storage devices on the server. To do this, you need to have the sudo command working, and set up to not ask a password for the unmount command.
$unmountEnabled = true;
//Here you can tell the system to ignore some devices for unmounting. Seperate them with a ;
$ignoredStorageDevices = "/dev/sda1;/dev/sda2;/dev/sdb1";

?>
