<?php

namespace App\Contracts;

/**
 * Interface SupportFaqCategoryContract
 * @package App\Contracts
 */
interface SupportFaqContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSupportFaq(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSupportFaqById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSupportFaq(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportFaq(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSupportFaq($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsSupportFaq($id);
    public function updateSupportFaqStatus(array $params);
    public function getSearchSupportFaq(string $term);

}
