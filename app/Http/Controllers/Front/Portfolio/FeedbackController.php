<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\FeedbackContract;
use App\Feedback;
use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class FeedbackController extends BaseController
{
    /**
     * @var FeedbackContract
     */
    protected $FeedbackRepository;


    /**
     * FeedbackController constructor.
     * @param FeedbackContract $FeedbackRepository
     */
    public function __construct(FeedbackContract $FeedbackRepository)
    {
        $this->FeedbackRepository = $FeedbackRepository;
    }
    public function index(Request $request)
    {
        $this->setPageTitle('Feedback', ' Feedback');
        $data = (object)[];
        $user_id = auth()->guard('web')->user()->id;
        $data->feedback = Feedback::where('user_id', $user_id)->get();
       // $category=ArticleCategory::orderby('title')->get();
        return view('front.portfolio.feedback.index',compact('data'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Feedback', 'Create Feedback');
        return view('front.portfolio.feedback.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date_from' => 'required',
            'title' => 'required',
            'rating' => 'required',
            'review' => 'required',
            'review_person' => 'required',

        ]);
        $params = $request->except('_token');

        $feedback = $this->FeedbackRepository->createFeedback($params);

        if (!$feedback) {
            return $this->responseRedirectBack('Error occurred while creating Feedback.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Feedback has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $feedback = $this->FeedbackRepository->findFeedbackById($id);

        $this->setPageTitle('Feedback', 'Edit Feedback : ' . $feedback->occupation);
        return view('front.portfolio.feedback.edit', compact('feedback'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'date_from' => 'required',
            'title' => 'required',
            'rating' => 'required',
            'review' => 'required',
            'review_person' => 'required',
        ]);
        $params = $request->except('_token');
        $feedback = $this->FeedbackRepository->updateFeedback($params);

        if (!$feedback) {
            return $this->responseRedirectBack('Error occurred while updating Feedback.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Feedback has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $feedback = $this->FeedbackRepository->deleteFeedback($id);

        if (!$feedback) {
            return $this->responseRedirectBack('Error occurred while deleting Feedback.', 'error', true, true);
        }
        return redirect()->back()->with('success','Feedback field has been deleted successfully', 'success', false, false);
    }
}
