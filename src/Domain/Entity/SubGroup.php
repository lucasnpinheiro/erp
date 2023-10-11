<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use Lucasnpinheiro\Erp\Domain\ValueObject\Date;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;

class SubGroup extends Entity
{

    private function __construct(
        private Code $code,
        private Name $name,
        private Date $createdAt,
        private ?Date $modifiedAt,
        private ?Date $deletedAt,
    ) {
    }

    public static function create(
        Code $code,
        Name $name,
        Date $createdAt,
        ?Date $modifiedAt = null,
        ?Date $deletedAt = null,
    ): SubGroup {
        return new self(
            $code,
            $name,
            $createdAt,
            $modifiedAt,
            $deletedAt
        );
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function code(): Code
    {
        return $this->code;
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
            'code' => $this->code()->value(),
            'name' => $this->name()->value(),
            'created_at' => $this->createdAt()->value(),
            'modified_at' => $this->modifiedAt()?->value(),
            'deleted_at' => $this->deletedAt()?->value(),
        ];
    }
}
