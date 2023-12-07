<?php

// UkupnoSati.php

class UkupnoSati extends Zaposlenici
{

    function __construct()
    {
        parent::getImenaZaposlenika();
    }

    function OdabirZaposlenika(): void
    {
        while (true)
        {
            $odabir = readline("Odaberite broj ispred imena zaposlenika: ");
            if (is_numeric($odabir) and key_exists(($odabir-1), $this->lista_zaposlenika)){
                $this->setOdabraniZaposlenik($odabir);
                $this->odabir = $odabir;
                echo "----------------------------------------------------------\n";
                echo "Ispis podataka za: " . $this->getOdabraniZaposlenik()->getZaposlenik()."\n";
                echo "----------------------------------------------------------\n";
                echo $this->Ucitaj();
                break;
            } else {
                echo "Pogrešan Unos. Ponovi Unos!\n";
            }
        }
        end:
    }

    function Ucitaj(): string
    {
        $suma_sati = 0;
        $csv_file = __DIR__."\\Zaposlenici\\".$this->getOdabraniZaposlenik()->getZaposlenik().".csv";
        if(file_exists($csv_file))
        {
            $file_array = file($csv_file);
            if(is_array($file_array))
            {
                foreach($file_array as $line) {
                    $line = trim($line, "\n");
                    $line = trim($line, "\r");

                    $line_array = explode(";", $line);

                    //$datum = $line_array[0];
                    $dolazak = $line_array[1];
                    $odlazak = $line_array[2];

                    $suma_sati += (int)$odlazak - (int)$dolazak;
                }
            }
        }
        else
        {
            echo "Zaposlenik \"" . $this->getOdabraniZaposlenik()->getZaposlenik() . "\" još nema unesenih sati!\n";
        }
        return "Ukupno Sati za ".date("n").". mjesec: ".$suma_sati . " h\n\n";
    }
}