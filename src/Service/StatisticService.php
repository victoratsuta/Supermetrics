<?php


namespace App\Service;


use App\Contract\StatisticServiceInterface;
use App\Model\Post;
use Exception;

class StatisticService implements StatisticServiceInterface
{
    /**
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function getStat(array $data): array
    {
        $data = $this->wrapData($data);

        return [
            'Average character length of a post / month' => $this->averageCharacterLengthOfPostPerMonth($data),
            'Longest post by character length / month' => $this->longestPostByCharacterLengthPerMonth($data),
            'Total posts split by week' => $this->totalPostsSplitByWeek($data),
            'Average number of posts per user / month' => $this->averageNumberOfPostsPerUserPerMonth($data)
        ];
    }

    /**
     * @param array $data
     *
     * @return Post[]
     * @throws Exception
     */
    private function wrapData(array $data): array
    {
        foreach ($data as &$post) {

            $post = new Post(
                $post['id'],
                $post['from_name'],
                $post['from_id'],
                $post['message'],
                $post['type'],
                $post['created_time']
            );

        }

        return $data;
    }

    /**
     * @param array $posts
     *
     * @return array
     */
    private function averageCharacterLengthOfPostPerMonth(array $posts): array
    {
        $stat = [];

        /** @var Post $post */
        foreach ($posts as $post) {
            $stat[$post->getCreatedTime()->format('M')][] = strlen($post->getMessage());
        }

        foreach ($stat as &$item) {
            $item = array_sum($item) / count($item);
        }

        return $stat;

    }

    /**
     * @param array $posts
     *
     * @return array
     */
    private function longestPostByCharacterLengthPerMonth(array $posts): array
    {
        $stat = [];

        /** @var Post $post */
        foreach ($posts as $post) {
            $stat[$post->getCreatedTime()->format('M')][] = strlen($post->getMessage());
        }

        foreach ($stat as &$item) {
            $item = max($item);
        }

        return $stat;
    }

    /**
     * @param array $posts
     *
     * @return array
     */
    private function totalPostsSplitByWeek(array $posts): array
    {
        $stat = [];

        /** @var Post $post */
        foreach ($posts as $post) {

            if (!isset($stat[$post->getCreatedTime()->format('W.M')])) {
                $stat[$post->getCreatedTime()->format('W.M')] = 0;
            }

            ++$stat[$post->getCreatedTime()->format('W.M')];
        }

        return $stat;
    }

    /**
     * @param array $posts
     *
     * @return array
     */
    private function averageNumberOfPostsPerUserPerMonth(array $posts): array
    {

        $stat = [];

        /** @var Post $post */
        foreach ($posts as $post) {

            if (!isset($stat[$post->getFromId()][$post->getCreatedTime()->format('M')])) {
                $stat[$post->getFromId()][$post->getCreatedTime()->format('M')] = 0;
            }

            ++$stat[$post->getFromId()][$post->getCreatedTime()->format('M')];

        }

        return $stat;

    }

}
