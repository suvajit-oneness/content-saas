<?php

namespace App\Contracts;

/**
 * Interface PortfolioContract
 * @package App\Contracts
 */
interface PortfolioContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findPortfolioById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createPortfolio(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePortfolio(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deletePortfolio($id);

}

