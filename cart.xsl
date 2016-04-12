<!--  	Student ID: 1060325
		Student Name: Danielle Walker
		Subject: COS30020 - Web Application Development
		Assignment - Assignment 2
		
		File: cart.xsl - This file is used to format the data from goods.xml when displaying the shopping Cart.
			It is called after a user clicks on either of the button "Add To Cart" or "Remove from Cart".
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"
               xmlns:exsl="http://exslt.org/common"
               exclude-result-prefixes="exsl">

    <xsl:output method="html" indent="yes" />

    <xsl:template match="/">
        <fieldset>
		<legend>Shopping Cart</legend>
		<BR />
		<table border="1" id="CartTable" align="center">
        <tr><th>Item Number</th>
        <th>Price</th>
        <th>Quantity</th>
		<th>Remove</th>
        </tr> 
        <xsl:for-each select="/Items/Item[QtyHold > 0]">
            <tr>
                <td><xsl:value-of select="ItemID"/></td>
                 <td>$<xsl:value-of select="ItemPrice"/></td>
                <td><xsl:value-of select="QtyHold"/></td>
				<td><button onclick="addtoCart({ItemID}, 'Remove')">Remove from Cart</button></td>
            </tr>
        </xsl:for-each>
        <tr>
            <td ALIGN="center" COLSPAN="3">Total:</td>
            <xsl:variable name="itemTotals">
                <xsl:for-each select="//Item[QtyHold >0]">
                    <total>
                        <xsl:value-of select="ItemPrice * QtyHold" />
                    </total>
                </xsl:for-each>
            </xsl:variable>
            <td>
                $<xsl:value-of select="sum(exsl:node-set($itemTotals)/total)"/>
                <xsl:apply-templates select="(//Item)[0]" mode="sum" />
            </td>
        </tr>
        </table>
		<BR />
		<button onclick="Purchase()" class="submit_btn float_l">Confirm Purchase</button>
		<button onclick="CancelOrder()" class="submit_btn float_r">Cancel Order</button>
		</fieldset>
</xsl:template>
</xsl:stylesheet>

