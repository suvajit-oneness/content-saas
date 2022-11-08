<?php

namespace App\Contracts;

/**
 * Interface ClientContract
 * @package App\Contracts
 */
interface ClientContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findClientById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createClient(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateClient(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteClient($id);

}
