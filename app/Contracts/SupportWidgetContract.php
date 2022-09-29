<?php

namespace App\Contracts;

/**
 * Interface SupportWidgetContract
 * @package App\Contracts
 */
interface SupportWidgetContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSupportWidget(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSupportWidgetById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSupportWidget(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportWidget(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSupportWidget($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsSupportWidget($id);
    public function updateSupportWidgetStatus(array $params);
    public function getSearchSupportFaqCategory(string $term);

}
