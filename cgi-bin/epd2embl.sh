#!/bin/sh
#
# This line defines the environment variable for FROMPS
SSA2DBC=/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def; export SSA2DBC

/bin/rm $4.inp $4
cat $1 > $4.fps
echo "$4.fps" > $4.inp
echo "$2"  >> $4.inp
echo "$3"  >> $4.inp
echo " "   >> $4.inp
echo " "   >> $4.inp
echo " "   >> $4.inp
echo "E"   >> $4.inp
echo "$4" >> $4.inp
/usr/molbio/bin/FROMFPS < $4.inp
./modify_blk.pl $4.dat > $4.blk
cat $4.blk

