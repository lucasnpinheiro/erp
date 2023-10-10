<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use BaseValueObject\MoneyValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidTaxeMoneyException;
use Lucasnpinheiro\Erp\Domain\ValueObject\TaxeMoney;
use PHPUnit\Framework\TestCase;

class TaxeMoneyTest extends TestCase
{
    public function testCreate(): void
    {
        $taxeMoney = TaxeMoney::create('10.50');
        $this->assertInstanceOf(TaxeMoney::class, $taxeMoney);
        $this->assertEquals('10.50', $taxeMoney->value());
    }

    public function testCreateZero(): void
    {
        $taxeMoney = TaxeMoney::createZero();
        $this->assertInstanceOf(TaxeMoney::class, $taxeMoney);
        $this->assertEquals('0.00', $taxeMoney->value());
    }

    public function testCreateWithInvalidValue(): void
    {
        $this->expectException(InvalidTaxeMoneyException::class);
        TaxeMoney::create('-10.50');
    }

    public function testValue(): void
    {
        $taxeMoney = TaxeMoney::create('10.50');
        $this->assertEquals('10.50', $taxeMoney->value());
    }

    public function testEquals(): void
    {
        $taxeMoney1 = TaxeMoney::create('10.50');
        $taxeMoney2 = TaxeMoney::create('10.50');
        $taxeMoney3 = TaxeMoney::create('20.00');

        $this->assertTrue($taxeMoney1->equals($taxeMoney2));
        $this->assertFalse($taxeMoney1->equals($taxeMoney3));
    }

    public function testAdd(): void
    {
        $taxeMoney1 = TaxeMoney::create('10.50');
        $taxeMoney2 = TaxeMoney::create('20.00');
        $taxeMoney3 = $taxeMoney1->add($taxeMoney2);

        $this->assertInstanceOf(MoneyValueObject::class, $taxeMoney3);
        $this->assertEquals('30.50', $taxeMoney3->value());
    }

    public function testSubtract(): void
    {
        $taxeMoney1 = TaxeMoney::create('20.00');
        $taxeMoney2 = TaxeMoney::create('10.50');
        $taxeMoney3 = $taxeMoney1->subtract($taxeMoney2);

        $this->assertInstanceOf(MoneyValueObject::class, $taxeMoney3);
        $this->assertEquals('9.50', $taxeMoney3->value());
    }

    public function testMultiply(): void
    {
        $taxeMoney1 = TaxeMoney::create('10.50');
        $taxeMoney2 = $taxeMoney1->multiply(2);

        $this->assertInstanceOf(MoneyValueObject::class, $taxeMoney2);
        $this->assertEquals('21.00', $taxeMoney2->value());
    }

    public function testDivide(): void
    {
        $taxeMoney1 = TaxeMoney::create('10.50');
        $taxeMoney2 = $taxeMoney1->divide(2);

        $this->assertInstanceOf(MoneyValueObject::class, $taxeMoney2);
        $this->assertEquals('5.25', $taxeMoney2->value());
    }

    public function testDivideByZero(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        $taxeMoney1 = TaxeMoney::create('10.50');
        $taxeMoney1->divide(0);
    }
}
