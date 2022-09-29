<?php

namespace App\Contracts;

/**
 * Interface SupportFaqCategoryContract
 * @package App\Contracts
 */
interface SupportFaqCategoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSupportFaqCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSupportFaqCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSupportFaqCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportFaqCategory(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSupportFaqCategory($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsSupportFaqCategory($id);
    public function updateSupportFaqCategoryStatus(array $params);
    public function getSearchSupportFaqCategory(string $term);

}
