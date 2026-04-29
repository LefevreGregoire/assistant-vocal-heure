<?php

namespace App;

class VocalTime
{
    private static array $nombres = [
        1 => 'une', 2 => 'deux', 3 => 'trois', 4 => 'quatre', 5 => 'cinq',
        6 => 'six', 7 => 'sept', 8 => 'huit', 9 => 'neuf', 10 => 'dix',
        11 => 'onze'
    ];

    public static function traduire(\DateTime $time): string
    {
        $heure = (int) $time->format('G');
        
        // Gestion rapide (Green) de l'après-midi
        if ($heure > 12) {
            $heureTexte = self::$nombres[$heure - 12];
            $pluriel = ($heure - 12) > 1 ? 's' : '';
            return "{$heureTexte} heure{$pluriel} de l'après-midi";
        }
        
        // Matin
        $texteHeure = self::$nombres[$heure];
        $pluriel = $heure > 1 ? 's' : '';
        
        return "{$texteHeure} heure{$pluriel} du matin";
    }
}
