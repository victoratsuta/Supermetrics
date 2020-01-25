<?php


namespace App\Contract;


interface StorageClientInterface
{
    /**
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * @param string $token
     */
    public function saveToken(string $token): void;
}
