<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\StringValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\EmptyException;

class Name extends StringValueObject
{

    public static function create(string $name)
    {
        return new self($name);
    }

    protected function validate(string $value): bool
    {
        if (trim($value) === '') {
            throw new EmptyException($value);
        }
        return true;
    }
}
