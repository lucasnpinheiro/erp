<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\StringValueObject;
use Lucasnpinheiro\Erp\Domain\Exception\InvalidFeeTypeException;

class FeeType extends StringValueObject
{
    private const ICMS = 'ICMS';
    private const IPI = 'IPI';
    private const PIS = 'PIS';
    private const COFINS = 'COFINS';
    private const ISS = 'ISS';

    public static function create(string $name): FeeType
    {
        return new static($name);
    }

    public static function all()
    {
        return [self::ICMS, self::IPI, self::PIS, self::COFINS, self::ISS];
    }

    protected function validate(string $value): bool
    {
        if (!in_array($value, self::all())) {
            throw new InvalidFeeTypeException($value);
        }
        return true;
    }

    public static function ICMS(): FeeType
    {
        return self::create(self::ICMS);
    }

    public static function IPI(): FeeType
    {
        return self::create(self::IPI);
    }

    public static function PIS(): FeeType
    {
        return self::create(self::PIS);
    }

    public static function COFINS(): FeeType
    {
        return self::create(self::COFINS);
    }

    public static function ISS(): FeeType
    {
        return self::create(self::ISS);
    }

    public function isICMS(): bool
    {
        return $this->value === self::ICMS;
    }

    public function isIPI(): bool
    {
        return $this->value === self::IPI;
    }

    public function isPIS(): bool
    {
        return $this->value === self::PIS;
    }

    public function isCOFINS(): bool
    {
        return $this->value === self::COFINS;
    }

    public function isISS(): bool
    {
        return $this->value === self::ISS;
    }
}
