<?php

declare(strict_types=1);

namespace Doctrine\RST\TextRoles;

use Doctrine\RST\Span\SpanProcessor;

class StrongTextRole extends SpecialTextRole
{
    public function __construct()
    {
        parent::__construct('strong');
    }

    public function replaceAndRegisterTokens(SpanProcessor $spanProcessor, string $span): string
    {
        return $this->replaceTokens($spanProcessor, $span, '/\*\*(.+)\*\*/mUsi');
    }

    public function hasRecursiveSyntax(): bool
    {
        return true;
    }
}
