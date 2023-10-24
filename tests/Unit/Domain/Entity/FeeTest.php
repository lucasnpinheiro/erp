<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Entity;

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
        $baseValue = FeeMoney::create('100');
        $percentage = FeeMoney::create('10');
        $value = FeeMoney::create('110');
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

    public function testCalculate(): void
    {
        $baseValue = FeeMoney::create('100');
        $percentage = FeeMoney::create('10');
        $fee = FeeMoney::createZero();
        $createdAt = Date::create('2022-01-01');
        $fee = Fee::create(FeeType::PIS(), $baseValue, $percentage, $fee, $createdAt);

        $fee->calculate();

        $this->assertEquals(FeeMoney::create('10'), $fee->value());
    }

    public function testToArray()
    {
        $type = FeeType::PIS();
        $baseValue = FeeMoney::create('100');
        $percentage = FeeMoney::create('10');
        $value = FeeMoney::create('110');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $fee = Fee::create($type, $baseValue, $percentage, $value, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'type' => 'PIS',
            'base_value' => '100.00',
            'percentage' => '10.00',
            'value' => '110.00',
            'created_at' => $createdAt->value(),
            'modified_at' => $modifiedAt->value(),
            'deleted_at' => $deletedAt->value(),
        ];

        $this->assertSame($expectedArray, $fee->toArray());
    }

    public function testToJsonSerialize()
    {
        $type = FeeType::PIS();
        $baseValue = FeeMoney::create('100');
        $percentage = FeeMoney::create('10');
        $value = FeeMoney::create('110');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $fee = Fee::create($type, $baseValue, $percentage, $value, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'type' => 'PIS',
            'base_value' => '100.00',
            'percentage' => '10.00',
            'value' => '110.00',
            'created_at' => $createdAt->value(),
            'modified_at' => $modifiedAt->value(),
            'deleted_at' => $deletedAt->value(),
        ];

        $this->assertSame($expectedArray, $fee->toJsonSerialize());
    }
}
