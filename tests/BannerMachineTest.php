<?php

namespace MakeBanner\Tests;

use MakeBanner\BannerMachine;
use PHPUnit\Framework\TestCase;

class BannerMachineTest extends TestCase
{
    private BannerMachine $machine;

    protected function setUp(): void
    {
        $this->machine = new BannerMachine();
    }

    public function testProcessTextReturnsArrayOfCharacters(): void
    {
        $result = $this->machine->processText('AB');
        $this->assertSame(['A', 'B'], $result);
    }

    public function testProcessTextRemoveSpaces(): void
    {
        $result = $this->machine->processText('A B');
        $this->assertSame(['A', 'B'], $result);
    }

    public function testProcessTextHandlesUtf8(): void
    {
        $result = $this->machine->processText('Hé');
        $this->assertSame(['H','é'], $result);
    }
}