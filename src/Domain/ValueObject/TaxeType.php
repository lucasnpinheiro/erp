<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\StringValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidTaxeTypeException;

class TaxeType extends StringValueObject
{

    public const ICMS = 'ICMS';
    public const IPI = 'IPI';
    public const PIS = 'PIS';
    public const COFINS = 'COFINS';
    public const ISS = 'ISS';

    public static function create(string $name): TaxeType
    {
        return new self($name);
    }

    public static function all()
    {
        return [self::ICMS, self::IPI, self::PIS, self::COFINS, self::ISS];
    }

    protected function validate(string $value): bool
    {
        if (!in_array($value, [self::all()], true)) {
            throw new InvalidTaxeTypeException($value);
        }
        return true;
    }

    public static function ICMS(): TaxeType
    {
        return self::create(self::ICMS);
    }

    public static function IPI(): TaxeType
    {
        return self::create(self::IPI);
    }

    public static function PIS(): TaxeType
    {
        return self::create(self::PIS);
    }

    public static function COFINS(): TaxeType
    {
        return self::create(self::COFINS);
    }

    public static function ISS(): TaxeType
    {
        return self::create(self::ISS);
    }
}
