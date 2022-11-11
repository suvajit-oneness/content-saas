<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketFaqContract;
use Illuminate\Http\Request;
use App\Models\MarketFaq;
use App\Http\Controllers\BaseController;
use App\Models\MarketPlaceFaq;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class MarketPlaceFaqController extends BaseController

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
            $faqs = MarketPlaceFaq::groupBy('header_id')->where('header',$request->term)->paginate(15);
        } else {
            $faqs = MarketPlaceFaq::groupBy('header_id')->paginate(15);
        }
        $this->setPageTitle('MarketPlace faq', 'List of all Marketplace Faqs');
        return view('admin.marketplace.faq.index', compact('faqs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Marketplace faq', 'Create Marketplace faq');
        return view('admin.marketplace.faq.create');
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
                $marketplacefaq = new MarketPlaceFaq();
                $marketplacefaq->header = $params['header'];
                $marketplacefaq->header_id = $header;
                $marketplacefaq->question = $params['question'][$i];
                $marketplacefaq->answer = $params['answer'][$i];
                $marketplacefaq->save();
            }
        }

        return $this->responseRedirect('admin.marketplace.faq.index', 'Marketplace faqs has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetfaq = MarketPlaceFaq::where('header_id',$id)->get();

        $this->setPageTitle('MarketPlace faq', 'Edit MarketPlace faq : ' . $targetfaq[0]->header);
        return view('admin.marketplace.faq.edit', compact('targetfaq'));
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
        $marketplacefaq = MarketPlaceFaq::where('header_id',$request->id)->delete();

        for($i=0; $i<count($params['question']); $i++) { 
            if($params['question'][$i] != ''){
                $marketplacefaq = new MarketPlaceFaq();
                $marketplacefaq->header = $params['header'];
                $marketplacefaq->header_id = $params['id'];
                $marketplacefaq->question = $params['question'][$i];
                $marketplacefaq->answer = $params['answer'][$i];
                $marketplacefaq->save();
            }
        }

        return $this->responseRedirectBack('Marketplace faq has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = MarketPlaceFaq::where('header_id',$id)->delete();

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while deleting MarketPlace faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.marketplace.faq.index', 'MarketPlace faq has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');
        $faq = MarketPlaceFaq::where('header_id',$request->id)->update(['status'=>$request->check_status]);


        if ($faq) {
            return response()->json(array('message' => 'Marketplace faq status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $faq = MarketPlaceFaq::where('header_id',$id)->get();

        $this->setPageTitle('MarketPlace faq Details', 'Marketplace faq Details : ' . $faq[0]->header);

        return view('admin.marketplace.faq.details', compact('faq'));
    }
}
