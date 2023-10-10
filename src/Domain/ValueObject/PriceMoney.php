<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\MoneyValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidTaxeMoneyException;

class PriceMoney extends MoneyValueObject
{

    public static function create(string $name): PriceMoney
    {
        return new self($name);
    }

    public static function createZero(): PriceMoney
    {
        return new self('0');
    }

    protected function validate(string $value): bool
    {
        if ((float) $value < 0) {
            throw new InvalidTaxeMoneyException($value);
        }
        return true;
    }
}
