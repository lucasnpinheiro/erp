<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

abstract class Entity
{

    abstract public function toArray(): array;

    public function toJsonSerialize(): array
    {
        return $this->toArray();
    }
}
