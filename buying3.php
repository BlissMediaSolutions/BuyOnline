<!--  	Student ID: 1060325
		Student Name: Danielle Walker
		Subject: COS30020 - Web Application Development
		Assignment - Assignment 2
		
		File: buying3.php - Utilized/called by the page buying.html.  Specifically this php code is used for when a Shopping Cart is
			either 'purchased' or 'cancelled' & changes all XML values back to what they should be.
-->

<?php

	$status = $_GET['status'];
	$dom = new DOMDocument('1.0');
	$dom=simplexml_load_file("../../data/goods.xml") or die("Error: can't locate Goods file.  Please contact the WebMaster");
	foreach($dom->children() as $id) 
	{	
		if ($id-> QtyHold > 0)
		{
			if ($status == 'Purchase')
			{
				$currQtyHold = $id->QtyHold;
				$currQtySold = $id->QtySold;
				
				$id->QtySold = $currQtySold + $currQtyHold;
				$id->QtyHold = 0;
			} elseif ($status == 'Cancel')
			{
				$currQtyHold = $id->QtyHold;
				$currItemQty = $id->ItemQty;
				
				$id->ItemQty = $currItemQty + $currQtyHold;
				$id->QtyHold = 0;
			}
		}
	}
	$dom->asXML("../../data/goods.xml");
	echo ("OK");
		
?>