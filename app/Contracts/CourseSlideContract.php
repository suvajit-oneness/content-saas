<?php

namespace App\Contracts;

/**
 * Interface CourseSlideContract
 * @package App\Contracts
 */
interface CourseSlideContract
{


    /**
     * @param array $params
     * @return mixed
     */
    public function createSlide(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSlide(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSlide($id);
    public function updateSlideStatus(array $params);

}
