#!/usr/bin/env perl

# This script creates a BASH script that will update database and
# viewer PHP files for each species.
# "_old" backup files will automatically be produced, in case any edits
# were previously made.
#
# The correct place to run the scripts is /local/ccguser/epd_http/htdocs

use strict;
use warnings;

my $SCRIPT_PATH = "/home/pameylan/home.vital-it/bin";

my %twolettcode2dir;
my %twolettcode2ass;
# I added a 4th column to "epd.conf" containing the assembly to be used for the
# the database and viewer PHP files
my $epdconf = "/local/ccg/etc/viewer.conf";
if(open(my $fh, '<', $epdconf)) {
    while (<$fh>) {
        chomp;
        my @f = split /\t/;
        $twolettcode2dir{$f[0]} = $f[1];
        $twolettcode2ass{$f[0]} = $f[3];
    }
    close $fh;
} else { die("Could not open file $epdconf."); }

print "#!/usr/bin/bash\n\n";
print "# Run this script in /local/ccguser/epd_http/htdocs\n\n";

foreach(keys %twolettcode2dir) {
    my $dir = $twolettcode2dir{$_};
    my $assembly = $twolettcode2ass{$_};
    my $viewertable = (ucfirst $_)."_viewer_table.txt";
    my $command = "cd $dir
cp $dir\_database.php $dir\_database_old.php
cp $dir\_viewer.php $dir\_viewer_old.php
$SCRIPT_PATH/make_database_template.pl ".(($_ =~ m/NC$/) ? "-n " : "")."-a $assembly > $dir\_database.php
$SCRIPT_PATH/make_viewer_page.pl -a $assembly $viewertable > $dir\_viewer.php
cd ..";
    print "$command\n\n";
}

