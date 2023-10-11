<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\Exception\InvalidIdentifierException;
use Lucasnpinheiro\Erp\Domain\ValueObject\Identifier;
use PHPUnit\Framework\TestCase;

class IdentifierTest extends TestCase
{
    public function testCreate(): void
    {
        $identifier = Identifier::create(1);
        $this->assertInstanceOf(Identifier::class, $identifier);
        $this->assertEquals(1, $identifier->value());
    }

    public function testCreateWithNegativeValue(): void
    {
        $this->expectException(InvalidIdentifierException::class);
        Identifier::create(-1);
    }

    public function testZero(): void
    {
        $identifier = Identifier::zero();
        $this->assertInstanceOf(Identifier::class, $identifier);
        $this->assertEquals(0, $identifier->value());
    }

    public function testIsZero(): void
    {
        $identifier1 = Identifier::create(0);
        $identifier2 = Identifier::create(1);

        $this->assertTrue($identifier1->isZero());
        $this->assertFalse($identifier2->isZero());
    }
}
