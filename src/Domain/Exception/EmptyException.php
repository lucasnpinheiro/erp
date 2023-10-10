<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Exception;

use InvalidArgumentException;

class EmptyException extends InvalidArgumentException
{
    protected $code = 422;

    public function __construct(string $name)
    {
        parent::__construct("Invalid name: {$name}");
    }
}
