<xsl:template name="strip-tags" xmlns:php="http://php.net/xsl">
    <xsl:param name="text"/>
    <xsl:choose>
        <xsl:when test="contains($text, '&lt;')">
            <xsl:value-of select="substring-before($text, '&lt;')"/>
            <xsl:call-template name="strip-tags">
                <xsl:with-param name="text" select="concat(' ', substring-after($text, '&gt;'))"/>
            </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:value-of select="$text"/>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template match="data" xmlns:php="http://php.net/xsl">
    <xsl:choose>
        <xsl:when test="results/total_records_sum &gt; 0">
            <div id = "total_records" style="display: none;">
                <h5>
                    <u>
                        <strong>
                            <xsl:value-of select="php:function('lang', 'Found %1 results', results/total_records_sum)" />
                        </strong>
                    </u>
                </h5>
            </div>
            <br />
            <br />
            <ol id="result">
                <div class="row">
                    <xsl:for-each select="results/results">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-light">
                                    <div id="{img_container}"/>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                    JqueryPortico.booking.inlineImages('<xsl:value-of select="img_container"/>', '<xsl:value-of select="img_url"/>');
                                                    });
                                                </script>         
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a class="bui_single_view_link">
                                            <xsl:attribute name="href">
                                                <xsl:value-of select="link"/>
                                            </xsl:attribute>
                                            <xsl:value-of select="name"/>
                                        </a> (<xsl:value-of select="php:function('lang', string(type))"/>) </h5>
                                    <p class="card-text">
                                        <xsl:variable name="tag_stripped_description">
                                            <xsl:call-template name="strip-tags">
                                                <xsl:with-param name="text" select="description"/>
                                            </xsl:call-template>
                                        </xsl:variable>
                                        <xsl:choose>
                                            <xsl:when test="string-length($tag_stripped_description) &gt; 1">
                                                <xsl:choose>
                                                    <xsl:when test="string-length($tag_stripped_description) &gt; 100">
                                                        <xsl:value-of select="substring($tag_stripped_description, 0, 97)"/>...
                                                    </xsl:when>
                                                    <xsl:otherwise>
                                                        <xsl:value-of select="$tag_stripped_description"/>
                                                    </xsl:otherwise>
                                                </xsl:choose>
                                            </xsl:when>
                                            <xsl:otherwise>
                                                <xsl:value-of select="php:function('lang', 'No description yet')" />
                                            </xsl:otherwise>
                                        </xsl:choose>
                                    </p> 
                                    <xsl:if test="string-length(homepage) &gt; 1">
                                                    <p class="lead">
                                                        <xsl:value-of select="php:function('lang', 'Homepage')" />
                                                    </p>
                                      
                                                    <a class="card-link">
                                                        <xsl:attribute name="href">
                                                            <xsl:value-of select="homepage"/>
                                                        </xsl:attribute>
                                                        <xsl:value-of select="homepage"/>
                                                    </a>
                                           
                                            </xsl:if>   
                                </div>    
                                            
                                            
                                            
                                            
                                            
                                 <!--           
                                
                                <div class="header">
                                    <b>
                                        <a class="bui_single_view_link">
                                            <xsl:attribute name="href">
                                                <xsl:value-of select="link"/>
                                            </xsl:attribute>
                                            <xsl:value-of select="name"/>
                                        </a>
                                        (<xsl:value-of select="php:function('lang', string(type))"/>)</b>
                                </div>
                                <div class="details">
                                    <div>
                                        <dl>
									
                                            <dd class="description">
                                                <xsl:variable name="tag_stripped_description">
                                                    <xsl:call-template name="strip-tags">
                                                        <xsl:with-param name="text" select="description"/>
                                                    </xsl:call-template>
                                                </xsl:variable>
                                                <xsl:choose>
                                                    <xsl:when test="string-length($tag_stripped_description) &gt; 1">
                                                        <xsl:choose>
                                                            <xsl:when test="string-length($tag_stripped_description) &gt; 100">
                                                                <xsl:value-of select="substring($tag_stripped_description, 0, 97)"/>...
                                                            </xsl:when>
                                                            <xsl:otherwise>
                                                                <xsl:value-of select="$tag_stripped_description"/>
                                                            </xsl:otherwise>
                                                        </xsl:choose>
                                                    </xsl:when>
                                                    <xsl:otherwise>
                                                        <xsl:value-of select="php:function('lang', 'No description yet')" />
                                                    </xsl:otherwise>
                                                </xsl:choose>
                                                <div id="{img_container}"/>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                    JqueryPortico.booking.inlineImages('<xsl:value-of select="img_container"/>', '<xsl:value-of select="img_url"/>');
                                                    });
                                                </script> 
                                            </dd>
                                            <xsl:if test="string-length(homepage) &gt; 1">
                                                <dt>
                                                    <h4>
                                                        <xsl:value-of select="php:function('lang', 'Homepage')" />
                                                    </h4>
                                                </dt>
                                                <dd class="description">
                                                    <a>
                                                        <xsl:attribute name="href">
                                                            <xsl:value-of select="homepage"/>
                                                        </xsl:attribute>
                                                        <xsl:value-of select="homepage"/>
                                                    </a>
                                                </dd>
                                            </xsl:if>
                                        </dl>
                                    </div>
                                    <div class="clr"></div>                           
                                </div>
                                -->
                            </div>
                        </div>   
                    </xsl:for-each>
                </div>
            </ol>
        </xsl:when>
        <xsl:otherwise>
            <div id = "total_records" style="display: none;">
                <h5>
                    <u>
                        <strong>
                            <xsl:value-of select="php:function('lang', 'Found %1 results', 0)" />
                        </strong>
                    </u>
                </h5>
            </div>

        </xsl:otherwise>
    </xsl:choose>
</xsl:template>
