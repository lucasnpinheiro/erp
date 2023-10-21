<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Metadata;
use Lucasnpinheiro\Erp\Domain\ValueObject\PriceMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\PriceType;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeMoney;
use Lucasnpinheiro\Erp\Domain\ValueObject\FeeType;

class Price extends Entity
{

    protected function __construct(
        private PriceType $type,
        private PriceMoney $costValue,
        private Fees $fees,
        private PriceMoney $saleValue,
        private PriceMoney $profitMargin,
        private PriceMoney $basicMargin,
        private PriceMoney $markup,
        private Metadata $metadata,
        private Date $createdAt,
        private ?Date $modifiedAt,
        private ?Date $deletedAt,
    ) {
    }

    public static function create(
        PriceType $type,
        PriceMoney $costValue,
        Fees $fees,
        PriceMoney $saleValue,
        PriceMoney $profitMargin,
        PriceMoney $basicMargin,
        PriceMoney $markup,
        Metadata $metadata,
        Date $createdAt,
        ?Date $modifiedAt = null,
        ?Date $deletedAt = null,
    ): Price {
        return new self(
            $type,
            $costValue,
            $fees,
            $saleValue,
            $profitMargin,
            $basicMargin,
            $markup,
            $metadata,
            $createdAt,
            $modifiedAt,
            $deletedAt,
        );
    }

    public function type(): PriceType
    {
        return $this->type;
    }

    public function costValue(): PriceMoney
    {
        return $this->costValue;
    }

    public function saleValue(): PriceMoney
    {
        return $this->saleValue;
    }

    public function profitMargin(): PriceMoney
    {
        return $this->profitMargin;
    }

    public function basicMargin(): PriceMoney
    {
        return $this->basicMargin;
    }

    public function markup(): PriceMoney
    {
        return $this->markup;
    }

    public function metadata(): Metadata
    {
        return $this->metadata;
    }

    public function fees(): Fees
    {
        return $this->fees;
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
            'cost_value' => $this->costValue()->value(),
            'fees' => $this->fees()->toArray(),
            'sale_value' => $this->saleValue()->value(),
            'profit_margin' => $this->profitMargin()->value(),
            'basic_margin' => $this->basicMargin()->value(),
            'markup' => $this->markup()->value(),
            'metadata' => $this->metadata()->toArray(),
            'created_at' => $this->createdAt()->value(),
            'modified_at' => $this->modifiedAt()?->value(),
            'deleted_at' => $this->deletedAt()?->value(),
        ];
    }
}
