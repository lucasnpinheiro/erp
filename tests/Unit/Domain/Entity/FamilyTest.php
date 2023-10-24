<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\Entity\Family;
use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class FamilyTest extends TestCase
{
    public function testCreateFamily(): void
    {
        $code =  Code::create('FAM001');
        $name =  Name::create('Test Family');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $family = Family::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $this->assertInstanceOf(Family::class, $family);
        $this->assertSame($code, $family->code());
        $this->assertSame($name, $family->name());
        $this->assertSame($createdAt, $family->createdAt());
        $this->assertSame($modifiedAt, $family->modifiedAt());
        $this->assertSame($deletedAt, $family->deletedAt());
    }

    public function testCreateFamilyWithoutOptionalDates(): void
    {
        $code =  Code::create('FAM001');
        $name =  Name::create('Test Family');
        $createdAt = Date::create('2022-01-01');

        $family = Family::create($code, $name, $createdAt);

        $this->assertInstanceOf(Family::class, $family);
        $this->assertSame($code, $family->code());
        $this->assertSame($name, $family->name());
        $this->assertSame($createdAt, $family->createdAt());
        $this->assertNull($family->modifiedAt());
        $this->assertNull($family->deletedAt());
    }

    public function testToArray(): void
    {
        $code =  Code::create('FAM001');
        $name =  Name::create('Test Family');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $family = Family::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => 'FAM001',
            'name' => 'Test Family',
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $family->toArray());
    }

    public function testToArrayWithoutOptionalDates(): void
    {
        $code =  Code::create('FAM001');
        $name =  Name::create('Test Family');
        $createdAt = Date::create('2022-01-01');

        $family = Family::create($code, $name, $createdAt);

        $expectedArray = [
            'code' => 'FAM001',
            'name' => 'Test Family',
            'created_at' => '1640995200',
            'modified_at' => null,
            'deleted_at' => null,
        ];

        $this->assertSame($expectedArray, $family->toArray());
    }

    public function testToJsonSerialize(): void
    {
        $code =  Code::create('FAM001');
        $name =  Name::create('Test Family');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $family = Family::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => 'FAM001',
            'name' => 'Test Family',
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $family->toJsonSerialize());
    }
}
