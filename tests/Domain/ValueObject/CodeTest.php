<?php

declare(strict_types=1);

namespace Lucasnpinheiro\Erp\Tests\Domain\ValueObject;

use Lucasnpinheiro\Erp\Domain\Exception\EmptyException;
use Lucasnpinheiro\Erp\Domain\ValueObject\Code;
use PHPUnit\Framework\TestCase;

class CodeTest extends TestCase
{
    public function testCreate(): void
    {
        $code = Code::create('123');
        $this->assertSame('123', $code->value());
    }

    public function testCreateThrowsExceptionOnEmptyValue(): void
    {
        $this->expectException(EmptyException::class);
        Code::create('');
    }

    public function testGenerate(): void
    {
        $code = Code::generate();
        $this->assertGreaterThanOrEqual(1, (int) $code->value());
        $this->assertLessThanOrEqual(11, (int) $code->value());
    }
}
