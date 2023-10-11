<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Domain\Exception;

use InvalidArgumentException;

class InvalidIdentifierException extends InvalidArgumentException
{
    protected $code = 422;

    public function __construct()
    {
        parent::__construct("Invalid identifier");
    }
}