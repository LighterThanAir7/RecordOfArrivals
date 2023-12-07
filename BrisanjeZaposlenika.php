<?php

// BrisanjeZaposlenika.php

class BrisanjeZaposlenika extends Zaposlenici
{
    function __construct()
    {
        parent::getImenaZaposlenika();
    }

    function OdabirZaposlenika(): void
    {
        if (0 == filesize(__DIR__."\\Zaposlenici\\Zaposlenici.csv"))
        {
            goto end;
        }
        while (true)
        {
            Unos:
            $odabir = readline("Odaberite zaposlenika kojeg želite obrisati: ");
            if (is_numeric($odabir) and key_exists(($odabir-1), $this->lista_zaposlenika)) {
                $this->setOdabraniZaposlenik($odabir);
                $file = __DIR__ . "\\Zaposlenici\\" . $this->getOdabraniZaposlenik()->getZaposlenik() . ".csv";
                if (file_exists($file)) {
                    unlink($file);
                }
                $file_array = file(__DIR__ . "\\Zaposlenici\\Zaposlenici.csv");
                echo <<<EOF
                ------------------------------------------------
                Jeste li sigurni da želite obrisati zaposlenika? 
                >> Zaposlenik: {$this->getOdabraniZaposlenik()->getZaposlenik()}
                1. Potvrdi unos
                Zad22. Izmijeni unos
                ------------------------------------------------
                
                EOF;
                $check = readline("Vaš odabir: ");
                if ($check == 1)
                {
                    unset($file_array[$odabir-1]);

                    $csvContent = implode(PHP_EOL, $file_array);
                    file_put_contents(__DIR__ . "\\Zaposlenici\\Zaposlenici.csv", $csvContent);
                    echo "\n-----| Zaposlenik uspješno obrisan ! |-----\n\n";
                    break;
                }
                else if ($check == 2)
                {
                    goto Unos;
                }
                else {
                    echo "\nPogrešan Unos. Ponovite Unos !\n";
                }
            }
            else {
                echo "\nNe postoji takav zaposlenik. Ponovite Unos !\n";
            }
        }
        end:
    }
}