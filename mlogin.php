<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
//		
//		File: mlogin.php - Utilized/called by the page mlogin.html.  Specifically this php code is used for when a Manager tries to log
//			into the system - it checks the TXT file as to whether the username/password are correct.

	$manid = $_GET['manid'];
	$manpass = $_GET['password'];

	if (file_exists("../../data/manager.txt") == false)
	{
		exit("Error: can't locate Manager file.  Please contact the WebMaster");
	}
	
	$fileData = file("../../data/manager.txt");
	for ($x=0; $x < count($fileData); $x++)
	{
		$managers = explode(",", $fileData[$x]);
		if (trim($managers[0]) == $manid && trim($managers[1]) == trim($manpass)) {
			exit ("Found");
		} 
	}
	exit ("Error: Unknown Username or Password");

?>