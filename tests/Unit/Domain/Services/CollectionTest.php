<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Services;

use Lucasnpinheiro\Erp\Domain\Entity\Fee;
use Lucasnpinheiro\Erp\Domain\Entity\Fees;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeType;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCreateEmptyCollection(): void
    {
        $collection = Fees::create();
        $this->assertInstanceOf(Fees::class, $collection);
        $this->assertEmpty($collection->toArray());
    }

    public function testCreateCollectionWithElements(): void
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);
        $this->assertInstanceOf(Fees::class, $collection);
        $this->assertEquals($elements, $collection->toArray());
    }

    public function testAddElementToCollection(): void
    {
        $fee = Fee::create(
            FeeType::PIS(),
            FeeMoney::create('100'),
            FeeMoney::create('10'),
            FeeMoney::create('110'),
            Date::create('2022-01-01')
        );
        $collection = Fees::create();
        $collection->add($fee);
        $this->assertEquals([$fee], $collection->toArray());
    }

    public function testRemoveElementFromCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $removed = $collection->remove(1);
        $this->assertEquals('bar', $removed);
        $this->assertEquals(['foo', 'baz'], $collection->toArray());
    }

    public function testRemoveElementFromCollectionWithObjects(): void
    {
        $element = new \stdClass();
        $collection = Fees::create([$element]);
        $collection->removeElement($element);
        $this->assertEmpty($collection->toArray());
    }

    public function testRemoveElementFromCollectionIndexNotExists(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $removed = $collection->removeElement(4);
        $this->assertFalse($removed);
        $this->assertEquals(['foo', 'bar', 'baz'], $collection->toArray());
    }

    public function testRemoveNonexistentElementFromCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $removed = $collection->remove(3);
        $this->assertNull($removed);
        $this->assertEquals(['foo', 'bar', 'baz'], $collection->toArray());
    }

    public function testRemoveElementObjectFromCollection(): void
    {
        $element = new \stdClass();
        $collection = Fees::create([$element]);
        $collection->removeElement($element);
        $this->assertEmpty($collection->toArray());
    }

    public function testContainsElementInCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $this->assertTrue($collection->contains('bar'));
        $this->assertFalse($collection->contains('qux'));
    }

    public function testExistsElementInCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $this->assertTrue($collection->exists(fn ($key, $value) => $value === 'bar'));
        $this->assertFalse($collection->exists(fn ($key, $value) => $value === 'qux'));
    }

    public function testGetElementByKey(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $this->assertEquals('bar', $collection->get(1));
        $this->assertNull($collection->get(3));
    }

    public function testGetKeys(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $this->assertEquals([0, 1, 2], $collection->getKeys());
    }

    public function testGetValues(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $this->assertEquals(['foo', 'bar', 'baz'], $collection->getValues());
    }

    public function testClearCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $collection->clear();
        $this->assertEmpty($collection->toArray());
    }

    public function testCountElementsInCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $this->assertCount(3, $collection);
    }

    public function testIsEmptyCollection(): void
    {
        $collection = Fees::create();
        $this->assertTrue($collection->isEmpty());
        $collection->add(
            Fee::create(
                FeeType::PIS(),
                FeeMoney::create('100'),
                FeeMoney::create('10'),
                FeeMoney::create('110'),
                Date::create('2022-01-01')
            )
        );
        $this->assertFalse($collection->isEmpty());
    }

    public function testFilterCollection(): void
    {
        $collection = Fees::create(['foo', 'bar', 'baz']);
        $filtered = $collection->filter(fn ($value) => $value !== 'bar');
        $this->assertEquals(['foo', 'baz'], $filtered->toArray());
    }

    public function testCollectionIteration(): void
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);

        $iteratedElements = [];
        foreach ($collection as $element) {
            $iteratedElements[] = $element;
        }

        $this->assertEquals($elements, $iteratedElements);
    }

    public function testCollectionKey(): void
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);

        $keys = [];
        foreach ($collection as $key => $element) {
            $keys[] = $key;
        }

        $this->assertEquals([0, 1, 2], $keys);
    }

    public function testCollectionRewind(): void
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);

        $iteratedElements = [];
        foreach ($collection as $element) {
            $iteratedElements[] = $element;
        }

        $iteratedElementsAfterRewind = [];
        foreach ($collection as $element) {
            $iteratedElementsAfterRewind[] = $element;
        }

        $this->assertEquals($elements, $iteratedElements);
        $this->assertEquals($elements, $iteratedElementsAfterRewind);
    }

    public function testCollectionValid(): void
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);

        $this->assertTrue($collection->valid());

        $iteratedElements = [];
        foreach ($collection as $element) {
            $iteratedElements[] = $element;
        }

        $this->assertFalse($collection->valid());
    }

    public function testAllReturnsArrayCopy(): void
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);
        $this->assertEquals($elements, $collection->all());
    }

    public function testAllReturnsEmptyArrayForEmptyCollection(): void
    {
        $collection = Fees::create();
        $this->assertEmpty($collection->all());
    }

    public function testIndexOf()
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);
        $this->assertEquals(1, $collection->indexOf('bar'));
        $this->assertFalse($collection->indexOf('qux'));
    }

    public function testIndexOfWithObjects()
    {
        $element = new \stdClass();
        $collection = Fees::create([$element]);
        $this->assertEquals(0, $collection->indexOf($element));
    }

    public function testJsonSerialize()
    {
        $elements = ['foo', 'bar', 'baz'];
        $collection = Fees::create($elements);
        $this->assertEquals($elements, $collection->jsonSerialize());
    }

    public function testJsonSerializeWithObjects()
    {
        $element = new \stdClass();
        $collection = Fees::create([$element]);
        $this->assertEquals([$element], $collection->jsonSerialize());
    }

    public function testToString()
    {
        $collection = Fees::create();
        $this->assertEquals(Fees::class . '@' . spl_object_hash($collection), $collection->__toString());
    }
}
