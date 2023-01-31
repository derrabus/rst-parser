<?php

declare(strict_types=1);

namespace Doctrine\RST\Event;

use Doctrine\Common\EventArgs;
use Doctrine\RST\Nodes\Node;

final class PreNodeRenderEvent extends EventArgs
{
    public const PRE_NODE_RENDER = 'preNodeRender';

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
