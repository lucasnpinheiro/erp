<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\Exception\EmptyException;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testCreate(): void
    {
        $name = Name::create('John Doe');
        $this->assertInstanceOf(Name::class, $name);
        $this->assertEquals('John Doe', $name->value());
    }

    public function testCreateWithEmptyValue(): void
    {
        $this->expectException(EmptyException::class);
        Name::create('');
    }

    public function testValue(): void
    {
        $name = Name::create('John Doe');
        $this->assertEquals('John Doe', $name->value());
    }
}
