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

    public function first(): ?Entity
    {
        return reset($this->list);
    }

    public function last(): ?Entity
    {
        return end($this->list);
    }

    public function key()
    {
        return key($this->list);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return next($this->list);
    }

    public function current()
    {
        return current($this->list);
    }

    public function all(): array
    {
        return $this->list->getArrayCopy();
    }

    public function remove(string|int $key)
    {
        $removed = $this->get($key);

        if (!$removed) {
            return null;
        }

        unset($this->list[$key]);

        return $removed;
    }

    /**
     * {@inheritDoc}
     */
    public function removeElement(mixed $element)
    {
        $key = array_search($element, $this->toArray(), true);

        if ($key === false) {
            return false;
        }

        unset($this->list[$key]);

        return true;
    }

    public function contains(mixed $element)
    {
        return in_array($element, $this->toArray(), true);
    }

    /**
     * {@inheritDoc}
     */
    public function exists(Closure $p)
    {
        foreach ($this->list->toArray() as $key => $element) {
            if ($p($key, $element)) {
                return true;
            }
        }

        return false;
    }

    public function indexOf($element)
    {
        return array_search($element, $this->toArray(), true);
    }

    public function get(string|int $key)
    {
        return $this->list[$key] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function getKeys(): array
    {
        return array_keys($this->toArray());
    }

    /**
     * {@inheritDoc}
     */
    public function getValues(): array
    {
        return array_values($this->toArray());
    }

    public function __toString(): string
    {
        return self::class . '@' . spl_object_hash($this);
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): void
    {
        static::create([]);
    }

    public function count(): int
    {
        return count($this->list->toArray());
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
