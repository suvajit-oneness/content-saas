<?php

namespace App\Contracts;

/**
 * Interface BlogContract
 * @package App\Contracts
 */
interface BlogContract
{
   /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listArticles(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findArticleById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createArticle(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateArticle(array $params);
    /**
     * @param array $params
     * @return mixed
     */
    public function updateArticleStatus(array $params);
    /**
     * @param array $params
     * @return mixed
     */
    public function updateLatestArticleStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteArticle($id);

    /**
     * @param $id
     * @return mixed
     */
    public function detailsArticle($id);

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
     * @param $categoryId
     * @param $subCategoryId
     * @param $keyword
     * @return mixed
     */
    public function searchBlogsData($categoryId,$subCategoryId,$keyword);

}

