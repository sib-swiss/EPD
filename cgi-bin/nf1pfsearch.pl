#!/usr/bin/env perl

# CGI-bin: input data is a nuclear factor 1 (NF-1) binding site
# profile and a DNA sequence.  These inputs are reformatted and fes to
# 'pfsearch' as files. Output is sent back to the server as is.

use CGI::Lite;			# CGI package
$form = new CGI::Lite();

# get input
%val = $form->parse_form_data();

# print the header
print "Content-type: text/html\n\n";
print "<HTML><HEAD><TITLE>Profile search results</TITLE><HEAD><BODY>";
print "<H2>Profile search results</H2><HR>";
print "<PRE>";

# write files
$pfilename = writeProfile();
$sfilename = writeSequence();

# call pfsearch and print results, according to output option

if ($val{'outputOption'} eq "optimal") {
    open ('PFSEARCH', "/usr/molbio/bin/pfsearch -raf $pfilename $sfilename 2>&1|") or die
	("Could not start pfsearch.");

    while (<PFSEARCH>) {
	print;
    }

    close ('PFSEARCH');
}

if ($val{'outputOption'} eq "withCutoff") {
    open ('PFSEARCH', "/usr/molbio/bin/pfsearch -fry $pfilename $sfilename 2>&1|") or die
	("Could not start pfsearch.");

    while (<PFSEARCH>) {
	print;
    }
    close ('PFSEARCH');
}

# $form->print_form_data();


# print footer
print "</PRE>";
print "</BODY></HTML>";

# clean up
  unlink ($pfilename, $sfilename);



# subroutines ----------------------------------------------------------

sub writeProfile {
    my ($pfilename) = "/tmp/profile" . $$; # construct unique temporary filename
    open (PFILE, ">$pfilename") or die ("Could not open $pfilename for writing.\n");

print PFILE <<"End";
ID   NF1_SITE; MATRIX.
AC   NS00000;
DT   OCT-1996 (CREATED).
DE   Nuclear factor I-binding site.
MA   /GENERAL_SPEC: ALPHABET='ACGT'; LENGTH=16;
MA   /DISJOINT: DEFINITION=PROTECT; N1=1; N2=1;
MA   /NORMALIZATION: MODE=1; FUNCTION=LINEAR; R1=0.0; R2=0.1;
MA      TEXT='-LogK[M]';
MA   /CUT_OFF: LEVEL=0; SCORE=$val{'cutoff'}; N_SCORE=0.0; MODE=1;
MA   /DEFAULT: B0=-9999; B1=-9999; E0=-9999; E1=-9999;
MA   /I: B0=0; B1=0;
MA   /M: SY='T'; M= $val{'A1'}, $val{'C1'}, $val{'G1'}, $val{'T1'};
MA   /M: SY='T'; M= $val{'A2'}, $val{'C2'}, $val{'G2'}, $val{'T2'};
MA   /M: SY='G'; M= $val{'A3'}, $val{'C3'}, $val{'G3'}, $val{'T3'};
MA   /M: SY='G'; M= $val{'A4'}, $val{'C4'}, $val{'G4'}, $val{'T4'};
MA   /M: SY='C'; M= $val{'A5'}, $val{'C5'}, $val{'G5'}, $val{'T5'};
MA   /I: E0=$val{'hspenalty'}; E1=$val{'hspenalty'};
MA   /M:
MA   /M:
MA   /I: MM= $val{'llen7'}; MD= 0;
MA   /M: SY='X';
MA   /I: DM= $val{'llen6'};
MA   /M: SY='-';
MA   /I: DM= $val{'llen5'};
MA   /M: SY='-';
MA   /I: DM= $val{'llen4'};
MA   /M:
MA   /M:
MA   /I: B0=$val{'hspenalty'}; B1=$val{'hspenalty'};
MA   /M: SY='G'; M= $val{'T5'}, $val{'G5'}, $val{'C5'}, $val{'A5'};
MA   /M: SY='C'; M= $val{'T4'}, $val{'G4'}, $val{'C4'}, $val{'A4'};
MA   /M: SY='C'; M= $val{'T3'}, $val{'G3'}, $val{'C3'}, $val{'A3'};
MA   /M: SY='A'; M= $val{'T2'}, $val{'G2'}, $val{'C2'}, $val{'A2'};
MA   /M: SY='A'; M= $val{'T1'}, $val{'G1'}, $val{'C1'}, $val{'A1'};
MA   /I: E0=0; E1=0;
//
End

    close (PFILE);
return $pfilename;
}

sub writeSequence {
    my ($sfilename) = "/tmp/sequence" . $$; # construct unique temporary filename
    open (SFILE, ">$sfilename") or die ("Could not open $sfilename for writing.\n");

    # discard leading whitespace from sequence.
    $val{'sequence'} =~ s/^\s+//;

    print SFILE "$val{'sequence'}\n";

    close(SFILE);

    return $sfilename;
}
