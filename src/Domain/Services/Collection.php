<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Services;

use Closure;
use Lucasnpinheiro\Erp\Domain\Entity\Entity;

abstract class Collection implements \IteratorAggregate
{
    private CollectionIterator $list;

    private function __construct(array $list = [])
    {
        $this->list = new CollectionIterator($list);
    }

    public static function create(array $list = []): static
    {
        return new static($list);
    }

    public function getIterator(): \FilterIterator
    {
        return new class($this->list) extends \FilterIterator
        {
            public function __construct(CollectionIterator $iterator)
            {
                parent::__construct($iterator);
            }

            public function accept(): bool
            {
                return parent::accept();
            }
        };
    }

    public function filter(Closure $callback = null): Collection
    {

        return new static(array_filter($this->list->toArray(), $callback));
    }

    public function add(Entity $instance): void
    {
        $this->list[] = $instance;
    }

    public function count(): int
    {
        return count($this->list);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function toArray(): array
    {
        return $this->list->getArrayCopy();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
