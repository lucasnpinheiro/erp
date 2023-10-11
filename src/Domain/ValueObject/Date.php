<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use BaseValueObject\StringValueObject;

class Date extends StringValueObject
{
    public static function create(string $date): self
    {
        return new self((string) (new \DateTime($date))->getTimestamp());
    }

    public static function current(): self
    {
        return new self((string) (new \DateTime('now'))->getTimestamp());
    }

    public function format(string $format): string
    {
        return (new \DateTime('now'))->setTimestamp((int)$this->value())->format($format);
    }

    public function __toString(): string
    {
        return $this->value();
    }
}