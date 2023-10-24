<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeType;

class Fee extends Entity
{
    private function __construct(
        private FeeType $type,
        private FeeMoney $baseValue,
        private FeeMoney $percentage,
        private FeeMoney $value,
        private Date $createdAt,
        private ?Date $modifiedAt,
        private ?Date $deletedAt,
    ) {
    }

    public static function create(
        FeeType $type,
        FeeMoney $baseValue,
        FeeMoney $percentage,
        FeeMoney $value,
        Date $createdAt,
        ?Date $modifiedAt = null,
        ?Date $deletedAt = null,
    ): Fee {
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

    public function type(): FeeType
    {
        return $this->type;
    }

    public function baseValue(): FeeMoney
    {
        return $this->baseValue;
    }

    public function percentage(): FeeMoney
    {
        return $this->percentage;
    }

    public function value(): FeeMoney
    {
        return $this->value;
    }

    public function calculate()
    {
        $this->value = FeeMoney::createZero();
        if (!$this->percentage()->isZero() && !$this->baseValue()->isZero()) {
            $this->value = FeeMoney::create(
                $this->baseValue()
                    ->multiply(
                        $this->percentage()->value()
                    )
                    ->value()
            );
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
