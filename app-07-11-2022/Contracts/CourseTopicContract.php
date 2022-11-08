<?php

namespace App\Contracts;

/**
 * Interface CourseTopicContract
 * @package App\Contracts
 */
interface CourseTopicContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTopic(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTopicById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTopic(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTopic(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTopic($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsTopic($id);


    public function updateTopicStatus(array $params);
    public function getSearchTopic(string $term);
}
