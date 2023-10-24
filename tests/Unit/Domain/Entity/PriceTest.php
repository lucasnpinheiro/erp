<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\Entity\Fees;
use Lucasnpinheiro\Erp\Domain\Entity\Price;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Metadata;
use Lucasnpinheiro\Erp\Domain\ValueObject\PriceMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\PriceType;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testCreateAndGetters(): void
    {
        $type = PriceType::RETAIL();
        $costValue = PriceMoney::create('1000');
        $fees = Fees::create([]);
        $saleValue = PriceMoney::create('1200');
        $profitMargin = PriceMoney::create('200');
        $basicMargin = PriceMoney::create('150');
        $markup = PriceMoney::create('20');
        $metadata = Metadata::create(['color' => 'blue']);
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $price = Price::create(
            $type,
            $costValue,
            $fees,
            $saleValue,
            $profitMargin,
            $basicMargin,
            $markup,
            $metadata,
            $createdAt,
            $modifiedAt,
            $deletedAt
        );

        $this->assertSame($type, $price->type());
        $this->assertSame($costValue, $price->costValue());
        $this->assertSame($fees, $price->fees());
        $this->assertSame($saleValue, $price->saleValue());
        $this->assertSame($profitMargin, $price->profitMargin());
        $this->assertSame($basicMargin, $price->basicMargin());
        $this->assertSame($markup, $price->markup());
        $this->assertSame($metadata, $price->metadata());
        $this->assertSame($createdAt, $price->createdAt());
        $this->assertSame($modifiedAt, $price->modifiedAt());
        $this->assertSame($deletedAt, $price->deletedAt());
    }

    public function testToArray(): void
    {
        $type = PriceType::RETAIL();
        $costValue = PriceMoney::create('1000');
        $fees = Fees::create([]);
        $saleValue = PriceMoney::create('1200');
        $profitMargin = PriceMoney::create('200');
        $basicMargin = PriceMoney::create('150');
        $markup = PriceMoney::create('20');
        $metadata = Metadata::create(['color' => 'blue']);
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $price = Price::create(
            $type,
            $costValue,
            $fees,
            $saleValue,
            $profitMargin,
            $basicMargin,
            $markup,
            $metadata,
            $createdAt,
            $modifiedAt,
            $deletedAt
        );

        $expectedArray = [
            'type' => 'RETAIL',
            'cost_value' => '1000.00',
            'fees' => [],
            'sale_value' => '1200.00',
            'profit_margin' => '200.00',
            'basic_margin' => '150.00',
            'markup' => '20.00',
            'metadata' => ['color' => 'blue'],
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $price->toArray());
    }

    public function testToJsonSerialize()
    {
        $type = PriceType::RETAIL();
        $costValue = PriceMoney::create('1000');
        $fees = Fees::create([]);
        $saleValue = PriceMoney::create('1200');
        $profitMargin = PriceMoney::create('200');
        $basicMargin = PriceMoney::create('150');
        $markup = PriceMoney::create('20');
        $metadata = Metadata::create(['color' => 'blue']);
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $price = Price::create(
            $type,
            $costValue,
            $fees,
            $saleValue,
            $profitMargin,
            $basicMargin,
            $markup,
            $metadata,
            $createdAt,
            $modifiedAt,
            $deletedAt
        );

        $expectedArray = [
            'type' => 'RETAIL',
            'cost_value' => '1000.00',
            'fees' => [],
            'sale_value' => '1200.00',
            'profit_margin' => '200.00',
            'basic_margin' => '150.00',
            'markup' => '20.00',
            'metadata' => ['color' => 'blue'],
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $price->toJsonSerialize());
    }
}
