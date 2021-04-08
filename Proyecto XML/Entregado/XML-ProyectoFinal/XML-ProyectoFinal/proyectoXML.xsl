<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns="http://earth.google.com/kml/2.1" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" indent="yes"/>
	<xsl:template match="/">
		<kml>
		<Document>
		  <Style id="default">
			<LineStyle>
				<color><xsl:value-of select="ruta/color" /></color>
				<width><xsl:value-of select="ruta/anchura" /></width>
			</LineStyle>
		  </Style>
		  <xsl:apply-templates select="//ruta"/>
		</Document>
		</kml>
	</xsl:template>

	<xsl:template match="ruta">
		<Folder>
			<name><xsl:value-of select="nombre" /></name>			
			<xsl:apply-templates select="coordenadas"/>
		</Folder>
	</xsl:template>
	
	<xsl:template match="coordenadas">
		<xsl:for-each select="latlon">
			<Placemark>
				<name><xsl:value-of select="//ruta/nombre" /></name>
				<description><xsl:value-of select="//ruta/descripcion" /></description>
				<Point>
					<coordinates><xsl:value-of select="text()"/></coordinates>
				</Point>
			</Placemark>
		</xsl:for-each>
	</xsl:template>	
	
</xsl:stylesheet>
