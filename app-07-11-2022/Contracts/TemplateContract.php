<?php

namespace App\Contracts;

/**
 * Interface TemplateContract
 * @package App\Contracts
 */
interface TemplateContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTemplate(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTemplateById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTemplate(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTemplate(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTemplate($id);

    /**
     * @param $id
     * @return mixed
     */
    public function detailsTemplate($id);
    /**
     * @param $params
     * @return mixed
     */
    public function updateTemplateStatus(array $params);
    /**
     * @param
     * @return mixed
     */
    public function listCategory();
    /**
     * @param
     * @return mixed
     */
    public function listSubcategory();
    /**
     * @param
     * @return mixed
     */
    public function listType();
    /**
     * @param $from
     * @param $to
     * @param $type
     * @param $keyword
     * @return mixed
     */
    public function getSearchTemplate(string $term);
    public function searchTemplatefrontData($keyword, $category, $subcategory, $type);
}
