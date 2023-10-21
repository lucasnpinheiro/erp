<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use BaseValueObject\MoneyValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidFeeMoneyException;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeMoney;
use PHPUnit\Framework\TestCase;

class FeeMoneyTest extends TestCase
{
    public function testCreate(): void
    {
        $feeMoney = FeeMoney::create('10.50');
        $this->assertInstanceOf(FeeMoney::class, $feeMoney);
        $this->assertEquals('10.50', $feeMoney->value());
    }

    public function testCreateZero(): void
    {
        $feeMoney = FeeMoney::createZero();
        $this->assertInstanceOf(FeeMoney::class, $feeMoney);
        $this->assertEquals('0.00', $feeMoney->value());
    }

    public function testCreateWithInvalidValue(): void
    {
        $this->expectException(InvalidFeeMoneyException::class);
        FeeMoney::create('-10.50');
    }

    public function testValue(): void
    {
        $feeMoney = FeeMoney::create('10.50');
        $this->assertEquals('10.50', $feeMoney->value());
    }

    public function testEquals(): void
    {
        $feeMoney1 = FeeMoney::create('10.50');
        $feeMoney2 = FeeMoney::create('10.50');
        $feeMoney3 = FeeMoney::create('20.00');

        $this->assertTrue($feeMoney1->equals($feeMoney2));
        $this->assertFalse($feeMoney1->equals($feeMoney3));
    }

    public function testAdd(): void
    {
        $feeMoney1 = FeeMoney::create('10.50');
        $feeMoney2 = FeeMoney::create('20.00');
        $feeMoney3 = $feeMoney1->add($feeMoney2);

        $this->assertInstanceOf(MoneyValueObject::class, $feeMoney3);
        $this->assertEquals('30.50', $feeMoney3->value());
    }

    public function testSubtract(): void
    {
        $feeMoney1 = FeeMoney::create('20.00');
        $feeMoney2 = FeeMoney::create('10.50');
        $feeMoney3 = $feeMoney1->subtract($feeMoney2);

        $this->assertInstanceOf(MoneyValueObject::class, $feeMoney3);
        $this->assertEquals('9.50', $feeMoney3->value());
    }

    public function testMultiply(): void
    {
        $feeMoney1 = FeeMoney::create('10.50');
        $feeMoney2 = $feeMoney1->multiply(2);

        $this->assertInstanceOf(MoneyValueObject::class, $feeMoney2);
        $this->assertEquals('21.00', $feeMoney2->value());
    }

    public function testDivide(): void
    {
        $feeMoney1 = FeeMoney::create('10.50');
        $feeMoney2 = $feeMoney1->divide(2);

        $this->assertInstanceOf(MoneyValueObject::class, $feeMoney2);
        $this->assertEquals('5.25', $feeMoney2->value());
    }

    public function testDivideByZero(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        $feeMoney1 = FeeMoney::create('10.50');
        $feeMoney1->divide(0);
    }
}
