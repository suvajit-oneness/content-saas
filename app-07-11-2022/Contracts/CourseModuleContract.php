<?php

namespace App\Contracts;

/**
 * Interface CourseModuleContract
 * @package App\Contracts
 */
interface CourseModuleContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listModule(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findModuleById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createModule(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateModule(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteModule($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsModule($id);


    public function updateModuleStatus(array $params);
    public function getSearchModule(string $term);
}
