<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\Services;

use Lucasnpinheiro\Erp\Domain\Services\CollectionIterator;
use PHPUnit\Framework\TestCase;

final class CollectionIteratorTest extends TestCase
{
    public function testToArray(): void
    {
        $data = ['foo', 'bar', 'baz'];
        $iterator = new CollectionIterator($data);

        $this->assertSame($data, $iterator->toArray());
    }

    public function testJsonSerialize(): void
    {
        $data = ['foo', 'bar', 'baz'];
        $iterator = new CollectionIterator($data);

        $this->assertSame($data, $iterator->jsonSerialize());
    }
}
