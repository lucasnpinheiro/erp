<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\TaxeMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\TaxeType;

class Taxe extends Entity
{

    private function __construct(
        private TaxeType $type,
        private TaxeMoney $baseValue,
        private TaxeMoney $percentage,
        private TaxeMoney $value,
        private Date $createdAt,
        private ?Date $modifiedAt,
        private ?Date $deletedAt,
    ) {
    }

    public static function create(
        TaxeType $type,
        TaxeMoney $baseValue,
        TaxeMoney $percentage,
        TaxeMoney $value,
        Date $createdAt,
        ?Date $modifiedAt = null,
        ?Date $deletedAt = null,
    ): Taxe {
        return new self(
            $type,
            $baseValue,
            $percentage,
            $value,
            $createdAt,
            $modifiedAt,
            $deletedAt,
        );
    }

    public function type(): TaxeType
    {
        return $this->type;
    }

    public function baseValue(): TaxeMoney
    {
        return $this->baseValue;
    }

    public function percentage(): TaxeMoney
    {
        return $this->percentage;
    }

    public function value(): TaxeMoney
    {
        return $this->value;
    }

    public function calculate()
    {
        $this->value = TaxeMoney::createZero();
        if (!$this->percentage()->isZero() && !$this->baseValue()->isZero()) {
            $this->value = $this->baseValue()->multiply($this->percentage());
        }
    }

    public function createdAt(): Date
    {
        return $this->createdAt;
    }

    public function modifiedAt(): ?Date
    {
        return $this->modifiedAt;
    }

    public function deletedAt(): ?Date
    {
        return $this->deletedAt;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type()->value(),
            'base_value' => $this->baseValue()->value(),
            'percentage' => $this->percentage()->value(),
            'value' => $this->value()->value(),
            'created_at' => $this->createdAt()->value(),
            'modified_at' => $this->modifiedAt()?->value(),
            'deleted_at' => $this->deletedAt()?->value(),
        ];
    }
}
