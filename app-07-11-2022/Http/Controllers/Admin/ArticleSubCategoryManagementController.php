<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\ArticleSubCategoryContract;
use Illuminate\Http\Request;
use App\Models\ArticleSubCategory;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticleSubcategoryExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class ArticleSubCategoryManagementController extends BaseController
{
    /**
     * @var ArticleSubCategoryContract
     */
    protected $ArticleSubCategoryRepository;


    /**
     * PageController constructor.
     * @param SubCategoryContract $SubCategoryRepository
     */
    public function __construct(ArticleSubCategoryContract $ArticleSubCategoryRepository)
    {
        $this->ArticleSubCategoryRepository = $ArticleSubCategoryRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        if (!empty($request->term)) {
             $subcategories = $this->ArticleSubCategoryRepository->getSearchSubcategory($request->term);
         } else {
           $subcategories = ArticleSubCategory::orderby('title')->paginate(35);
         }
        $categories = $this->ArticleSubCategoryRepository->listCategory();
        $this->setPageTitle('Article Sub Category', 'List of all article sub categories');
        return view('admin.articlesubcategory.index', compact('subcategories','categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Article Sub Category', 'Create Article Subcategory');
        $categories = $this->ArticleSubCategoryRepository->listCategory();

        return view('admin.articlesubcategory.create',compact('categories'));
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
            'category_id'      =>  'required|max:191',
        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = ArticleSubCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        // send slug
        request()->merge(['slug' => $slug]);
        $params = $request->except('_token');

        $targetsubCategory = $this->ArticleSubCategoryRepository->createSubCategory($params);

        if (!$targetsubCategory) {
            return $this->responseRedirectBack('Error occurred while creating article sub category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.article-subcategory.index', 'Article SubCategory has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetsubCategory = $this->ArticleSubCategoryRepository->findSubCategoryById($id);
        $categories = $this->ArticleSubCategoryRepository->listCategory();
        $this->setPageTitle('Article Sub Category', 'Edit Article Sub Category : '.$targetsubCategory->title);
        return view('admin.articlesubcategory.edit', compact('targetsubCategory','categories'));
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
            'category_id'      =>  'required|max:191',
        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = ArticleSubCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $params = $request->except('_token');

        $subcategory = $this->ArticleSubCategoryRepository->updateSubCategory($params);

        if (!$subcategory) {
            return $this->responseRedirectBack('Error occurred while updating article sub category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Article SubCategory has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $subcategory = $this->ArticleSubCategoryRepository->deleteSubCategory($id);

        if (!$subcategory) {
            return $this->responseRedirectBack('Error occurred while deleting article sub category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.article-subcategory.index', 'article sub Category has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $subcategory = $this->ArticleSubCategoryRepository->updatesubCategoryStatus($params);

        if ($subcategory) {
            return response()->json(array('message'=>'Article SubCategory status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->ArticleSubCategoryRepository->detailsSubCategory($id);
        $subcategory = $categories[0];

        $this->setPageTitle('Article SubCategory', 'Article Sub Category Details : '.$subcategory->title);
        return view('admin.articlesubcategory.details', compact('subcategory'));
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
                            "category_id" => isset($importData[2]) ? $importData[2] : null,
                        );
                        $resp = ArticleSubCategory::insertData($insertData, $count, $successArr, $failureArr);
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
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }
        return redirect()->route('admin.article-subcategory.index');
    }
    public function export()
    {
        return Excel::download(new ArticleSubcategoryExport, 'articlesubcategory.xlsx');
    }
}


