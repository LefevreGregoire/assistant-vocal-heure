<?php

namespace App;

class VocalTime
{
    private static array $nombres = [
        1 => 'une', 2 => 'deux', 3 => 'trois', 4 => 'quatre', 5 => 'cinq',
        6 => 'six', 7 => 'sept', 8 => 'huit', 9 => 'neuf', 10 => 'dix',
        11 => 'onze'
    ];

    private static array $minutesTexte = [
        5 => 'cinq', 10 => 'dix', 15 => 'et quart',
        20 => 'vingt', 25 => 'vingt-cinq', 30 => 'et demie',
        35 => 'moins vingt-cinq', 40 => 'moins vingt', 45 => 'moins le quart',
        50 => 'moins dix', 55 => 'moins cinq'
    ];

    public static function traduire(\DateTime $time): string
    {
        $heure = (int) $time->format('G');
        $minute = (int) $time->format('i');

        // Bascule sur l'heure suivante si on a dépassé la demi-heure
        if ($minute > 30) {
            $heure = ($heure + 1) % 24;
        }

        $strMinute = '';
        if ($minute > 0 && isset(self::$minutesTexte[$minute])) {
            $strMinute = ' ' . self::$minutesTexte[$minute];
        }

        if ($heure === 12) {
            return "midi{$strMinute}";
        }
        if ($heure === 0) {
            return "minuit{$strMinute}";
        }

        $suffixe = "du matin";
        $heureAffichee = $heure;

        if ($heure > 12) {
            $heureAffichee = $heure - 12;
            $suffixe = "de l'après-midi";
        }

        $texteHeure = self::$nombres[$heureAffichee];
        $pluriel = $heureAffichee > 1 ? 's' : '';

        return "{$texteHeure} heure{$pluriel}{$strMinute} {$suffixe}";
    }
}
