<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\MoneyValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidFeeMoneyException;

class FeeMoney extends MoneyValueObject
{

    public static function create(string $name): FeeMoney
    {
        return new self($name);
    }

    public static function createZero(): FeeMoney
    {
        return new self('0');
    }

    protected function validate(string $value): bool
    {
        if ((float) $value < 0) {
            throw new InvalidFeeMoneyException($value);
        }
        return true;
    }
}
