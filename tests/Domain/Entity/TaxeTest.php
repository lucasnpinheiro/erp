<?php

use PHPUnit\Framework\TestCase;
use Lucasnpinheiro\Erp\Domain\Entity\Taxe;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\TaxeType;
use Lucasnpinheiro\Erp\Domain\ValueObject\TaxeMoney;

class TaxeTest extends TestCase
{
    public function testCreate()
    {
        $type = new TaxeType('VAT');
        $baseValue = new TaxeMoney(100);
        $percentage = new TaxeMoney(0.1);
        $value = new TaxeMoney(10);
        $createdAt = new Date('2022-01-01');
        $modifiedAt = new Date('2022-01-02');
        $deletedAt = new Date('2022-01-03');

        $taxe = Taxe::create($type, $baseValue, $percentage, $value, $createdAt, $modifiedAt, $deletedAt);

        $this->assertInstanceOf(Taxe::class, $taxe);
        $this->assertEquals($type, $taxe->type());
        $this->assertEquals($baseValue, $taxe->baseValue());
        $this->assertEquals($percentage, $taxe->percentage());
        $this->assertEquals($value, $taxe->value());
        $this->assertEquals($createdAt, $taxe->createdAt());
        $this->assertEquals($modifiedAt, $taxe->modifiedAt());
        $this->assertEquals($deletedAt, $taxe->deletedAt());
    }

    public function testCalculateWithValueAndPercentage()
    {
        $type = new TaxeType('VAT');
        $baseValue = new TaxeMoney(100);
        $percentage = new TaxeMoney(0.1);
        $value = new TaxeMoney(0);
        $createdAt = new Date('2022-01-01');

        $taxe = Taxe::create($type, $baseValue, $percentage, $value, $createdAt);
        $taxe->calculate();

        $expectedValue = $baseValue->multiply($percentage);
        $this->assertEquals($expectedValue, $taxe->value());
    }

    public function testCalculateWithZeroValueOrPercentage()
    {
        $type = new TaxeType('VAT');
        $baseValue = new TaxeMoney(100);
        $percentage = new TaxeMoney(0);
        $value = new TaxeMoney(0);
        $createdAt = new Date('2022-01-01');

        $taxe = Taxe::create($type, $baseValue, $percentage, $value, $createdAt);
        $taxe->calculate();

        $this->assertEquals($value, $taxe->value());
    }

    public function testToArray()
    {
        $type = new TaxeType('VAT');
        $baseValue = new TaxeMoney(100);
        $percentage = new TaxeMoney(0.1);
        $value = new TaxeMoney(10);
        $createdAt = new Date('2022-01-01');
        $modifiedAt = new Date('2022-01-02');
        $deletedAt = new Date('2022-01-03');

        $taxe = Taxe::create($