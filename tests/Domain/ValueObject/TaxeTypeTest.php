<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\Exception\InvalidTaxeTypeException;
use Lucasnpinheiro\Erp\Domain\ValueObject\TaxeType;
use PHPUnit\Framework\TestCase;

class TaxeTypeTest extends TestCase
{
    public function testCreate(): void
    {
        $taxeType = TaxeType::create('ICMS');
        $this->assertInstanceOf(TaxeType::class, $taxeType);
    }

    public function testAll(): void
    {
        $allTaxeTypes = TaxeType::all();
        $this->assertIsArray($allTaxeTypes);
        $this->assertCount(5, $allTaxeTypes);
        $this->assertContains(TaxeType::ICMS()->value(), $allTaxeTypes);
        $this->assertContains(TaxeType::IPI()->value(), $allTaxeTypes);
        $this->assertContains(TaxeType::PIS()->value(), $allTaxeTypes);
        $this->assertContains(TaxeType::COFINS()->value(), $allTaxeTypes);
        $this->assertContains(TaxeType::ISS()->value(), $allTaxeTypes);
    }

    public function testInvalidTaxeType(): void
    {
        $this->expectException(InvalidTaxeTypeException::class);
        TaxeType::create('invalid');
    }

    public function testIsICMS(): void
    {
        $taxeType = TaxeType::ICMS();
        $this->assertTrue($taxeType->isICMS());
        $this->assertFalse($taxeType->isIPI());
    }

    public function testIsIPI(): void
    {
        $taxeType = TaxeType::IPI();
        $this->assertTrue($taxeType->isIPI());
        $this->assertFalse($taxeType->isICMS());
    }

    public function testIsPIS(): void
    {
        $taxeType = TaxeType::PIS();
        $this->assertTrue($taxeType->isPIS());
        $this->assertFalse($taxeType->isIPI());
    }

    public function testIsCOFINS(): void
    {
        $taxeType = TaxeType::COFINS();
        $this->assertTrue($taxeType->isCOFINS());
        $this->assertFalse($taxeType->isIPI());
    }

    public function testIsISS(): void
    {
        $taxeType = TaxeType::ISS();
        $this->assertTrue($taxeType->isISS());
        $this->assertFalse($taxeType->isIPI());
    }

    public function testCreateWithInvalidValue(): void
    {
        $this->expectException(InvalidTaxeTypeException::class);
        TaxeType::create('invalid');
    }

    public function testIsICMSWithInvalidValue(): void
    {
        $taxeType = TaxeType::IPI();
        $this->assertFalse($taxeType->isICMS());
    }

    public function testIsIPIWithInvalidValue(): void
    {
        $taxeType = TaxeType::ICMS();
        $this->assertFalse($taxeType->isIPI());
    }

    public function testIsPISWithInvalidValue(): void
    {
        $taxeType = TaxeType::COFINS();
        $this->assertFalse($taxeType->isPIS());
    }

    public function testIsCOFINSWithInvalidValue(): void
    {
        $taxeType = TaxeType::ISS();
        $this->assertFalse($taxeType->isCOFINS());
    }

    public function testIsISSWithInvalidValue(): void
    {
        $taxeType = TaxeType::ICMS();
        $this->assertFalse($taxeType->isISS());
    }
}
