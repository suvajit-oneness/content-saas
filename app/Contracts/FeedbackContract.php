<?php

namespace App\Contracts;

/**
 * Interface FeedbackContract
 * @package App\Contracts
 */
interface FeedbackContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findFeedbackById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createFeedback(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFeedback(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFeedback($id);

}
