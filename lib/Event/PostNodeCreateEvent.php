<?php

declare(strict_types=1);

namespace Doctrine\RST\Event;

use Doctrine\Common\EventArgs;
use Doctrine\RST\Nodes\Node;

final class PostNodeCreateEvent extends EventArgs
{
    public const POST_NODE_CREATE = 'postNodeCreate';

    private Node $node;

    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    public function getNode(): Node
    {
        return $this->node;
    }
}
