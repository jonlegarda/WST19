<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
	<html>
		<body>
			<h2>Galderak</h2>
				<table border="1">
					<tr bgcolor="skyblue">
						<th>Enuntziatua</th>
						<th>Zailtasuna</th>
						<th>Gaia</th>
						<th>Erantzun Zuzena</th>
						<th>Erantzun Okerrak</th>
					</tr>
				<xsl:for-each select="/assessmentItems/assessmentItem">
					<tr>
						<td><xsl:value-of select="itemBody/p"/></td>
						<td><xsl:value-of select="@complexity"/></td>
						<td><xsl:value-of select="@subject"/></td>
						<td><xsl:value-of select="correctResponse"/></td>
						<td><xsl:for-each select="incorrectResponses/value">
							<xsl:value-of select="."/><br/>
							</xsl:for-each>
						</td>	
					</tr>
				</xsl:for-each>
				</table>
		</body>
	</html>
</xsl:template>
</xsl:stylesheet>