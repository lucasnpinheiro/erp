<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\Entity\Product;
use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testCreateProduct(): void
    {
        $code = Code::create('123456');
        $name = Name::create('Product Name');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $product = Product::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame($code, $product->code());
        $this->assertSame($name, $product->name());
        $this->assertSame($createdAt, $product->createdAt());
        $this->assertSame($modifiedAt, $product->modifiedAt());
        $this->assertSame($deletedAt, $product->deletedAt());
    }

    public function testCreateProductWithoutOptionalDates(): void
    {
        $code = Code::create('123456');
        $name = Name::create('Product Name');
        $createdAt = Date::create('2022-01-01');

        $product = Product::create($code, $name, $createdAt);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame($code, $product->code());
        $this->assertSame($name, $product->name());
        $this->assertSame($createdAt, $product->createdAt());
        $this->assertNull($product->modifiedAt());
        $this->assertNull($product->deletedAt());
    }

    public function testToArray(): void
    {
        $code = Code::create('123456');
        $name = Name::create('Product Name');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $product = Product::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => '123456',
            'name' => 'Product Name',
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $product->toArray());
    }

    public function testToJsonSerialize()
    {
        $code = Code::create('123456');
        $name = Name::create('Product Name');
        $createdAt = Date::create('2022-01-01');
        $modifiedAt = Date::create('2022-01-02');
        $deletedAt = Date::create('2022-01-03');

        $product = Product::create($code, $name, $createdAt, $modifiedAt, $deletedAt);

        $expectedArray = [
            'code' => '123456',
            'name' => 'Product Name',
            'created_at' => '1640995200',
            'modified_at' => '1641081600',
            'deleted_at' => '1641168000',
        ];

        $this->assertSame($expectedArray, $product->toJsonSerialize());
    }
}
