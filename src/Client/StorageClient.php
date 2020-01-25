<?php


namespace App\Client;


use App\Contract\StorageClientInterface;

class StorageClient implements StorageClientInterface
{
    const FILE_NAME = 'storage.txt';

    /**
     * @var string
     */
    private $filePath;

    /**
     * StorageClient constructor.
     */
    public function __construct()
    {
        $this->filePath = __DIR__ . '/../../data/' . self::FILE_NAME;
    }

    /**
     * @return string|null
     */
    public function getToken() : ?string
    {
        return  file_get_contents($this->filePath);
    }

    /**
     * @param string $token
     */
    public function saveToken(string $token): void
    {
        file_put_contents($this->filePath, $token, LOCK_EX);
    }
}
