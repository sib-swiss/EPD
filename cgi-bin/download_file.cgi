#!/usr/bin/env perl

use CGI ':standard';
use CGI::Carp qw(fatalsToBrowser);
use MyCGI;

my $q = new MyCGI;

my @fileholder;

my $files_location = './';
#my $ID = param('ID');
my $ID = $q->param('ID');

if ($ID eq '') {
   print "Content-type: text/html\n\n";
   print "You must specify a file to download.";
   } else {
   open(DLFILE, "<$files_location/$ID") || Error('open', 'file');
   @fileholder = <DLFILE>;
   close (DLFILE) || Error ('close', 'file');
   print "Content-Type:application/x-download\n";
   print "Content-Disposition:attachment;filename=$ID\n\n";
   print @fileholder
}

sub Error {
   print "Content-type: text/html\n\n";
   print "The server can't $_[0] the $_[1]: $! \n";
   exit;
}
