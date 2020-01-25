<?php


namespace App;


use App\Contract\ApiClientInterface;
use App\Contract\StatisticServiceInterface;
use App\Contract\StorageClientInterface;

class App
{
    /**
     * @var StorageClientInterface
     */
    private $storageClient;

    /**
     * @var ApiClientInterface
     */
    private $apiClient;

    /**
     * @var StatisticServiceInterface
     */
    private $statisticService;

    /**
     * App constructor.
     *
     * @param StorageClientInterface    $storageClient
     * @param ApiClientInterface        $apiClient
     * @param StatisticServiceInterface $statisticService
     */
    public function __construct(
        StorageClientInterface $storageClient,
        ApiClientInterface $apiClient,
        StatisticServiceInterface $statisticService
    )
    {
        $this->storageClient = $storageClient;
        $this->apiClient = $apiClient;
        $this->statisticService = $statisticService;
    }

    /**
     * @return false|string
     */
    public function run()
    {
        $token = $this->getToken();
        $data = $this->getData($token);
        $stat =  $this->statisticService->getStat($data);
        return json_encode($stat);
    }

    /**
     * @return string
     */
    private function getToken(): string
    {
        $token = $this->storageClient->getToken();

        if (!$token) {
            $token = $this->apiClient->generateToken();
            $this->storageClient->saveToken($token);
        }

        return $token;
    }

    /**
     * @param string $token
     *
     * @return array
     */
    private function getData(string $token): array
    {
        $data = [];

        for ($i = 1; $i <= 10; $i++) {

            $dataFromApi = $this->apiClient->getData($i, $token);
            $data = array_merge($data, $dataFromApi['data']['posts']);

        }

        return $data;
    }
}
