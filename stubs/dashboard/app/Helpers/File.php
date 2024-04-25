<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class File
{
    private $path;
    private $type;
    private $mimeType;
    private $extension;

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function setMimeType($mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function setExtension($extension): void
    {
        $this->extension = $extension;
    }

    public static function getLimitFileSize(): int
    {
        return 8192000;
    }
}
