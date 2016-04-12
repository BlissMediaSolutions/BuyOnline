<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
//		
//		File: login.php - Utilized/called by the page login.html.  Specifically this php code is used for when a user tries to log
//			into the system - it checks the XML file as to whether the username/password are correct.
	
	$emailadd = $_GET['emailadd'];
	$custpass = $_GET['custpass'];
	
	if (file_exists("../../data/customer.xml") == false)
	{
		exit("Error: can't locate Customer file.  Please contact the WebMaster");
	}
	
	$xml=simplexml_load_file("../../data/customer.xml") or die("Error: can't locate Customer file.  Please contact the WebMaster");
	foreach($xml->children() as $customers)
	{
		$curremail = $customers->Email;
		if ($curremail == $emailadd)
		{
			$currpass = $customers->Password;
			if ($currpass == $custpass)
			{
				$firstname = $customers->FirstName;
				$surname = $customers->LastName;
				$username = $firstname." ".$surname;
				exit ("Success,".$username);
			} else {
				exit ("Error: Incorrect Email or Password");
			}
		}
	}
	exit ("Error: Incorrect Email or Password");
	
?>

