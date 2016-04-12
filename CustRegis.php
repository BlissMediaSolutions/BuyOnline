<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
//		
//		File: CustRegis.php - Utilized/called by the page register.html.  Specifically this php code is used for adding a new Customer
//			into the customer.xml file.  If the XML file doesn't exist, this code will create it.  If the XML does exist, it appends 
//			new Nodes to it.
	
	
	$fname = $_GET['fname'];
	$lname = $_GET['lname'];
	$custpass = $_GET['custpass'];
	$emailadd = $_GET['emailadd'];
	$custphone = $_GET['custphone'];
		
	if (file_exists("../../data/customer.xml")) {
		WriteToXML($fname, $lname, $custpass, $emailadd, $custphone);
	} else {
		CreateXMLFile($fname, $lname, $custpass, $emailadd, $custphone);
	}
	
	//The XML file doesn't exist, so we'll create a new one and write to it.
	function CreateXMLFile($fname, $lname, $custpass, $emailadd, $custphone) {
		$xml = new DOMDocument("1.0", "UTF-8");
		$xmlCustomers = $xml->createElement("Customers");
		$xmlCust = $xml->createElement("Customer");
		$xmlCustID = $xml->createElement("CustomerID");
		$xmlCustID->nodeValue = '1001';
		$xmlFName = $xml->createElement("FirstName");
		$xmlFName->nodeValue = $fname;
		$xmlLName = $xml->createElement("LastName");
		$xmlLName->nodeValue = $lname;
		$xmlEmail = $xml->createElement("Email");
		$xmlEmail->nodeValue = $emailadd;
		$xmlPass = $xml->createElement("Password");
		$xmlPass->nodeValue = $custpass;
		$xmlPhone = $xml->createElement("Phone");
		$xmlPhone->nodeValue = $custphone;
		$xmlCustomers->appendChild($xmlCust);
		$xmlCust->appendChild($xmlCustID);
		$xmlCust->appendChild($xmlFName);
		$xmlCust->appendChild($xmlLName);
		$xmlCust->appendChild($xmlEmail);
		$xmlCust->appendChild($xmlPass);
		$xmlCust->appendChild($xmlPhone);
		$xml->appendChild($xmlCustomers);
	
		$xml->formatOutput = true;
		echo "Congratulations ". $fname. " ".$lname. ", you are now registered and your Customer ID is: 10001";
		$xml->save("../../data/customer.xml") or die("Error");
	}

	//The XML file exists, so we'll just append some new values.
	function WriteToXML($fname, $lname, $custpass, $emailadd, $custphone)
	{
		SearchForEmail($emailadd);
		
		$xml = new DOMDocument("1.0", "UTF-8");
		$xml->load("../../data/customer.xml");
		$xmlCustomers = $xml->documentElement;
		$xmlCust = $xml->createElement("Customer");
		$xmlCustID = $xml->createElement("CustomerID");
		$newCustID = GetLastCustomerID();
		$xmlCustID->nodeValue = $newCustID + 1;
		$xmlFName = $xml->createElement("FirstName");
		$xmlFName->nodeValue = $fname;
		$xmlLName = $xml->createElement("LastName");
		$xmlLName->nodeValue = $lname;
		$xmlEmail = $xml->createElement("Email");
		$xmlEmail->nodeValue = $emailadd;
		$xmlPass = $xml->createElement("Password");
		$xmlPass->nodeValue = $custpass;
		$xmlPhone = $xml->createElement("Phone");
		$xmlPhone->nodeValue = $custphone;
		$xmlCustomers->appendChild($xmlCust);
		$xmlCust->appendChild($xmlCustID);
		$xmlCust->appendChild($xmlFName);
		$xmlCust->appendChild($xmlLName);
		$xmlCust->appendChild($xmlEmail);
		$xmlCust->appendChild($xmlPass);
		$xmlCust->appendChild($xmlPhone);
		$xml->appendChild($xmlCustomers);
	
		$xml->formatOutput = true;
		$newCustomer = GetLastCustomerID() + 1;
		echo "Congratulations ". $fname. " ".$lname. ", you are now registered and your Customer ID is: ".$newCustomer;
		$xml->save("../../data/customer.xml") or die("Error");
	}

	//Check to see if the email address has already been registered
	function SearchForEmail($emailadd)
	{
		$xml = new DOMDocument;
		$xml->load("../../data/customer.xml");
		$emails = $xml->getElementsByTagName('Email');
		foreach ($emails as $email) {
			if ($emailadd == $email->nodeValue) {
				exit ("This email address has already been registered");
			}
		}
	}
	
	//Get the CustomerID of the last customer which was registered
	function GetLastCustomerID()
	{
		$xml=simplexml_load_file("../../data/customer.xml");
		foreach($xml->children() as $Customers) {
			$CustID = $Customers->CustomerID;
		}
		return $CustID;	
	}
			
?>

