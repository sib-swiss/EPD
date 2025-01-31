# perl module containing variables with frequently used URLs, links, ...

package links;
require Exporter;
our @ISA=('Exporter');
our @EXPORT=qw(%URLs %assemb %BEDE %BEDU %BEDP %ENSEMBL %UCSC %PlantGDB %Gramene %taxID);


# URLs of database access sites.

%URLs = (
    'DBTSS' => "http://dbtss.hgc.jp/cgi-bin/home.cgi?NMID=",
    'DDBJ' => "http://getentry.ddbj.nig.ac.jp/getentry/na/", #AC
    'EMBL' => "https://www.ebi.ac.uk/htbin/emblfetch?",
    'ENSEMBL' =>"https://www.ensembl.org/Drosophila_melanogaster/geneview?gene=",
    'EPD' => "/cgi-bin/miniepd/query_result.pl?out_format=NICE&from=-499&to=100&Entry_0=",
    'CLEANEX' =>"http://cleanex.vital-it.ch/cgi-bin/get_doc?db=cleanex&format=nice&entry=",
    'FLYBASE' => "http://flybase.bio.indiana.edu/cgi-bin/gbrowse/dmel/?",
    'GenBank' => "https://www.ncbi.nlm.nih.gov/nuccore/", #SV
    'GENOME' => "https://www.ncbi.nlm.nih.gov/sites/entrez?cmd=Search&db=nuccore&QueryKey=1&term=", #SV
    'MEDLINE' => "https://www.ncbi.nlm.nih.gov/entrez/query.fcgi?db=PubMed&cmd=Retrieve&list_uids=",
    'MGD'=> "http://www.informatics.jax.org/searches/accession_report.cgi?id=",
    'MIM' => "https://www.ncbi.nlm.nih.gov/omim/",
    'RefSeq' => "https://www.ncbi.nlm.nih.gov/nuccore/",
    'SPTREMBL' => "https://www.expasy.org/cgi-bin/sprot-search-ac?",
    'SWISS-PROT' => "https://www.uniprot.org/uniprot/",
    'TAXONOMY' => "https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Undef&name=",
    'TRANSCRIPTOME' => "/cgi-bin/tromer/tromer_quick_search_internal.pl?query_str=",
    'TRANSFAC' => "http://www.gene-regulation.com/cgi-bin/pub/databases/transfac/getTF.cgi?AC=",
    'TIGR' => "http://www.tigr.org/tigr-scripts/osa1_web/gbrowse/rice?name=LOC_",
    'HapMap' => "http://www.hapmap.org/cgi-perl/gbrowse/gbrowse/hapmap3r3_B36/?name=xx;width=800;version=100;label=CYT%3Aoverview-gene%3Aoverview-gts%3Aoverview-gtsh-dbS-mRNA",
#Os09g23620;type=Contig+Genes+Rice_Annotation+rice_flcdna+TIGR_rice_ta',
	 );
# current genome assemblies
%assemb=(
    'Arabidopsis thaliana' => 'AT_NCBI_TAIR7.0',
#          'Apis mellifera' => 'Amel_v4.0', # no entries in EPD!
    'Bos taurus' => 'BT_NCBI_3.1',
    'Caenorhabditis elegans' => 'CE_WS170',
    'Drosophila melanogaster' => 'DM_BDGP5.1',
    'Gallus gallus' => 'GG_NCBI_2.1',
    'Homo sapiens' => 'HS_NCBI36',
    'Mus musculus' => 'MM_NCBI_m37',
    'Oryza sativa' => 'OS_TIGR_5',
    'Pan troglodytes' => 'PT_NCBI_2.1',
    'Rattus norvegicus' => 'RN_RGSC_3.4'
    );
# BED file names to visualize data in genome browsers (if not yet updated to latest genome assembly, use BED from previous EPD rel.)
# ENSEMBL ContigView
%BEDE = (
    'Bos taurus' => 'epd128_BT_NCBI_3.1.BED',
    'Caenorhabditis elegans' => 'epd128_CE_WS170.BED',
    'Drosophila melanogaster' => 'epd128_DM_BDGP5.1.BED',
    'Gallus gallus' => 'epd128_GG_NCBI_2.1.BED',
    'Homo sapiens' => 'epd128_HS_NCBI36.BED',
    'Mus musculus' => 'epd128_MM_NCBI_m37.BED',
    'Pan troglodytes' => 'epd128_PT_NCBI_2.1.BED',
    'Rattus norvegicus' => 'epd128_RN_RGSC_3.4.BED'
    );
