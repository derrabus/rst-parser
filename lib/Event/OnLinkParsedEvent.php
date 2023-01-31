<?php

declare(strict_types=1);

namespace Doctrine\RST\Event;

use Doctrine\Common\EventArgs;

final class OnLinkParsedEvent extends EventArgs
{
    public const ON_LINK_PARSED = 'onLinkParsed';

    private string $url;

    private string $linkType;

    private string $currentFileName;

    public function __construct(string $url, string $linkType, string $currentFileName)
    {
        $this->url             = $url;
        $this->linkType        = $linkType;
        $this->currentFileName = $currentFileName;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getLinkType(): string
    {
        return $this->linkType;
    }

    public function getCurrentFileName(): string
    {
        return $this->currentFileName;
    }
}
