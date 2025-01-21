<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LocalFileUploader implements FileUploaderInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/public/uploads')]
        private string $uploadFolder
    ) {}

    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->uploadFolder, $fileName);

        return $fileName;
    }

    public function remove(string $path): void
    {
        if (file_exists($path)) {
            unlink($path); // Supprime le fichier
        }
    }
}
