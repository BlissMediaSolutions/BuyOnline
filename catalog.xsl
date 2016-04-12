<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" version="4.0"/>
<xsl:template match="/">
	<table border="1" id="table1" align="center">
	<tr><th>Item Number</th>
	<th>Item Name</th>
	<th>Description</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Add</th></tr> 
	<xsl:for-each select="/Items/Item[ItemQty > 0]">
		<tr><td><xsl:value-of select="ItemID"/></td>
		<td><xsl:value-of select="ItemName"/></td>
		<td><xsl:value-of select="ItemDesc"/></td>
		<td><xsl:value-of select="ItemPrice"/></td>
		<td><xsl:value-of select="ItemQty"/></td>
		<td><button onclick="addtoCart({ItemID}, 'Add')">Add to Cart</button></td> 
		</tr>
	</xsl:for-each>
	</table>
		
</xsl:template>
</xsl:stylesheet>