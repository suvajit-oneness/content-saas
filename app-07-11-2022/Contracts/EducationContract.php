<?php

namespace App\Contracts;

/**
 * Interface EducationContract
 * @package App\Contracts
 */
interface EducationContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findEducationById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createEducation(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEducation(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteEducation($id);

}
