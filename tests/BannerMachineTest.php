<?php

namespace MakeBanner\Tests;

use MakeBanner\BannerMachine;
use PHPUnit\Framework\TestCase;

class BannerMachineTest extends TestCase
{
    private BannerMachine $machine;

    protected function setUp(): void
    {
        $pdfMock = $this->createMock(\TCPDF::class);
        $this->machine = new BannerMachine($pdfMock);
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

    public function testMainStreetAddsOnePagePerCharacter(): void
    {
        $pdfMock = $this->createMock(\TCPDF::class);
        $pdfMock->expects($this->exactly(3))->method('AddPage');

        $machine = new BannerMachine($pdfMock);
        $machine->mainStreet('ABC');
    }

    public function testMainStreetSavesThePdf(): void
    {
        $pdfMock = $this->createMock(\TCPDF::class);
        $pdfMock->expects($this->once())->method('Output');

        $machine = new BannerMachine($pdfMock);
        $machine->mainStreet('A');
    }
}