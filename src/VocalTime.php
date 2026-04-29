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
        $minute = (int) $time->format('i');
        
        // Gestion des heures spéciales "pile"
        if ($heure === 12 && $minute === 0) {
            return "midi";
        }
        if ($heure === 0 && $minute === 0) {
            return "minuit";
        }
        
        $suffixe = "du matin";
        $heureAffichee = $heure;

        if ($heure > 12) {
            $heureAffichee = $heure - 12;
            $suffixe = "de l'après-midi";
        }
        
        $texteHeure = self::$nombres[$heureAffichee];
        $pluriel = $heureAffichee > 1 ? 's' : '';
        
        return "{$texteHeure} heure{$pluriel} {$suffixe}";
    }
}
