<?php

namespace App\Contracts;

/**
 * Interface SupportContract
 * @package App\Contracts
 */
interface SupportContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSupport(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSupportById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSupport(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupport(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSupport($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsSupport($id);

}
