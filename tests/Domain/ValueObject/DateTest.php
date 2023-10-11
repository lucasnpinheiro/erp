<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testCreate(): void
    {
        $date = Date::create('2022-01-01');
        $this->assertInstanceOf(Date::class, $date);
        $this->assertSame('1640995200', $date->value());
    }

    public function testCurrent(): void
    {
        $date = Date::current();
        $this->assertInstanceOf(Date::class, $date);
        $this->assertIsString($date->value());
    }

    public function testFormat(): void
    {
        $date = Date::create('2022-01-01');
        $this->assertSame('01/01/2022', $date->format('d/m/Y'));
    }

    public function testToString(): void
    {
        $date = Date::create('2022-01-01');
        $this->assertSame('1640995200', (string) $date);
    }
}
