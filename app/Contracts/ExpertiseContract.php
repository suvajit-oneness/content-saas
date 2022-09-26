<?php

namespace App\Contracts;

/**
 * Interface ExpertiseContract
 * @package App\Contracts
 */
interface ExpertiseContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findExpertiseById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createExpertise(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateExpertise(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteExpertise($id);

}
