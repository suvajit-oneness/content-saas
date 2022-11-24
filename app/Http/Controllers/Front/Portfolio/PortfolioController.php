<?php

namespace App\Http\Controllers\Front\Portfolio;
use App\Http\Controllers\Controller;
use App\Contracts\PortfolioContract;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Http\Controllers\BaseController;
use App\Models\ArticleCategory;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class PortfolioController extends BaseController
{
     /**
     * @var PortfolioContract
     */
    protected $PortfolioRepository;


    /**
     * PortfolioController constructor.
     * @param PortfolioContract $PortfolioRepository
     */
    public function __construct(PortfolioContract $PortfolioRepository)
    {
        $this->PortfolioRepository = $PortfolioRepository;
    }
    public function index(Request $request)
    {
        $this->setPageTitle('Portfolio', 'Create Portfolio');
        $data = (object)[];
        $user_id = auth()->guard('web')->user()->id;
        $data->portfolios = Portfolio::where('user_id', $user_id)->get();
        $category=ArticleCategory::orderby('title')->get();
        return view('front.portfolio.portfolio.index',compact('category','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Portfolio', 'Create Portfolio');
        $category=ArticleCategory::orderby('title')->get();
        return view('front.portfolio.portfolio.create',compact('category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'short_desc' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:50'
        ]);
        $params = $request->except('_token');

        $portfolio = $this->PortfolioRepository->createPortfolio($params);

        if (!$portfolio) {
            return $this->responseRedirectBack('Error occurred while creating Portfolio.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Portfolio has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $portfolio = $this->PortfolioRepository->findPortfolioById($id);
        $category=ArticleCategory::orderby('title')->get();
        $this->setPageTitle('Portfolio', 'Edit Portfolio : ' . $portfolio->occupation);
        return view('front.portfolio.portfolio.edit', compact('portfolio','category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'short_desc' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:50'
        ]);
        $params = $request->except('_token');
        $portfolio = $this->PortfolioRepository->updatePortfolio($params);

        if (!$portfolio) {
            return $this->responseRedirectBack('Error occurred while updating Portfolio.', 'error', true, true);
        }
        // return $this->responseRedirectBack('Portfolio has been updated successfully', 'success', false, false);
        return redirect()->back()->with('success', 'Portfolio has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $portfolio = $this->PortfolioRepository->deletePortfolio($id);

        if (!$portfolio) {
            return $this->responseRedirectBack('Error occurred while deleting Portfolio.', 'error', true, true);
        }
        return redirect()->back()->with('success','Portfolio has been deleted successfully', 'success', false, false);
    }
}
