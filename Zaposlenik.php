<?php

// Zaposlenik.php

class Zaposlenik {
    protected string $zaposlenik;
    protected bool $upisana_evidencija = false;

    function __construct($z)
    {
        $this->setZaposlenik($z);
    }

    public function getZaposlenik(): string
    {
        return $this->zaposlenik;
    }

    public function setZaposlenik(string $zaposlenik): bool
    {
        $this->zaposlenik = $zaposlenik;
        return true;
    }

    public function isUpisanaEvidencija(): bool
    {
        return $this->upisana_evidencija;
    }

    public function setUpisanaEvidencija(): bool
    {
        $this->upisana_evidencija = true;
        return true;
    }
}