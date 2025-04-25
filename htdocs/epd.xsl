<?xml version='1.0'?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <xsl:for-each select="epd/Entry">
            <xsl:apply-templates select="ID_line"/>
            XX
            AC   <xsl:value-of select="AC_line"/>
            XX
            <xsl:for-each select="DT_line/Creation_lines">
                DT   <xsl:value-of select="Day1"/>-<xsl:value-of select="Month1"/>-<xsl:value-of select="Year1"/> (Rel. <xsl:value-of select="Creation"/>, created)
            </xsl:for-each>
            <xsl:for-each select="DT_line/Annotation_lines">
                DT   <xsl:value-of select="Day2"/>-<xsl:value-of select="Month2"/>-<xsl:value-of select="Year2"/> (Rel. <xsl:value-of select="Annotation"/>, Last annotation update).
            </xsl:for-each>
            XX
            DE   <xsl:value-of select="DE_line"/>
            OS   <xsl:value-of select="OS_line"/>
            XX
            <xsl:for-each select="Similarity/HG_line/No_similarity">
                HG   none.
            </xsl:for-each>
            <xsl:for-each select="Similarity/HG_line/Homology">
                HG   Homology group <xsl:value-of select="Homology_number"/>; <xsl:value-of select="Homology_description"/>.
            </xsl:for-each>
            <xsl:for-each select="Similarity/AP_line/No_similarity">
                AP   none.
            </xsl:for-each>
            <xsl:for-each select="Similarity/AP_line/Alternative">
                AP   Alternative promoter #<xsl:value-of select="Alternative_number"/> of <xsl:value-of select="Alternative_total"/>; exon <xsl:value-of select="Alternative_exon"/>; site <xsl:value-of select="Alternative_site"/>.
            </xsl:for-each>
            <xsl:for-each select="Similarity/NP_line/No_similarity">
                NP   none.
            </xsl:for-each>
            <xsl:for-each select="Similarity/NP_line/Neighbour">
                NP   Neighbouring Promoter; <xsl:value-of select="Neighbour_AC"/>; <xsl:value-of select="Neighbour_ID"/>; <xsl:value-of select="Neighbour_position"/>.
            </xsl:for-each>
            XX
            <xsl:for-each select="Cross-links/EPD_link">
                DR   EPD; <xsl:value-of select="EPD_AC"/>; <xsl:value-of select="EPD_ID"/>; <xsl:value-of select="EPD_type"/>; <xsl:value-of select="EPD_pos"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/GENOME">
                DR   GENOME; <xsl:value-of select="GENOME_SV"/>; <xsl:value-of select="GENOME_AC"/>; <xsl:value-of select="GENOME_Position"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/EMBL_first">
                DR   EMBL; <xsl:value-of select="EMBL_SV"/>; <xsl:value-of select="EMBL_Position"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/EMBL">
                DR   EMBL; <xsl:value-of select="EMBL_SV"/>; <xsl:value-of select="EMBL_Position"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/SWISSPROT">
                DR   SWISS-PROT; <xsl:value-of select="SP_AC"/>; <xsl:value-of select="SP_ID"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/TRANSFAC">
                DR   TRANSFAC; <xsl:value-of select="TF_AC"/>; <xsl:value-of select="TF_ID"/>; <xsl:value-of select="TF_Position"/>; <xsl:value-of select="TF_Type"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/MIM">
                DR   MIM; <xsl:value-of select="MIM_AC"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/MGD">
                DR   MGD; <xsl:value-of select="MGD_AC"/>; <xsl:value-of select="MGD_ID"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/FLYBASE">
                DR   FLYBASE; <xsl:value-of select="FB_AC"/>; <xsl:value-of select="FB_ID"/>.
            </xsl:for-each>
            <xsl:for-each select="Cross-links/RefSeq">
                DR   RefSeq; <xsl:value-of select="RefSeq_AC"/>.
            </xsl:for-each>
            <xsl:for-each select="References">
                XX
                RN   <xsl:value-of select="RN_line"/>
                RX   MEDLINE; <xsl:value-of select="RX_line"/>
                <xsl:for-each select="RA_line">
                    RA   <xsl:value-of select="."/>
                </xsl:for-each>
                <xsl:for-each select="RT_line">
                    RT   <xsl:value-of select="."/>
                </xsl:for-each>
                <xsl:for-each select="RL_line">
                    RL   <xsl:value-of select="Journal_name"/> <xsl:value-of select="Volume"/>:<xsl:value-of select="Page_number"/> <xsl:value-of select="Journal_issue"/>.
                </xsl:for-each>
            </xsl:for-each>
            XX
            <xsl:for-each select="ME_line">
                ME   <xsl:value-of select="."/>
            </xsl:for-each>
            <xsl:for-each select="SE_line">
                XX
                SE   <xsl:value-of select="."/>
                XX
            </xsl:for-each>
            FL   <xsl:value-of select="MGA/FL_line"/>
            <xsl:for-each select="MGA/IF_line">
                IF   <xsl:value-of select="MGA/POS"/>   <xsl:value-of select="MGA/BASE"/>   <xsl:value-of select="MGA/DBTSS"/>   <xsl:value-of select="MGA/MGC"/>
                XX
            </xsl:for-each>
            <xsl:for-each select="Taxonomy">
                <xsl:for-each select="TX_line">
                    TX   <xsl:value-of select="."/>
                </xsl:for-each>
            </xsl:for-each>
            XX
            <xsl:for-each select="KW_line">
                KW   <xsl:value-of select="."/>
            </xsl:for-each>
            XX
            <xsl:for-each select="Old_format/FP_line">
                <xsl:value-of select="."/>
            </xsl:for-each>
            <xsl:for-each select="Old_format/DO1_line">
                DO   <xsl:value-of select="."/>
            </xsl:for-each>
            <xsl:for-each select="Old_format/DO2_line">
                DO   <xsl:value-of select="."/>
            </xsl:for-each>
            <xsl:for-each select="Old_format/RF_line">
                RF   <xsl:for-each select="REFS_ABB">
                    <xsl:value-of select="."/>;
                </xsl:for-each>
            </xsl:for-each>
            //
        </xsl:for-each>
    </xsl:template>

    <xsl:template match="ID_line">
        ID   <xsl:value-of select="."/>; <xsl:value-of select="@Type"/>; <xsl:value-of select="@Site_type"/>; <xsl:value-of select="@Taxonomic_division"/>
    </xsl:template>
</xsl:stylesheet>

