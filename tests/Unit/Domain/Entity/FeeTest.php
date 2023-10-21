<?php

use Lucasnpinheiro\Erp\Domain\Entity\Fee;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeType;
use PHPUnit\Framework\TestCase;

class FeeTest extends TestCase
{
    public function testCreate(): void
    {
        $type = FeeType::PIS();
        $baseValue = FeeMoney::create(100);
        $percentage = FeeMoney::create(10);
        $value = FeeMoney::create(110);
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $fee = Fee::create($type, $baseValue, $percentage, $value, $createdAt, $modifiedAt, $deletedAt);

        $this->assertInstanceOf(Fee::class, $fee);
        $this->assertSame($type, $fee->type());
        $this->assertSame($baseValue, $fee->baseValue());
        $this->assertSame($percentage, $fee->percentage());
        $this->assertSame($value, $fee->value());
        $this->assertSame($createdAt, $fee->createdAt());
        $this->assertSame($modifiedAt, $fee->modifiedAt());
        $this->assertSame($deletedAt, $fee->deletedAt());
    }
}
