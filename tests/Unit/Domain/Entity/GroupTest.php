<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\Entity\Group;
use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    public function testCreateGroup(): void
    {
        $code =  Code::create('123');
        $name =  Name::create('Test Group');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $group = Group::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertSame($code, $group->code());
        $this->assertSame($name, $group->name());
        $this->assertSame($createdAt, $group->createdAt());
        $this->assertSame($modifiedAt, $group->modifiedAt());
        $this->assertSame($deletedAt, $group->deletedAt());
    }

    public function testCreateGroupWithoutOptionalDates(): void
    {
        $code =  Code::create('123');
        $name =  Name::create('Test Group');
        $createdAt = Date::create('2022-01-01');

        $group = Group::create($code, $name, $createdAt);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertSame($code, $group->code());
        $this->assertSame($name, $group->name());
        $this->assertSame($createdAt, $group->createdAt());
        $this->assertNull($group->modifiedAt());
        $this->assertNull($group->deletedAt());
    }

    public function testToArray(): void
    {
        $code =  Code::create('123');
        $name =  Name::create('Test Group');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $group = Group::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => '123',
            'name' => 'Test Group',
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $group->toArray());
    }

    public function testToArrayWithoutOptionalDates(): void
    {
        $code =  Code::create('123');
        $name =  Name::create('Test Group');
        $createdAt = Date::create('2022-01-01');

        $group = Group::create($code, $name, $createdAt);

        $expectedArray = [
            'code' => '123',
            'name' => 'Test Group',
            'created_at' => '1640995200',
            'modified_at' => null,
            'deleted_at' => null,
        ];

        $this->assertSame($expectedArray, $group->toArray());
    }

    public function testToJsonSerialize()
    {
        $code =  Code::create('123');
        $name =  Name::create('Test Group');
        $createdAt = Date::create('2022-01-01');

        $group = Group::create($code, $name, $createdAt);

        $expectedArray = [
            'code' => '123',
            'name' => 'Test Group',
            'created_at' => '1640995200',
            'modified_at' => null,
            'deleted_at' => null,
        ];

        $this->assertSame($expectedArray, $group->toJsonSerialize());
    }
}
