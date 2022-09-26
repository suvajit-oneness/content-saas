<?php

namespace App\Contracts;

/**
 * Interface EventContract
 * @package App\Contracts
 */
interface CourseContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCourse(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCourseById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCourse(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCourse(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCourse($id);

    /**
     * @param $id
     * @return mixed
     */
    public function detailsCourse($id);
    /**
     * @param $params
     * @return mixed
     */
    public function updateCourseStatus(array $params);
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
    public function searchCoursesData($category,$author,$type,$keyword);
}
