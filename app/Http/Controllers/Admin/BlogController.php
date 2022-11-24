<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\User;
use App\Contracts\BlogContract;
use App\Contracts\DirectoryCategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticleExport;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class BlogController extends BaseController
{
    protected $BlogRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $BlogRepository
     */

    public function __construct(BlogContract $BlogRepository)
    {
        $this->BlogRepository = $BlogRepository;

    }

    /**
     * List all the states
     */
    public function index(Request $request)
    {
        if (isset($request->article_category_id) || isset($request->from) || isset($request->keyword)) {
            $categoryId = !empty($request->article_category_id) ? $request->article_category_id : '';
            $subCategoryId = !empty($request->article_sub_category_id) ? $request->article_sub_category_id : '';
            $keyword = !empty($request->keyword) ? $request->keyword : '';
            $article = $this->BlogRepository->searchBlogsData($categoryId,$subCategoryId,$keyword);
        } else {
            $article =  Article::orderby('title')->paginate(25);
        }
        $articlecat = $this->BlogRepository->getArticlecategories();
        $articlesubcat = $this->BlogRepository->getArticlesubcategories();
        $this->setPageTitle('Blog', 'List of all Blog');
        return view('admin.article.index', compact('article','articlecat', 'articlesubcat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Blog', 'Create Blog');
         $articlecat = $this->BlogRepository->getArticlecategories();
         $articlesubcat = $this->BlogRepository->getArticlesubcategories();
        return view('admin.article.create', compact('articlecat', 'articlesubcat'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|string|min:1',
            'article_category_id' => 'required|array|min:1',
            'content' => 'required|string|min:1',
            'short_desc' => 'required|string|min:1|max:150',
            'tag'=>'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:20000',
        ]);

        $article = $this->BlogRepository->createArticle($request->except('_token'));

        if (!$article) {
            return $this->responseRedirectBack('Error occurred while creating Blog.', 'error', true, true);
        }
        return $this->responseRedirect('admin.article.index', 'Blog has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetarticle = $this->BlogRepository->findArticleById($id);
        $articlecat = $this->BlogRepository->getArticlecategories();
        $articlesubcat = $this->BlogRepository->getArticlesubcategories();
        $this->setPageTitle('Blog', 'Edit Blog : ' . $targetarticle->title);
        return view('admin.article.edit', compact('targetarticle', 'articlecat', 'articlesubcat'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|min:1',
            'article_category_id' => 'required|array|min:1',
            'content' => 'required|string|min:1',
            'short_desc' => 'required|string|min:1|max:150',
            'tag'=>'required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:20000',
        ]);
        $params = $request->except('_token');

        $targetblog = $this->BlogRepository->updateArticle($params);

        if (!$targetblog) {
            return $this->responseRedirectBack('Error occurred while updating Blog.', 'error', true, true);
        }
        return $this->responseRedirectBack('Blog has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $targetblog = $this->BlogRepository->deleteArticle($id);

        if (!$targetblog) {
            return $this->responseRedirectBack('Error occurred while deleting Blog.', 'error', true, true);
        }
        return $this->responseRedirect('admin.article.index', 'Article has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $targetblog = $this->BlogRepository->updateArticleStatus($params);

        if ($targetblog) {
            return response()->json(array('message' => 'Blog status has been successfully updated'));
        }
    }

    public function blogupdateStatus(Request $request)
    {

        $params = $request->except('_token');

        $targetblog = $this->BlogRepository->updateLatestArticleStatus($params);

        if ($targetblog) {
            return response()->json(array('message' => 'Blog status has been successfully updated'));
        }
    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $targetarticle = $this->BlogRepository->Articledetails($id);
        $article = $targetarticle[0];

        $this->setPageTitle('Blog', 'Blog Details : ' . $article->title);
        return view('admin.article.details', compact('article'));
    }


    public function csvStore(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'admin/uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database



                    foreach ($importData_arr as $importData) {

                        $commaSeperatedCats = '';

                            $catExistCheck = ArticleCategory::where('title', $importData[2])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new ArticleCategory();
                                $dirCat->title = $importData[2];
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId . ',';
                            }

                        $count = 0;
                        $commaSeperatedSubCats = '';
                         $count = $total = 0;
                        $successArr = $failureArr = [];

                            $catExistCheck = ArticleSubCategory::where('title', $importData[3])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedSubCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new ArticleSubCategory();
                                $dirCat->title = $importData[3];
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedSubCats .= $insertDirCatId . ',';
                            }

                        if (!empty($importData[9])) {
                            // dd($importData[0]);
                            $titleArr = explode(',', $importData[9]);

                            // echo '<pre>';print_r($titleArr);exit();

                            foreach ($titleArr as $titleKey => $titleValue) {
                                // slug generate
                                $slug = Str::slug($titleValue, '-');
                                $slugExistCount = DB::table('articles')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => $titleValue,
                                    "content" => isset($importData[7]) ? $importData[7] : null,
                                    "meta_title" => isset($importData[8]) ? $importData[8] : null,
                                    "meta_key" => isset($importData[6]) ? $importData[6] : null,
                                    "article_category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                                    "article_sub_category_id" => isset($commaSeperatedSubCats) ? $commaSeperatedSubCats : null,
                                    "article_tertiary_category_id" => isset($commaSeperatedSublevelCats) ? $commaSeperatedSublevelCats : null,
                                    "slug" => $slug,
                                    "meta_description" => isset($importData[8]) ? $importData[8] : null,

                                );

                                $resp =Article::insertData($insertData, $count,$successArr,$failureArr);
                                $count = $resp['count'];
                                $successArr = $resp['successArr'];
                                $failureArr = $resp['failureArr'];
                                $total++;
                            }
                        }
                    }
                    //Session::flash('message', 'Import Successful.');
                        if($count==0){
                            FacadesSession::flash('csv', 'Already Uploaded. ');
                        }
                        else{
                             FacadesSession::flash('csv', 'Import Successful. '.$count.' Data Uploaded');
                        }
                } else {
                    FacadesSession::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                FacadesSession::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            FacadesSession::flash('message', 'No file found.');
        }
        return redirect()->route('admin.article.index');
    }
    // csv upload

    public function export()
    {
        return Excel::download(new ArticleExport, 'article.xlsx');
    }
}
