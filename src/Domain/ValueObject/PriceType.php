<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\StringValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidPriceTypeException;

class PriceType extends StringValueObject
{

    public const RETAIL = 'RETAIL';
    public const WHOLESALE = 'WHOLESALE';
    public const PROMOTION = 'PROMOTION';

    public static function create(string $name): PriceType
    {
        return new self($name);
    }

    public static function all()
    {
        return [self::RETAIL, self::WHOLESALE, self::PROMOTION];
    }

    protected function validate(string $value): bool
    {
        if (!in_array($value, [self::all()], true)) {
            throw new InvalidPriceTypeException($value);
        }
        return true;
    }

    public static function RETAIL(): PriceType
    {
        return self::create(self::RETAIL);
    }

    public static function WHOLESALE(): PriceType
    {
        return self::create(self::WHOLESALE);
    }

    public static function PROMOTION(): PriceType
    {
        return self::create(self::PROMOTION);
    }
}
