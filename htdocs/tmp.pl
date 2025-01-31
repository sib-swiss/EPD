#!/usr/bin/perl
#
open(INP, "<url_extern.txt"); while(<INP>) {
  chomp; ($name, $url) = split /\s+/;
  $url_extern{$name} = $url;
  print "$name $url_extern{$name}\n"
  }
