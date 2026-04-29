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

        // On cherche le multiple de 5 le plus proche
        $minuteArrondie = (int) round($minute / 5) * 5;
        $ecart = abs($minute - $minuteArrondie);

        // Si l'arrondi nous fait basculer à l'heure pile suivante (ex: 58 -> 60)
        if ($minuteArrondie === 60) {
            $minuteArrondie = 0;
            $heure = ($heure + 1) % 24;
        } elseif ($minuteArrondie > 30) {
            // Si on dépasse la demi-heure, on prépare le "moins le quart", etc.
            $heure = ($heure + 1) % 24;
        }

        // 1. Construction des minutes
        $strMinute = '';
        if ($minuteArrondie > 0 && isset(self::$minutesTexte[$minuteArrondie])) {
            $strMinute = ' ' . self::$minutesTexte[$minuteArrondie];
        }

        // 2. Construction de la base (Heure + Période)
        $baseTexte = "";
        if ($heure === 12) {
            $baseTexte = "midi{$strMinute}";
        } elseif ($heure === 0) {
            $baseTexte = "minuit{$strMinute}";
        } else {
            $suffixe = "du matin";
            $heureAffichee = $heure;

            if ($heure > 12) {
                $heureAffichee = $heure - 12;
                $suffixe = "de l'après-midi";
            }

            $texteHeure = self::$nombres[$heureAffichee];
            $pluriel = $heureAffichee > 1 ? 's' : '';

            $baseTexte = "{$texteHeure} heure{$pluriel}{$strMinute} {$suffixe}";
        }

        // 3. Ajout de la précision si nécessaire
        $precisionTexte = '';
        if ($ecart > 0) {
            // On réutilise notre tableau de nombres pour avoir "une" ou "deux"
            $motEcart = self::$nombres[$ecart];
            $plurielEcart = $ecart > 1 ? 's' : '';
            $precisionTexte = " à {$motEcart} minute{$plurielEcart} près";
        }

        return $baseTexte . $precisionTexte;
    }
}
