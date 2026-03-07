<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use App\State\FileService;

class File
{
    #[ApiProperty(identifier: true)]
    public string $path;
}
