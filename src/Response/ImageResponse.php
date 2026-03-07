<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;

class ImageResponse extends Response
{
    public function __construct(string $content, string $filename, string $format)
    {
        parent::__construct(
            $content,
            Response::HTTP_OK,
            [
                'Content-Type' => 'image/' . $format,
                'Content-Disposition' => 'attachment; filename="' . $filename . '";',
                'Content-Length' => strlen($content),
            ]
        );
    }
}
