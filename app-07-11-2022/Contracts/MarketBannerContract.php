<?php

namespace App\Contracts;

/**
 * Interface MarketBannerContract
 * @package App\Contracts
 */
interface MarketBannerContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listMarketBanner(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findMarketBannerById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createMarketBanner(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketBanner(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteMarketBanner($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsMarketBanner($id);


    public function updateMarketBannerStatus(array $params);
    public function getSearchMarketBanner(string $term);
}
