<?php

namespace App\Contracts;

/**
 * Interface MarketContract
 * @package App\Contracts
 */
interface MarketContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listMarket(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findMarketById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createMarket(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarket(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteMarket($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsMarket($id);


    public function updateMarketStatus(array $params);
    public function getSearchMarket(string $term);
}
