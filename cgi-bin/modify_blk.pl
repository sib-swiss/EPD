#!/usr/bin/env perl
#

init_ID_list();

$/ = "//\n";

while (<>)

{
    my @a = split /^/;
    foreach (@a)
    {

	if (/^ID/)
	{
	    /^ID   FP0(\d{5})(\s+[^\;]+); ([^\;]+); ([^\;]+); (.*)/;
	    $AC_number="EP$1";
	    $type=$2;
	    $rest=$5;
	    $epd_id=($id{$AC_number});
	    print
	print "ID   $epd_id$type; DNA; EPD; $rest\n";

	}
	elsif (/^AC/)
	{
	    print "AC   $AC_number\;\n";
	}
	else
	{
	    print;
	}
    }

}


######Subroutine

sub init_ID_list {
    open ( ID_LIST, "/db/epd/current/ID_list") || die " can't open ID_list: $!";

	   while ( defined ($ID = <ID_LIST>)) {
	       chomp ($ID);
	       $AC= <ID_LIST>;
	       chomp ($AC);
	       $id{$AC} = $ID;
	   }
	   close (ID_LIST) || die " couldn't close ID_list: $!";
}
