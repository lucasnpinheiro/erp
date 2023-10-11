<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\IntValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidIdentifierException;

class Identifier extends IntValueObject
{
    public static function create(int $identifier): Identifier
    {
        return new self($identifier);
    }

    public static function zero(): Identifier
    {
        return new self(0);
    }

    protected function validate(int $value): bool
    {
        if ($value < 0) {
            throw new InvalidIdentifierException();
        }
        return true;
    }
}
