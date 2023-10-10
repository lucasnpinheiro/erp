<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\StringValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\EmptyException;

class Code extends StringValueObject
{
    public static function create(string $name): Code
    {
        return new self($name);
    }

    public static function generate(): Code
    {
        return new self((string) mt_rand(1, 11));
    }

    protected function validate(string $value): bool
    {
        if (trim($value) === '') {
            throw new EmptyException($value);
        }
        return true;
    }
}
