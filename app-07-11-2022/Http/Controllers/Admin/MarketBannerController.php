<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketBannerContract;
use Illuminate\Http\Request;
use App\Models\MarketBanner;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class MarketBannerController extends BaseController
{
    /**
     * @var MarketBannerContract
     */
    protected $MarketBannerRepository;


    /**
     * MarketBannerController constructor.
     * @param MarketBannerContract $MarketBannerRepository
     */
    public function __construct(MarketBannerContract $MarketBannerRepository)
    {
        $this->MarketBannerRepository = $MarketBannerRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $categories = $this->MarketBannerRepository->getSearchMarketBanner($request->term);
        } else {
            $categories = MarketBanner::all();
        }
        $this->setPageTitle('Market banner', 'List of all Market categories');
        return view('admin.market.banner.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Market banner', 'Create Market banner');
        return view('admin.market.banner.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content_heading'      =>  'required',

        ]);
        $params = $request->except('_token');

        $banner = $this->MarketBannerRepository->createMarketBanner($params);

        if (!$banner) {
            return $this->responseRedirectBack('Error occurred while creating Market banner.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.banner.index', 'Market banner has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetbanner = $this->MarketBannerRepository->findMarketBannerById($id);

        $this->setPageTitle('Market banner', 'Edit Market banner : ' . $targetbanner->title);
        return view('admin.market.banner.edit', compact('targetbanner'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'content_heading'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $banner = $this->MarketBannerRepository->updateMarketBanner($params);

        if (!$banner) {
            return $this->responseRedirectBack('Error occurred while updating Market banner.', 'error', true, true);
        }
        return $this->responseRedirectBack('Market banner has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $banner = $this->MarketBannerRepository->deleteMarketBanner($id);

        if (!$banner) {
            return $this->responseRedirectBack('Error occurred while deleting Market banner.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.banner.index', 'Market banner has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $banner = $this->MarketBannerRepository->updateMarketBannerStatus($params);

        if ($banner) {
            return response()->json(array('message' => 'Market banner status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->MarketBannerRepository->detailsMarketBanner($id);
        $banner = $categories[0];

        $this->setPageTitle('Market banner Details', 'Market banner Details : ' . $banner->title);
        return view('admin.market.banner.details', compact('banner'));
    }
}
