<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
//		
//		File: buying2.php - Utilized/called by the page buying.html.  Specifically this php code is used for when a Shopping Cart has
//			items either 'added' or 'removed' from it & changes all XML values as necessary.
//


	$itemID = $_GET['itemID'];
	$status = $_GET['status'];
	$itemFound = False;
	$dom = new DOMDocument('1.0');
	$dom=simplexml_load_file("../../data/goods.xml") or die("Error: can't locate Goods file.  Please contact the WebMaster");
	foreach($dom->children() as $id) 
	{	
		if ($id->ItemID == $itemID) 
		{	
			$itemFound = True;
			if ($id->ItemQty <= 0)
			{
				die ("No Stock");
			} else {
				if ($status == 'Add')		//An Item is being Added to the Cart
				{
					$currItemQty = $id->ItemQty;
					$currQtyHold = $id->QtyHold;
					$id->ItemQty = $currItemQty-1;
					$id->QtyHold = $currQtyHold+1;
				} 
				elseif ($status == 'Remove')		//An Item is being removed from the Cart.
				{
					$currItemQty = $id->ItemQty;
					$currQtyHold = $id->QtyHold;
					$id->ItemQty = $currItemQty+1;
					$id->QtyHold = $currQtyHold-1;
				}
			}
		} 
	}
	
	if ($itemFound == False)						//Some simple error handling. 
	{
		die ("Can't Find Item");
	}
	$dom->asXML("../../data/goods.xml");			//Save the XML file with the updated data.
	

	$xmlDoc = new DOMDocument('1.0');
	$xmlDoc->formatOutput = true;
	$xmlDoc->load("../../data/goods.xml");
	// load XSL file into a DOM document
	$xslDoc = new DomDocument('1.0');
	$xslDoc->load("../../data/cart.xsl");
	// create a new XSLT processor object
	$proc = new XSLTProcessor;
	// load the XSL DOM object into the XSLT processor
	$proc->importStyleSheet($xslDoc);
	// transform the XML document using the configured XSLT processor
	$strXml= $proc->transformToXML($xmlDoc);
	// echo the transformed HTML back to the client
	echo ($strXml);
		
?>