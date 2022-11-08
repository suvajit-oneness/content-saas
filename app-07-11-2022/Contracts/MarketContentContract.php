<?php

namespace App\Contracts;

/**
 * Interface MarketContentContract
 * @package App\Contracts
 */
interface MarketContentContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listContent(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findContentById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createContent(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateContent(array $params);
    /**
     * @param array $params
     * @return mixed
     */
    public function updateContentStatus(array $params);
    /**
     * @param array $params
     * @return mixed
     */
    public function updateLatestContentStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteContent($id);

    /**
     * @param $id
     * @return mixed
     */
    public function detailsContent($id);

    /**
     * @return mixed
     */
    public function getArticlecategories();
    /**
     * @param $term
     * @return mixed
     */
    public function getSearchArticle(string $term);
    /**
     * @return mixed
     */
    public function getArticlesubcategories();
    /**
     * @return mixed
     */
    public function getArticletertiarycategories();
   /**
     * @param $categoryId
     * @param $subCategoryId
     * @param $keyword
     * @return mixed
     */
    public function searchBlogsData($categoryId,$subCategoryId,$keyword);

}

