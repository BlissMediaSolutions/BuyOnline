<?php
//  	Student ID: 1060325
//		Student Name: Danielle Walker
//		Subject: COS30020 - Web Application Development
//		Assignment - Assignment 2
//		
//		File: buying.php - Utilized/called by the page buying.php.  Specifically this php code is used for when a user tries to log
//			into the system - it checks the XML file as to whether the username/password are correct.

if (file_exists("../../data/goods.xml") == false)
{
	exit("Error: can't locate Goods file.  Please contact the WebMaster");
}

// load XML file into a DOM document
$xmlDoc = new DOMDocument('1.0');
$xmlDoc->formatOutput = true;
$xmlDoc->load("../../data/goods.xml");
// load XSL file into a DOM document
$xslDoc = new DomDocument('1.0');
$xslDoc->load("../../data/catalog.xsl");
// create a new XSLT processor object
$proc = new XSLTProcessor;
// load the XSL DOM object into the XSLT processor
$proc->importStyleSheet($xslDoc);
// transform the XML document using the configured XSLT processor
$strXml= $proc->transformToXML($xmlDoc);
// echo the transformed HTML back to the client
echo ($strXml);
?>