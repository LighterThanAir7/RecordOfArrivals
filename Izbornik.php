<?php

// Izbornik.php

class Izbornik
{
    function __construct()
    {
        $this->Izbornik();
    }

    function Izbornik()
    {
        while (true) {
            echo <<<EOF
            >------------------------------<
            >--| EVIDENCIJA RADNIH SATI |--<
            >------------------------------<
            
            >> Izbornik
            --------------------------------
            1. Upis radnih sati
            2. Ispis ukupnih radnih sati
            3. Dodaj novog zaposlenika
            4. Obriši zaposlenika
            --------------------------------
            
            EOF;

            while (true) {
                $odabir = readline("Odaberite opciju: ");
                if ($odabir == 1){
                    $upis = new Zaposlenici();
                    break;
                }
                else if ($odabir == 2) {
                    $ispis = new UkupnoSati();
                    break;
                }
                else if ($odabir == 3) {
                    $novi_zaposlenik = new NoviZaposlenik();
                    break;
                } else if($odabir == 4) {
                    $brisanje_zaposlenika = new BrisanjeZaposlenika();
                    break;
                }
                else {
                    echo "\n-----| Krivi Unos, Ponovite Unos! |-----\n";
                }
            }

            while (true) {
                $check = readline("Želite li nastaviti s radom programa? (d/n) => ");
                if ($check == 'd' or $check == 'D'){
                    break;
                } else if ($check == 'n' or $check == 'N'){
                    echo "\n-----| Kraj Programa |-----\n";
                    exit();
                } else {
                    echo "\n-----| Krivi Unos, Ponovite Unos! |-----\n";
                }
            }
        }
    }
}
