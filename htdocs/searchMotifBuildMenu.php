<?php

$library = $_GET["lib"];

if ($library == "promoter"){
  echo "tata TATA-box\n";
  echo "initiator Initiator\n";
  echo "gcbox GC-box\n";
  echo "ccaatbox CCAAT-box\n";
}else{
  if ($library == "jasparCoreVertebrates"){
    $pwmFile = "pwmlib/JASPAR_CORE_2018_vert_matrix_logodds.mat";
    $command = 'awk \'$1 ~ "^>"{print $3,$4}\' '.$pwmFile.' | sort -k2,2 | sed \'s/:$//\'';
  }
  else if ($library == "jasparCorePlants"){
    $pwmFile = "pwmlib/JASPAR_CORE_2018_plants_matrix_logodds.mat";
    $command = 'awk \'$1 ~ "^>"{print $3,$4}\' '.$pwmFile.' | sort -k2,2 | sed \'s/:$//\'';
  }
  else if ($library == "jasparCoreInsects"){
    $pwmFile = "pwmlib/JASPAR_CORE_2018_insects_matrix_logodds.mat";
    $command = 'awk \'$1 ~ "^>"{print $3,$4}\' '.$pwmFile.' | sort -k2,2 | sed \'s/:$//\'';
  }
  else if ($library == "uniprobeWorm"){
    $pwmFile = "pwmlib/uniprobe_worm_matrix_logodds.mat";
    $command = 'awk \'$1 ~ "^>"{print $3,$3}\' '.$pwmFile.' | sort -k2,2 | sed \'s/:$//g\'';
  }
  else if ($library == "swissRegulonYeast"){
    $pwmFile = "pwmlib/SwissRegulon_s_cer_matrix_logodds.mat";
    $command = 'awk \'$1 ~ "^>"{print $3,$3}\' '.$pwmFile.' | sort -k2,2 | sed \'s/:$//g\'';
  }

#  $command = 'awk \'$1 ~ "^>"{print $3,$4}\' '.$pwmFile.' | sort -k2,2 | sed \'s/:$//\'';
#  print "$command\n"
  $options = shell_exec($command);
#  foreach ($options as $option) {
#    print "$option\n";
#  }
  print "$options\n";
}


?>
