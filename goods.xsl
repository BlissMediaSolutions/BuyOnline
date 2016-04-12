<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" version="4.0"/>
<xsl:template match="/">
	<!-- <fieldset> -->
	<table border="1" align="center">
	<tr><th>Item Number</th>
	<th>Item Name</th>
	<th>Price</th>
	<th>Quantity Available</th>
	<th>Quantity on Hold</th>
	<th>Quantity Sold</th></tr> 
	<xsl:for-each select="/Items/Item">
		<tr><td><xsl:value-of select="ItemID"/></td>
		<td><xsl:value-of select="ItemName"/></td>
		<td>$<xsl:value-of select="ItemPrice"/></td>
		<td><xsl:value-of select="ItemQty"/></td>
		<td><xsl:value-of select="QtyHold"/></td>
		<td><xsl:value-of select="QtySold"/></td>
		</tr>
	</xsl:for-each>
	<tr><td ALIGN="center" COLSPAN="6"><button id="process" onclick="Process()">Process</button></td></tr>
	</table>
	<BR />
	<!-- <button onclick="Process()" class="submit_btn float_l">Process</button> 
	</fieldset>-->
</xsl:template>
</xsl:stylesheet>