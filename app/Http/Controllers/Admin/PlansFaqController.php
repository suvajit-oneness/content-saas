<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketFaqContract;
use Illuminate\Http\Request;
use App\Models\MarketFaq;
use App\Http\Controllers\BaseController;
use App\Models\MarketPlaceFaq;
use App\Models\PlansPriceFaq;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class PlansFaqController extends BaseController

{
    /**
     * @var MarketfaqContract
     */
    /**
     * MarketfaqController constructor.
     * @param MarketfaqContract $MarketFaqRepository
     */

    // public function __construct(MarketFaqContract $MarketFaqRepository)
    // {
    //     $this->MarketFaqRepository = $MarketFaqRepository;
    // }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $faqs = PlansPriceFaq::groupBy('header_id')->get();
        } else {
            $faqs = PlansPriceFaq::groupBy('header_id')->paginate(15);
        }
        $this->setPageTitle('plans faq', 'List of all planspage Faqs');
        return view('admin.planspricefaq.index', compact('faqs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('planspage faq', 'Create planspage faq');
        return view('admin.planspricefaq.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'header' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);

        if(count($request->question) == count($request->answer)){
            foreach ($request->question as $key => $q) {
                if($q != '' && $request->answer[$key] == ''){
                    return $this->responseRedirectBack('All the questions and answer are not set properly!', 'error', true, true);
                }
            }
        }
        else{
            return $this->responseRedirectBack('All the questions and answer are not set properly!', 'error', true, true);
        }
        
        $params = $request->except('_token');

        $header = "hdr_" . uniqid();

        for($i=0; $i<count($params['question']); $i++) { 
            if($params['question'][$i] != ''){
                $planspagefaq = new PlansPriceFaq();
                $planspagefaq->header = $params['header'];
                $planspagefaq->header_id = $header;
                $planspagefaq->question = $params['question'][$i];
                $planspagefaq->answer = $params['answer'][$i];
                $planspagefaq->save();
            }
        }

        return $this->responseRedirect('admin.plans.faq.index', 'Plans page faqs has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetfaq = PlansPriceFaq::where('header_id',$id)->get();

        $this->setPageTitle('plans faq', 'Edit plans faq : ' . $targetfaq[0]->header);
        return view('admin.planspricefaq.edit', compact('targetfaq'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'header' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);

        if(count($request->question) == count($request->answer)){
            foreach ($request->question as $key => $q) {
                if($q != '' && $request->answer[$key] == ''){
                    return $this->responseRedirectBack('All the questions and answer are not set properly!', 'error', true, true);
                }
            }
        }
        else{
            return $this->responseRedirectBack('All the questions and answer are not set properly!', 'error', true, true);
        }
        $params = $request->except('_token');
        $planspagefaq = PlansPriceFaq::where('header_id',$request->id)->delete();

        for($i=0; $i<count($params['question']); $i++) { 
            if($params['question'][$i] != ''){
                $planspagefaq = new PlansPriceFaq();
                $planspagefaq->header = $params['header'];
                $planspagefaq->header_id = $params['id'];
                $planspagefaq->question = $params['question'][$i];
                $planspagefaq->answer = $params['answer'][$i];
                $planspagefaq->save();
            }
        }

        return $this->responseRedirectBack('Plans page faq has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = PlansPriceFaq::where('header_id',$id)->delete();

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while deleting plans faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.plans.faq.index', 'plans faq has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');
        $faq = PlansPriceFaq::where('header_id',$request->id)->update(['status'=>$request->check_status]);


        if ($faq) {
            return response()->json(array('message' => 'Plans page faq status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $faq = PlansPriceFaq::where('header_id',$id)->get();

        $this->setPageTitle('Plans faq Details', 'Planspage faq Details : ' . $faq[0]->header);

        return view('admin.planspricefaq.details', compact('faq'));
    }
}
