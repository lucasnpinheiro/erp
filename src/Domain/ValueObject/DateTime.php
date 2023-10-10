<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\ValueObject;

use DateTimeImmutable;

class DateTime extends DateTimeImmutable
{

    public static function create(string $date): DateTime
    {
        return new self((new DateTimeImmutable($date))->format('Y-m-d H:i:s'));
    }

    public static function current(): DateTime
    {
        return new self((new DateTimeImmutable('now'))->format('Y-m-d H:i:s'));
    }

    public function format(string $format): string
    {
        return (new DateTimeImmutable($this->value()))->format($format);
    }

    public function value(): string
    {
        return $this->format('Y-m-d H:i:s');
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
