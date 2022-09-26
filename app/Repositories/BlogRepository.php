<?php
namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\BlogContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
/**
 * Class BlogRepository
 *
 * @package \App\Repositories
 */
class BlogRepository extends BaseRepository implements BlogContract
{
    use UploadAble;

    /**
     * ArticleRepository constructor.
     * @param Article $model
     */
    public function __construct(Article $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listArticles(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findArticleById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Blog|mixed
     */
    public function createArticle(array $params)
    {
        try {
            $collection = collect($params);
            $article = new Article;
            $article->title = $collection['title'];
            $article->article_category_id = implode(',',$collection['article_category_id']) ?? '';
            $article->article_sub_category_id = $collection['article_sub_category_id'] ?? '';
            $article->content = $collection['content'];
            $article->meta_title = $collection['meta_title'] ?? '';
            $article->meta_key = $collection['meta_key'] ?? '';
            $article->meta_description = $collection['meta_description'] ?? '';
            $article->tag = $collection['tag'] ?? '';
            // slug generate
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = Article::where('title', $collection['title'])->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $article->slug = $slug;
            if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("articles/",$imageName);
            $uploadedImage = $imageName;
            $article->image = $uploadedImage;
            }

            $article->save();
            return $article;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateArticle(array $params)
    {
        $article = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $article->title = $collection['title'];
        if(!empty($params['article_category_id'])) {
        $article->article_category_id = implode(',',$collection['article_category_id']);
        }
        if(!empty($params['article_sub_category_id'])) {
        $article->article_sub_category_id = $collection['article_sub_category_id'] ?? '';
        }
        $article->content = $collection['content'];
        $article->meta_title = $collection['meta_title'] ?? '';
        $article->meta_key = $collection['meta_key'] ?? '';
        $article->meta_description = $collection['meta_description'] ?? '';
        $article->tag = $collection['tag'] ?? '';
        if($article->title != $collection['title']) {
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = Article::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $article->slug = $slug;
        }
        if(!empty($params['image'])) {
            $profile_image = $collection['image'] ?? '';
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("articles/",$imageName);
            $uploadedImage = $imageName;
            $article->image = $uploadedImage;
        }
        $article->save();

        return $article;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteArticle($id)
    {
        $article = $this->findOneOrFail($id);
        $article->delete();
        return $article;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateArticleStatus(array $params){
        $article = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $article->status = $collection['check_status'];
        $article->save();
        return $article;
    }

    public function updateLatestArticleStatus(array $params){
        $article = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $article->blog_status = $collection['check_status'];
        $article->save();
        return $article;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function detailsArticle($slug){
        $article = Article::where('slug', $slug)->get();
        return $article;
    }

    public function Articledetails($id){
        $article = Article::where('id', $id)->get();
        return $article;
    }

    /**
     * @return mixed
     */
    public function getSearchArticle(string $term)
    {
        return Article::where([['title', 'LIKE', '%' . $term . '%']])
        ->orWhere('article_category_id', 'LIKE', '%' . $term . '%')
        ->orWhere('meta_title', 'LIKE', '%' . $term . '%')
        ->orWhere('meta_key', 'LIKE', '%' . $term . '%')
        ->paginate(25);
    }
    /**
     * @return mixed
     */
    public function getArticlecategories(){
        $categories = ArticleCategory::orderBy('title')->get();
        return $categories;
    }
    /**
     * @return mixed
     */
    public function getArticlesubcategories(){
        $categories = ArticleSubCategory::orderBy('title')->get();
        return $categories;
    }
    /**
     * @param $categoryId
     * @param $subCategoryId
     * @param $keyword
     * @return mixed
     */
    public function searchBlogsData($categoryId,$subCategoryId,$keyword){
        $article = Article::with('category')->where('status','=',1)->

        when($categoryId!='', function($query) use ($categoryId){
            $query->where('article_category_id', '=', $categoryId);
        })
         ->when($subCategoryId!='', function($query) use ($subCategoryId){
            $query->where('article_sub_category_id', '=', $subCategoryId);
        })
        ->when($keyword, function($query) use ($keyword){
            $query->where('title', 'like', '%' . $keyword .'%');
        })
        ->paginate(25);
        return $article;
    }

}

