<?php

namespace App\Contracts;

/**
 * Interface UserPortfolioCategoryContract
 * @package App\Contracts
 */
interface UserPortfolioCategoryContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findUserPortfolioCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createUserPortfolioCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUserPortfolioCategory(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteUserPortfolioCategory($id);

}


