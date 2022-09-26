<?php

namespace App\Contracts;

/**
 * Interface MarketFaqContract
 * @package App\Contracts
 */
interface MarketFaqContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listMarketFaq(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findMarketFaqById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createMarketFaq(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketFaq(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteMarketFaq($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsMarketFaq($id);


    public function updateMarketFaqStatus(array $params);
    public function getSearchMarketFaq(string $term);
}
