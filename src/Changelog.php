<?php

declare(strict_types=1);

namespace Autodocs;

class Changelog
{
    public string $monitoredPath;
    public array $monitoredFiles = [];
    public array $changedFiles = [];
    public array $newFiles = [];
    public function __construct(string $monitoredPath)
    {
        $this->monitoredPath = $monitoredPath;
    }

    public function capture(): void
    {
        $this->registerFiles($this->monitoredPath);
    }

    public function makeDiff(?string $monitoredPath = null): void
    {
        if ( ! $monitoredPath) {
            $monitoredPath = $this->monitoredPath;
        }
        $previous = $this->monitoredFiles;
        $this->registerFiles($monitoredPath);

        foreach ($this->monitoredFiles as $index => $file) {
            if ( ! array_key_exists($index, $previous)) {
                $this->newFiles[] = $file;
                continue;
            }

            if ($previous[$index]['md5'] !== $file['md5']) {
                $this->changedFiles[] = $file;
            }
        }
    }

    public function hasNewFiles(): bool
    {
        return count($this->newFiles) > 0;
    }

    public function hasChangedFiles(): bool
    {
        return count($this->changedFiles) > 0;
    }

    public function hasChanges(): bool
    {
        return $this->hasNewFiles() || $this->hasChangedFiles();
    }

    public function getChangesSummary(): string
    {
        if ($this->hasChanges()) {
            return sprintf(
                "%s files added and %s files changed.",
                count($this->newFiles),
                count($this->changedFiles)
            );
        }

        return "No changes.";
    }

    public function registerFiles(string $monitoredPath): void
    {
        foreach (glob($monitoredPath.'/*') as $filename) {
            if (is_dir($filename)) {
                $this->registerFiles($filename);
            }

            $index = md5($filename);
            $this->monitoredFiles[$index] = [
                'path' => $filename,
                'isDir' => is_dir($filename) ? "yes" : "no",
                'md5' => is_dir($filename) ? $index : md5_file($filename),
            ];
        }
    }
}
