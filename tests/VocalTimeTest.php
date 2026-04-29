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
}
