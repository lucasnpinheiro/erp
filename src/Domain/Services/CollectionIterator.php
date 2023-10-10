<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Services;

final class CollectionIterator extends \ArrayIterator
{
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}