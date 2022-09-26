<?php

namespace App\Contracts;

/**
 * Interface TestimonialContract
 * @package App\Contracts
 */
interface TestimonialContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findTestimonialById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTestimonial(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTestimonial(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTestimonial($id);

}
