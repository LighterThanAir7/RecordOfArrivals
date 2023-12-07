<?php

// Zaposlenici.php

class Zaposlenici
{
    protected array $lista_zaposlenika = array();
    protected object $odabrani_zaposlenik;
    protected string $danasnji_datum;
    protected int $dolazak;
    protected int $odlazak;
    protected int $odabir;

    function __construct() {
        $this->getDanasnjiDatum();
        $this->getImenaZaposlenika();
    }

    function getImenaZaposlenika(): void
    {
        $file = __DIR__."\\Zaposlenici\\Zaposlenici.csv";
        $resource = fopen($file, "r");
        if (!fgetcsv($resource))
        {
            echo "\n-----| Potrebno je prvo unijeti zaposlenike ! |-----\n\n";
            fclose($resource);
            goto end;
        } else {
            $file_array = file($file);
            if (is_array($file_array)) {
                foreach ($file_array as $key => $line) {
                    $line = trim($line, "\n");
                    $line = trim($line, "\r");
                    $line = trim($line, ";");
                    $line = trim($line, "\"");
                    $novi_zaposlenik = new Zaposlenik($line);         // Konstruktor klasa Zaposlenik
                    $this->lista_zaposlenika[] = $novi_zaposlenik;
                }
            }
            $this->prikaziZaposlenike();
        }
        end:
    }

    function prikaziZaposlenike(): void
    {
        echo "-----------------------------------\n";
        foreach ($this->lista_zaposlenika as $key => $zaposlenik)
        {
            echo ($key+1).". ".$zaposlenik->getZaposlenik()."\n";
        }
        echo "-----------------------------------\n";
        $this->OdabirZaposlenika();
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
                echo "Unos podataka za: " . $this->getOdabraniZaposlenik()->getZaposlenik()."\n";
                echo "----------------------------------------------------------\n";
                echo "Unesite vrijeme kao CIJELI BROJ između 10-22 (Radno Vrijeme)\n";
                echo $this->DolazakNaPosao();
                echo $this->OdlazakSPosla();
                echo $this->UcitajPodatkeZaposlenika();
                break;
            } else {
                echo "Pogrešan Unos. Ponovite Unos!\n";
            }
        }
    }

    function DolazakNaPosao(): string
    {
        $ispis = "";
        while (true){
            $dolazak = readline("Vrijeme Dolaska: ");
            if(is_numeric($dolazak) and $dolazak >= 10 and $dolazak <= 22) { // 10-22 = radno vrijeme
                $this->setDolazak($dolazak);
                break;
            }
            else {
                echo "Unesite vrijeme dolaska u ispravnom intervalu. Ponovite Unos!\n";
            }
        }
        return $ispis;
    }

    function OdlazakSPosla(): string
    {
        $ispis = "";
        while (true){
            $odlazak = readline("Vrijeme Odlaska: ");
            if(is_numeric($odlazak) and $odlazak >= 10 and $odlazak <= 22 and $odlazak > $this->getDolazak()) { // 10-22 = radno vrijeme
                $this->setOdlazak($odlazak);
                break;
            }
            else {
                echo "Unesite vrijeme odlaska u ispravnom intervalu. Ponovite Unos!\n";
            }
        }
        return $ispis;
    }

    function UcitajPodatkeZaposlenika(): string
    {
        $ispis = "";
        $z = 0;
        $csv_file = __DIR__."\\Zaposlenici\\".$this->getOdabraniZaposlenik()->getZaposlenik().".csv";
        if(file_exists($csv_file))
        {
            upis:
            $file_array = file($csv_file);
            if (is_array($file_array)) {
                foreach ($file_array as $line) {
                    $line = trim($line, "\n");
                    $line = trim($line, "\r");
                    $line_array = explode(";", $line);

                    $datum_iz_csv = $line_array[0]; // Datum npr. 2022-06-03
                    if ($datum_iz_csv == date("Y-m-d")){
                        $z++;
                    }
                }

                if ($z == 0) {
                    $file = __DIR__ . "\\Zaposlenici\\" . $this->getOdabraniZaposlenik()->getZaposlenik() . ".csv";
                    $fp = fopen($file, "a+");
                    $input_data = array($this->getDanasnjiDatum(), $this->getDolazak(), $this->getOdlazak());
                    fputcsv($fp, $input_data, ";");
                    $this->odabrani_zaposlenik->setUpisanaEvidencija();
                    $ispis .= "\n-----| Upis Evidencije ! |-----\n";
                    $ispis .= "=> Zaposlenik: ".$this->odabrani_zaposlenik->getZaposlenik()."\n";
                    $ispis .= "=> Datum: ".date("d.m.Y");
                    $ispis .= "\n-----| Uspješan Unos ! |-----\n\n";
                    fclose($fp);
                } else {
                    $ispis .= "\n-----| Upis Evidencije ! |-----\n";
                    $ispis .= "=> Zaposlenik: ".$this->odabrani_zaposlenik->getZaposlenik()."\n";
                    $ispis .= "=> Datum: ".date("d.m.Y");
                    $ispis .= "\n=> Evidencija je VEĆ UPISANA!\n\n\n";
                }
            }
        } else {
            $fp = fopen($csv_file, "w+");
            fclose($fp);
            goto upis;
        }
        return $ispis;
    }

    //-----------------------          GETTERS & SETTERS          ----------------------------ž

    public function setOdabraniZaposlenik($odabrani_zaposlenik): bool
    {
        $this->odabrani_zaposlenik = $this->lista_zaposlenika[$odabrani_zaposlenik-1];//->getZaposlenik();
        return true;
    }

    public function setDolazak($dolazak): bool
    {
        $this->dolazak = $dolazak;
        return true;
    }

    public function setOdlazak($odlazak): bool
    {
        $this->odlazak = $odlazak;
        return true;
    }

    public function getDolazak(): int
    {
        return $this->dolazak;
    }

    public function getOdlazak(): int
    {
        return $this->odlazak;
    }

    public function getOdabraniZaposlenik(): object
    {
        return $this->odabrani_zaposlenik;
    }

    function getDanasnjiDatum(): string
    {
        $this->danasnji_datum = date("Y-m-d");
        return $this->danasnji_datum;
    }
}