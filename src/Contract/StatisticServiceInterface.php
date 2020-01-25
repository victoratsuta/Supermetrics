<?php


namespace App\Contract;


interface StatisticServiceInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function getStat(array $data): array;
}
