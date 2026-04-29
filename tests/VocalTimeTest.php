<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\VocalTime;

class VocalTimeTest extends TestCase
{
    public function testHeurePileMatin(): void
    {
        $this->assertEquals("sept heures du matin", VocalTime::traduire(new \DateTime('07:00')));
        $this->assertEquals("une heure du matin", VocalTime::traduire(new \DateTime('01:00')));
    }

    public function testHeurePileApresMidi(): void
    {
        $this->assertEquals("deux heures de l'après-midi", VocalTime::traduire(new \DateTime('14:00')));
    }

    public function testHeuresSpeciales(): void
    {
        $this->assertEquals("midi", VocalTime::traduire(new \DateTime('12:00')));
        $this->assertEquals("minuit", VocalTime::traduire(new \DateTime('00:00')));
    }

    public function testTranchesCinqMinutesNormales(): void
    {
        $this->assertEquals("midi dix", VocalTime::traduire(new \DateTime('12:10')));
        $this->assertEquals("minuit et quart", VocalTime::traduire(new \DateTime('00:15')));
        $this->assertEquals("trois heures vingt-cinq de l'après-midi", VocalTime::traduire(new \DateTime('15:25')));
    }

    public function testTranchesCinqMinutesSpeciales(): void
    {
        $this->assertEquals("neuf heures moins le quart du matin", VocalTime::traduire(new \DateTime('08:45')));
        $this->assertEquals("une heure moins vingt-cinq de l'après-midi", VocalTime::traduire(new \DateTime('12:35')));
    }

    public function testMinutesPrecises(): void
    {
        $this->assertEquals("neuf heures moins dix du matin à deux minutes près", VocalTime::traduire(new \DateTime('08:48')));
        // Le strtolower sert à ignorer la majuscule sur le 'M' de Midi mise dans l'énoncé pour simplifier
        $this->assertEquals("midi cinq à une minute près", strtolower(VocalTime::traduire(new \DateTime('12:04')))); 
    }
}
