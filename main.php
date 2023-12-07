<?php

include 'Zaposlenik.php';
include 'Zaposlenici.php';
include 'UkupnoSati.php';
include "Izbornik.php";
include "NoviZaposlenik.php";
include "BrisanjeZaposlenika.php";

$izbornik = new Izbornik();

// TODO: 1. Povratak na glavni meni u koracima kod
//  Upis Randnih Sati               prilikom POTVRDE UNOSA
//  Ispis ukupnih radnih sati       prilikom POTVRDE UNOSA
//  Dodavanje novog zaposlenika     prilikom POTVRDE UNOSA
//  Brisanje postojećeg zaposlenika prilikom POTVRDE UNOSA