# UCSC Genome Browser
%BEDU = (
    'Bos taurus' => 'epd128_BT_NCBI_3.1.BED',
    'Caenorhabditis elegans' => 'epd128_CE_WS170.BED',
    'Drosophila melanogaster' => 'epd128_DM_BDGP5.1.BED',
    'Gallus gallus' => 'epd128_GG_NCBI_2.1.BED',
    'Homo sapiens' => 'epd128_HS_NCBI36.BED',
    'Mus musculus' => 'epd128_MM_NCBI_m37.BED',
    'Pan troglodytes' => 'epd128_PT_NCBI_2.1.BED',
    'Rattus norvegicus' => 'epd128_RN_RGSC_3.4.BED'
    );
# PlantGDB Genome Browser
%BEDP = (
    'Arabidopsis thaliana' => 'epd128_AT_NCBI_TAIR7.0.BED',
    'Oryza sativa' => 'epd128_OS_TIGR_5.BED'
    );
# ENSEMBL version to use in URL (missing URL -> no link)
%ENSEMBL= (
    'Bos taurus' => 'http://dec2008.archive.ensembl.org/Bos_taurus/contigview',
    'Caenorhabditis elegans' => 'http://dec2008.archive.ensembl.org/Caenorhabditis_elegans/contigview',
    'Drosophila melanogaster' => 'http://dec2008.archive.ensembl.org/Drosophila_melanogaster/contigview',
    'Gallus gallus' => 'http://dec2008.archive.ensembl.org/Gallus_gallus/contigview',
    'Homo sapiens' => 'http://dec2008.archive.ensembl.org/Homo_sapiens/contigview',
    'Mus musculus' => 'http://dec2008.archive.ensembl.org/Mus_musculus/contigview',
    'Pan troglodytes' => 'http://dec2008.archive.ensembl.org/Pan_troglodytes/contigview',
    'Rattus norvegicus' => 'http://dec2008.archive.ensembl.org/Rattus_norvegicus/contigview'
    );
# UCSC species specific URL (missing URL -> no link)
%UCSC = (
    'Bos taurus' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=vertebrate&org=Cow&db=bosTau3',
    'Caenorhabditis elegans' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=worm&org=C.+elegans&db=ce6',
    'Drosophila melanogaster' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=insect&org=D.+melanogaster&db=dm3',
    'Gallus gallus' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=vertebrate&org=Chicken&db=galGal3',
    'Homo sapiens' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=vertebrate&org=Human&db=hg18',
    'Mus musculus' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=vertebrate&org=Mouse&db=mm9',
    'Pan troglodytes' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=vertebrate&org=Chimp&db=panTro2',
    'Rattus norvegicus' => 'http://genome.ucsc.edu/cgi-bin/hgTracks?clade=vertebrate&org=Rat&db=rn4'
    );
# PlantGDB species specific URL (missing URL -> no link)
%PlantGDB =(
    'Arabidopsis thaliana' => 'http://www.plantgdb.org/AtGDB-cgi/getRegion.pl?dbid=2',
    'Oryza sativa' => 'http://www.plantgdb.org/OsGDB-cgi/getRegion.pl?dbid=3'
    );
# Gramene species specific URL (missing URL -> no link)
%Gramene=(
    'Arabidopsis thaliana' => 'http://www.gramene.org/Arabidopsis_thaliana/contigview?',
    'Oryza sativa' => 'http://www.gramene.org/Oryza_sativa_japonica/contigview?'
    );
# NCBI taxonomic ID
%taxID= (
    'Arabidopsis thaliana' => '3702',
    'Bos taurus' => '9913',
    'Caenorhabditis elegans' => '6239',
    'Drosophila melanogaster' => '7227',
    'Gallus gallus' => '9031',
    'Homo sapiens' => '9606',
    'Mus musculus' => '10090',
    'Rattus norvegicus' => '10116',
    'Oryza sativa' => '4530',
    'Pan troglodytes' => '9598'
    );
