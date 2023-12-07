<?php

$novi_zaposlenik = readline("Unesi ime i prezime novog zaposlenika: ");
$input_data = array($novi_zaposlenik);


echo "\n";
echo "\n";
echo $novi_zaposlenik;
echo "\n";
echo "\n";
foreach ($input_data as $line){
    echo $line;
}
echo "\n";
echo "\n";
print_r($input_data);