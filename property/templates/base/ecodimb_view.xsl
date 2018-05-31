
<!-- $Id: ecodimb_view.xsl 14719 2016-02-10 19:45:46Z sigurdne $ -->
<xsl:template name="ecodimb_view">
		<xsl:apply-templates select="ecodimb_data"/>
</xsl:template>

<!-- New template-->
<xsl:template match="ecodimb_data">
	<div class="pure-control-group">
		<label>
				<xsl:value-of select="lang_ecodimb"/>
		</label>
				<xsl:value-of select="value_ecodimb"/>
				<xsl:text> [</xsl:text>
				<xsl:value-of select="value_ecodimb_descr"/>
				<xsl:text>]</xsl:text>
	</div>
</xsl:template>
