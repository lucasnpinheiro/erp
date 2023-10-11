<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Entity;

use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use Lucasnpinheiro\Erp\Domain\ValueObject\DateTime;
use Lucasnpinheiro\Erp\Domain\ValueObject\Name;

class Family extends Entity
{

    private function __construct(
        private Code $code,
        private Name $name,
        private DateTime $createdAt,
        private ?DateTime $modifiedAt,
        private ?DateTime $deletedAt,
    ) {
    }

    public static function create(
        Code $code,
        Name $name,
        DateTime $createdAt,
        ?DateTime $modifiedAt = null,
        ?DateTime $deletedAt = null,
    ): Family {
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

    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }

    public function modifiedAt(): ?DateTime
    {
        return $this->modifiedAt;
    }

    public function deletedAt(): ?DateTime
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
