<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\Exception\InvalidFeeTypeException;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeType;
use PHPUnit\Framework\TestCase;

class FeeTypeTest extends TestCase
{
    public function testCreate(): void
    {
        $feeType = FeeType::create('ICMS');
        $this->assertInstanceOf(FeeType::class, $feeType);
    }

    public function testAll(): void
    {
        $allFeeTypes = FeeType::all();
        $this->assertIsArray($allFeeTypes);
        $this->assertCount(5, $allFeeTypes);
        $this->assertContains(FeeType::ICMS()->value(), $allFeeTypes);
        $this->assertContains(FeeType::IPI()->value(), $allFeeTypes);
        $this->assertContains(FeeType::PIS()->value(), $allFeeTypes);
        $this->assertContains(FeeType::COFINS()->value(), $allFeeTypes);
        $this->assertContains(FeeType::ISS()->value(), $allFeeTypes);
    }

    public function testInvalidFeeType(): void
    {
        $this->expectException(InvalidFeeTypeException::class);
        FeeType::create('invalid');
    }

    public function testIsICMS(): void
    {
        $feeType = FeeType::ICMS();
        $this->assertTrue($feeType->isICMS());
        $this->assertFalse($feeType->isIPI());
    }

    public function testIsIPI(): void
    {
        $feeType = FeeType::IPI();
        $this->assertTrue($feeType->isIPI());
        $this->assertFalse($feeType->isICMS());
    }

    public function testIsPIS(): void
    {
        $feeType = FeeType::PIS();
        $this->assertTrue($feeType->isPIS());
        $this->assertFalse($feeType->isIPI());
    }

    public function testIsCOFINS(): void
    {
        $feeType = FeeType::COFINS();
        $this->assertTrue($feeType->isCOFINS());
        $this->assertFalse($feeType->isIPI());
    }

    public function testIsISS(): void
    {
        $feeType = FeeType::ISS();
        $this->assertTrue($feeType->isISS());
        $this->assertFalse($feeType->isIPI());
    }

    public function testCreateWithInvalidValue(): void
    {
        $this->expectException(InvalidFeeTypeException::class);
        FeeType::create('invalid');
    }

    public function testIsICMSWithInvalidValue(): void
    {
        $feeType = FeeType::IPI();
        $this->assertFalse($feeType->isICMS());
    }

    public function testIsIPIWithInvalidValue(): void
    {
        $feeType = FeeType::ICMS();
        $this->assertFalse($feeType->isIPI());
    }

    public function testIsPISWithInvalidValue(): void
    {
        $feeType = FeeType::COFINS();
        $this->assertFalse($feeType->isPIS());
    }

    public function testIsCOFINSWithInvalidValue(): void
    {
        $feeType = FeeType::ISS();
        $this->assertFalse($feeType->isCOFINS());
    }

    public function testIsISSWithInvalidValue(): void
    {
        $feeType = FeeType::ICMS();
        $this->assertFalse($feeType->isISS());
    }
}
