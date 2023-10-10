<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

abstract class Collection implements \IteratorAggregate
{
    private \ArrayIterator $list;

    private function __construct(array $list = [])
    {
        $this->list = new \ArrayIterator($list);
    }

    public static function create(array $list = []): static
    {
        return new static($list);
    }

    public function getIterator(): \FilterIterator
    {
        return new class($this->list) extends \FilterIterator
        {
            public function __construct(\ArrayIterator $iterator)
            {
                parent::__construct($iterator);
            }

            public function accept(): bool
            {
                return parent::accept();
            }
        };
    }

    public function filter(callable $callback = null): \FilterIterator
    {
        return new class($this->list) extends \FilterIterator
        {
            protected $callback;
            public function __construct(\ArrayIterator $iterator, callable $callback = null)
            {
                parent::__construct($iterator);

                $this->callback = $callback ?: function ($current) {
                    return !empty($current);
                };
            }

            public function accept(): bool
            {
                return call_user_func($this->callback, parent::accept());
            }
        };
    }

    public function add(mixed $instance): void
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