<?php

namespace App\Service;

use App\Response\ImageResponse;
use Gaufrette\Exception\FileNotFound;
use InvalidArgumentException;
use Knp\Bundle\GaufretteBundle\FilesystemMap;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class FileService
{
    private const FILE_STORAGES = [
        'cartes' => 'cartes_file_storage',
        'fleurderoc' => 'fleurderoc_file_storage',
        'livres' => 'livres_file_storage',
    ];

    public function __construct(
        private FilesystemMap $filesystem,
        private LoggerInterface $logger
    ) {
    }

    public function provide(string $storage, string $path): object|array|null
    {
        if (!isset(self::FILE_STORAGES[$storage])) {
            $this->logger->debug('Le storage '.$storage.' n\'est pas implémenté');
            throw new NotFoundHttpException('File not found');
        }

	try {
            $fileInfo = explode('/', $path);

            $fileNameWithExtension = array_pop($fileInfo);
            $fileName = explode('.', $fileNameWithExtension);

            $fileStorage = $this->filesystem->get(self::FILE_STORAGES[$storage]);
            $file = $fileStorage->get($path);

            return new ImageResponse($file->getContent(), $fileNameWithExtension, $fileName[1]);
	} catch (FileNotFound) {
            $this->logger->debug('Le fichier '.$path.' n\'existe pas');
            throw new NotFoundHttpException('File not found');
        } catch (InvalidArgumentException) {
            $this->logger->debug('Le storage '.self::FILE_STORAGES[$storage].' n\'existe pas');
            throw new NotFoundHttpException('File not found');
        }
    }
}
