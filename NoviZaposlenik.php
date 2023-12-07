<?php

// NoviZaposlenik.php

class NoviZaposlenik
{
    function __construct()
    {
        $this->NoviZaposlenik();
    }

    function NoviZaposlenik(): void
    {
        while (true) {
            Unos:
            echo "--------------------------------------\n";
            echo "Unesi IME i PREZIME novog zaposlenika:\n";
            $ime = readline(">> Ime: ");
            $prezime = readline(">> Prezime: ");
            $novi_zaposlenik = $ime." ".$prezime;
            str_replace('"', "", $novi_zaposlenik);
            $file_array = file(__DIR__ . "\\Zaposlenici\\Zaposlenici.csv");
            //print_r($file_array);
            foreach ($file_array as $key => $line) {
                $line = trim($line, "\n");
                $line = trim($line, "\r");
                $line = trim($line, ";");
                $line = trim($line, "\"");
                //echo "\n" . $line . "\n";
                if($line == $novi_zaposlenik) {
                    echo "\n>> Zaposlenik \"" . $novi_zaposlenik . "\" već postoji!\n\n";
                    goto end;
                }
            }
            echo <<<EOF
            
            ---------------------------------------
            Unos zaposlenika: $novi_zaposlenik
            1. Potvrdi unos
            2. Izmijeni unos
            ---------------------------------------
            
            EOF;
            $odabir = readline("Vaš odabir: ");

            if ($odabir == 1) {
                $file = __DIR__ . "\\Zaposlenici\\Zaposlenici.csv";
                $fp = fopen($file, "a+");

                $input_data = array((string)$novi_zaposlenik);
                echo "Novi Zaposlenik: ".$novi_zaposlenik;
                fputcsv($fp, $input_data, ";");
                fclose($fp);
                echo "\n-----| Uspješan Unos ! |-----\n\n";
                break;
            } else if ($odabir == 2) {
                goto Unos;
            } else {
                echo "\nPogrešan Unos. Ponovite Unos !\n";
            }
        }
        end:
    }
}