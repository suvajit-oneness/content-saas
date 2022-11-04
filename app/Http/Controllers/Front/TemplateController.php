<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemplateCategory;
use App\Models\TemplateSubCategory;
use App\Models\TemplateType;
use App\Models\Template;
use App\Contracts\TemplateContract;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    protected $TemplateRepository;

    /**
     * StateManagementController constructor.
     * @param PincodeRepository $StateRepository
     */

    public function __construct(TemplateContract $TemplateRepository)
    {
        $this->TemplateRepository = $TemplateRepository;
    }
    public function index(Request $request)
    {
        if (!empty($request->filter)) {
            // dd($request->all());

            $keyword = !empty($request->keyword) ? $request->keyword : '';
            $category = (!empty($request->cat_id) && $request->cat_id!='')?$request->cat_id:'';
            $subcategory = (!empty($request->sub_cat_id) && $request->sub_cat_id!='')? $request->sub_cat_id:'';
            $type = (!empty($request->type) && $request->type!='')?$request->type:'';

            $template = $this->TemplateRepository->searchTemplatefrontData($keyword, $category, $subcategory, $type);
        } else{
            $template = Template::where('status',1)->orderby('title')->paginate(10);
        }

        $category=TemplateCategory::where('status',1)->orderby('title')->get();
        $subcategory=TemplateSubCategory::where('status',1)->orderby('title')->get();
        $type=TemplateType::orderby('title')->get();

        return view('front.template.index',compact('template', 'category', 'subcategory', 'type'));
    }
}
