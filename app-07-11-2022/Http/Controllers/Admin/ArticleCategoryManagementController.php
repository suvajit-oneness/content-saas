<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\ArticleCategoryContract;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticleCategoryExport;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class ArticleCategoryManagementController extends BaseController
{
    /**
     * @var ArticleCategoryContract
     */
    protected $ArticleCategoryRepository;


    /**
     * CategoryManagementController constructor.
     * @param ArticleCategoryContract $ArticleCategoryRepository
     */
    public function __construct(ArticleCategoryContract $ArticleCategoryRepository)
    {
        $this->ArticleCategoryRepository = $ArticleCategoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $categories = $this->ArticleCategoryRepository->getSearchCategories($request->term);
        } else {
            $categories = ArticleCategory::orderby('title')->paginate(25);
        }
        $this->setPageTitle('Article Category', 'List of all article categories');
        return view('admin.articlecategory.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Article Category', 'Create article category');
        return view('admin.articlecategory.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');

        $category = $this->ArticleCategoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating article category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.article-category.index', 'Article Category has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCategory = $this->ArticleCategoryRepository->findCategoryById($id);

        $this->setPageTitle('Article Category', 'Edit Article Category : ' . $targetCategory->title);
        return view('admin.articlecategory.edit', compact('targetCategory'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $category = $this->ArticleCategoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating article category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Article Category has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->ArticleCategoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting article category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.article-category.index', 'Article Category has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $category = $this->ArticleCategoryRepository->updateCategoryStatus($params);

        if ($category) {
            return response()->json(array('message' => 'Article Category status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->ArticleCategoryRepository->detailsCategory($id);
        $category = $categories[0];

        $this->setPageTitle('Article Category Details', 'Article Category Details : ' . $category->title);
        return view('admin.articlecategory.details', compact('category'));
    }


    //csv upload

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
                    $insertData = [];
                    $count = $total = 0;
                    $successArr = $failureArr = [];
                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        $storeData = 0;
                        if (isset($importData[3]) == "Carry In") $storeData = 1;
                            $titleArr = explode(',', $importData[0]);
                        foreach ($titleArr as $titleKey => $titleValue) {
                            // slug generate
                            $slug = Str::slug($titleValue, '-');
                            $slugExistCount = DB::table('article_categories')->where('title', $titleValue)->count();
                            if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                        $insertData = array(
                            "title" => isset($importData[0]) ? $importData[0] : null,
                            "slug" => $slug,
                            "description" => isset($importData[1]) ? $importData[1] : null,

                        );
                        // echo '<pre>';print_r($insertData);exit();
                        $resp = ArticleCategory::insertData($insertData, $count, $successArr, $failureArr);
                        $count = $resp['count'];
                        $successArr = $resp['successArr'];
                        $failureArr = $resp['failureArr'];
                        $total++;
                    }
                }
                if($count == 0){
                    FacadesSession::flash('csv', 'Already Uploaded. ');
                } else{
                     FacadesSession::flash('csv', 'Import Successful. '.$count.' Data Uploaded');
                }
                   // Session::flash('message', 'Import Successful.');
                } else {
                    FacadesSession::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                FacadesSession::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            FacadesSession::flash('message', 'No file found.');
        }
        return redirect()->route('admin.article-category.index');
    }
    // csv upload

    // export
    public function export()
    {
        return Excel::download(new ArticleCategoryExport, 'articlecategory.xlsx');
    }
    // export
}
