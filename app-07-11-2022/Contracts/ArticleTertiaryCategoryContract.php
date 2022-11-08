<?php

namespace App\Contracts;

/**
 * Interface ArticleTertiaryCategoryContract
 * @package App\Contracts
 */
interface ArticleTertiaryCategoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTertiarycategory(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTertiarycategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTertiarycategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTertiarycategory(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTertiarycategory($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsTertiarycategory($id);

    /**
     * @param $id
     * @return mixed
     */
    public function updateTertiarycategoryStatus(array $params);


    /**
     *
     * @return mixed
     */
    public function getSubCategory();
    public function getSearchTertiarycategory(string $term);


}
