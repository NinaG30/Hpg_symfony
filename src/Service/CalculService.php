<?php

namespace App\Service;

// Service personnalisé pour calculs à effectuer (allège le controller)
class CalculService
{
    public function effectuerCalcul($montantFacture, $lngToiture, $largeurToiture)
    {
        //Calcul de la facture en kwh
        $resultatCalcul = $montantFacture / 0.20;

        //Calculs pour dimensionnement de l'installation permettant 70% d'économie
        $prod = $resultatCalcul * 0.7;
        $d = round($prod / 1460);
        $dWC = $d * 1000;
        $nBP = ceil($dWC / 375);

        return $nBP;
    }
}
