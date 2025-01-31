#!/usr/bin/env perl


$ENV{'PATH'} .= ":/usr/molbio/perl";

$fetch = "/home/epd/new/fetch2";
@EPD=();
foreach (<>)

{

    /^FP   ([^\;]+)\; ([^\.]+)\.(.*)/;
    $EPD_ID="EP$2";
    push(@EPD, $EPD_ID);
    foreach $EPD (@EPD)
    {

        print (`$fetch epdblk:$EPD`);
    }
}
