<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
//		
//		File: ListItem.php - Utilized/called by the page listing.html.  Specifically this php code is used for adding a new item
//			into the goods.xml file.  If the XML file doesn't exist, this code will create it.  If the XML does exist, it appends 
//			new Nodes to it.

	
	
	$itemname = $_GET['ItemName'];
	$itemprice = $_GET['ItemPrice'];
	$itemqty = $_GET['ItemQty'];
	$itemdesc = $_GET['ItemDesc'];
			
	if (file_exists("../../data/goods.xml")) {
		WriteToXML($itemname, $itemprice, $itemqty, $itemdesc);
	} else {
		CreateXMLFile($itemname, $itemprice, $itemqty, $itemdesc);
	}
	
	//The XML file doesn't exist, so we'll create a new one and write to it.
	function CreateXMLFile($itemname, $itemprice, $itemqty, $itemdesc) {
		$xml = new DOMDocument("1.0", "UTF-8");
		$xmlItems = $xml->createElement("Items");
		$xmlItem = $xml->createElement("Item");
		$xmlItemID = $xml->createElement("ItemID");
		$xmlItemID->nodeValue = '50001';
		$xmlName = $xml->createElement("ItemName");
		$xmlName->nodeValue = $itemname;
		$xmlIPrice = $xml->createElement("ItemPrice");
		$xmlIPrice->nodeValue = $itemprice;
		$xmlQty = $xml->createElement("ItemQty");
		$xmlQty->nodeValue = $itemqty;
		$xmlDesc = $xml->createElement("ItemDesc");
		$xmlDesc->nodeValue = $itemdesc;
		$xmlQtyHold = $xml->createElement("QtyHold");
		$xmlQtyHold->nodeValue = "0";
		$xmlQtySold = $xml->createElement("QtySold");
		$xmlQtySold->nodeValue = "0";
		$xmlItems->appendChild($xmlItem);
		$xmlItem->appendChild($xmlItemID);
		$xmlItem->appendChild($xmlName);
		$xmlItem->appendChild($xmlIPrice);
		$xmlItem->appendChild($xmlQty);
		$xmlItem->appendChild($xmlDesc);
		$xmlItem->appendChild($xmlQtyHold);
		$xmlItem->appendChild($xmlQtySold);
		$xml->appendChild($xmlItems);
	
		$xml->formatOutput = true;
		echo "Item ". $itemname.", has now been added to the Item List, and its ID is: 50001";
		$xml->save("../../data/goods.xml") or die("Error");
	}

	//The XML file exists, so we'll just append some new data/values.
	function WriteToXML($itemname, $itemprice, $itemqty, $itemdesc)
	{
		$xml = new DOMDocument("1.0", "UTF-8");
		$xml->load("../../data/goods.xml");
		$xmlItems = $xml->documentElement;
		$xmlItem = $xml->createElement("Item");
		$xmlItemID = $xml->createElement("ItemID");
		//$newCustID = GetLastItemID() + 1;
		$newItemID = GetLastItemID();
		$xmlItemID->nodeValue = $newItemID + 1;
		$xmlName = $xml->createElement("ItemName");
		$xmlName->nodeValue = $itemname;
		$xmlIPrice = $xml->createElement("ItemPrice");
		$xmlIPrice->nodeValue = $itemprice;
		$xmlQty = $xml->createElement("ItemQty");
		$xmlQty->nodeValue = $itemqty;
		$xmlDesc = $xml->createElement("ItemDesc");
		$xmlQtyHold = $xml->createElement("QtyHold");
		$xmlQtyHold->nodeValue = "0";
		$xmlQtySold = $xml->createElement("QtySold");
		$xmlQtySold->nodeValue = "0";
		$xmlDesc->nodeValue = $itemdesc;
		$xmlItems->appendChild($xmlItem);
		$xmlItem->appendChild($xmlItemID);
		$xmlItem->appendChild($xmlName);
		$xmlItem->appendChild($xmlIPrice);
		$xmlItem->appendChild($xmlQty);
		$xmlItem->appendChild($xmlDesc);
		$xmlItem->appendChild($xmlQtyHold);
		$xmlItem->appendChild($xmlQtySold);
		$xml->appendChild($xmlItems);
	
		$xml->formatOutput = true;
		$newItem = GetLastItemID() + 1;
		echo "Item ".$itemname.", has now been added to the Item List, and its ID is: ".$newItem;
		$xml->save("../../data/goods.xml") or die("Error");
	}
		
	//Get the ItemID of the last Item listed in the XML file.
	function GetLastItemID()
	{
		$xml=simplexml_load_file("../../data/goods.xml");
		foreach($xml->children() as $Items) {
			$ItemID = $Items->ItemID;
		}
		return $ItemID;	
	}
			
?>

