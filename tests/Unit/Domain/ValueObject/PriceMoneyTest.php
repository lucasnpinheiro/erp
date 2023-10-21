<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use BaseValueObject\MoneyValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidFeeMoneyException;
use Lucasnpinheiro\Erp\Domain\ValueObject\PriceMoney;
use PHPUnit\Framework\TestCase;

class PriceMoneyTest extends TestCase
{
    public function testCreate(): void
    {
        $priceMoney = PriceMoney::create('10.50');
        $this->assertInstanceOf(PriceMoney::class, $priceMoney);
        $this->assertEquals('10.50', $priceMoney->value());
    }

    public function testCreateZero(): void
    {
        $priceMoney = PriceMoney::createZero();
        $this->assertInstanceOf(PriceMoney::class, $priceMoney);
        $this->assertEquals('0.00', $priceMoney->value());
    }

    public function testCreateWithInvalidValue(): void
    {
        $this->expectException(InvalidFeeMoneyException::class);
        PriceMoney::create('-10.50');
    }

    public function testValue(): void
    {
        $priceMoney = PriceMoney::create('10.50');
        $this->assertEquals('10.50', $priceMoney->value());
    }

    public function testEquals(): void
    {
        $priceMoney1 = PriceMoney::create('10.50');
        $priceMoney2 = PriceMoney::create('10.50');
        $priceMoney3 = PriceMoney::create('20.00');

        $this->assertTrue($priceMoney1->equals($priceMoney2));
        $this->assertFalse($priceMoney1->equals($priceMoney3));
    }

    public function testAdd(): void
    {
        $priceMoney1 = PriceMoney::create('10.50');
        $priceMoney2 = PriceMoney::create('20.00');
        $priceMoney3 = $priceMoney1->add($priceMoney2);

        $this->assertInstanceOf(MoneyValueObject::class, $priceMoney3);
        $this->assertEquals('30.50', $priceMoney3->value());
    }

    public function testSubtract(): void
    {
        $priceMoney1 = PriceMoney::create('20.00');
        $priceMoney2 = PriceMoney::create('10.50');
        $priceMoney3 = $priceMoney1->subtract($priceMoney2);

        $this->assertInstanceOf(MoneyValueObject::class, $priceMoney3);
        $this->assertEquals('9.50', $priceMoney3->value());
    }

    public function testMultiply(): void
    {
        $priceMoney1 = PriceMoney::create('10.50');
        $priceMoney2 = $priceMoney1->multiply(2);

        $this->assertInstanceOf(MoneyValueObject::class, $priceMoney2);
        $this->assertEquals('21.00', $priceMoney2->value());
    }

    public function testDivide(): void
    {
        $priceMoney1 = PriceMoney::create('10.50');
        $priceMoney2 = $priceMoney1->divide(2);

        $this->assertInstanceOf(MoneyValueObject::class, $priceMoney2);
        $this->assertEquals('5.25', $priceMoney2->value());
    }

    public function testDivideByZero(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        $priceMoney1 = PriceMoney::create('10.50');
        $priceMoney1->divide(0);
    }
}
