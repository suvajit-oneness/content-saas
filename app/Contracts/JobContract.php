<?php

namespace App\Contracts;

/**
 * Interface JobContract
 * @package App\Contracts
 */
interface JobContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listJob(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findJobById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createJob(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateJob(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteJob($id);

    /**
     * @param $id
     * @return mixed
     */
    public function detailsJob($id);
    /**
     * @param $params
     * @return mixed
     */
    public function updateJobStatus(array $params);
    public function updateJobfeatureStatus(array $params);
    public function updateJobbegineerfriendlyStatus(array $params);
    /**
     * @param
     * @return mixed
     */
    public function listCategory();
    /**
     * @param $from
     * @param $to
     * @param $type
     * @param $keyword
     * @return mixed
     */
    public function searchJobData($term);
    public function searchJobfrontData($categoryId,$keyword,$price,$type,$location);
}
