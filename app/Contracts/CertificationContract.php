<?php

namespace App\Contracts;

/**
 * Interface CertificationContract
 * @package App\Contracts
 */
interface CertificationContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findCertificationById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCertification(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCertification(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCertification($id);

}
