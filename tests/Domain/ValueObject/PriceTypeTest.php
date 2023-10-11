<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\Exception\InvalidPriceTypeException;
use Lucasnpinheiro\Erp\Domain\ValueObject\PriceType;
use PHPUnit\Framework\TestCase;

class PriceTypeTest extends TestCase
{
    public function testCreate(): void
    {
        $priceType = PriceType::create('RETAIL');
        $this->assertInstanceOf(PriceType::class, $priceType);
        $this->assertEquals('RETAIL', $priceType->value());
    }

    public function testCreateWithInvalidValue(): void
    {
        $this->expectException(InvalidPriceTypeException::class);
        PriceType::create('INVALID');
    }

    public function testValue(): void
    {
        $priceType = PriceType::create('RETAIL');
        $this->assertEquals('RETAIL', $priceType->value());
    }

    public function testRETAIL(): void
    {
        $priceType = PriceType::RETAIL();
        $this->assertInstanceOf(PriceType::class, $priceType);
        $this->assertEquals('RETAIL', $priceType->value());
    }

    public function testWHOLESALE(): void
    {
        $priceType = PriceType::WHOLESALE();
        $this->assertInstanceOf(PriceType::class, $priceType);
        $this->assertEquals('WHOLESALE', $priceType->value());
    }

    public function testPROMOTION(): void
    {
        $priceType = PriceType::PROMOTION();
        $this->assertInstanceOf(PriceType::class, $priceType);
        $this->assertEquals('PROMOTION', $priceType->value());
    }

    public function testAll(): void
    {
        $allPriceTypes = PriceType::all();
        $this->assertIsArray($allPriceTypes);
        $this->assertCount(3, $allPriceTypes);
        $this->assertContains('RETAIL', $allPriceTypes);
        $this->assertContains('WHOLESALE', $allPriceTypes);
        $this->assertContains('PROMOTION', $allPriceTypes);
    }
}
