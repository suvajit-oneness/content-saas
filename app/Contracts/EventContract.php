<?php

namespace App\Contracts;

/**
 * Interface EventContract
 * @package App\Contracts
 */
interface EventContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listEvents(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findEventById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createEvent(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEvent(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteEvent($id);

    /**
     * @param $id
     * @return mixed
     */
    public function detailsEvent($id);
    /**
     * @param $params
     * @return mixed
     */
    public function updateEventStatus(array $params);
    /**
     * @param
     * @return mixed
     */
    public function listCategory();
    /**
     * @param $from
     * @param $to
     * @param $type
     * @param $keyword
     * @return mixed
     */
    public function searchEventsData($from,$to,$type,$keyword);
}
