<?php

namespace App\Contracts;

/**
 * Interface WorkedForContract
 * @package App\Contracts
 */
interface WorkedForContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findWorkedForById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createWorkedFor(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWorkedFor(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteWorkedFor($id);

}

