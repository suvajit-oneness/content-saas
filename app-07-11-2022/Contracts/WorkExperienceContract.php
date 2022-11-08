<?php

namespace App\Contracts;

/**
 * Interface WorkExperienceContract
 * @package App\Contracts
 */
interface WorkExperienceContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findExperienceById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createExperience(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateExperience(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteExperience($id);

}
