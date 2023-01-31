<?php

declare(strict_types=1);

namespace Doctrine\RST\Event;

use Doctrine\Common\EventArgs;
use Doctrine\RST\Builder;

abstract class BuildEvent extends EventArgs
{
    private Builder $builder;

    private string $directory;

    private string $targetDirectory;

    public function __construct(
        Builder $builder,
        string $directory,
        string $targetDirectory
    ) {
        $this->builder         = $builder;
        $this->directory       = $directory;
        $this->targetDirectory = $targetDirectory;
    }

    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}
