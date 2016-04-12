<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
		
//		File: processing2.php - Used by the processing page (processing.html).  Specifically this code is called by the AJAX 
//			after a person clicks on the "Process" button to reset QtyHold values to 0, delete Items out of Stock & reload the table
//			on the screen after these changes have occured on the XML file.
//							
	
	$dom = new DOMDocument('1.0');
	$dom=simplexml_load_file("../../data/goods.xml") or die("Error: can't locate Goods file.  Please contact the WebMaster");
	//Reset the QtySold values to 0;
	foreach($dom->children() as $id) 
	{	
		$id->QtySold = 0;
	}
	
	//Iterate thru the XML file & look for any items which have 0 stock and add them to an Array
	$elementsToRemove = array();
	foreach($dom->children() as $id)
	{
		if (($id->ItemQty == 0) && ($id->QtyHold == 0))
		{
			$elementsToRemove[] = $id;
		}
	}
	
	//Iterate thru the Array and remove anything listed.
	foreach ($elementsToRemove as $id)
	{
		unset($id[0]);
	}
		
	//Save all changes to the XML file.
	$dom->asXML("../../data/goods.xml");
	
	
	// load XML file into a DOM document & send it back to be displayed within the HTML page
	$xmlDoc = new DOMDocument('1.0');
	$xmlDoc->formatOutput = true;
	$xmlDoc->load("../../data/goods.xml");
	// load XSL file into a DOM document
	$xslDoc = new DomDocument('1.0');
	$xslDoc->load("../../data/goods.xsl");
	// create a new XSLT processor object
	$proc = new XSLTProcessor;
	// load the XSL DOM object into the XSLT processor
	$proc->importStyleSheet($xslDoc);
	// transform the XML document using the configured XSLT processor
	$strXml= $proc->transformToXML($xmlDoc);
	// echo the transformed HTML back to the client
	echo ($strXml);
	
?>