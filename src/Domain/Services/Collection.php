<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Services;

use Closure;
use Lucasnpinheiro\Erp\Domain\Entity\Entity;
use Traversable;

abstract class Collection implements \Iterator
{
    private CollectionIterator $list;
    private int $index = 0;

    private function __construct(array $list = [])
    {
        $this->list = new CollectionIterator($list);
    }

    public static function create(array $list = []): static
    {
        return new static($list);
    }

    public function current(): string
    {
        return $this->list[$this->index];
    }

    public function key(): int
    {
        return $this->index;
    }

    public function next(): void
    {
        $this->index++;
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    public function valid(): bool
    {
        return \array_key_exists($this->index, $this->list->toArray());
    }

    public function filter(Closure $callback = null): Collection
    {
        return new static(
            array_values(
                array_filter(
                    $this->list->toArray(),
                    $callback
                )
            )
        );
    }

    public function add(Entity $instance): void
    {
        $this->list[] = $instance;
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

        $list = $this->list->toArray();

        unset($list[$key]);

        $this->list = new CollectionIterator(
            array_values($list)
        );

        return $removed;
    }

    public function removeElement(mixed $element): bool
    {
        $key = array_search($element, $this->toArray(), true);

        if ($key === false) {
            return false;
        }

        $this->list->offsetUnset($key);

        return true;
    }

    public function contains(mixed $element)
    {
        return in_array($element, $this->toArray(), true);
    }

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

    public function getKeys(): array
    {
        return array_keys($this->toArray());
    }

    public function getValues(): array
    {
        return array_values($this->toArray());
    }

    public function __toString(): string
    {
        return static::class . '@' . spl_object_hash($this);
    }

    public function clear(): void
    {
        $this->list = new CollectionIterator([]);
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
