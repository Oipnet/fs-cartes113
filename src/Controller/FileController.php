<?php

namespace App\Controller;

use App\Service\FileService;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
readonly class FileController
{
    public function __construct(private FileService $fileService)
    {
    }

    #[Route('/files/{storage}/{path}', name: 'file', requirements: ['path' => '.+'], methods: ['GET'])]
    public function __invoke(string $storage, string $path)
    {
        return $this->fileService->provide($storage, $path);
    }
}
