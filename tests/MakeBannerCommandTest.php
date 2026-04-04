<?php

namespace MakeBanner\Tests;

use MakeBanner\MakeBannerCommand;
use PHPUnit\Framework\TestCase;

class MakeBannerCommandTest extends TestCase
{
    private MakeBannerCommand $command;

    protected function setUp(): void
    {
        $this->command = new MakeBannerCommand();
    }

    public function testCommandHasCorrectName(): void
    {
        $this->assertSame('makebanner', $this->command->getName());
    }

    public function testCommandHasMessageOption(): void
    {
        $this->assertTrue($this->command->getDefinition()->hasOption('message'));
    }

    public function testMessageOptionIsRequired(): void
    {
        $option = $this->command->getDefinition()->getOption('message');
        $this->assertTrue($option->isValueRequired());
    }

    public function testCommandHasOutlineOption(): void
    {
        $this->assertTrue($this->command->getDefinition()->hasOption('outline'));
    }
}