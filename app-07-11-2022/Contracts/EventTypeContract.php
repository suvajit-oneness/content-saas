<?php

namespace App\Contracts;

/**
 * Interface EventTypeContract
 * @package App\Contracts
 */
interface EventTypeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listEventtype(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findEventtypeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createEventtype(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEventtype(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteEventtype($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsEventtype($id);
    /**
     * @param $params
     * @return mixed
     */
    public function updateEventtypeStatus(array $params);
    /**
     * @param $term
     * @return mixed
     */
    public function getSearchEventtype(string $term);
}
