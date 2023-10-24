<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\Entity\SubGroup;
use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class SubGroupTest extends TestCase
{
    public function testCreateSubGroup(): void
    {
        $code = Code::create('SG001');
        $name = Name::create('Test SubGroup');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $subGroup = SubGroup::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $this->assertInstanceOf(SubGroup::class, $subGroup);
        $this->assertSame($code, $subGroup->code());
        $this->assertSame($name, $subGroup->name());
        $this->assertSame($createdAt, $subGroup->createdAt());
        $this->assertSame($modifiedAt, $subGroup->modifiedAt());
        $this->assertSame($deletedAt, $subGroup->deletedAt());
    }

    public function testToArray(): void
    {
        $code = Code::create('SG001');
        $name = Name::create('Test SubGroup');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $subGroup = SubGroup::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => 'SG001',
            'name' => 'Test SubGroup',
            'created_at' => $createdAt->value(),
            'modified_at' => $modifiedAt->value(),
            'deleted_at' => $deletedAt->value(),
        ];

        $this->assertSame($expectedArray, $subGroup->toArray());
    }

    public function testToJsonSerialize()
    {
        $code = Code::create('SG001');
        $name = Name::create('Test SubGroup');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $subGroup = SubGroup::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => 'SG001',
            'name' => 'Test SubGroup',
            'created_at' => $createdAt->value(),
            'modified_at' => $modifiedAt->value(),
            'deleted_at' => $deletedAt->value(),
        ];

        $this->assertSame($expectedArray, $subGroup->toJsonSerialize());
    }
}
