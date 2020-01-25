<?php


namespace App\Contract;


interface ApiClientInterface
{
    /**
     * @return string
     */
    public function generateToken(): string;

    /**
     * @param int    $page
     * @param string $token
     *
     * @return array
     */
    public function getData(int $page, string $token): array;
}
