<?php

namespace App\Contracts;

/**
 * Interface CourseQuizContract
 * @package App\Contracts
 */
interface CourseQuizContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listQuiz(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findQuizById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createQuiz(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateQuiz(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteQuiz($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsQuiz($id);


    public function updateQuizStatus(array $params);
    public function getSearchQuiz(string $term);
}
