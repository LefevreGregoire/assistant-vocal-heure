# Assistant Vocal - Traduction d'Heure (TDD)

## Objectif
Élaborer une classe PHP traduisant une heure (`DateTime`) en texte "user friendly". Chaque étape a été implémentée avec la rigueur TDD (Red, Green, Refactor).

## Fonctionnalités
- Heures piles (matin/après-midi)
- Heures spéciales (midi/minuit)
- Minutes (05 à 30) incluant "et quart" et "et demie"
- Minutes (> 30) avec formulation "moins..."
- Précision à la minute près par arrondi au multiple de 5.

## Utilisation
```php
use App\VocalTime;
echo VocalTime::traduire(new \DateTime('08:48')); 
// "neuf heures moins dix du matin à deux minutes près"
```

## Tests 

```bash
composer install
./vendor/bin/phpunit tests
```

