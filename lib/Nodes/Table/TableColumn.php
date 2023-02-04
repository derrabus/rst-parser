<?php

declare(strict_types=1);

namespace Doctrine\RST\Nodes\Table;

use Doctrine\RST\Nodes\Node;
use LogicException;

use function strlen;
use function trim;

final class TableColumn
{
    private string $content;

    private int $colSpan;

    private int $rowSpan = 1;

    private ?Node $node = null;

    public function __construct(string $content, int $colSpan)
    {
        $this->content = trim($content);
        $this->colSpan = $colSpan;
    }

    public function getContent(): string
    {
        // "\" is a special way to make a column "empty", but
        // still indicate that you *want* that column
        if ($this->content === '\\') {
            return '';
        }

        return $this->content;
    }

    public function getColSpan(): int
    {
        return $this->colSpan;
    }

    public function getRowSpan(): int
    {
        return $this->rowSpan;
    }

    public function addContent(string $content): void
    {
        $this->content = trim($this->content . $content);
    }

    public function incrementRowSpan(): void
    {
        $this->rowSpan++;
    }

    public function getNode(): Node
    {
        if ($this->node === null) {
            throw new LogicException('The node is not yet set.');
        }

        return $this->node;
    }

    public function setNode(Node $node): void
    {
        $this->node = $node;
    }

    public function render(): string
    {
        $rendered = $this->getNode()->render();

        if ($rendered === '' && $this->content !== '\\') {
            $rendered = '&nbsp;';
        }

        return $rendered;
    }

    /**
     * Indicates that a column is empty, and could be skipped entirely.
     */
    public function isCompletelyEmpty(): bool
    {
        return strlen($this->content) === 0;
    }
}
